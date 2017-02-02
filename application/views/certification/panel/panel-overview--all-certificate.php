<div class="alert alert-info row">
	<i class="material-icons material-icons--middle">info</i> to edit or change the status of the certification, click 2 times on certificate's row. 
</div>
<div class="form-group">
	<button class="btn btn-warning mdl-button mdl-js-button" onclick="newCertification()">
	  <i class="material-icons">add</i> add Certification
	</button>
</div>
<div class="row">
	<table class="table-hover table-stripped table-bordered" id="all-certification-list">
		<thead>
			<tr>
				<th>No.</th>
				<th>Name</th>
				<th>Type</th>
				<th>use period</th>
				<th>resurvey attempt</th>
				<th>grace period</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>
<div class="row">
	<div class="col-md-12">
		<span> </span><span class="preview--color" style="background-color:rgba(255,0,0,.2); width:10px; height:10px;display:inline-block;"></span> <span>: Certification have meaning in an inactive state / <strong>Revoked</strong> state </span>
	</div>
</div>

<script type="text/javascript">
	
	function newCertification()
	{
		Doctab.show({
			onShow: function(e)
			{
				// console.log(e);
				$(e.tabContent).load(site_url('certification/panel/new/certification') )
			}
		})
	}
	function openCertification(ui)
	{
		var data = window.audit_referenceList.row(ui).data();
		var encURI = encodeURI( site_url('certification/panel/detail/audit_reference/'+data.audit_reference+'/'+data.name) )
		Doctab.show({
			load:
			{
				url: encURI,
			}
		})
	}

	$(document).ready(function(){
		window.audit_referenceList = $('#all-certification-list').DataTable({
			info: false,
	        lengthChange: false,
	        searching: true,
	        ajax: {
				url: site_url('certification/process/get/list'),
	            type: 'POST',
	            dataSrc: function(json)
	            {
	                json = (json.data)? json.data : json;
	                var i = 1;
	                $.each(json, function(a,b){
	                	json[a]['no'] = i;
	                	json[a]['actions'] = '<button class="mdl-button mdl-js-button mdl-button--icon" onclick="openCertification($(this).closest(\'tr\'))"><i class="material-icons" style="font-size:20px;">create</i></button></button>';
	                	i++;
	                })
	                if(!json){return false; }
	                return json;
	            }
	        },
	        createdRow: function(a,b,c){
	        	if(b.revoke_audit_reference == 1)
	        	{
	        		$(a).css({'background-color':'rgba(255,0,0,.2)'})
	        		$('td:nth(6)', a).html( '<b>revoked</b>' );
	        	}else
	        	{
	        		$('td:nth(6)', a).html( '<span class="text-success">active</span>' );
	        	}
	        },
	        columns:[
	            {data: 'no'},
	            {data: 'name'},
	            {data: 'type'},
	            {data: 'use_period'},
	            {data: 'resurvey_attempt'},
	            {data: 'grace_period'},
	            {data: 'revoke_audit_reference'},
	            {data: 'actions'},
	        ]
		});

		$('#all-certification-list').delegate('tr', 'dblclick', function(e){
			openCertification(this)
		})
	})
</script>