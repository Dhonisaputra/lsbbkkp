<section class="navbar">
	
	<button class="mdl-button mdl-js-button pull-right  mdl-button--raised mdl-button--colored" form="form--add-new-certification">
		<span class="glyphicon glyphicon-floppy-disk"></span> Submit 
	</button>
</section>

<form id="form--add-new-certification" name="form--add-new-certification" onSubmit = "SubmitNewCertification(event, this)">
	<div class="form-group">
		<div class="checkbox">
			<label><input type="radio" name="type" value="YQ-005"> YQ-005</label>
		</div>
		<div class="checkbox">
			<label><input type="radio" name="type" value="JECA-004"> JECA-004</label>
		</div>
		<div class="checkbox">
			<label><input type="radio" name="type" value="JPA-009"> JPA-009</label>
		</div>
	</div>

	<div class="form-group">
		<label>Certification Title</label>
		<input type="text" name="certificate_title" class="form-control" required placeholder="The Title of certificate ">
		<span id="" class="help-block">Certification title  / name</span>
	</div>
	<div class="form-group">
		<label>Certification Code</label>
		<input type="text" name="name" class="form-control" required placeholder="The Name of certificate ">
		<span id="" class="help-block">SNI ####:####</span>
	</div>
	<div class="form-group">
		<label>Use Period</label>
		<input type="number" name="use_period" class="form-control" required>
		<span id="" class="help-block">This Use period is in Month. e.g 4 its mean 4 Months.</span>
	</div>
	<div class="form-group">
		<label>Resurvey Attempt</label>
		<input type="number" name="resurvey_attempt" class="form-control" required>
		<span id="" class="help-block">Count of how many your audit will be re-survey. e.g 4 its mean 4 resurvey.</span>
	</div>
	<div class="form-group">
		<label>grace period </label>
		<input type="number" name="grace_period" class="form-control" required>
		<span id="" class="help-block">Berapa lama masa berlaku setelah re-survey. it in month.</span>
	</div>
	<div class="form-group">
		<label>expired period</label>
		<input type="number" name="expired_period" class="form-control" required>
		<span id="" class="help-block">lama masa tenggang setelah masa berlaku berakhir. *Hari..</span>
	</div>
	<div class="form-group">
		<label>Certification Note</label>
		<textarea name="certificate_note" class="form-control"></textarea>
	</div>
	
</form>

<script type="text/javascript">
	function SubmitNewCertification(event, ui)
	{
		event.preventDefault();
		var data = $(ui).serializeArray();
		console.log(data);
		$.post( site_url('certification/process/post/new_certification'), data )
		.done(function(e){
			Snackbar.show('Jenis sertifikat telah ditambahkan');
			ui.reset();
			window.allList.ajax.reload();
		})
		.error(function(e){
			console.log(e);
			swal({
				title: 'Gagal menambahkan jenis sertifikat',
				text: 'Kesalahan saat menambahkan sertifikat. silahkan coba kembali',
				type: 'error'

			})
			// Snackbar.manual({message: "SORRY! There are error on inserting new certification. please call your developer!"})
		})
	}
</script>