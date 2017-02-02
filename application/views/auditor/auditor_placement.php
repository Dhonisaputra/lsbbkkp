<style type="text/css">
	.auditor_placement--selected-company-list .sign
	{
		vertical-align: text-bottom;
	}
	.auditor_placement--selected-company-list .sign, .previewSelectedPlacement
	{
		min-width: 20px !important;
	    width: 20px !important;
	    height: 20px !important;
	}
	.auditor_placement--selected-company-list .sign .material-icons, .previewSelectedPlacement .material-icons
	{
		font-size: 16px !important;
	}
	.auditor_placement--selected-company-list .sign.active, .previewSelectedPlacement.sign.active
	{
		/*color: white;*/
		color: #26c281;
		/*background-color: #26c281;*/
	}
	
	.sign-text.active
	{
		color: #26c281;
	}
	.auditor_placement--selected-company-list .sign:not(.active), .auditor_placement--selected-company-list .sign-text:not(.active)
	{
		color: #6c7a89;
	}
</style>

<section class="navbar">
	<?php if($parameters['type_coordination'] != 'single'){ ?>
	<button class="mdl-button mdl-js-button" href="#auditor-assignment--tab--auditor-choose" aria-controls="auditor choose" data-tab="" role="tab" data-toggle="tab">
		<span class="glyphicon glyphicon-menu-left"></span> Pilih auditor
	</button>
	<?php }else{ ?>
		<button class="mdl-button mdl-js-button" onclick="window.opener.refreshMainTable(); window.close();">
			<span class="glyphicon glyphicon-menu-left"></span> Keluar
		</button>
	<?php } ?>

	<div class=" pull-right">
		<button class="mdl-button mdl-js-button mdl-button--raised btn btn-info" href="#auditor-assignment--tab--review-assigned-auditor" data-toggle="tab">
			Halaman review auditor <span class="material-icons">info</span>
		</button>

		<button class="mdl-button mdl-js-button mdl-button--raised btn btn-primary" href="#auditor-assignment--tab--review-assigned-auditor" data-toggle="tab" onclick="prepareReview()">
			Perbarui Auditor <span class="material-icons">add</span>
		</button>
	</div>
</section>
<div class="flat alert alert-info">
	Pertama, silahkan pilih perusahaan dengan cara klik nama perusahaan hingga muncul tanda centang berwarna hijau <span class="previewSelectedPlacement mdl-button mdl-button--icon mdl-js-button sign active"> <i class="material-icons material-icons--middle">check_box</i> </span> lalu pilih auditor yang akan ditugaskan.
</div>
<div class="flat alert alert-info">
	Untuk menyembunyikan detail permintaan, klik icon  <i class="material-icons  material-icons--middle">keyboard_arrow_down</i>. Untuk menampilkan permintaan, klik icon <i class="material-icons  material-icons--middle">keyboard_arrow_right</i>.
</div>

<div class="" id="container--counter-auditor" style="display: flex; justify-content: space-around;">

	<div class="panel panel-primary text-center">
		<div class="panel-body">
			<div class="text-center auditor--needed-all">
				<div> <span class="audit_time--counter" style="font-size: 40px;">0</span>/<span id="audit_time--auditor_that_can_add" style="font-size: 40px;"><?php echo $audit_time['detail']['fixed_auditor'] ?></span> </div>
				<div> Auditor yang dibutuhkan </div>
			</div>
		</div>
	</div>

	<?php foreach ($audit_time['data'] as $key => $value){ ?>
		<div class="panel panel-primary text-center auditor--request auditor--request--competency" data-competency_requested="<?php echo implode(', ', $value['competency']['name']) ?>" data-type="<?php echo $value['type'] ?>">
			
			<div class="panel-body">
				<div> <span class="audit_time--counter" style="font-size: 40px;">0</span> / <span id="audit_time--auditor_that_can_add" style="font-size: 40px;"><?php echo $value['auditor'] ?></span> </div>
				<div> Auditor yang dibutuhkan oleh <?php echo $value['type'] ?> </div>
				<div> Kompetensi yang dicari :  <br><span class="container--competency"> <?php echo implode(', ', $value['competency']['name']) ?> </span> </div>
			</div>
		</div>
	<?php } ?>

</div>
<div class="row row-company-selected">
	<?php 
		// if($parameters['type_coordination'] == 'single')
		// {
		if($parameters['type_coordination'] == 'single')
		{
			$data_company[] = $data;
		}else
		{
			$data_company = $data['datasource'];
		}
		foreach ($data_company as $key => $value) {	
			$this->load->view('auditor/auditor_placement--company list--single', $value); 
		}
		// }
	?>
</div>
<div class="row" style="padding-top:10px;">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist" id="tablist-auditor-placement--jabatan">
		<?php foreach ($jabatan as $jkey => $jvalue) { ?>
			<li role="presentation" class=""><a href="#auditor-placement--tab--jabatan-<?php echo $jvalue['id_jabatan'] ?>" class="text-uppercase" aria-controls="<?php echo $jvalue['nama_jabatan'] ?>" role="tab" data-toggle="tab"><?php echo $jvalue['nama_jabatan'] ?></a></li>
		<?php } ?>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content tab-content--auditor-placement" style="padding-top:10px;">
		<?php 
			foreach ($jabatan as $jkey => $jvalue) { 
		?>
			<div role="tabpanel" class="tab-pane col-md-12 auditor-placement--tab--jabatan" data-jabatan="<?php echo $jvalue['nama_jabatan'] ?>" id="auditor-placement--tab--jabatan-<?php echo $jvalue['id_jabatan'] ?>" style="margin-bottom: 100px;">
				
				<table class="table-choose-placement-auditor table table-hovered table-bordered table-striped" id="table--auditor-placement--auditor-list-<?php echo $jvalue['id_jabatan'] ?>"  style="width: 100%;">
					<thead>
						<tr>
							<th>Nama Auditor</th>
							<th>Jabatan</th>
							<th>Kompetensi</th>
							<th>action</th>
						</tr>
					</thead>
					<tbody>
					
					<?php 
						$i = 0;
						foreach ($auditor_competent as $akey => $avalue) { 
							if($avalue['id_jabatan'] == $jvalue['id_jabatan']){
					?>	
						<tr class="list-group-item-auditor list-group-item-auditor-placement " data-filter="<?php echo $avalue['nama_jabatan'] ?>" data-id_auditor="<?php echo $avalue['id_auditor'] ?>" data-group_type="<?php echo $avalue['group_type'] ?>" data-group_system="<?php echo $avalue['group_system'] ?>" data-nama_auditor="<?php echo $avalue['fullname'] ?>" data-nama_jabatan="<?php echo $avalue['nama_jabatan'] ?>">
							<td>
								<img src="<?php echo site_url($avalue['avatar']) ?>" class="auditor--avatar img-responsive img-thumbnail" style="width:60px;"> 							
								<?php echo $avalue['fullname'] ?> <a target="_blank" href="<?php echo site_url('auditor/panel/profile/'.$avalue['id_auditor']) ?>" title="profile <?php echo $avalue['fullname'] ?>"> <i class="material-icons middle">link</i> </a>
							</td>
							<td><?php echo $avalue['nama_jabatan'] ?></td>
							<td><?php echo implode( ', ', array_intersect( explode(',', $avalue['group_system']), $data['unique_audit_reference_title']) ) ?></td>
							<td>
								<input type="checkbox" name="auditor_assignment[]" data-id_auditor="<?php echo $avalue['id_auditor'] ?>" data-auditor="<?php echo $avalue['fullname'] ?>" class="sr-only checkbox-auditor-placement" value="<?php echo $avalue['id_auditor'] ?>"> 
								<button class="mdl-button mdl-js-button mdl-button--icon btn-configure-auditor" data-jabatan="<?php echo $avalue['nama_jabatan'] ?>" type-button="select_auditor" onclick="$(this).auditor_placement();update_auditor_requirement(this)"> <i class="material-icons">person_add</i> </button> 
							</td>
						</tr>
						
					<?php 
						$i++;
						} 
					} 
					?>				
				</tbody>
				</table>
				<!-- </div> --> <!-- end of #auditor-placement--auditor-list- -->
				
			</div>
		<?php } ?>
	</div>

</div>

<script type="text/javascript">
	$('.table-choose-placement-auditor').DataTable();
</script>