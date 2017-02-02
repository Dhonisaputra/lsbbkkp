<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
	<a href="" class="__link--confirmed-reassessment" target="_blank">Confirm</a>
	<hr>

	<div class="list-group">
		<div class="list-group-item"><strong>Perusahaan</strong> : <?php echo $_POST['company_name'] ?></div>
		<div class="list-group-item"><strong>Nomor Sertifikat</strong>: <?php echo $_POST['id_certificate'] ?></div>
		<div class="list-group-item"><strong>Deadline Resurvey</strong>: <?php echo $_POST['full_deadline_date'] ?></div>
		<div class="list-group-item"><strong>Expired Resurvey</strong>: <?php echo $_POST['expired_date'] ?></div>

	</div>
	<?php if($_POST['rs_status'] == 'process' && $_POST['token'] === ''){ ?>
	<div class="col-md-6 section--update-resurvey">
		<form action="<?php echo site_url('certification/update_resurvey') ?>" onsubmit="submit_resurvey_status(event)">
			<input name="id_rs" type="hidden" value="<?php echo $_POST['id_rs'] ?>">
			<input name="id_issued" type="hidden" value="<?php echo $_POST['id_issued'] ?>">
			<div class="form-group">
				<div class="radio"> <label><input type="radio" name="status" value="process" <?php echo ($_POST['rs_status'] == 'process')? 'checked' : '' ?>>process</label> </div>
				<div class="radio"> <label><input type="radio" name="status" value="success" <?php echo ($_POST['rs_status'] == 'success')? 'checked' : '' ?>>Success</label> </div>
				<div class="radio"> <label><input type="radio" name="status" value="fail" <?php echo ($_POST['rs_status'] == 'fail')? 'checked' : '' ?>>Fail</label> </div>
			</div>
			<div class="form-group">
				<!-- Colored raised button -->
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">
					Update
				</button>

			</div>
		</form>
	</div>
	<?php }else{ ?>

	<div class="alert alert-info"> Client <?php echo $_POST['company_name'] ?> belum konfirmasi tanggal Peninjauan Ulang.  </div>

	<?php } ?>
	<div class="tab col-md-12 section--alert">
		<div class="alert alert-success">
			Resurvey sudah di update!
		</div>
	</div>

</div>


<script type="text/javascript">
		
	function submit_resurvey_status(event)
	{
		event.preventDefault();
		var ui = $(event.target),
			action = ui.attr('action'),
			data = ui.serializeArray();
		$.post(action, data)
		.done(function(res){
			// console.log(res);
			window.tableReAssessment.ajax.reload()
			$('.section--update-resurvey').hide();
			$('.section--alert').show();
		})

	}

	$(function(){

		$.post(site_url('assessment/datatable__reassessment'))
		.done(function(res){
			res = JSON.parse(res)
			res = res.filter(function(r){ return r.id_rs == '<?php echo $_POST["id_rs"] ?>' })[0]
			$('.__link--confirmed-reassessment').attr('href', site_url('assessment/lanjutan/'+res.id_rs+'/'+res.token_link));
			
			if(res.id_rs)
			{
				$('.section--alert').hide();
				$('input[name="status"][value="'+res.rs_status+'"]').prop('checked',true);
			}else
			{
				$('.section--update-resurvey').hide();
			}
		})
	})
</script>