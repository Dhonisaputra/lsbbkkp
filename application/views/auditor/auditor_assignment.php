<?php echo $this->load->component('js', 'js/jspage/jspage.auditor_assignment.js') ?>
<?php echo $this->load->component('js', 'jsdata/jsdata.auditor_assignment.js');  ?>
<?php echo $this->load->component('js', 'jsdata/jsdata.auditor.js');  ?>
<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>
<div>
	  <!-- Nav tabs -->
	<ul class="sr-only" role="tablist">
	    <li role="presentation" class=""><a href="#auditor-assignment--tab--detail-group-participants" aria-controls="auditor choose" data-tab="" role="tab" data-toggle="tab">Auditor Choose</a></li>
	    <li role="presentation" class=""><a href="#auditor-assignment--tab--auditor-choose" aria-controls="auditor choose" data-tab="" role="tab" data-toggle="tab">Auditor Choose</a></li>
	    <li role="presentation"><a href="#auditor-assignment--tab--placement-auditor" aria-controls="compose auditor" data-tab="choose" role="tab" data-toggle="tab">auditor mixture</a></li>
	    <li role="presentation"><a href="#auditor-assignment--tab--review-assigned-auditor" aria-controls="review auditor" data-tab="review" role="tab" data-toggle="tab">review</a></li>
	</ul>

	  <!-- Tab panes -->
	<div class="tab-content">

		<?php if(isset($parameters['type_coordination']) && $parameters['type_coordination'] === 'group') { ?>
		    <div role="tabpanel" class="tab-pane active" id="auditor-assignment--tab--detail-group-participants">
		    	<?php $this->load->view('auditor/auditor_assignment_detail_participants_group') ?>
		    </div>

		    <div role="tabpanel" class="tab-pane" id="auditor-assignment--tab--auditor-choose">
		    	<?php $this->load->view('auditor/choose_auditor_assignment') ?>
		    </div>
		<?php } ?>

	    <div role="tabpanel" class="tab-pane  <?php echo (isset($parameters['type_coordination']) && $parameters['type_coordination'] === 'group')? '' : 'active'; ?>" id="auditor-assignment--tab--placement-auditor">
		    <div class="col-md-12">
		    	<?php $this->load->view('auditor/auditor_placement') ?>
		    </div>
	    </div> 
	    
	    <div role="tabpanel" class="tab-pane" id="auditor-assignment--tab--review-assigned-auditor">
	    	<?php $this->load->view('auditor/review_auditor_assigned' ) ?>
	    </div>   
	</div>

</div>

<script type="text/javascript">

	
</script>