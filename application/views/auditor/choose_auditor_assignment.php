<section class="navbar">
	<button class="mdl-button mdl-js-button" href="#auditor-assignment--tab--detail-group-participants" aria-controls="auditor choose" data-tab="" role="tab" data-toggle="tab">
		<span class="glyphicon glyphicon-menu-left"></span> Lihat partisipan
	</button>
	<a class="mdl-button mdl-js-button mdl-button--raised btn btn-primary pull-right" href="#auditor-assignment--tab--placement-auditor" data-toggle="tab">
		Selanjutnya <i class="glyphicon glyphicon-menu-right"></i>
	</a>
</section>

<div class="row" style="padding-top:10px;">
	
	<div class="" style="display: flex; justify-content: center;">

		<?php foreach ($audit_time['data'] as $key => $value){ ?>
			<div class="panel panel-primary" style="margin-right: 20px;">
				<div class="panel-body">
					<div> Auditor yang dibutuhkan oleh <?php echo $value['type'] ?> </div>
					<div> Kompetensi yang dicari :  <br><span class="container--competency" style="font-weight: bolder;"> <?php echo implode(', ', $value['competency']['name']) ?> </span> </div>
				</div>
			</div>
		<?php } ?>
	</div>

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist" id="tablist-auditor-assignment--jabatan">
		<?php foreach ($jabatan as $jkey => $jvalue) { ?>
			<li role="presentation" class=""><a href="#choose-auditor--tab--jabatan-<?php echo $jvalue['id_jabatan'] ?>" aria-controls="<?php echo $jvalue['nama_jabatan'] ?>" role="tab" data-toggle="tab"><?php echo $jvalue['nama_jabatan'] ?></a></li>
		<?php } ?>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content choose-auditor--tab--jabatan" style="padding-top:10px;">
		<?php foreach ($jabatan as $jkey => $jvalue) { ?>
			<div role="tabpanel" class="tab-pane col-md-12" id="choose-auditor--tab--jabatan-<?php echo $jvalue['id_jabatan'] ?>">
				
				<div class="checkbox">
					<label><input type="checkbox" name="select_all" onclick="checkbox_selectAll_auditor(this, <?php echo $jvalue['id_jabatan'] ?>)"> Select All </label>
				</div>

				<table class="table-choose-assignment-auditor table table-hovered table-bordered table-striped" id="table--auditor-assignment--auditor-list-<?php echo $jvalue['id_jabatan'] ?>"  style="width: 100%;">
					<thead>
						<tr>
							<th>No.</th>
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
						<tr class="list-group-item-auditor list-group-item-auditor-assignment list-group-auditor-assignment "  data-filter="<?php echo $avalue['nama_jabatan'] ?>" data-id_auditor="<?php echo $avalue['id_auditor'] ?>" data-group_type="<?php echo $avalue['group_type'] ?>" data-group_system="<?php echo $avalue['group_system'] ?>" data-nama_auditor="<?php echo $avalue['fullname'] ?>" data-nama_jabatan="<?php echo $avalue['nama_jabatan'] ?>">
							<td><?php echo $i+1; ?></td>
							<td>
								<img src="<?php echo site_url($avalue['avatar']) ?>" class="auditor--avatar img-responsive img-thumbnail" style="width:60px;"> 							
								<?php echo $avalue['fullname'] ?> <a target="_blank" href="<?php echo site_url('auditor/panel/profile/'.$avalue['id_auditor']) ?>" title="profile <?php echo $avalue['fullname'] ?>"> <i class="material-icons middle">link</i> </a>
							</td>
							<td><?php echo $avalue['nama_jabatan'] ?></td>
							<td><?php echo implode( ', ', array_intersect( explode(',', $avalue['group_system']), $data['unique_audit_reference_title']) ) ?></td>
							<td>
								<input type="checkbox" name="auditor_assignment[]" data-auditor="<?php echo $avalue['fullname'] ?>" data-id_auditor="<?php echo $avalue['id_auditor'] ?>" class="sr-only checkbox-auditor-assigment" value="<?php echo $avalue['id_auditor'] ?>"> 
								<button class="mdl-button mdl-js-button mdl-button--icon" type-button="select_auditor" onclick="$(this).auditor_assignment()"> <i class="material-icons">person_add</i> </button> 
							</td>
						</tr>
<!-- 	
						<div class="list-group-item list-group-item-auditor list-group-auditor-assignment" data-filter="<?php echo $avalue['nama_jabatan'] ?>" data-id_auditor="<?php echo $avalue['id_auditor'] ?>"> 
							<div class="btn-add-auditor" style="display:inline;float:right"> 
								<button class="mdl-button mdl-js-button mdl-button--icon" type-button="select_auditor" onclick="$(this).auditor_assignment()"> <i class="material-icons">person_add</i> </button> 
							</div> 

							<div class="checkbox" style="display:inline;"> 
								<label>
									<input type="checkbox" name="auditor_assignment[]" data-auditor="<?php echo $avalue['fullname'] ?>" data-id_auditor="<?php echo $avalue['id_auditor'] ?>" class="sr-only checkbox-auditor-assigment" value="<?php echo $avalue['id_auditor'] ?>"> 
								</label>  
							</div>
							<div class="row">
								<div class="col-md-1">
									<img src="<?php echo $avalue['avatar'] ?>" class="auditor--avatar img-responsive img-thumbnail" style="width:60px;"> 
								</div>
								<div class="col-md-9">
									<div class="auditor--name"> <strong> Nama :</strong> <strong> <?php echo $avalue['fullname'] ?> </strong> </div>
									<div class="auditor--jabatan"> <strong>Jabatan :</strong> <span class="badge" style="float:none!important;"> <?php echo $avalue['nama_jabatan'] ?> </span> </div>
									<div class="auditor--competency"> <strong>Kompetensi :</strong> <?php echo implode( ', ', array_intersect( explode(',', $avalue['group_system']), $data['unique_audit_reference_title']) ) ?> </div>
								</div>
							</div> 
						</div>
						 -->
					<?php 
						$i++;
						} 
					} 
					?>	
					</tbody>
				</table>
				<!-- </div> -->
				
			</div>
		<?php } ?>
	</div>

</div>



<!-- <div id="selected-auditor-assignment"></div>

<hr>

<div class="list-group" id="auditor-assignment--auditor-list" style="height:300px; overflow-y:auto"></div>

<hr> -->

<div class="form-group" id="">
	<!-- <button class="mdl-button mdl-js-button mdl-button--raised" onclick="clear_all()">
	 <i class="material-icons">clear_all</i> clear all
	</button>

	<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="submit_auditor_assignment()">
		<i class="material-icons">add</i> submit
	</button> -->
	

</div>

<script type="text/javascript">
	$('.table-choose-assignment-auditor').DataTable();
</script>
