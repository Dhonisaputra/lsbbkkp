/*
|-----------------------
| Fungsi untuk memilih semua auditor dari assignment-tab
|-----------------------
*/	
function checkbox_selectAll_auditor(ui, id_jabatan)
{
	var is_check = $(ui).is(':checked');
	var table = $('#table--auditor-assignment--auditor-list-'+id_jabatan).DataTable().cells( ).nodes();
	if(is_check)
	{
		$(table).find('[type-button="select_auditor"]:not(.auditor-assignment--selected)').trigger('click');
	}else
	{
		$(table).find('.auditor-assignment--selected[type-button="select_auditor"]').trigger('click');
	}
}

function asLeader(key, auditor)
{
	$.Auditor.Assigned_records[key].leader = auditor;
}
/*
|--------------------------
| fungsi untuk mengganti counter kebutuhan auditor per-semua permintaan dan per-masing-masing permintaan
|--------------------------
*/
function update_auditor_requirement(ui)
{
	if(!window._dataCounterRequest)
	{
		window._dataCounterRequest = [];		
	}

	var $this 		= $(ui) // button add auditor
		,$parents 	= $this.closest('.list-group-item-auditor-placement') // closest parent yang mengampu data auditor. serupa dengan tr
		,$checkbox 	= $parents.find('input[type="checkbox"]') // checkbox auditor
		,$data 		= $parents.data() // data dari parent
		,$system 	= $data.group_system.split(',') // group system dari auditor 
		,$type 		= $data.group_type.split(',') // type dari group system
		,$records 	= $.fn.auditor_placement.records // record auditor placement

	$('.auditor--request.auditor--request--competency').each(function(res){
		var data = $(this).data();
		if(!window._dataCounterRequest[data.type])
		{
			window._dataCounterRequest[data.type] = 0;		
		}

		var $requested = data.competency_requested.split(', ');			

		var is_competent = $requested.diff($system); 

		console.log(is_competent, $(this).find('#audit_time--auditor_that_can_add').text(), data)

		if(is_competent.length > 0)
		{
			var num  = parseInt( $(this).find('#audit_time--auditor_that_can_add').text() );

			if( $checkbox.is(':checked') )
			{
				window._dataCounterRequest[data.type] = window._dataCounterRequest[data.type] + 1;
			}else
			{
				window._dataCounterRequest[data.type] = window._dataCounterRequest[data.type] - 1;
			}
			counter = window._dataCounterRequest[data.type];
			counter = (counter < num)? counter : num;
			counter = (counter > 0)? counter : 0;
			$(this).find('.audit_time--counter').text(counter)
		}

	})

	var $counter = $('.tab-content--auditor-placement input[type="checkbox"]:checked');
	var $counterSerialize = $counter.serializeArray().map(function(res){ return res.value })
	var $Assigned_records = []
	$.each($.Auditor.Assigned_records, function(a,b){

		$.each(b.auditor, function(c,d){
			$Assigned_records.push(parseInt(d) )
		})
	})
	$.unique($Assigned_records)

	$('.auditor--needed-all .audit_time--counter').text($counter.length)

	var table = $('.table-choose-placement-auditor ').DataTable().cells( ).nodes();

	// jika jumlah counter == jumlah kebutuhan ATAU ( jika jumlah auditor yang sudah didaftarkan + jumlah auditor yang dipiih >= jumlah kebutuhan DAN  ) # bagian ini hanya digunakan ketika edit auditor
	if($counter.length  == parseInt($('.auditor--needed-all #audit_time--auditor_that_can_add').text())/* || ( $Assigned_records.length + $counter.length >= parseInt($('.auditor--needed-all #audit_time--auditor_that_can_add').text()) && )*/ )
	{
		// disable semua auditor kecuali PPC

		$(table).find('.btn-configure-auditor:not([data-jabatan="PPC"]):not(.auditor-placement--selected)').prop('disabled',true);

	}else
	{
		// enable semua auditor
		$(table).find('.btn-configure-auditor:not([data-jabatan="PPC"]):not(.auditor-placement--selected)').prop('disabled',false);
	}
	
	// lalu lihat records yang ada pada auditor yang sudah didaftarkan. 
	$.each($Assigned_records, function(a,b){
		$('[data-id_auditor="'+b+'"] .btn-configure-auditor').prop('disabled',false);					
	})
	
}

/*
|---------------------
| Fungsi setelah perusahaan yang tersedia dipilih
|---------------------
*/
function selectCompanyPlacement(ui)
{
	var $this 	= $(ui),
		$parent = $this.parents('.auditor_placement--selected-company-list'),
		$sign	= $parent.find('.sign'),
		$signText	= $parent.find('.sign-text'),
		isCheck	= $this.is(':checked')
		// console.log($sign, $parent, $this, isCheck)
		if(isCheck)
		{
			$sign.text('check_box');
			$sign.addClass('active');
			// $signText.addClass('active').text('terpilih');
		}else
		{

			$sign.text('check_box_outline_blank');
			$sign.removeClass('active');
			// $signText.removeClass('active').text('');
		}

}
/*
|------------------
| Fungsi yang di trigger setelah auditor di update dan masuk ke halaman review
|------------------
*/
function prepareReview()
{
	// jika belum ada perusahaan yang terpilih
	if( $('.placement_company_list:checked').length < 1 )
	{
		swal({title: 'Perusahaan belum dipilih', text: 'Silahkan Pilih perusahaan terlebih dahulu!', type: 'error'}, function(e){
			// kembali ke halaman placement
			$('[href="#auditor-assignment--tab--placement-auditor"]').tab('show')
			return false;

		})


	}

	if( $('.tab-content--auditor-placement input[type="checkbox"]:checked').length < 1 )
	{
		swal({title: 'Auditor belum ada yang dipilih', text: 'Silahkan Pilih auditor terlebih dahulu!', type: 'error'}, function(e){
			// kembali ke halaman placement
			$('[href="#auditor-assignment--tab--placement-auditor"]').tab('show')
			return false;

		})
	}

	// serialize data
	var $auditor = $('.tab-content--auditor-placement .list-group-item-auditor input[type="checkbox"]:checked').serializeArray().map(function(res){ return res.value });
	var $company = $('.placement_company_list:checked').serializeArray().map(function(res){ return res.value });

	// assign auditor dan perusahaan
	$.Auditor.assigned($company, $auditor);

	// sembunyikan perusahaan yang sudah dipilih
	$('.placement_company_list:checked').each(function(){
		var value = $(this).val();
		$('#selected-company--'+value).hide();
		$('#selected-company--'+value+' .material-icons.sign.active').trigger('click');
	})
}
/*
|-------------------
| Fungsi untuk menormalkan kembali auditor yang sudah dipilih
|-------------------
*/
function normalize_auditor_placement()
{
	// $('.tab-content--auditor-placement .auditor-placement--selected[type-button="select_auditor"]').trigger('click')
	var table = $('.table-choose-placement-auditor').DataTable().cells( ).nodes();
	$(table).closest('.auditor-selected').removeClass('sr-only');
	$(table).find('.auditor-placement--selected[type-button="select_auditor"]').trigger('click');
}
/*
|---------------
| Trigger when reset button in review auditor fired;
|---------------
*/
function resetAssignedAuditor(ui)
{
	swal({   
		title: "Menghapus semua auditor yang sudah ditambahkan",   
		text: "apakah anda yakin ingin menghapus semua auditor yang sudah ditambahkan? anda harus memilih kembali perusahaan!",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, Hapus auditor!",   
		closeOnConfirm: true 
	}, 
	function(){   
		$.Auditor.Assigned_records = [];
		$('#review-placement').html('');
		$('.btn-assign-other-auditor').prop('disabled', false);

		// normalkan kembali auditor
		normalize_auditor_placement();
		
		// uncheck company
		$('.auditor_placement--selected-company-list').show();
		$('.auditor_placement--selected-company-list .material-icons.sign.active').trigger('click');
		
		// kembali ke halaman placement
		$('[href="#auditor-assignment--tab--placement-auditor"]').tab('show')
		
		// reset 
		delete window._dataCounterRequest;

		// reset ke 0
		$('.audit_time--counter').text(0)
	});
}

// E N D  O F  F U N C T I O N ///////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
	if(URL.get().query.type_coordination == 'group')
	{
		$('#tablist-auditor-assignment--jabatan a:first').tab('show');	
	}
	$('#tablist-auditor-placement--jabatan a:first').tab('show');	

	/*do ketika tab #auditor-assignment--tab--placement-auditor show*/
	$('[href="#auditor-assignment--tab--placement-auditor"]').on('show.bs.tab', function (e) {

		var before = $(e.relatedTarget).data()
		// selalu tampilkan tab pertama
		// aktifkan tab pertama
		// 
		if(before && before.tab === 'review')
		{
			$.fn.auditor_placement.refreshAuditorAssigned()

			$('[name="placement_company_list[]"]').each(function(){
				var val = parseInt($(this).val() );
				if( $.fn.auditor_placement.checkDraft(val) >= 0 )
				{
					$(this).prop('checked',false);
					$('#selected-company--'+val).addClass('sr-only')
				}else
				{
					$('#selected-company--'+val).removeClass('sr-only')
				}
			})
	        
		}else
		{
			if(URL.get().query.type_coordination == 'group')
			{

				$('.tab-content--auditor-placement .list-group-item-auditor').show();

				$('.tab-content--auditor-placement .list-group-item-auditor').each(function(e){
					var data = $(this).data();
					var records = $('[name="auditor_assignment[]"]:checked');
					var isSelected = records.serializeArray().map(function(res){
						return parseInt( res.value )
					}).indexOf(data.id_auditor);

					if(isSelected < 0)
					{
						$(this).hide();
					}else
					{
						$(this).addClass('auditor-selected')
					}


				})

			}
		}
	})
	$('a[href="#auditor-assignment--tab--auditor-choose"][data-toggle="tab"]').on('show.bs.tab', function (e) {
		if(URL.get().hash.type=='group')
		{
			if($('[type-button="select_auditor"]').length < 1)
			fetch_auditor()
			.done(function(res){
				// console.log(res)
				swal('Data kolektif assessment selesai di load','Data perusahaan yang mengikuti assessment secara kolektif telah selesai di-load','success');
				$('#tablist-auditor-assignment--jabatan a:first').tab('show');
	        })
		}
        
    })



	/*
	|
	| Fungsi trigger ketika tab review dibuka
	|
	*/
	$('[href="#auditor-assignment--tab--review-assigned-auditor"][data-toggle="tab"]').on('shown.bs.tab', function (e) {
		// reset auditor placement
		$('#auditor-assignment--tab--review-assigned-auditor #review-placement').html('')

		// define template
        var template = 	'<div class="list-group list-group-assigned-auditor">'
				        +'<div class="list-group-item company-name"> '
				        +'<div class="pull-right btn-group" role="group" aria-label="..."> <button type="button" class="btn btn-default btn-edit--review-list" href="#auditor-assignment--tab--placement-auditor" aria-controls="compose auditor" data-tab="choose" role="tab" data-toggle="tab">Edit</button> <button type="button" class="btn btn-default btn-remove--review-list" >hapus</button>  </div>'
				        +'<p>Perusahaan : <strong class="company_name"></strong></p> '
				        +'</p></div></div>';

		// jika $.Auditor.Assigned_records == jumlah perusahaan, disable tambahkan perusahaan lain
		if($.Auditor.Assigned_records.length == $('.auditor_placement--selected-company-list').length )
		{
			// disable tombol 
			$('.btn-assign-other-auditor').prop('disabled',true);
		}

		// tuliskan auditor assigned records
        $.each($.Auditor.Assigned_records, function(a,b){
        	var ui = $(template)
        	$(ui).attr({'id':'review-company--'+b.company, 'data-key': b.key, 'data-company': b.company})
			
			// define company
        	var $company_name = $('#selected-company--'+b.company+' .company_name').text()
        	// tuliskan company name
        	$(ui).find('.company_name').text($company_name)
        	
        	// append ui
        	$('#auditor-assignment--tab--review-assigned-auditor #review-placement').append(ui)
        	.each(function(){

        		/*------------------------ TUliskan auditor ----------------------------*/
        		var auditorlist = $('<div class="list-group-item auditor-assigned"> <p>Auditor : </p> <ul class="list-group"> </ul> </div>');
        		$.each(b.auditor, function(c,d){    			
        			var auditor = $('.list-group-item-auditor[data-id_auditor="'+d+'"]').data();
        			$(auditorlist).find('ul').append('<li class="list-group-item" style="display:flex;justify-content:space-between"> <div>'+auditor.nama_auditor+' <span class="badge">'+auditor.nama_jabatan+'</span> </div> <div class="radio"> <label> <input type="radio" id="company--'+b.company+'--leader" value="'+d+'" name="company--'+b.company+'" onclick="asLeader('+a+','+d+')"> As Leader </label> </div>  </li>');
        		})
        		$(ui).append(auditorlist);
        		/*------------------------ End Of TUliskan auditor ----------------------*/
        	

        	})
        })
	})

	$(document).on('click', '.btn-edit--review-list', function(e){
		var $this 		= $(this)
			,$parents 	= $this.closest('.list-group')
			,$data 		= $parents.data()
			,$records 	= $.Auditor.Assigned_records.filter(function(res){return res.key == $data.key})[0]
			,$index 	= $.Auditor.Assigned_records.map(function(res){return res.key}).indexOf($data.key)
		

		// tampilkan kembali company yang di edit dan jadikan hijau
		$('#selected-company--'+$data.company).show();

		// check berapa jumlah auditor yang sudah dijumlahkan
		var $Assigned_records = []
		$.each($.Auditor.Assigned_records, function(a,b){

			$.each(b.auditor, function(c,d){
				$Assigned_records.push(d)
			})
		})
		$.unique($Assigned_records)

		// normalkan kembali auditor
		normalize_auditor_placement();
		
		if($Assigned_records.length  >= parseInt( $('.audit_time--counter').text() ) )
		{
			
			$('.btn-configure-auditor:not(.auditor-placement--selected):not([data-jabatan="PPC"])').prop('disabled',true);

			$.each($Assigned_records, function(a,b){
				$('.list-group-item-auditor-placement[data-id_auditor="'+b+'"] .btn-configure-auditor').prop('disabled',false);					
			})	

		}

		// lalu tandai auditor yang telah ditambahkan pada records terkait.
		$.each($records.auditor, function(a,b){
			$('.list-group-item-auditor-placement[data-id_auditor="'+b+'"] [type-button="select_auditor"]').trigger('click')
		})

		// click baris perusahaan yang di edit
		$('#selected-company--'+$data.company+' .material-icons.sign').trigger('click');


		// kembali ke halaman placement
		$('[href="#auditor-assignment--tab--placement-auditor"]').tab('show')

		// hapus data yang lama
		$.Auditor.Assigned_records.splice($index,1);
	})

	/*
	|----------------------
	| Function remove auditor assigned
	|----------------------
	*/
	$(document).on('click', '.btn-remove--review-list', function(e){

		var $this 		= $(this)
			,$parents 	= $this.closest('.list-group')
			,$data 		= $parents.data()
			,$records 	= $.Auditor.Assigned_records.filter(function(res){return res.key == $data.key})[0]
			,$index 	= $.Auditor.Assigned_records.filter(function(res){return res.key}).indexOf($data.key)

		swal({
			title: 'Hapus auditor yang ditambahkan?',
			text: 'Apakah anda yakin akan menghapus auditor yang sudah ditugaskan ini?',
			type: 'warning',
			showCancelButton:true,
		}, function(e){
			if(e)
			{

				// pertama hapus terlebih dahulu data yang lama
				$.Auditor.Assigned_records.splice($index,1);

				// tampilkan kembali company yang di edit dan jadikan hijau
				$('#selected-company--'+$data.company).show();

				// normalkan kembali auditor
				normalize_auditor_placement();

				//hapus element list-group-assigned-auditor
				$this.closest('.list-group-assigned-auditor').remove(); 

				// aktifkan tombol assign other auditor
				$('.btn-assign-other-auditor').prop('disabled',false);

				// uncheck company
				$('#selected-company--'+$data.company+' .material-icons.sign.active').trigger('click');

				// jika assigned auditor habis
				if($('.list-group-assigned-auditor').length == 0)
				{
					// kembali ke halaman placement
					$('[href="#auditor-assignment--tab--placement-auditor"]').tab('show')
				}


			} // end of if
		})

	})
	/*
	|---------------------
	| Fungsi eksekusi setelah user melakukan "tambahkan perusahaan lain"
	|---------------------
	*/
	$('.btn-assign-other-auditor').on('click', function(){
        
		// check berapa jumlah auditor yang sudah dijumlahkan
		var $Assigned_records = []
		$.each($.Auditor.Assigned_records, function(a,b){

			$.each(b.auditor, function(c,d){
				$Assigned_records.push(d)
			})
		})
		$.unique($Assigned_records)

		// normalkan kembali auditor
		// normalize_auditor_placement();
		var table = $('.table-choose-placement-auditor').DataTable().cells( ).nodes();
	
		$(table).closest('.list-group-item-auditor-placement:not([data-jabatan="PPC"])').addClass('sr-only');
		
		if($Assigned_records.length  >= parseInt( $('#audit_time--auditor_that_can_add').text() ) )
		{			

			$.each($Assigned_records, function(a,b){
				$(table).closest('.list-group-item-auditor-placement[data-id_auditor="'+b+'"]').removeClass('sr-only')		
				$(table).closest('.list-group-item-auditor-placement[data-id_auditor="'+b+'"]').find('input[type="checkbox"]').prop('checked',false)					
				$(table).closest('.list-group-item-auditor-placement[data-id_auditor="'+b+'"]').find('.btn-configure-auditor .material-icons').text('person_add')
			})	

		}



	})

	$('.btn-submit-assigned-auditor').on('click', function(e){
		var $data = $.Auditor.Assigned_records

		// check apakah ada yang belum diisi auditor
		var unLeadered = $data.filter(function(res){ return !res.leader });
		if ( unLeadered.length > 0 )
		{
			swal({
				title: 'Belum ada leader',
				text: 'Ada kelompok auditor yang belum anda pilih leader. pilih leader terlebih dahulu!',
				type: 'error'
			})
			return false;
		}
		swal({
			title: 'Menyimpan auditor',
			text: 'Mohon tunggu. Sedang menyimpan auditor',
			allowEscapeKey:false,
			showConfirmButton: false,
		})

		$.post( site_url('auditor/process/post/auditor_assignment'), {data: $data} )
		.done(function(res){

			swal({   
                title: "Auditor telah ditambahkan",   
                text: "Auditor telah ditambahkan pada perusahaan yang terpilih!",   
                type: "info",   showCancelButton: false,   closeOnConfirm: true,   showLoaderOnConfirm: false,   

            // on alert clicked
            }, function(){  
				
				$.each( $.Auditor.Assigned_records, function(a,b){
					$( '#selected-company--'+b.company ).remove();
				} )

				$('#auditor-assignment--tab--review-assigned-auditor #review-placement').html('')

                // reset  data assigned records
                $.Auditor.Assigned_records = []

                normalize_auditor_placement();


                // jika company masih ada
				if($('.auditor_placement--selected-company-list').length > 0)
				{
					// kembali ke halaman placement
					$('[href="#auditor-assignment--tab--placement-auditor"]').tab('show')
				}else
				{
					// nav.back();
					window.opener.refreshMainTable()
					window.close();
				}

			});
		})
		.fail(function(res){
			console.log(res)
		})
	})


})


