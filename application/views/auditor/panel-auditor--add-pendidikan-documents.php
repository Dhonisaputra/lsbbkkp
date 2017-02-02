<?php echo $this->load->component('js', 'jsdata/jsdata.upload.js') ?>
<div class="alert alert-info flat"> Silahkan upload dokumen sebagai bukti pendidikan yang telah anda laksanakan. </div>
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
		swal({
			title: 'Simpan dokumen',
			text: 'Apakah anda telah mengunggah semua permintaan? halaman ini akan ditutup setelah dokumen anda simpan.',
			type: 'warning'
			showCancelButton: true,
		}, function(res){
			if(res)
			{

				$.Upload.submit({
					url: site_url('auditor/upload_kegiatan_documents'),
					data: {id_riwayat_pendidikan_auditor: <?php echo $id_riwayat_pendidikan_auditor ?>}
				})
				.done(function(res){
					// window.close();
					console.log(res);
					nav.back();
				})
				
			}
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