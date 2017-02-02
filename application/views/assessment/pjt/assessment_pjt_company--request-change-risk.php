<div class="">
	<table class="table table-bordered table-hovered table-striped" id="table--a0">
		<thead>
			<tr>
				<th>Perusahaan</th>
				<th>email</th>
				<th>status</th>
				<th>aksi</th>
			</tr>
		</thead>
	</table>
</div>

<script type="text/javascript">
	window['precertification_table_a0'] = $('#table--a0').DataTable({
		ajax: {
			url: site_url('assessment/get_presertification'),
			dataSrc: function(json){
				json = (json.data)?json.data : json;

				$.each(json, function(a,b){
					json[a]['action'] = ' <a data-engine="pushstate" data-target="#document-actual-tab" title="presertification detail" href="'+site_url('assessment/precertification/detail/'+b.id_a0)+'" class="mdl-button mdl-js-button btn-primary"> <i class="material-icons">build</i> Buka </a>';
					json[a]['status'] = (b.pass_the_review < 0)? 'Remidial' : 'Belum di review'
				})	
				return json;
			}
		},
		columns: [
			{data: 'company_name'},
			{data: 'email'},
			{data: 'status'},
			{data: 'action'},
		]
	});

</script>