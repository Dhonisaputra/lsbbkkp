var deffCountry = $.Deferred();

function add_contact()
{
	$('#components-content').find('.list-group-contact').clone().appendTo('#section--company-contact').each(function(){

		var len = $('#section--company-contact .list-group-contact').length
		$(this).find('.contact_no').text(len);
		$(this).find('.form-required').prop('required',true);
		$(this).find('input:nth(0)').focus();
	});
}

function get_country_data()
{
	var url = site_url('clients/process/get/countries');
	$.get(url)
	.done(function(response){
		response = JSON.parse(response);
		deffCountry.resolve(response);

		Tools.write_data({
			records: response,
			template: '<option value="::country_name::">',
			target: '#datalist--country'
		})
	})
	.error(function(res){
		$.post(site_url('developers/send_error'),{ message:'error ketika mengambil data negara pada company create!' })
	})
}
		// function getCertification()
		// {
		// 	$.get('controllers/certification/getCertification.php')
		// 	.done(function (response){
		// 		response = JSON.parse(response);
		// 		$.each(response, function(a,b){

		// 			var template = '<option value="'+b.audit_reference+'"> '+b.name+' </option>'
		// 			$('#certification_category').append(template);

		// 		})
		// 	})
		// }

		function prepareNewCompany(event)
		{
			event.preventDefault();
			swal({
				title: 'Simpan perusahaan',
				text: 'Apakah data perusahaan sudah benar? anda tidak dapat mengganti data selama proses penyimpanan.',
				type: 'warning',
				showCancelButton: true,
				closeOnCancel: true,
				closeOnConfirm: false,
				allowEscapeKey: false,
			}, function(res){
				if(res)
				{
					swal({   title: "Menyimpan perusahaan",   text: "Sedang menyimpan perusahaan. Silahkan tunggu beberapa saat!",   type: "info", allowEscapeKey: false,   showConfirmButton: false});
					newCompany(event)
				}
			})
		}
		function newCompany(event)
		{


			event.preventDefault();
			var action = $(event.target).attr('action'), data = $(event.target).serializeArray();
			if( $(event.target).find('.list-group-contact').length < 1 )
			{
				swal('Kontak masih kosong','Silahkan tambahkan minimal 1 kontak!', 'error');
				event.preventDefault();
				return false;
			}
			$.post(action, data)
			.done(function(response){
				
				response = JSON.parse(response);
				if(response.success == true)
				{

					// SEND NOTIFICATION
					Notify.send({notification_for_level:1, notification_text: response.company_name+' telah mendaftarkan perusahaan nya kedalam sistem LSBBKKP.'})

					event.target.reset()
					swal({   title: "Perusahaan berhasil ditambahkan",   text: "Perusahaan telah selesai ditambahkan. Silahkan periksa email perusahaan anda!",   type: "success",   showConfirmButton: true}, function(){
						if( $('#redirect_after_submit').is(':checked') )
						{    					
							window.location.replace('<?php echo site_url("certification/add/'+response.id_company+'") ?>');
						}else{
							// event.target.reset();
							if(!window.cookie)
							{
								window.close();
								return false;
							}
							$('[data-toggle="tab"][href="#company-create--index"]').tab('show')
						}
					});

					// nav.to({url:'#!stage/certificate&company='+response.id_company})
					// $('#panel--company--certification').load(site_url('certification/adding_certification__no_template/'+response.id_company) )
					// $('[href="#panel--company--certification"]').tab('show');
				}else
				{
					swal('Perusahaan gagal ditambahkan','Kesalahan saat menambahkan perusahaan. kemungkinan dikarenakan koneksi anda atau server yang kurang stabil. Silahkan ulangi tambah perusahaan.', 'error')
				}
			})
			.error(function(res){
				swal('error', res.statusText, 'error');
				// alert('save company error. please check process save company!. call our developers instead!')
				
			})

		}

		function get_province_data()
		{
			var def = $.Deferred();
			$.post(site_url('application/components/json/province.json'))
			.done(function(resProv){
				def.resolve(resProv)
			})
			
			.fail(function(resProv){
				console.log(resProv)
			})
			return $.when(def);
		}

		
		$(function(){
			
			// getCertification();
			get_country_data();

			$('#company_country[list="datalist--country"]').on('change', function(event){
				var ui = $(this)
				if(ui.val() !== '')
				{
					

					$.when(deffCountry).done(function(res){
						var data = res.filter(function(res){ return res.country_name == $(ui).val() })[0];
						// console.log(data);
						
						if(data && data['id_country'])
						{
							Snackbar.manual({message: 'Mengambil daftar provinsi', spinner:true})
							get_province_data()
							.done(function(resProv){
								$('#datalist--province').html('');
								Tools.write_data({
									records: resProv[data['callingCodes']],
									template: '<option value="::label::">',
									target: '#datalist--province'
								})
								.done(function(){
									Snackbar.show('Provinsi selesai diambil');
								})
							})

							$('input[name="country_code"]').val(data['id_country']);
							$('#addon--handphone-area').text('+'+data['callingCodes']);
							$('#addon--fax').text('+'+data['callingCodes']);
						}

					})
				}else
				{
					$('input[name="country_code"]').val('');
					$('#addon--handphone-area, #addon--fax').text('+~~');
				}
			})


			$('#company_province[list="datalist--province"]').on('change', function(event){
				var $this = $(this)

				Snackbar.manual({message: 'Mengambil daftar kabupaten / kota', spinner:true})
				
				get_province_data()
				.done(function(resProv){
					var callingCodes = parseInt( $('#addon--handphone-area').text() );
					var province = $('#company_province').val();

					resProvINdex = resProv[callingCodes].map(function(res){
						return res.label
					}).indexOf(province)

					$('#datalist--city').html('');
					
					Tools.write_data({
						records: resProv[callingCodes][resProvINdex]['regencies'],
						template: '<option value="::label::">',
						target: '#datalist--city'
					})
					.done(function(){
						Snackbar.show('Kab / Kota selesai diambil');
					})
				})
			})

			$('input[name="company_email"]').on('change', function(event){
				Snackbar.manual({message:'Melakukan pengechekan ketersediaan email', spinner:true});
				var email = $(this).val(),
				ui = $(this);
				$.post(site_url('company/get_check_availability_company_email'), {email: email})
				.done(function(a,b,c){
					Snackbar.show('Email tersedia!');
				})
				.error(function(res){
					Snackbar.show('Email ini sudah digunakan');
					swal({
						title: 'Email sudah terdaftar dalam sistem LSBBKKP',
						text: 'Maaf, '+email+' telah digunakan pada sistem LSBBKKP. Silahkan anda check terlebih dahulu penulisan email anda. Jika peringatan ini tetap muncul, silahkan check perusahaan dengan email tersebut pada halaman daftar perusahaan atau tanyakan pada admin LSBBKKP!.',
						type: 'error',
					},
					function(res){
						if(res)
						{
							$(ui).val('').focus();
						}
					});
				})
			})

			$('#btn-reset-pendaftaran-perusahaan').on('click', function(){
				$contact = $('#section--company-contact .list-group-contact'),
				$contactLen = $contact.length

				if($contactLen > 0)
				{
					$contact.remove();
				}
			})

			$('[data-toggle="tab"][href="#company-create--summary"]').on('shown.bs.tab', function (e) {
			  	e.target // newly activated tab
			  	e.relatedTarget // previous active tab
			  	console.log(e)
			  	$('form').serializeArray();
			})

		})