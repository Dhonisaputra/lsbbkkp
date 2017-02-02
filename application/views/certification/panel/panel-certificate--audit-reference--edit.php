<section class="navbar">
	<div class="col-md-2">
		<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-revoke">
		  	<input type="checkbox" id="switch-revoke" class="mdl-switch__input" name="revoke_audit_reference" value="1" form="form--add-update-certification" <?php echo $AR['revoke_audit_reference'] > 0? 'checked' : '' ?>>
		  	<span class="mdl-switch__label">Revoke </span>
		</label>
	</div>

	<button class="mdl-button mdl-js-button pull-right  mdl-button--raised mdl-button--colored" form="form--add-update-certification">
		<span class="glyphicon glyphicon-floppy-disk"></span> Update 
	</button>
</section>
<div class="alert row alert-info">
	If you do not want this certification is shown on page Request Certification, Please switch on the revoke toggle <br>
	During <strong>Revoke</strong> This certification will not be displayed on the page Request Certification..
</div>

<h2>#<?php echo $AR['name'] ?></h2>

<form id="form--add-update-certification" name="form--add-update-certification" onSubmit = "UpdateNewCertification(event, this)">
	<input type="hidden" name="audit_reference" value="<?php echo $AR['audit_reference'] ?>">
	<div class="form-group">
		<label>Type</label>
		<span><?php echo $AR['type'] ?></span> <span><a href="#" onclick="$('#form-group--type').removeClass('sr-only')" class="preventDefault">Change ?</a> </span>
	</div>
	<div class="form-group sr-only" id="form-group--type">
		<div class="checkbox">
			<label><input type="radio" name="type" value="YQ-005" <?php echo ($AR['type'] == 'YQ-005')? 'checked' : '' ?> > YQ-005</label>
		</div>
		<div class="checkbox">
			<label><input type="radio" name="type" value="JECA-004" <?php echo ($AR['type'] == 'JECA-004')? 'checked' : '' ?> > JECA-004</label>
		</div>
		<div class="checkbox">
			<label><input type="radio" name="type" value="JPA-009" <?php echo ($AR['type'] == 'JPA-009')? 'checked' : '' ?> > JPA-009</label>
		</div>
		<p><a href="#" onclick="cancelChangeType('<?php echo $AR['type'] ?>')" class="preventDefault">Cancel</a></p>
	</div>

	<div class="form-group">
		<label>Certification Title</label>
		<input type="text" name="certificate_title" class="form-control" required placeholder="The Title of certificate " value="<?php echo $AR['certificate_title'] ?>">
		<span id="" class="help-block">Certification title  / name</span>
	</div>
	<div class="form-group">
		<label>Certification Code</label>
		<input type="text" name="name" class="form-control" required placeholder="The Name of certificate " value="<?php echo $AR['name'] ?>" required>
		<span id="" class="help-block">SNI ####:####</span>
	</div>
	<div class="form-group">
		<label>Use Period</label>
		<div class="input-group">
			<input type="number" name="use_period" class="form-control" required value="<?php echo $AR['use_period'] ?>">
			<span class="input-group-addon">months</span>
		</div>
		<span id="" class="help-block">calculate how many months after the previous survey. e.g 4 its mean 4 Months.</span>
	</div>
	<div class="form-group">
		<label>Resurvey Attempt</label>
		<div class="input-group">
			<input type="number" name="resurvey_attempt" class="form-control" value="<?php echo $AR['resurvey_attempt'] ?>" required>
			<span class="input-group-addon">times</span>
		</div>
		<span id="" class="help-block">calculate how many your audit will be re-survey. e.g 4 its mean 4 resurvey.</span>
	</div>
	<div class="form-group">
		<label>grace period </label>
		<div class="input-group">
			<input type="number" name="grace_period" class="form-control" value="<?php echo $AR['grace_period'] ?>" required>
			<span class="input-group-addon">months</span>
		</div>
		<span id="" class="help-block">calculate how long the period of validity after the last re-survey. in month.</span>
	</div>
	<div class="form-group">
		<label>expired period</label>
		<div class="input-group">
			<input type="number" name="expired_period" class="form-control" value="<?php echo $AR['expired_period'] ?>" required>
			<span class="input-group-addon">days</span>
		</div>
		<span id="" class="help-block">long grace period after expiration</span>
	</div>
	<div class="form-group">
		<label>Certification Note</label>
		<textarea name="certificate_note" class="form-control" value="<?php echo $AR['certificate_note'] ?>"></textarea>
	</div>
	
</form>

<script type="text/javascript">
	function UpdateNewCertification(event, ui)
	{
		swal({
			title: 'Memperbarui sertifikat',
			text: 'Sedang memperbarui status sertifikat. Silahkan tunggu!',
			type: 'info',
			allowEscapeKey: false
		})
		event.preventDefault();
		var url = site_url('certification/process/post/update/audit_reference'),
			data = $(ui).serializeArray();
		$.post(url, data)
		.done(function(res){
			swal('Status sertifikat berhasil di perbarui', '', 'success')
			window.audit_referenceList.ajax.reload();
			
		})
		.error(function(res){
			console.log(res)
			swal('error', res.statusText, 'error');
		})
	}

	function cancelChangeType(def)
	{
		$('#form-group--type').addClass('sr-only')
		$('input[type="radio"][value="'+def+'"]').prop('checked',true)
	}
</script>