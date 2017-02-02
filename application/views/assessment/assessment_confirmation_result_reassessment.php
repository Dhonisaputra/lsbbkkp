<?php foreach ($unconfirmed_rs as $key => $value) { ?>
	<div class="col-md-12 list-assessment-result parent--tab parent--tab-reassessment list-reassessment" data-typeassessment="reassessment"> 
		<a class="collapse-toggle" data-toggle="collapse" data-target="#collapseReassessment-<?php echo $value['id_rs'] ?>" aria-expanded="false" aria-controls="collapseReassessment-<?php echo $value['id_rs'] ?>" style="cursor:pointer;"><span class="sign"></span> Reassessment <?php echo $value['id_certificate'] ?> </a> 
		<div class="panel-body-reassessment-<?php echo $value['id_rs'] ?> collapse" id="collapseReassessment-<?php echo $value['id_rs'] ?>"> 
			
			<p> <strong> Jenis sertifikasi : <?php echo $value['type'] ?></strong></p>
			<p> <strong> Surveilen ke :</strong> Surveilen ke <?php echo $value['rs_description'] ?></p>
			<p> <strong> Jenis Permintaan :</strong> <?php echo isset($value['data_detail']['text_brand'])? $value['data_detail']['text_brand'] : 'N/A'; ?> </p>
			<p> <strong> Nomor Sertifikat :</strong> <?php echo $value['id_certificate'] ?> </p>
			<p> <strong> Ruang Lingkup / Scope :</strong> <?php echo isset($value['data_detail']['text_scope'])? $value['data_detail']['text_scope'] : 'N/A' ?> </p>
			<p> <strong> Komoditas / Product Line :</strong> <?php echo isset($value['data_detail']['text_product_line'])? $value['data_detail']['text_product_line'] : 'N/A' ?> </p>
			<p> <strong> NACE :</strong> <?php echo isset($value['data_detail']['text_nace'])? $value['data_detail']['text_nace'] : 'N/A' ?> </p>
			<p> <strong> Current Risk :</strong> <?php echo $value['risk'] ?> </p>

			<p> <a href="#" class="preventDefault" onclick="Tools.popupCenter('<?php echo site_url('assessment/data_detail_certification/reassessment/'.$value['id_rs']) ?>','rulsd',500,500)">Detail</a> </p>
			
			<h6>Latest Notes</h6>
			<div class="list-group list-group-flat list-group-notes-reassessment-<?php echo $value['id_rs'] ?>">
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
			<strong>Select new status for this assessment</strong>
			<div class="radio">
				<label><input type="radio" class="new_restatus" name="new_restatus_<?php echo $value['id_rs'] ?>" value="success" <?php echo ($value['rs_status'] == 'success') ? 'checked' : ''; ?>>success</label>
			</div> 

			<div class="radio">
				<label><input type="radio" class="new_restatus" name="new_restatus_<?php echo $value['id_rs'] ?>" value="fail" <?php echo ($value['rs_status'] == 'fail') ? 'checked' : ''; ?>>Fail</label>
			</div> 

			<div class="radio">
				<label><input type="radio" class="new_restatus" name="new_restatus_<?php echo $value['id_rs'] ?>" value="remidial" <?php echo ($value['rs_status'] == 'remidial') ? 'checked' : ''; ?>>Remidial</label>
			</div> 

			<!-- start of suggest risk -->
			<div class="form-group">
				<label>Suggest Risk</label>
				<div class="row">
					<div class="col-md-4">
						<select id="reassessment_suggest_risk" class="form-control suggest_risk">
    						<option value="Low" <?php echo ($value['suggest_risk'] == 'Low')? 'selected' : ''; ?> >Low</option>
    						<option value="Medium low" <?php echo ($value['suggest_risk'] == 'Medium low')? 'selected' : ''; ?> >Medium low</option>
    						<option value="Medium" <?php echo ($value['suggest_risk'] == 'Medium')? 'selected' : ''; ?> >Medium</option>
    						<option value="Medium high" <?php echo ($value['suggest_risk'] == 'Medium high')? 'selected' : ''; ?> >Medium high</option>
    						<option value="High" <?php echo ($value['suggest_risk'] == 'High')? 'selected' : ''; ?> >High</option>
    					</select>
					</div>
				</div>
			</div>
			<!-- end of suggest risk -->

			<div class="form-group box-explain-fail-<?php echo $value['id_rs'] ?>" style="margin:0px;"> 
				<textarea name="explanation-fail-<?php echo $value['id_rs'] ?>" id="explanation-fail-<?php echo $value['id_rs'] ?>" class="form-control" placeholder="Add Note?" style="border-radius:0px;height:100px;"></textarea>
			</div>

			<div class="list-group upload-confirmation-result" id="upload-confirmation-result">

			</div>
			
			<button class="mdl-button mdl-js-button" id="attach_result" onclick="upload_confirmation_assessment(this)"> <i class="material-icons">attachment</i> Lampiran </button>
			<div class="mdl-tooltip" for="attach_result"> Attach Assessment result</div>
			
			<button class="mdl-button mdl-js-button btn btn-primary" onclick="rs_status__change(event, '<?php echo $value['id_certificate'] ?>', <?php echo $value['id_rs'] ?>, <?php echo $value['id_issued'] ?>)">Update</button>
			
		</div> 
	</div>
<?php } ?>

<script type="text/javascript">
	function rs_status__change(event, id_certificate, id_rs, id_issued)
	{
		var status = $('.new_restatus:checked').val()
		if(!status)
		{
			swal({   title: "Kesalahan dalam memperbarui sertifikasi",   text: "Anda tidak memilih hasil sertifikasi. hasil sertifikasi dibutuhkan untuk laporan hasil kegiatan sertifikasi.", allowEscapeKey:false,   type: "info",   showConfirmButton: false});
			return false;
		}

		Snackbar.manual({message:'Mengganti status sertifikat!', spinner: true});
			swal({   title: "Memperbarui hasil sertifikasi",   text: "Memperbarui hasil sertifikasi. Silahkan tunggu sebentar!", allowEscapeKey:false,   type: "info",   showConfirmButton: false});

		
		var parents 	= $(event.target).parents('li.list-group-item'), // parants
			explanation = $('#explanation-fail-'+id_rs).length > 0 ? $('#explanation-fail-'+id_rs).val() : '', // explanation
			data = { id_certificate: id_certificate, id_rs: id_rs, id_issued: id_issued, status: status, 'explanation': explanation }
			
			// send ajax files with other parameters

			// old post
			// $.post(site_url('certification/create_certificate'), { 'new_status': status, 'explanation': explanation, 'type': type, 'id_a0_cat': id_a0_cat })
			
			// new ajax send. using formData; FormData inside $.Upload.data_submit();
		$.ajax({
		    url 		: site_url('certification/process/post/update/resurvey'),
		    data 		: $.Upload.data_submit(data),
		    cache 		: false,
		    contentType : false,
		    processData : false,
		    type 		: 'POST',
		})

		.done(function(res){
			console.log(res);
			
			// refresh table
			window.assignedassessment.ajax.reload();
			window.conductedassessment.ajax.reload();
			window.waitingresult.ajax.reload();

			// show snackbar
			swal('Sertifikasi telah berhasil diperbarui','', 'success')
			Snackbar.show('Sertifikasi telah berhasil diperbarui!');

			// reset uploaded file
			if( Object.keys($.Upload.records).length > 0 )
			{
				$('.list-group-item--attachment-confirmation').remove();
				$.Upload.reset();
			}

			// status
			if(status === 'success' || status === 'fail' )
			{
				// hide snackbar

				// remove accordion
				$(event.target).parents('.parent--tab').remove();

				var badge = $('.badge-reassessment');
				var latestBadge =  parseInt( $(badge).attr('data-badge') );
				latestBadge = latestBadge - 1;
				$(badge).attr('data-badge',latestBadge)

				// if( $('.parent--tab-reassessment').length < 1 )
				// {
				// 	Doctab.hide()
				// }

			}else
			{
				// collapse in
				$('.panel-body-reassessment-'+id_rs).removeClass('in');
				
				// explanation fail
				$('#explanation-fail-'+id_rs).val('');
				
				// get notes
				$.post(site_url('notes/get_notes'),{ returnAs:'json', params: {notes_reference_id: id_rs, notes_for_type:1} })
				.done(function(res){

					res = JSON.parse(res);
					$('.list-group-notes-reassessment-'+id_rs).html('');
				
					// write notes
					Tools.write_data({
						template: '<div class=""> <div><strong>Latest Status</strong>: <span class="badge">::notes_status::</span> </div> <div class="text-muted" style="font-size:13px; padding-bottom:10px;">::notes_addtime::</div> <div>::notes_content::</div> <div class="notes--files notes--files-reassessment list-group">  </div> </div> <hr> ',
						records: res,
						target: $('.list-group-notes-reassessment-'+id_rs),
						afterAppend: function(event, ui, data)
						{
							var files = '';
							if(data.files)
							{
								$.each(data.files, function(a,b){
									var url = site_url('files/download/'+b.file_id);
									files += '<div><a href="'+url+'" target="_blank">'+b.client_name+'</a></div>'
								})
								$(ui).find('.notes--files-reassessment').append(files)
							}
						}
					}) // end tool write
				
				})
			}
			// check jumlah .list-assessment-result
			if($('.list-assessment-result').length <= 0)
			{
				Doctab.hide();
			}
		})
		.error(function(res){
			console.log(res);
			swal('error', res.textStatus, 'error');
		})
	}
</script>