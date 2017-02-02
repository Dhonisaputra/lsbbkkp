<style type="text/css">
	#list-group--detail-schedules .list-group-item-scope
	{
		cursor: pointer;
	}
	#list-group--detail-schedules .list-group-item-scope:hover
	{
		/*opacity: 0.7;*/
		background-color: rgba(218, 223, 225,.5);
	}

	.list-group-item-scope
	{
		border-left: 3px;
	}

</style>

<section class="navbar">
	<div class="pull-right">
	    <button class="mdl-button mdl-js-button btn-primary btn-tambahkan-assessment" disabled onclick="tambahkanAssessment(this)">
	        <span class="material-icons">done</span> Update
	    </button>
	    <button class="mdl-button mdl-js-button btn-danger btn-cancel-assessment" onclick="Doctab.hide()">
	         Batal <span class="material-icons">clear</span>
	    </button>
	</div>
</section>
<div class="container-fluid">
	
	<div class="row">
		<div class="alert alert-info">Tandai jadwal yang ingin di sertifikasi ulang.</div>
	</div>

	<div class="list-group " id="list-group--detail-schedules"></div>
	<div class="legend-group">
		<div class="legend-item block">
			<div class="legend-symbol" style="width:20px; background-color:#e74c3c;"></div>
			<div class="legend-description">Batas waktu sertifikasi ulang kurang dari 60 hari.</div>
		</div>
		<div class="legend-item block">
			<div class="legend-symbol" style="width:20px; background-color:#f4b350;"></div>
			<div class="legend-description">Batas waktu sertifikasi lebih dari 60 hari namun kurang dari 140 hari.</div>
		</div>
		<div class="legend-item block">
			<div class="legend-symbol" style="width:20px; background-color:#26c281;"></div>
			<div class="legend-description">Batas waktu sertifikasi masih lebih dari 140 hari.</div>
		</div>
	</div>

</div>

<script type="text/javascript">
	var isAnyChanged = []
	function tambahkanAssessment(ui)
	{
		var ar = [],arCheck = [], defer = $.Deferred();
		// check data jarak[under60, near, safe] di dalam list
		$('.list-group-item-scope').each(function(){
		 	var data = $(this).data();
		 	var isChecked = $(this).find('[type="checkbox"]').is(':checked')
		 	ar.push(data)

		 	if(isChecked)
		 	{
		 		arCheck.push( data )
		 	}
		})
		
		// check apakah didalam list ada under60
		var d0 = ar.filter(function(res){
		  return res.type_jarak == 'under60';
		})

		// check yang terpilih ada under 60
		var d1 = arCheck.filter(function(res){
			return res.type_jarak == 'under60';
		})

		// jika di d0 ada lebih dari 1 under 60 sedangkan d1 tidak memilih under60 tersebut. (min=1).
		if(d0.length > 0 && d1.length < 1)
		{
			swal({
				title: 'Terdapat jadwal yang lebih penting',
				text: 'Sistem membaca ada '+d0.length+' jadwal yang lebih penting. apakah anda yakin tetap menambahkan jadwal ini?',
				type: 'warning',
				showCancelButton: true,
				closeOnCancel: true

			}, function(isConfirm){
				if(isConfirm)
				{
					defer.resolve()
				}else
				{

				}
			})
		}else
		{
			defer.resolve();
		}

		defer.pipe(function(res){
			$('.list-group-item-scope [type="checkbox"]').each(function(){
				var data = $(this).parents('.list-group-item-scope').data();
				selected_schedules_from_modal( $(this) , data.id)
			})
			Doctab.hide();
			Snackbar.show('Jadwal ditemukan. pilih Send as Single atau Send as Group! ')
		})

	}

	/*
	* function to check is there are checkbox which has been selected. 
	* if exist, check == true
	*/
	function check_selected_onload()
	{
		records = $.sendAs.records;
		$.each(records, function(a,b){
			$('[data-assessment-type="'+b.type_schedule+'"][data-assessment-id="'+b.id+'"]').find('input[type="checkbox"]').prop('checked',true);
		} )
	}

	function selected_schedules_from_modal(ui, id)
	{
		var isChecked = $(ui).is(':checked');

		var data = $(ui).parents('.list-group-item-scope').data();

		// console.log(data)
		// check apakah data ada di log?
		isExist = $.sendAs.records.filter(function(res){
			return res.id == data.id;
		})
		if(isExist.length < 1 && !isChecked)
		{
			return false;
		}
		$.sendAs.sign(data, isChecked)

		// change sign check in table 
		var id_company = data.id_company,
			lengthOfAssessmentAssociatedWithCompany = $.sendAs.records.filter(function(res){ return res.id_company == id_company }).length;

		if( lengthOfAssessmentAssociatedWithCompany < 1 )
		{
			$('#all_schedules_notified--'+id_company).prop('checked',false).change();
		}else
		{
			$('#all_schedules_notified--'+id_company).prop('checked',true).change();
		}

		var companyLen = $.unique( $.sendAs.records.map(function(res){ return res.id_company }) )

		// Check length for send as Single
		// if( $.sendAs.records.length >= 1 )
		if( companyLen.length >= 1 )
		{
			$('#assessment-group--send-as-single').prop('disabled',false);
		}else
		{
			$('#assessment-group--send-as-single').prop('disabled',true);
		}

		// Check length for send as Group
		if( companyLen.length > 1 )
		{
			$('#assessment-group--send-as-group').prop('disabled',false);
		}else
		{
			$('#assessment-group--send-as-group').prop('disabled',true);
		}



		// if(isChecked)
		// {
		// 	$('#all_schedules_notified--'+id).prop('checked',true);
		// 	$.fn.selecting_all_schedules.add(data);
		// }else
		// {
		// 	$('#all_schedules_notified--'+id).prop('checked',false);
		// 	var data = $.fn.selecting_all_schedules.remove(data);
		// }
	}

	var isLoad = [];

	if(isLoad.length < 1)
	{
		isLoad.push('1');

		$.post(site_url('company/process/get/assessment_available'), {id_company:'<?php echo $_POST["id_company"] ?>'} )
		.done(function(data){
			if(data)
			{
				data = JSON.parse(data);
				Tools.write_data({
					target: $('#list-group--detail-schedules'),
					template: '<div class="list-group-item list-group-item-scope list-group-::id::" data-assessment-type="::type_schedule::" data-assessment-id="::id::"> <span class="material-icons pull-right sign" style="color:#4183D7">check_box_outline</span> <div class="pull-right"> <label><input class="schedules_on_company sr-only" type="checkbox" data-sendAs="::identifier::" onchange=""></label> </div> <p><strong class="label label-primary">::type_schedule::</strong> </p> <h7>::assessment_name:: </h7> <div> Jenis sertifikasi: ::type:: <br> Akan dilaksanakan pada?: ::humanize:: ::deadline_edited:: </div> <div>::execution_new_assessment::</div> </div>',

					records: data,
					dataCustom: function(res)
					{	
						var execution_date= (res.execution)? res.execution+' ('+moment(res.execution).fromNow()+' )' : 'Not Confirm yet';
						var data = {
							deadline_edited: moment(res.deadline).isValid() ? '(<strong>'+moment(res.deadline).fromNow()+' From Now</strong>)' : '', 
							execution_new_assessment: res.type_schedule == 'new assessment'? 'Execution: '+execution_date : '',
							humanize: moment(res.deadline).format('DD MMMM YYYY')
						}
						return data;
					},
					success: function(event, ui, data)
					{
						var dataFilter = $.fn.selecting_all_schedules.check(data);
						if(dataFilter.index > -1)
						{
							$(ui).find('input[type="checkbox"]').prop('checked',true)
						}
					},
					afterAppend: function(a,b,c)
					{
						var safe = '#26c281', near = '#f4b350', under60 = '#e0665a';
						var dateDiffSafe = 140, dateDiffAlert = 60
						var adiff = moment(),
							bdiff = moment(c.deadline)
							diff = bdiff.diff(adiff,'days'),
							inRecords = $.sendAs.records.filter(function(res){ return res.id == c.id });
						
						// jika ada di record property checkbox true
						if(inRecords.length > 0)
						{
							$(b).find('input[type="checkbox"]').prop('checked',true);
							$(b).find('.sign').text('check_circle');
						}else {
							$(b).find('.sign').text('check_box_outline_blank');
						}

						// penambahan warna pada masing2 jarak 
						if( diff > dateDiffSafe )
						{
							$(b).css({'border-left': '6px solid '+safe}).data({type_jarak:'safe'})
						}else if(diff < dateDiffSafe && diff > dateDiffAlert)
						{
							$(b).css({'border-left': '6px solid '+near}).data({type_jarak:'near'})
						}else if(diff < dateDiffAlert)
						{
							$(b).css({'border-left': '6px solid '+under60}).data({type_jarak:'under60'})
						}


					}
				})
				// after success append data
				.done(function(res){
					
					// check_selected_onload()
					/*check jika ada schedules yang ter-check, disabled false*/
					// if( $('.schedules_on_company:checked').length > 0)
					// { 
					// 	$('.btn-tambahkan-assessment').prop('disabled',false) 
					// }else{ 
					// 	$('.btn-tambahkan-assessment').prop('disabled',true) 
					// }

				})
			}
		})
		
	}

	$(function(){
		$('#list-group--detail-schedules').delegate('.list-group-item-scope', 'click', function(){
			var checkbox = $(this).find('[type="checkbox"]'),
				isChecked = checkbox.is(':checked')
			checkbox.trigger('click')

			if(!isChecked)
			{
				$(this).find('.sign').text('check_circle')
			}else
			{
				$(this).find('.sign').text('check_box_outline_blank')
			}

			$('.btn-tambahkan-assessment').prop('disabled',false)
		})
	})

</script>