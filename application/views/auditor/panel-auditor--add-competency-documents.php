<?php echo $this->load->component('js', 'jsdata/jsdata.upload.js') ?>
<section class="navbar">
	<div class="container-fluid">
		<button class="mdl-button mdl-js-button" onclick="nav.back()"><i class="material-icons middle">chevron_left</i> Kembali </button>
		<button class="btn btn-primary" onclick="$('.input-upload-document').trigger('click')">Tambah file <i class="material-icons middle">cloud_upload</i></button>
		<input type="file" name="upload" class="sr-only input-upload-document">
		<button class="btn btn-primary pull-right" onclick="filesubmit()"> Simpan dokumen <i class="material-icons middle">archive</i></button>
	</div>
</section>
<div class="list-group list-group-document">
		
</div>
<script type="text/javascript">
	// remove file uploaded
	function removeFile(filename, key)
	{
		$.Upload.delete(filename,key)
		.done(function(res){
			$('.list-group-document').find('#file-uploaded-'+res.value.key).remove();
		})
	}

	function filesubmit()
	{
		$.Upload.submit({
			url: site_url('auditor/upload_competency_document'),
			data: {id_auditor: <?php echo $id_auditor ?>, competency: <?php echo $id_competency ?>}
		})
		.done(function(res){
			/*window.opener.sign_document_done();
			window.close();
			console.log(res);*/
			nav.back();
		})
	}

	$(document).ready(function(){
		$('.input-upload-document').on('change', function(event){
			event.preventDefault();
			$.Upload( $(this) )
			.done(function(res){
				console.log(res);
				// tulis data file uploaded
				Tools.write_data({
					target: $('.list-group-document'),//'#upload-confirmation-result',
					records: res,
					template: '<div class="list-group-item list-group-item--attachment-confirmation" id="file-uploaded-::key::"> <button class=" mdl-button mdl-js-button mdl-button--icon" onclick="removeFile(\'::name::\',::key::)"><span class="material-icons">clear</span> </button> ::name:: </div>'
				})

				// reset input type file
				$('.input-upload-document').val('');
			})
		})
	})
</script>