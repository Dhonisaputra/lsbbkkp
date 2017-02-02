<?php echo $this->load->component('js', 'plugins/ckeditor/ckeditor.js') ?>
<?php echo $this->load->component('js', 'plugins/ckeditor/adapters/jquery.js') ?>

<fieldset class="">
	<legend>Buat FaQ baru</legend>
	<div class="alert-place"></div>
	<form onsubmit="submit_new_faq(event)">
		<input type="hidden" name="faq-id" value="<?php echo isset($faq['id_faq'])? $faq['id_faq'] : '0'  ?>">
		<div class="form-group">
			<label>Isikan Judul</label>
			<input type="text" name="faq-title" class="form-control" placeholder="Judul" value="<?php echo @$faq['faq_title'] ?>">
		</div>
		<div class="form-group">
			<label>Isikan konten</label>
			<textarea class="form-control" name="faq-content"> <?php echo @$faq['faq_content'] ?> </textarea>
		</div>
		<div class="form-group">
			<label> FaQ ini untuk pengguna? </label>
			<?php 
				$array_level_selected = explode(',', @$faq['faq_for']);
				foreach ($level as $key => $value): ?>
				<div class="checkbox">
					<label class="">
					  	<input type="checkbox" id="" class="" name="faq-for[]" value="<?php echo $value['id_userlevel'] ?>" <?php echo in_array($value['id_userlevel'] , $array_level_selected)? 'checked' : '' ?> > <?php echo $value['userlevel_description'] ?>
					</label>
				</div>
			<?php endforeach ?>	
		</div>
		<div class="form-group">
			<label> Status untuk FaQ ini? </label>
			<div class="radio"><label> <input type="radio" name="faq-status" value="0" <?php echo @$faq['faq_status'] == '0'? 'checked' : '' ?>> Draft </label></div>
			<div class="radio"><label> <input type="radio" name="faq-status" value="1" <?php echo @$faq['faq_status'] == '1'? 'checked' : '' ?>> Terbitkan </label></div>
		</div>
		<div class="form-group">
			<button class="btn btn-primary flat " type="submit"> Simpan </button>
		</div>
	</form>
</fieldset>

<script type="text/javascript">
	function recovery_text(ui)
	{
		var _temp_faq = Cookies.get('_temp_faq')
		$('textarea').val(_temp_faq)
		$(ui).closest('.alert').remove();
		reset_temp();
	}

	function reset_temp()
	{
		Cookies.remove('_temp_faq')
	}
	
	function submit_new_faq(event)
	{
		Snackbar.manual({message: 'Menyimpan..', spinner: true})
		event.preventDefault();
		var data = $(event.target).serializeArray();
		$.post(site_url('users/save_new_faq'), data)
		.done(function(res){
			Snackbar.show('Selesai menyimpan')
			res = JSON.parse(res);
			reset_temp()
			if(res.faq_id)
			{
				$('[name="faq-id"]').val(res.faq_id)
				nav.toUrl({
					title: 'Edit FaQ',
					url: site_url('faq/edit/'+res.faq_id),
				})
			}
		})
	}
	$(document).ready(function(){
		

		$('textarea').ckeditor();

		$('textarea').ckeditorGet().on('key', function(e) {
			var val = $('textarea').val();
			Cookies.set('_temp_faq', val)
		});

		var _temp_faq = Cookies.get('_temp_faq')
		console.log(_temp_faq != $('textarea').val(), _temp_faq, $('textarea').val())
		if(_temp_faq && _temp_faq != '' && _temp_faq != $('textarea').val())
		{
			$('.alert-place').append('<div class="alert alert-warning"> Sistem mendeteksi ada post yang belum tersimpan. apakah anda ingin menampilkan kembali? <br> <button class="btn btn-warning" onclick="recovery_text(this)"> Tampilkan kembali </button> <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="reset_temp()"> <span aria-hidden="true">&times;</span></button></div>')
		}
		
	})
</script>