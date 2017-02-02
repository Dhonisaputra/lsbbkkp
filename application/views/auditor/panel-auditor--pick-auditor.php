<?php echo $this->load->component('js', 'jsdata/jsdata.auditor_assignment.js') ?>

	
<div class="row" id="window--pick-auditor" style="padding-top:10px;">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs " role="tablist" id="tablist-auditor-assignment--jabatan">
		<?php foreach ($jabatan as $jkey => $jvalue) { ?>
			<li role="presentation" class=""><a href="#choose-auditor--tab--jabatan-<?php echo $jvalue['id_jabatan'] ?>" class="text-uppercase" aria-controls="<?php echo $jvalue['nama_jabatan'] ?>" role="tab" data-toggle="tab"><?php echo $jvalue['nama_jabatan'] ?></a></li>
		<?php } ?>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content" style="padding-top:10px;">
		<?php foreach ($jabatan as $jkey => $jvalue) { ?>
			<div role="tabpanel" class="tab-pane col-md-12" id="choose-auditor--tab--jabatan-<?php echo $jvalue['id_jabatan'] ?>">
				<!-- <div class="form-group">
					<input class="form-control filter-auditor" id="filter-auditor-assignment-<?php echo $jvalue['id_jabatan'] ?>" placeholder="filter auditor">
				</div> -->
				
				<div class="list-group" id="auditor-assignment--auditor-list-<?php echo $jvalue['id_jabatan'] ?>" style="height:300px; overflow-y:auto"></div>
				
			</div>
		<?php } ?>
	</div>

</div>

<?php 
	switch ($_REQUEST['media']) {
		case 'doctab':
			$callback = "Doctab.exchangeData.set('pick-auditor--records',$.fn.auditor_assignment.records);nav.back()";
			break;
		case 'window':
			$callback = 'passing_data_to_callback();window.close()';
			break;
		
		default:
			break;
	}
?>
<button class="mdl-button mdl-js-button btn btn-primary pull-right" onclick="<?php echo isset($callback)? $callback : '' ?>"> <i class="material-icons">save</i> Selesai </button>

<script type="text/javascript">
	// make function from callback
	<?php 
		if(isset($_REQUEST['callback']))
		{
	?>
	function passing_data_to_callback()
	{
		var data = $.fn.auditor_assignment.records;
		window.opener['<?php echo $_REQUEST["callback"] ?>'](data);
	}	
	<?php } ?>

	/*
	|-------------------
	| function send shake to parent when close
	|-------------------
	*/
	function inform_parent(){
		var data = $.fn.auditor_assignment.records;
		opener.auditoPickerOnHide(event, data);
	} 
	window.onbeforeunload = inform_parent;

	var thisWindow = $('#window--pick-auditor'),
		body = $(thisWindow).find('#auditor-assignment--auditor-list'),
        template = '<div class="list-group-item list-group-item-auditor list-group-auditor-assignment" data-filter="::nama_jabatan::"> <div class="checkbox" style="display:inline;"> <label><input type="checkbox" name="auditor_assignment[]" data-auditor="::fullname::" class="sr-only checkbox-auditor-assigment" value="::id_auditor::"> <i class="material-icons" style="vertical-align:middle;">account_circle</i> ::fullname:: <span class="badge" style="float:none!important;">::nama_jabatan::</span> </label>  </div> <div class="btn-add-auditor" style="display:inline;float:right"> <button class="mdl-button mdl-js-button mdl-button--icon" onclick="$(this).auditor_assignment()"> <i class="material-icons">person_add</i> </button> </div> </div>';
    	
    	// untuk filtering auditor berdasarkan competency dan jadwal 
    	<?php 
    		if(isset($_REQUEST['filter']))
    		{
    	?>
    		var $competency = <?php echo $_REQUEST['competency'] ?>,
    			$assessment_date = <?php echo $_REQUEST['assessment_date'] ?>,
    			$assessment_date_range = <?php echo $_REQUEST['assessment_date_range'] ?>

	    	$.post(site_url('auditor/get_competent_and_available_auditor'), {competency: $competency, assessment_date_range: $assessment_date_range, assessment_date: $assessment_date})
	    
	    <?php }else{ ?>
	
		    // untuk ambil semua auditor 
	    	$.post(site_url('auditor/process/get/auditor'))

	    <?php } ?>
	    .done(function(res){
	        res = JSON.parse(res);
	        console.log(res)
	        /*res = temp1.slice(0);
	        res.sort(function(a,b){ return a.jabatan - b.jabatan });*/
	        Tools.write_data({
	            template: template,
	            records: res,
	            success: function(event, ui, data)
	            {
	            	if( $(thisWindow).find('.auditor-assignment--auditor-id--'+data.id_auditor).length < 1 )
	            	{
		            	ui = $(ui).addClass('auditor-assignment--auditor-id--'+data.id_auditor)
	                	$(thisWindow).find('#auditor-assignment--auditor-list-'+data.id_jabatan).append(ui).each(function(){
	                		$(ui).find('input[type="checkbox"]').data(data);
	                	});
	            	}

	            }

	        })
	        .done(function(){
				
				// show first tab after load;
				$(thisWindow).find('#tablist-auditor-assignment--jabatan a:first').tab('show');
	        })
	        
	    })
</script>
