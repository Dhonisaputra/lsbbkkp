<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>
<section class="navbar " style="margin-bottom: 20px;">
	<!-- Flat button -->
	<button  class="mdl-button mdl-js-button" href="#home" aria-controls="home" role="tab" data-toggle="tab">
		<span class="material-icons middle hidden-lg hidden-md">receipt</span> <span class="hidden-xs hidden-sm">permintaan baru</span>
	</button>

	<button  class="mdl-button mdl-js-button" href="#risk" aria-controls="home" role="tab" data-toggle="tab">
		<span class="material-icons middle hidden-lg hidden-md">report_problem</span> <span class="hidden-xs hidden-sm">Penggantian resiko</span>
	</button>

</section>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    	<div class="table-responsive">
    		<div class="form-group">
    			<button class="btn btn-primary" onclick="window['precertification_table_a0'].ajax.reload()"> Refresh </button>
    		</div>
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
    
    </div>
    <div role="tabpanel" class="tab-pane" id="risk">
    	<div class="table-responsive">
    		<div class="form-group">
    			<button class="btn btn-primary" onclick="window['risk'].ajax.reload()"> Refresh </button>
    		</div>
	    	<table class="table table-bordered table-hovered table-striped" id="table--risk" style="width: 100%;">
				<thead>
					<tr>
						<th>Perusahaan</th>
						<th>Risk Sekarang</th>
						<th>Risk yang disarankan</th>
						<th>aksi</th>
					</tr>
				</thead>
			</table>
    	</div>

    </div>
</div>


<script type="text/javascript">
	window['risk'] = $('#table--risk').DataTable({
		ajax: {
			url: site_url('assessment/get_requested_risk_change'),
			dataSrc: function(json){
				json = (json.data)?json.data : json;
				if(json.length < 1){return false}
				
				$.each(json, function(a,b){
					json[a]['action'] = ' <a data-engine="pushstate" data-target="#document-actual-tab" title="presertification detail" href="'+site_url('assessment/precertification/detail/'+b.id_a0)+'" class="btn btn-primary btn-xs"> <i class="glyphicon glyphicon-new-window"></i> Buka </a>';
				})	
				return false;
			}
		},
		columns: [
			{data: 'company_name'},
			{data: 'risk'},
			{data: 'suggest_risk'},
			{data: 'action'},
		]
	});
	window['precertification_table_a0'] = $('#table--a0').DataTable({
		ajax: {
			url: site_url('assessment/get_presertification'),
			dataSrc: function(json){
				json = (json.data)?json.data : json;
				// console.log(json)

				$.each(json, function(a,b){
					json[a]['action'] = ' <a target="_blank" href="'+site_url('assessment/moderasi/pengajuan/'+b.id_company+'/'+b.id_permintaan_sertifikasi)+'" class="btn btn-primary btn-xs"> <i class="glyphicon glyphicon-new-window"></i> Buka </a>';
					json[a]['status'] = (b.is_accepted < 0) ? '' : 'Belum di review'
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