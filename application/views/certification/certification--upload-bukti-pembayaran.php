<?php echo $this->load->component('js', 'jsdata/jsdata.upload.js') ?>

<form onsubmit="filesubmit(event)">
	<input type="file" name="files">
	<input type="" name="id_a0" value="<?php echo $a0['id_a0'] ?>">
	<button class="btn btn-primary"> Simpan </button>
</form>
<div class="uploaded-document">
	
</div>

<script type="text/javascript">
	// remove file uploaded
	function removeFile(filename)
	{
		$.Upload.delete(filename)
		.done(function(res){
			$('.uploaded-document').find('#file-uploaded-'+res.value.key).remove();
		})

	}

	function filesubmit(e)
	{
		e.preventDefault();

		var data = $(e.target).serializeArray();

		$.Upload.submit({
			url: site_url('certification/process/upload/bukti_pembayaran'),
			data: {id_a0: $('[name="id_a0"]').val()}
		})
		.done(function(res){
			console.log(res)
			Snackbar.show('Nota telah diupload')
		})
	}

	$(document).ready(function(){
		$('[type="file"]').on('change', function(event){
			var ui = $(this)
			var target= $('.uploaded-document')
			// console.log(ui, btnTrigger, target)
			
			$.Upload( ui )
			.done(function(res){
				// tulis data file uploaded
				Tools.write_data({
					target: target,//'#upload-confirmation-result',
					records: res,
					template: '<div class="list-group-item list-group-item--attachment-confirmation" id="file-uploaded-::key::"> <button class=" mdl-button mdl-js-button mdl-button--icon" onclick="removeFile(\'::name::\')"><span class="material-icons">clear</span> </button> ::name:: </div>'
				})

				// reset input type file
				ui.val('');
			})
		})
	})
</script>