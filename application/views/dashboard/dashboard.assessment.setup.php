<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('js', 'js/jstools/jquery.datatable.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<div class="" id="assessment-setup--counter"></div>
<div class="" id="assessment-setup--search"></div>
<div class="" id="assessment-setup--table">
	<div>

	  <!-- Nav tabs -->
	 	<ul class="nav nav-tabs" role="tablist">
	    	<li role="presentation" class="active"><a href="#assessment-setup--tab--a0" aria-controls="home" role="tab" data-toggle="tab">Assessment available</a></li>
			<li role="presentation"><a href="#assessment-setup--tab--a1" aria-controls="profile" role="tab" data-toggle="tab">Waiting Confirmation</a></li>
			<li role="presentation"><a href="#assessment-setup--tab--a2" aria-controls="messages" role="tab" data-toggle="tab">All Confirmed</a></li>
	  	</ul>

	  	<!-- Tab panes -->
	  	<div class="tab-content">
	    	<div role="tabpanel" class="tab-pane active" id="assessment-setup--tab--a0">
	    		<table class="table table-bordered table-striped table-hover" id="table-a0">
	    			<thead>
	    				<tr>
	    					<th>Deadline</th>
	    					<th>Company Name</th>
	    					<th>Country</th>
	    					<th>Region</th>
	    					<th>Notified</th>
	    				</tr>
	    			</thead>
	    			<tbody></tbody>
	    		</table>
	    	</div>
	    	<div role="tabpanel" class="tab-pane" id="assessment-setup--tab--a1">
	    		
	    		<table class="table table-bordered table-striped table-hover" id="table-a1" style="width:100%;">
	    			<thead>
	    				<tr>
	    					<th>Deadline</th>
	    					<th>Last Notice</th>
	    					<th>Company Name</th>
	    					<th>Phone Number</th>
	    					<th>Contact</th>
	    					<th>Notified</th>
	    				</tr>
	    			</thead>
	    			<tbody></tbody>
	    		</table>

	    	</div>
	    	<div role="tabpanel" class="tab-pane" id="assessment-setup--tab--a2">

	    		<table class="table table-bordered table-striped table-hover" id="table-a2" style="width:100%;">
	    			<thead>
	    				<tr>
	    					<th>Assess</th>
	    					<th>Company Name</th>
	    					<th>Country</th>
	    					<th>Region</th>
	    					<th>Assign</th>
	    				</tr>
	    			</thead>
	    			<tbody></tbody>
	    		</table>

	    	</div>
	  	</div>

	</div>
</div>

<script type="text/javascript">
	window.tableavailable = $('#table-a0').DataTable();
	window.tableWaiting = $('#table-a1').DataTable({
		ajax: {
			url: site_url('assessment/process/get/schedules/unconfirmed'),
			dataSrc: function(json)
			{
                json = (json.data)? json.data : json;
                if(!json){return false; }
				$.each(json, function(a,b){
					json[a]['checkbox_notified'] = '<input type="checkbox">';
					json[a]['deadline'] = 'N/A';
					json[a]['contact'] = 'Company Phone Number';
				})
				console.log(json)
				return json;
			}
		},
		columns:[
			{data: 'deadline'},
			{data: 'last_notice'},
			{data: 'company_name'},
			{data: 'telephone'},
			{data: 'contact'},
			{data: 'checkbox_notified'},
		]
	});

	window.tableconfirmed = $('#table-a2').DataTable({
		ajax: {
			url: site_url('assessment/process/get/schedules/confirmed'),
			dataSrc: function(json)
			{
                json = (json.data)? json.data : json;
                if(!json){return false; }
				$.each(json, function(a,b){
					json[a]['checkbox_assign'] = '<input type="checkbox">';
				})
				return json;
			}
		},
		columns:[
			{data: 'execution'},
			{data: 'company_name'},
			{data: 'country_name'},
			{data: 'region'},
			{data: 'checkbox_assign'},
		]
	});
</script>