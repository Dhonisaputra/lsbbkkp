<section class="navbar">
		<button class="btn btn-warning text-uppercase" onclick="window.close()"> <i class="material-icons middle" >chevron_left</i> Kembali </button>
	<div class="pull-right">
		<button class="btn btn-primary text-uppercase" form="form-old" type="submit"> Save </button>
	</div>
</section>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<form onsubmit="submitOldCertificate(event, this)" name="form-old" id="form-old"> 
				<div class="form-group" >
					<label>Sertifikat sekarang</label>
					<input class="form-control" type="text" name="id_certificate" value="<?php echo $data['id_certificate'] ?>" readonly>
				</div>
				<div class="form-group">
					<label>No Sertifikat yang lama *sebagai referensi</label>
					<input class="form-control" type="hidden" name="has_old" value="<?php echo $data['has_old'] ?>">
					<input class="form-control" type="text" name="old_certificate" value="<?php echo $data['old'] ?>">
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	function submitOldCertificate(e, ui)
	{
		e.preventDefault();
		var data = $(ui).serializeArray()
			console.log(data)
		$.post(site_url('certification/process/update/reference_old_certificate'), data)
		.done(function(res){
			console.log(res)
			if( $('[name="has_old"]').val() <= 0 )
			{

				Snackbar.show('Nomor Sertifikat untuk referensi telah ditambahkan')
			}else{
				Snackbar.show('Nomor Sertifikat untuk referensi telah diperbarui')
			}
		})
	}
</script>