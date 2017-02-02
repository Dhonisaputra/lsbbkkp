
<?php
	foreach ($schedule as $key => $value) {
?>
	<div class="item-schedule" style="margin-bottom:15px;" data-list="assessment" data-id="<?php echo $value['id_assessment'] ?>">
		<button class="mdl-button mdl-js-button button-toggle-schedule collapsed" type="button" data-toggle="collapse" data-target="#a0-<?php echo $value['id_assessment']; ?>" aria-expanded="false" aria-controls="collapseExample">
			<i class="material-icons">chevron_right</i> Permintaan baru <?php echo $value['type'] ?>
		</button>
		<div class="collapse" id="a0-<?php echo $value['id_assessment']; ?>">
			<div class="well">
				<section class="navbar">
					<!-- Colored raised button -->
					<button class="mdl-button mdl-js-button flat btn btn-info" onclick="openAuditorPicker('assessment',<?php echo $value['id_assessment']; ?>)">
					  	<i class="material-icons" style="vertical-align:middle">add</i> Tambah auditor
					</button>
					<button class="mdl-button mdl-js-button flat btn btn-primary" onclick="updateAuditor('assessment',<?php echo $value['id_assessment']; ?>)">
					  	<i class="material-icons" style="vertical-align:middle">update</i> Update auditor
					</button>
				</section>

				<div class="" style="margin-top:20px;">
					<div class="list-group list-registered-auditor" id="auditor-assignment--assigned-auditor-list-<?php echo $value['id_assessment'] ?>" style="max-height:300px; overflow-y:auto">
						
					</div>
					<div class="list-group list-new-auditor" id="auditor-assignment--new-assigned-auditor-list-<?php echo $value['id_assessment'] ?>" style="max-height:300px; overflow-y:auto"></div>
				</div>
		  	</div>
		</div>
	</div>

<?php		
	}
?>