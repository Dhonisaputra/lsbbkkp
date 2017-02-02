<?php foreach ($audit_khusus as $key => $value) { ?>
	    	<div class="col-md-12 list-assessment-result list-audit-khusus parent--tab" data-typeassessment="audit-khusus">
	    		<a  class="collapse-toggle" data-toggle="collapse" data-target="#collapseCertification-<?php echo $value['id_a0_cat'] ?>" aria-expanded="false" aria-controls="collapseCertification-<?php echo $value['id_a0_cat'] ?>" style="cursor:pointer;"> <span class="sign"></span> Audit Khusus <?php echo $value['id_certificate'] ?></a>
    			<div class="col-md-12 panel-body-<?php echo $value['id_a0_cat'] ?> collapse" id="collapseCertification-<?php echo $value['id_a0_cat'] ?>"> 
					<div class="section--accreditationRelated">
		    			<p> <strong> Type : <?php echo $value['type'] ?></strong></p>
	    				<p> <strong> Type Permintaan : <?php echo $value['data_detail']['text_type_request'] ?></strong></p>
						<p> <strong> Nomor Sertifikat :</strong> <?php echo $value['id_certificate'] ?> </p>
						<p> <strong> Ruang Lingkup / Scope :</strong> <?php echo isset($value['data_detail']['text_scope'])? $value['data_detail']['text_scope'] : 'N/A' ?> </p>
						<p> <strong> Komoditas / Product Line :</strong> <?php echo isset($value['data_detail']['text_product_line'])? $value['data_detail']['text_product_line'] : 'N/A' ?> </p>
						<p> <strong> Merek :</strong> <?php echo isset($value['data_detail']['text_brand'])? $value['data_detail']['text_brand'] : 'N/A'; ?> </p>
						<p> <strong> NACE :</strong> <?php echo isset($value['data_detail']['text_nace'])? $value['data_detail']['text_nace'] : 'N/A' ?> </p>
						<p> <strong> Current Risk :</strong> <?php echo $value['risk'] ?> </p>

					<div class="section--notes">
	    				<h6>Latest Notes</h6>
	    				<div class="list-group list-group-flat list-group-notes-<?php echo $value['id_a0_cat'] ?>">
	    					<?php 
								if(isset($value['notes']))
								{
	    							foreach ($value['notes'] as $nkey => $nvalue) {
	    								$notes = (!empty($nvalue['notes_content']))? $nvalue['notes_content'] : 'No Notes';
	    								$files = '';
	    								
	    								if( isset($nvalue['files']) )
	    								{
		    								foreach ($nvalue['files'] as $fkey => $fvalue) { 
		    									$files .= '<div><a href="'.site_url('files/download/'.$fvalue['file_id']).'" target="_blank">'.$fvalue['client_name'].'</a></div>';
		    								}
	    								
	    								}
	    								echo '<div class=""> <div><strong>Latest Status</strong>: <span class="badge">'.$nvalue['notes_status'].'</span> </div> <div class="text-muted" style="font-size:13px; padding-bottom:10px;">'.$nvalue['notes_addtime'].'</div> <div>'.$notes.'</div> <div class="notes--files list-group">  '.$files.' </div> </div>  <hr>'; 
	    							}
	    						}else
	    						{
	    							echo 'No notes found.';
	    						}
							?>
    					</div>
    				</div>
    				<strong>Select new status for this assessment</strong>
    				<div class="radio">
    					<label><input type="radio" name="new_status_<?php echo $value['id_a0_cat'] ?>" value="success" <?php echo ($value['status'] == 'success') ? 'checked' : ''; ?>>success</label>
    				</div> 

    				<div class="radio">
    					<label><input type="radio" name="new_status_<?php echo $value['id_a0_cat'] ?>" value="fail" <?php echo ($value['status'] == 'fail') ? 'checked' : ''; ?>>Fail</label>
    				</div> 

    				<div class="radio">
    					<label><input type="radio" name="new_status_<?php echo $value['id_a0_cat'] ?>" value="remidial" <?php echo ($value['status'] == 'remidial') ? 'checked' : ''; ?>>Remidial</label>
    				</div> 

    				<!-- start suggest risk -->
    				<div class="form-group">
						<label>Suggest Risk</label>
    					<div class="row">
    						<div class="col-md-4">
								<select id="audit_khusus_suggest_risk" class="form-control suggest_risk">
		    						<option value="Low" <?php echo ($value['suggest_risk'] == 'Low')? 'selected' : ''; ?> >Low</option>
		    						<option value="Medium low" <?php echo ($value['suggest_risk'] == 'Medium low')? 'selected' : ''; ?> >Medium low</option>
		    						<option value="Medium" <?php echo ($value['suggest_risk'] == 'Medium')? 'selected' : ''; ?> >Medium</option>
		    						<option value="Medium high" <?php echo ($value['suggest_risk'] == 'Medium high')? 'selected' : ''; ?> >Medium high</option>
		    						<option value="High" <?php echo ($value['suggest_risk'] == 'High')? 'selected' : ''; ?> >High</option>
		    					</select>
    						</div>
    					</div>
					</div>
    				<!-- end suggest risk -->

					<div class="form-group box-explain-fail-<?php echo $value['id_a0_cat'] ?>" style="margin:0px;"> <textarea name="explanation-fail-<?php echo $value['id_a0_cat'] ?>" id="explanation-fail-<?php echo $value['id_a0_cat'] ?>" class="form-control" placeholder="Add Note?" style="border-radius:0px;height:100px;"></textarea></div>

					<div class="list-group list-group-upload-confirmation-resul upload-confirmation-result" id="upload-confirmation-result"></div>

					<button class="mdl-button mdl-js-button" id="attach_result" onclick="upload_confirmation_assessment(this)"> <i class="material-icons">attachment</i> Lampiran </button>
					<div class="mdl-tooltip" for="attach_result"> Attach Assessment result</div>
					
					<button class="mdl-button mdl-js-button btn btn-primary" onclick="status__change(event, '<?php echo $value['id_a0_cat'] ?>', '<?php echo $value['type'] ?>','audit-khusus')">Update</button>

				</div> 
    		</div>

	    	<?php } ?>