<div class="container-fluid">
	
	<div class="company-profile-description">
		<h4>Company </h4>
		<div class="divider"></div>
		<p class="company-profile-item"><strong>Perusahaan: </strong> <?php echo $company['company_name'] ?> </p>
		<p class="company-profile-item"><strong>Alamat: </strong> <?php echo $company['company_address'] ?></p>
		<p class="company-profile-item"><strong>Email: </strong> <?php echo $company['email'] ?></p>
		<p class="company-profile-item"><strong>Telephone: </strong> <?php echo $company['telephone'] ?></p>
	</div>

	<div>

	  	<!-- Nav tabs -->
	  	<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a class="text-uppercase" href="#list-assigned--assessment" aria-controls="home" role="tab" data-toggle="tab">Permintaan baru</a></li>
			<li role="presentation"><a class="text-uppercase" href="#list-assigned--reassessment" aria-controls="profile" role="tab" data-toggle="tab">Surveilen</a></li>
			<li role="presentation"><a class="text-uppercase" href="#list-assigned--audit-khusus" aria-controls="messages" role="tab" data-toggle="tab">Audit Khusus</a></li>
	  	</ul>
	  	
	  	<div class="tab-content" style="padding-top:15px;">
			<div role="tabpanel" class="tab-pane active" id="list-assigned--assessment"> <?php echo $this->load->view('auditor/list_assigned_auditor--assessment', array('schedule' => $a0) ) ?> </div>
			<div role="tabpanel" class="tab-pane active" id="list-assigned--reassessment"> </div>
			<div role="tabpanel" class="tab-pane active" id="list-assigned--audit-khusus"> </div>
		</div>

	</div>
</div>



<!-- <table class="table table-hover" id="assigned-auditor-table" style="width:100%;">
	<thead>
		<tr>
			<th>Auditor</th>
			<th>As</th>
		</tr>
	</thead>
</table> -->

<script type="text/javascript">
	var id_a0 = URL.get().query.a0,
		deffnewauditor = $.Deferred(); 
	window.recyclebin = {};
	window.newauditor = [];

	function openAuditorPicker(list, id_assessment)
	{
		var url = site_url('auditor/picker')+'?media=window&callback=exchange_auditor_picker_records';
		Tools.popupCenter(url,"pickAuditor",900,600)	
		window.id_assessment_active = id_assessment;	
		window.type_assessment = list;	
	}

	/*
	|-----------------------
	| Function to get data from auditor pricker
	|-----------------------
	*/
	function exchange_auditor_picker_records(data)
	{
		console.log(data)
		$.each(data, function(a,b){
			console.log(b);
			processAddAuditor(b.auditor)
		})
	}

	function get_data_auditor_assigned(list, id)
	{
		var deff = $.Deferred();
		$.post( site_url('auditor/get_auditor_assigned/'+list+'/'+id) )
	    .done(function(res){
			var body = $('[data-list="'+list+'"][data-id="'+id+'"]').find('.list-registered-auditor'),
	        	template = '<div class="list-group-item list-group-auditor-assigned auditor-assigned-::id_auditor::" data-filter="::nama_jabatan::"> <div class="checkbox" style="display:inline;"> <label><input type="checkbox" name="auditor_assigned[]" data-auditor="::fullname::" class="sr-only checkbox-auditor-assigment" value="::id_auditor::"> <i class="material-icons" style="vertical-align:middle;">account_circle</i> ::fullname:: <span class="badge" style="float:none!important;">::nama_jabatan::</span> <span class="label-status"></span> </label>  </div> <div class="btn-add-auditor" style="display:inline;float:right"> <button class="mdl-button mdl-js-button mdl-button--icon btn-action" onclick="remove_auditor_assignment_person(\'assessment\', this)"> <i class="material-icons">clear</i> <span></span> </button> </div> </div>';
	        $(body).html('');

	        res = JSON.parse(res);
	        // res = res.filter(function (r){
	        // 	return r.schedule_confirm == 1;
	        // })

	    	Tools.write_data({
	            template: template,
	            target: $(body),
	            records: res,
	            afterAppend: function(a,b,c){
	            	if(c.schedule_confirm == 0)
	            	{
	            		$(b).find('.label-status').addClass('label label-danger').text('Status: belum konfirmasi');
	            	}
	            }
	        })
	        .done(function(a,b,c){
	        	deff.resolve('');
	        })
		    
	    })
		return $.when(deff.promise())
	}

	// remove existed assignment auditor
	function remove_auditor_assignment_person(list, e)
	{
		var parents = $(e).parents('.list-group-auditor-assigned'),
			data = $(parents).data();
		$(parents).css('opacity','.5').addClass('removed').find('input[type="checkbox"]').prop('checked',true);
		$(e).attr('onclick', 'undo_remove_auditor_assignment_person("assessment", this)').find('.material-icons').text('undo')


		window.recyclebin[data.id_assessment].push({id_auditor: data.id_auditor, jabatan: data.nama_jabatan, type: list}) ;

	}

	// remove new assignement auditor
	function remove_new_auditor_assignment_person(e)
	{
		//autocomplete_new_auditor();
		$(e).parents('.list-group-new-auditor-assigned').remove();
		if( $('.list-group-new-auditor-assigned').length < 1 )
		{
	    	$('#new-auditor--legend').addClass('sr-only');
		}
	}

	// undo remove auditor assignment
	function undo_remove_auditor_assignment_person(list, e)
	{
		var parents = $(e).parents('.list-group-auditor-assigned'),
			data = $(parents).data();
		
		$(parents).css('opacity','1').removeClass('removed').find('input[type="checkbox"]').prop('checked',false);;
		$(e).attr('onclick', 'remove_auditor_assignment_person(\'assessment\',this)').find('.material-icons').text('clear');

		var id_auditor = window.recyclebin[data.id_assessment].map(function(res){ return res.id_auditor }).indexOf(data.id_auditor);
		delete window.recyclebin[data.id_assessment][id_auditor];
	}

	function autocomplete_new_auditor()
	{
		// get auditor all except assigned
		$.post(site_url('auditor/process/get/auditor'))
	    .done(function(res){
	        res = JSON.parse(res);
	        deffnewauditor.resolve(res);
	        var data = []
	        $.each(res, function(a,b){
	        	if( $('.auditor-assigned-'+b.id_auditor).length < 1  && $('.new-auditor-assigned-'+b.id_auditor).length < 1 )
	        	{
		        	data.push(b)    		
	        	}
	        })

	        // easy auto complete
	        /*$("#newdata-auditor").easyAutocomplete( {
	        	data: data, 
	        	list:{ 
	        		match:{enabled:true},
	        		onClickEvent: function() {

					} 
	        	},
	        	getValue: "fullname",
	        	template: {
					type: "custom",
					method: function(value, item) {
						return "<div> <span>"+item.fullname+"</span> <span class='badge'>"+item.nama_jabatan+"</span> </div>";
					}
				} 
	        } );*/
	    })
	}

	function addauditor()
	{
		var name =  $("#newdata-auditor").val();
		processAddAuditor(name)
	}

	function processAddAuditor(name)
	{
		$.when(deffnewauditor)
		.done(function(res){
			var data = res.filter(function(res){ return res.fullname == name });
			if(data.length > 0)
			{

				var body = $('[data-list="'+window.type_assessment+'"][data-id="'+window.id_assessment_active+'"]').find('.list-new-auditor'),
	        		template = '<div class="list-group-item list-group-new-auditor-assigned new-auditor-assigned-::id_auditor::" data-filter="::nama_jabatan::"> <div class="checkbox" style="display:inline;"> <label><input type="checkbox" name="new_auditor_assigned[]" data-auditor="::fullname::" class="sr-only checkbox-auditor-assigment" value="::id_auditor::" checked> <i class="material-icons" style="vertical-align:middle;">account_circle</i> ::fullname:: <span class="badge" style="float:none!important;">::nama_jabatan::</span> </label>  </div> <div class="btn-add-auditor" style="display:inline;float:right"> <button class="mdl-button mdl-js-button mdl-button--icon btn-action" onclick="remove_new_auditor_assignment_person(this)"> <i class="material-icons">clear</i> <span></span> </button> </div> </div>';
	        	
	        	console.log(body)

				Tools.write_data({
		            template: template,
		            target: $(body),
		            records: data
		        })
		        .done(function(res){
					//autocomplete_new_auditor();
		        	$("#newdata-auditor").val('').focus();
			    	$('#new-auditor--legend').removeClass('sr-only');

			    })
			}else
			{
				swal('Kesalahan saat menambahkan auditor', name+' tidak ditemukan di dalam daftar auditor.', 'error');
			}
		})
		.fail(function(res){
			console.log(res)
		})
	}
	// get auditor has been assigned

	function updateAuditor(list, id)
	{
		$('.btn-action').prop('disabled',true);
		var newauditor = $('[data-list="'+list+'"][data-id="'+id+'"]').find('.list-group-new-auditor-assigned input[type="checkbox"]').serializeArray().map(function(res){ return res.value });
		
		var dataUpdate = {removed: window.recyclebin[id], type: list, newdata: newauditor, id_a0: parseInt(id) } ;
		// console.log(dataUpdate, list, id); return false;

		$.post( site_url('auditor/update_auditor_assigned'),  dataUpdate)
		.done(function(res){

			console.log(res);
			$('[data-list="'+list+'"][data-id="'+id+'"]').find('.removed').remove();
			$('[data-list="'+list+'"][data-id="'+id+'"]').find('.list-group-new-auditor-assigned').remove();
			
			$('.btn-action').prop('disabled',false);
			window.recyclebin[id] = [];
			if(newauditor.length > 0)
			{
				get_data_auditor_assigned(list, id);
			}


		})
		.fail(function(res){
			console.log(res)
		})

	}

	

	$(document).ready(function(){
		$('.button-toggle-schedule').on('click', function(){
			var attrExpand = $(this).hasClass('collapsed')

			console.log(attrExpand)
			if(attrExpand){ $(this).find('.material-icons').text('expand_more') }else{ $(this).find('.material-icons').text('chevron_right') }
		})
		autocomplete_new_auditor();
		
		$('.item-schedule').each(function(){
			var $this = $(this),
				data = $this.data()
			window.recyclebin[data.id] = []

			get_data_auditor_assigned(data.list, data.id)
			.done(function(){
			})
		})

	})
	
	

</script>