var dataCompany = [];
// data unique
var dataUnique = [];
$.each($.sendAs.records, function(a,b){
	var dataLength = dataUnique.filter(function(res){ return res.id_company == b.id_company }).length
	if(dataLength < 1)
	{
		dataUnique.push(b);
	}
})
	
	function check_configuration()
	{
		var date = $('#assessment_collectif_date').val()
		if( date == '' )
		{
			swal('Pilih tanggal batas konfirmasi','Silahkan pilih batas tanggal kofirmasi untuk assessment secara kolektif.', 'error');
		}else
		{
			$('[role="tab"][href="#notify-as-group--tab-coordinator"]').tab('show')
		}
	}

	function notifyAsGroup_create_email_editor_each_company()
	{
		$.each($.fn.selecting_all_schedules.records, function(a,b){
			var isset = dataCompany.map(function(res){ return res.id_company }).indexOf(b.id_company);
			if(isset < 0)
			{
				dataCompany.push(b);
			}
		})


		var a = {},i = 0;
		$.each(dataCompany, function(a,b){
			var template = '<div class="form-group">'+
				'<label>Draft '+b.company_name+' email content</label>'+
				'<textarea id="editor_email_client_'+b.id_company+'" class="message_content message_content_participants" form="form-notify-as-group" name="message_content['+b.id_company+']"></textarea>'+
				'</div>';

			$('#content-editor-participant-notify-as-group [role="tablist"]').append('<li role="presentation" class=""><a href="#partisipan-group--company-'+b.id_company+'" aria-controls="home" role="tab" data-toggle="tab">'+b.company_name+'</a></li>')
			$('#content-editor-participant-notify-as-group .tab-content').append('<div role="tabpanel" class="tab-pane" id="partisipan-group--company-'+b.id_company+'" style="padding: 10px 20px;"> '+template+' </div>')
			
			var configCKEDITOR = {toolbar: [ [ 'Bold', 'Italic', 'Strike' ], [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ], [ 'Link', 'Unlink', 'Table' ] ] }

			$('.text-email-client').find('.company_name').text(b.company_name)
			var value 	= $('.text-email-client').html();
			
			
			$('#content-editor-participant-notify-as-group').find('#editor_email_client_'+b.id_company).ckeditor(function(){
				$('#content-editor-participant-notify-as-group').find('#editor_email_client_'+b.id_company).val(value)
			}, configCKEDITOR)
			
			a[i] = b;
			i++;
		})
		$('#content-editor-participant-notify-as-group a:first').tab('show')


		/*Tools.write_data({
			template: template,
			records: dataCompany,
			target: $('#content-editor-participant-notify-as-group'),
			
			afterAppend: function(event, ui, data)
			{
				$('#content-editor-participant-notify-as-group--tab [role="tablist"]').append('<li role="presentation" class=""><a href="#partisipan-group--company-'+data.id_company+'" aria-controls="home" role="tab" data-toggle="tab">'+data.company_name+'</a></li>')
				$('#content-editor-participant-notify-as-group--tab .tab-content').append('<div role="tabpanel" class="tab-pane" id="partisipan-group--company-'+data.id_company+'"></div>')
				
				
			}
		})
		.done(function(){
			$('#content-editor-participant-notify-as-group--tab a:first').tab('show')
		})*/
	}
	function notifyasgroup__write_selected_schedules()
	{
		$.each($.fn.selecting_all_schedules.records, function(a,b){
			var isset = dataCompany.map(function(res){ return res.id_company }).indexOf(b.id_company);
			if(isset < 0)
			{
				dataCompany.push(b);
			}
		})

		var template = '<div class="list-group list-group--notify-as-group"><div class="list-group-item list-group-item-assessment-notify-as-group">'
		+' <div >::company_name::</div> <div> ::company_region::,::country_name::</div>'
		+' <div class="form-group"><a class="url_detail preventDefault" href="#"> detail</a></div> '
		+'<div class="row collapse" id="collapseNotifyGroup-::id_company::" style="margin-top:20px;"> <div class="list-group list-group-assessment-item" style="margin-bottom:0px;"> </div> </div> </div></div>'
		Tools.write_data({
			template: template,
			records: dataCompany,
			target: $('.content-notify-as-group'),
			
			afterAppend: function(event, ui, data)
			{
				var url = site_url('assessment/data_detail_certification/reassessment/'+data.id);
				$(ui).find('.url_detail').attr('onclick', "Tools.popupCenter(\'"+url+"\',\'detailRequest\',500,500)");
				
			}
		})
	}

	function remove_schedule_in_notify_as_group(id,id_company)
	{
		var data = $('#list-group-item-notify-as-group-schedules-'+id_company+id).data()
		$('#all_schedules_notified--'+id).trigger('click');
		$('#list-group-item-notify-as-group-schedules-'+id_company+id).remove();
		Snackbar.show(data.type_schedule+' '+data.certificate+' removed from group assessment.')

	}

	// submit data notify as group
	function submit_notify_as_group(event, form)
	{
		event.preventDefault();

		var date = $('#assessment_collectif_date').val(), 
			data = {
				items: $.sendAs.records, 
				date: date,
				emailContent: {},
				coordinator_email_content: {subject: 'Pemberitahuan sebagai koordinator assessment ', content: $('#email-text-coordinator-notify-as-group').val()},
				coordinator_name: $("#input-coordinator-name-notify-as-group").val(),
				coordinator_email: $("#input-email-coordinator-notify-as-group").val(),
				company: dataUnique
			}

			$.each(data.company, function(a,b){
				var companyEmail = $('[name="message_content['+b.id_company+']"]').val();
				data.emailContent[b.id_company] = companyEmail;
			})

		// Doctab.toggle();
		swal({title: 'Sedang mengirimkan data', text: 'Silahkan tunggu!', type:'info', showConfirmButton: false, allowEscapeKey: false })
		

		$.post(site_url('assessment/process/post/assessment/collective'), data)
		.done(function(res){
			refreshMainTable();
			Doctab.hide();
			// give alert
			swal({title: 'Jadwal assessment telah dikirim',text:'Jadwal assessment telah dikirimkan kepada koordinator dan perusahaan.',type:'success', function(res){
				
			}} );
			// reset Doctab
			// close snackbar
			Snackbar.hide('#snackbarTemp')
		})
		.error(function(res){
			console.log(res)
			// give alert
			swal('Kesalahan saat pengiriman','Sepertinya terdapat kesalahan saat melakukan pengiriman permintaan anda. mohon laporkan kesalahan ini pada administrator LSBBKKP', 'error');
			// close snackbar
			Snackbar.hide('#snackbarTemp')
		})
	}

	$(document).ready(function(){

		
		// initialize assessment collectife date
		$('#assessment_collectif_date').datetimepicker({
			timepicker:false,
			minDate:0,
			format:'d/m/Y',
			lang: 'id',
			onSelectDate: function(ct, inp)
			{
				var date = moment(ct).format('DD/MM/YYYY');
                $('.fixed_assessment_collectif_date').text(date);
			}
		});

		notifyasgroup__write_selected_schedules();

		// initialize ckeditor
		$('#email-text-coordinator-notify-as-group' ).ckeditor(function(){

		}, {
			toolbar: [ [ 'Bold', 'Italic', 'Strike' ], [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ], [ 'Link', 'Unlink', 'Table' ] ] 
		});
		notifyAsGroup_create_email_editor_each_company();
		// CKEDITOR.replace( 'email-text-client-notify-as-group' );

		// check if finishing tab is show
		$('[data-toggle="tab"][href="#notify-as-group--tab-finishing"]').on('show.bs.tab', function (e) {
			// check apakah data sudah diisi semua
			if($("#input-coordinator-name-notify-as-group").val() === '' || $("#input-email-coordinator-notify-as-group").val() === '')
			{
				swal('Kesalahan saat pengisian koordinator', 'Nama dan email koordinator tidak boleh kosong!', 'error');

				$('[href="#notify-as-group--tab-coordinator" ]').tab('show');

				return false;
			}
			Tools.write_data({
				records: $.sendAs.records,
				template: '<div class="list-group-item list-group-item--notify-as-group--finishing-client-item">::company_name:: ::company_region::, ::country_name:: <div>schedule: ::type_schedule:: ::certificate::</div> </div>',
				target: $('.list-group--notify-as-group--finishing-client-list'),
				beforeWrite: function(event, target, records)
				{
					$('.list-group-item--notify-as-group--finishing-client-item').remove();
				}
			})
		});

		// check if coordinator tab show
		$('[data-toggle="tab"][href="#notify-as-group--tab-coordinator"]').on('show.bs.tab', function (e) {

			if($.sendAs.records.length < 1)
			{
				swal('Tidak ada jadwal yang ditambahkan','Sistem mendeteksi tidak ada jadwal yang dipilih. Silahkan pilih jadwal terlebih dahulu!', 'error');
				Modal.hidden();
				return false;

			}

			// create autocomplete
		  	var options = {
				data: dataUnique,

				getValue: "company_name",
				template: {
					type: "custom",
					method: function(value, item) {
						return "<div> <span>"+item.company_name+"</span> <strong class=''>"+item.email+"</strong> </div>";
					}
				},
				list: {
					match: {
						enabled: true
					},
					onChooseEvent: function()
					{
						var input = $("#input-coordinator-name-notify-as-group")
						var data = $.sendAs.records.filter(function(res){ return res.company_name == input.val() })[0]
						// $("#input-email-coordinator-notify-as-group").prop('readonly',true).val(data.email)
						$("#input-email-coordinator-notify-as-group").val(data.email).focus()
						$('.fixed_coordinator_name').text( data.company_name );
						$('.fixed_coordinator_email').text(data.email)
						.each(function(){
							$('.message_content_participants').val($('.text-email-client').html())
						})
						$('#email-text-coordinator-notify-as-group').val($('.text-email-coordinator').html())

					}
				}
			};

			$("#input-coordinator-name-notify-as-group").easyAutocomplete(options);

			// generate content email
			
			Tools.write_data({
				target: $('.table-email--company-list tbody'),
				records: dataUnique,
				template: '<tr> <td  style="border: 1px solid black; border-collapse: collapse;padding:5px;">::company_name::</td> <td  style="border: 1px solid black; border-collapse: collapse;padding:5px;"><a href="mailto:::email::"> ::email:: </a></td> <td  style="border: 1px solid black; border-collapse: collapse;padding:5px;">::telephone::</td> </tr>',
				beforeWrite: function(event, target, records)
				{
					$(target).html('');
				}
			})
			.done(function(){
				$('.message_content_participants').val($('.text-email-client').html())
				$('#email-text-coordinator-notify-as-group').val($('.text-email-coordinator').html())
			})
		})
		
		// on change name coordinator
		$("#input-email-coordinator-notify-as-group").on('blur change', function(){
			$('.fixed_coordinator_email').text( $(this).val() )
			$('.message_content_participants').val($('.text-email-client').html())
			
		})

		$("#input-coordinator-name-notify-as-group").on('input change', function(){
			$('#input-email-coordinator-notify-as-group').prop('readonly',false).val('');
			var coordinator = $(this).val();
			$('.fixed_coordinator_name').text(coordinator);

			$('.message_content_participants').val($('.text-email-client').html())
				$('#email-text-coordinator-notify-as-group').val($('.text-email-coordinator').html())
		})
	})