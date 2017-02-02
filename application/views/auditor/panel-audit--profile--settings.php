<?php echo $this->load->component('js', 'js/zebra_datepicker/javascript/zebra_datepicker.js') ?>
<?php echo $this->load->component('css', 'js/zebra_datepicker/css/default.css') ?>
<?php echo $this->load->component('css', 'plugins/cropperjs/cropper.min.css') ?>
<?php echo $this->load->component('js', 'plugins/cropperjs/cropper.min.js') ?>
<!-- datepicker -->
<?php echo $this->load->component('js', 'plugins/foundation_datepicker/js/foundation-datepicker.min.js') ?>
<?php echo $this->load->component('css', 'plugins/foundation_datepicker/css/foundation-datepicker.min.css') ?> 
<?php
	$dateComponent = explode('-', $profile['birth_date']);
	list($year, $month, $date) = $dateComponent;
?>
<style type="text/css">
	.btn-clear--right
	{
		position: absolute;
		right: 10px;
		top: 5px;
	}

	.avatar-box
	{
		margin-top: 50px;
	}
	
	.preview-avatar
	{
		width: 100%;
	}
	.container-preview-avatar
	{
	    width: 300px;
		height: 300px;
		background: #eee;
		margin: auto;
		display: flex;
	    justify-content: center;
	    align-items: center;
	    text-align: center;
	}
</style>




<section>
	<div>

	  	<!-- Nav tabs -->
	 	 <ul class="nav nav-tabs sr-only" role="tablist">
	    	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
	    	<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
	    	<li role="presentation"><a href="#edit_photo_profile" aria-controls="edit_photo_profile" role="tab" data-toggle="tab">Profile</a></li>
	  	</ul>

	  	<!-- Tab panes -->
	  	<div class="tab-content">
	    	<div role="tabpanel" class="tab-pane active" id="home">
	    		
	    		<section class="navbar">
					<a href="<?php echo site_url('auditor/panel/profile/'.$profile['id_auditor']); ?>" class="flat text-uppercase mdl-button mdl-js-button"><i class="material-icons">chevron_left</i> Kembali ke panel profil</a>
				</section>
				<?php if(is_null($profile['auditor_password'])){ ?>
	    		<div class="alert alert-warning alert-no-account-login">
	    			Pengguna ini belum mempunyai akun login. 
	    			<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="buatAccount()">
						<i class="material-icons">vpn_lock</i> Buatkan akun
					</button>
	    		</div>
	    		<?php } ?>
	    		<div class="list-group">
	    			<div class="list-group-item">
						<center>
							<h3><strong><?php echo $profile['fullname'] ?></strong></h3>
						</center>
	    				<button class="mdl-button mdl-js-button mdl-button--icon btn-clear--right" href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="material-icons">mode_edit</i></button>
	    				<p> <strong> Tempat lahir: </strong> <?php echo $profile['birth_place'] ?> </p>
	    				<p> <strong> Tanggal lahir: </strong> <?php echo $profile['birth_date'] ?> </p>
	    				<p> <strong> Agama: </strong> <?php echo $profile['religion'] ?> </p>
	    				<p> <strong> Alamat: </strong> <?php echo $profile['address'] ?> </p>
	    				<p> <strong> Jenis Kelamin: </strong> <?php echo $profile['gender'] ?> </p>
	    				<p> <strong> NPWP: </strong> <?php echo $profile['npwp'] ?> </p>
	    				<p> <strong> Email: </strong> <?php echo $profile['email'] ?> </p>
	    				<p> <strong> Instansi: </strong> <?php echo $profile['instansi'] ?> </p>
	    				<p> <strong> Kompetensi: </strong> <?php echo $profile['competency'] ?> </p>
	    				<p> <strong> Jabatan: </strong> <?php echo $profile['nama_jabatan'] ?> </p>
	    			</div>
	    			<div class="list-group-item">
                        <img class="img-thumbnail img-responsive" style="width:48px;" src="<?php echo $profile['avatar'] == ''? base_url('application/components/images/user.jpg') : base_url($profile['avatar']) ?>">
    					<a href="#edit_photo_profile" aria-controls="edit_photo_profile" role="tab" data-toggle="tab" class="pull-right mdl-button mdl-js-button" > Ganti photo <i class="material-icons">chevron_right</i> </a>
	    			</div>

	    			<?php 

	    				// if level !admin, unvisible
	    				if( $_SESSION['level'] == 1 )
	    				{
	    			?>
	    			<div class="list-group-item">
	    				<label>Status Dinas </label>
	    				<div class="pull-right">
	    					<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-status-dinas">
								  <input type="checkbox" id="switch-status-dinas" data-auditor_status = "<?php echo $profile['status_dinas'] ?>" data-auditor_id = "<?php echo $profile['id_auditor'] ?>" class="mdl-switch__input" <?php echo $profile['status_dinas'] == 1? 'checked' : '' ?> onchange="make_pensiun(this)" >
							  	<span class="mdl-switch__label"></span>
							</label>

	    				</div>
	    			</div>
	    			<?php 
	    				}
	    			?>
	    		</div>
	    		
	    		<?php  if( $_SESSION['level'] == 1 || $_SESSION['level'] == 100 ) { ?>
				<button class="btn-danger text-uppercase btn btn-block" onclick="removeAuditor()"> Remove this auditor</button>
				<?php } ?>
	    	</div>

	    	<!-- E D I T  -  P H O T O  P R O F I L E -->
	    	<div role="tabpanel" class="tab-pane" id="edit_photo_profile">
	    		<div class="">
		    		<section class="navbar">
						<button class="mdl-button mdl-js-button btn btn-warning" type="button" href="#home" aria-controls="home" role="tab" data-toggle="tab" >  <i class="material-icons">chevron_left</i> Kembali </button>

						<button class="mdl-button mdl-js-button btn btn-primary pull-right" onclick="update_photo()">  Simpan Photo </button>
					</section>

					<div class="avatar-box">
						<div class="container-preview-avatar">
			    			<img class="preview-avatar img-responsive noimage" data-src="<?php echo $profile['avatar'] == ''? base_url('application/components/images/user.jpg') : base_url($profile['avatar']) ?>" src="<?php echo $profile['avatar'] == ''? base_url('application/components/images/user.jpg') : base_url($profile['avatar']) ?>">
						</div>
			    		<center style="margin-top: 10px;"> 
			    			<button class="  mdl-button mdl-js-button text-uppercase trigger-crop sr-only"> Selesai </button> 
			    			<button class="  mdl-button mdl-js-button text-uppercase trigger-recrop sr-only"> <i class="material-icons">crop</i> Crop</button> 
			    			<button class=" mdl-button mdl-js-button mdl-button--icon text-uppercase trigger-upload"><i class="material-icons">add_a_photo</i></button> 
			    			<button class=" mdl-button mdl-js-button text-uppercase trigger-cancel sr-only"> Cancel <i class="material-icons">close</i></button> 
			    		</center>
			    		<input type="file" class="sr-only" id="avaupload" accept="image/*">
					</div>

		    	</div>
	    	</div>

	    	<!-- E D I T  -  P R O F I L E -->
	    	<div role="tabpanel" class="tab-pane" id="profile">
	    		<section class="navbar">
					<button class="mdl-button mdl-js-button pull-left" href="#home" aria-controls="home" role="tab" data-toggle="tab"> <i class="material-icons">chevron_left</i> Back</button>
					<button class="btn btn-primary flat text-uppercase pull-right" form="updateAuditor" type="submit">Update</button>
				</section>
				<h4><strong><?php echo $profile['fullname'] ?></strong></h4>
				<hr>
				<form id="updateAuditor" name="updateAuditor" onsubmit="updateProfileAuditor(event, this)">
					<input  name="id_auditor" type="hidden" value="<?php echo $profile['id_auditor'] ?>" required>
		    		<!-- tempat lahir -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label>Birth place</label>
								<input class="form-control" name="birth_place" placeholder="Birth Place" value="<?php echo $profile['birth_place'] ?>" required>
							</div>
						</div> <!-- end of col-md-6 -->
					</div> <!-- end of row -->

					<!-- Tanggal Lahir -->
					<div class="row">
						<div class="col-md-4">
							<div class="form-group required">
								<label>Birth Year</label>
								<input type="year" id="birth_year" class="form-control" placeholder="Birth Year example: 1980" pattern="(?:19|20)[0-9]{2}" value="<?php echo $year ?>"  required>
							</div>
						</div> <!-- end of col-md-6 -->
						<div class="col-md-4">
							<div class="form-group required">
								<label>Birth Month</label>
								<input type="text" id="birth_month" class="form-control" placeholder="example: 01 for January" pattern="(0[1-9]|1[012])" value="<?php echo $month ?>" required>
							</div>
						</div> <!-- end of col-md-6 -->
						<div class="col-md-4">
							<div class="form-group required">
								<label>Birth Date</label>
								<input type="text" id="birth_date" class="form-control" placeholder="Fill date from 01 until 31" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])" value="<?php echo $date ?>" required>
							</div>
						</div> <!-- end of col-md-6 -->
					</div> <!-- end of row -->

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Religion</label>
								<select class="form-control" name="religion">
									<option value="islam" <?php echo ($profile['religion'] == 'islam')? 'selected' : ''; ?> >Islam</option>
									<option value="kristen" <?php echo ($profile['religion'] == 'kristen')? 'selected' : ''; ?> >Kristen</option>
									<option value="katolik" <?php echo ($profile['religion'] == 'katolik')? 'selected' : ''; ?> >Katolik</option>
									<option value="hindu" <?php echo ($profile['religion'] == 'hindu')? 'selected' : ''; ?> >Hindu</option>
									<option value="budha" <?php echo ($profile['religion'] == 'budha')? 'selected' : ''; ?> >Budha</option>
									<option value="konghuchu" <?php echo ($profile['religion'] == 'konghuchu')? 'selected' : ''; ?> >Konghuchu</option>
									<option value="protestan" <?php echo ($profile['religion'] == 'protestan')? 'selected' : ''; ?> >konghuchu</option>

								</select>
							</div>
						</div> <!-- end of col-md-6 -->
					</div> <!-- end of row -->

					<!-- Desa-->
					<div class="row">
						<div class="col-md-3">
							<div class="form-group required">
								<label>Village / Desa</label>
								<input class="form-control" name="desa" placeholder="Village" value="<?php echo $profile['desa'] ?>" required>
							</div>
						</div> <!-- end of col-md-3 -->
						<div class="col-md-3">
							<div class="form-group required">
								<label>sub district / Kecamatan</label>
								<input class="form-control" name="kecamatan" placeholder="Sub District" value="<?php echo $profile['kecamatan'] ?>" required>
							</div>
						</div> <!-- end of col-md-3 -->
						<div class="col-md-3">
							<div class="form-group required">
								<label>Regency / Kabupaten</label>
								<input class="form-control" name="kabupaten" placeholder="Regency" value="<?php echo $profile['kabupaten'] ?>" required>
							</div>
						</div> <!-- end of col-md-3 -->
					</div> <!-- end of row -->

					<div class="row">
						<div class="col-md-3">
							<div class="form-group required">
								<label>City</label>
								<input class="form-control" name="kota" placeholder="City" value="<?php echo $profile['kota'] ?>" required>
							</div>
						</div> <!-- end of col-md-3 -->
						<div class="col-md-3 ">
							<div class="form-group required">
								<label>Province</label>
								<input class="form-control" name="provinsi" placeholder="Provinsi" value="<?php echo $profile['provinsi'] ?>" required>
							</div>
						</div> <!-- end of col-md-3 -->
						<div class="col-md-3">
							<div class="form-group">
								<label>Postal Code</label>
								<input class="form-control" name="postal" placeholder="Postal Code" value="<?php echo $profile['postal'] ?>">
							</div>
						</div> <!-- end of col-md-3 -->
					</div> <!-- end of row -->

					<!-- address -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ">
								<label>Detail Address</label>
								<textarea class="form-control" name="address" placeholder="Seperti nama jalan, No Rumah, Gang, dll" ><?php echo $profile['address'] ?></textarea>
							</div>
						</div> <!-- end of col-md-6 -->
					</div> <!-- end of row -->

					<div class="">

						<div class="form-group required">
							<label>Gender</label>
							<div class="checkbox" required>
								<label><input type="radio" name="gender" value="L" <?php echo ($profile['gender'] == 'L')? 'checked' : ''; ?> >Male</label>
							</div>
							<div class="checkbox" required>
								<label><input type="radio" name="gender" value="P" <?php echo ($profile['gender'] == 'P')? 'checked' : ''; ?> >Female</label>
							</div>
						</div>
					</div> <!-- end of row -->

					<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label>NPWP</label>
								<input class="form-control" name="npwp" placeholder="NPWP" value="<?php echo $profile['npwp'] ?>" required>
							</div>
						</div> <!-- end of col-md-6 -->
					</div> <!-- end of row -->

					<!-- martial status -->
					<div class="">
						<div class="form-group required">
							<label>Marital status</label>
							<div class="checkbox" required>
								<label><input type="radio" name="martial_status" value="menikah" <?php echo ($profile['martial_status'] == 'P')? 'checked' : 'menikah'; ?> >Married</label>
							</div>
							<div class="checkbox" required>
								<label><input type="radio" name="martial_status" value="bujang" <?php echo ($profile['martial_status'] == 'P')? 'checked' : 'bujang'; ?> >Single</label>
							</div>
						</div>
					</div> <!-- end of row -->

					<!-- Email -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label>Email</label>
								<input class="form-control" type="email" name="email" placeholder="somemail@domain.com" value="<?php echo $profile['email'] ?>" required>
							</div>
						</div> <!-- end of col-md-6 -->
					</div> <!-- end of row -->

					<!-- Telephone -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone Number (e.g Home)</label>
								<input class="form-control" name="telephone_number" placeholder="example: (0351) ### ###" value="<?php echo $profile['telephone_number'] ?>">
							</div>
						</div> <!-- end of col-md-6 -->
					</div> <!-- end of row -->

					<!-- mobile phone -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group required">
								<label>Mobile Phone Number (e.g Handphone)</label>
								<input class="form-control" name="phone_number" placeholder="example : 0851-####-####" value="<?php echo $profile['phone_number'] ?>" required>
							</div>
						</div> <!-- end of col-md-6 -->
					</div> <!-- end of row -->

					<!-- instansi -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Instansi</label>
								<input class="form-control" name="instansi" placeholder="instansi" value="LSBBKKP">
							</div>
						</div> <!-- end of col-md-6 -->
					</div> <!-- end of row -->
	    		<?php  if( $_SESSION['level'] == 1 ) { ?>
					<!-- Jabatan -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<select id="editor_jabatan" class="form-control" name="jabatan">
									
								</select>

								<!-- <input class="form-control" type="hidden" name="jabatan" value="<?php echo $profile['id_jabatan'] ?>" required> -->
							</div>
						</div> <!-- end of col-md-6 -->
					</div> <!-- end of row -->
				<?php } ?>
				</form> <!-- end of form -->

	    	</div> <!-- end of tabpanel -->
	  	</div>

	</div>
</section>
<script type="text/javascript">
	function buatAccount()
	{
		var email = "<?php echo $profile['email'] ?>";
		var phone_number = "<?php echo $profile['phone_number'] ?>";

		if(!email && !phone_number)
		{
			swal('Gagal membuat akun auditor', 'Email dan nomor telephone auditor belum diisi. Silahkan isi terlebih dahulu email / nomor telephone untuk login!', 'error');
			return false;
		}

		Snackbar.manual({message: 'Membuat akun login. Silahkan tunggu!', spinner: true });
		
		$.post( site_url('auditor/create_new_account_auditor'), {id_auditor:<?php echo $profile['id_auditor'] ?>, password: 12345} )
		.done(function(res){
			Snackbar.show('Akun login selesai dibuat.')
			swal('Sukses','Akun login telah dibuat. auditor dapat melakukan login.', 'success');
			$('.alert-no-account-login').remove();
		})
		.fail(function(res){
			Snackbar.show('Akun login gagal dibuat.')
			swal('kesalahan terdeteksi', 'kesalahan saat menambahkan akun login. silahkan ulangi kembali!', 'error');
		})
	} 

	function make_pensiun(ui)
	{
		var $this = $(ui)
			$data = $this.data(),
			status_dinas = ($data.auditor_status == 0)? 1 : 0;


		$.post( site_url('auditor/update_auditor'), {id_auditor: $data.auditor_id, status_dinas: status_dinas} )
		.done(function(res){
		})
		.fail(function(res){
			console.log(res)
		})
	}
	function updateProfileAuditor(event, ui)
	{
		event.preventDefault();
		Snackbar.manual({message: 'Updating auditor please wait!', spinner:true});
		var data = $(ui).serializeArray()
		var y = $('#birth_year').val();
		var m = $('#birth_month').val();
		var d = $('#birth_date').val();
		data.push({name: 'birth_date', value:y+'/'+m+'/'+d})

		$.post( site_url('auditor/process/update/auditor'), data )
		.done(function(res){
			Snackbar.show('Auditor selesai diperbaiki. memuat ulang!')
			window.location.reload();
		})
	}

	function getJabatan()
	{
		$.post(site_url('auditor/process/get/jabatan'))
		.done(function(res){
			res = JSON.parse(res);
			$.each(res, function(a,b){
				$('#editor_jabatan').append('<option value="'+b.id_jabatan+'">'+b.nama_jabatan+'</option>')
			})
			$('#editor_jabatan').val("<?php echo $profile['id_jabatan'] ?>")
		})
	}
	function removeAuditor()
	{
		swal({
			title: 'Hapus auditor',
			text: 'Apakah anda yakin akan menghapus auditor ini? anda tidak dapat membatalkan dan auditor ini akan dihapus permanen.',
			type: 'warning',
			showCancelButton: true,
			closeOnConfirm: true,
		}, function(e){
			if(e)
			{
				Snackbar.manual({message: 'Silahkan tunggu! sedang menghapus auditor', spinner: true})

				var data = {id_auditor: parseInt($('input[name="id_auditor"]').val()) }
				$.post( site_url('auditor/process/delete/auditor'), data )
				.done(function(res){
					swal({
						title: 'Auditor telah dihapus',
						text: 'Auditor ini sudah tidak tersedia. Setelah anda klik tombol OK, anda akan dialihkan menuju halaman daftar auditor.',
						type: 'success',
						allowEscapeButton: false,
					}, function(e){
						if(e)
						{
							window.location.href = site_url('auditor');					
						}
					})
				})
				.fail(function(){
					swal('Kesalahan saat menghapus auditor', 'Kesalahan saat menghapus auditor. Silahkan ulangi kembali!', 'error')
				})
			}
		});
	}

	function previewImage(data)
	{
		var deff = $.Deferred();
		var reader      = new FileReader();
		reader.onloadend = function()
		{

        	$('.preview-avatar').removeClass('noimage').attr('src',reader.result)  // if you want to add more result to other element
        	.each(function(){			
	        	deff.resolve(reader.result)
        	})
		}
		
		reader.readAsDataURL(data);
		return $.when(deff.promise());
	}

	function cropDestroy()
	{
		if( (typeof window.cropper === 'object' && typeof window.cropper.destroy === 'function' )) 
		{
			window.cropper.destroy();
		}
	}

	function update_photo()
	{
		var formData = new FormData();
		formData.append('id_auditor', "<?php echo $profile['id_auditor'] ?>");

		window.cropper.blobData.toBlob(function (blob) {
			formData.append('avatar', blob);

			$.ajax(site_url('auditor/process/update/photo_auditor'), {
		    	method: "POST",
		    	data: formData,
		    	processData: false,
		    	contentType: false,
		    	success: function (res) {
		    	},
		    	error: function (res) {
		    		console.log(res)
		    	}
		  	});

		})
	}

	$(document).ready(function(){
		getJabatan();

		$('#avaupload').on('change',function(){
		    var value = $(this).val(),
		    	$this = $(this)

		    window.image = $('.preview-avatar')[0]
    		cropDestroy();
    		

		    if(value == '')
		    {
		    	$('.preview-avatar').addClass('noimage').removeAttr('src')
		        return false;
		    }
		       
		    var file = $(this)[0].files[0];
		    previewImage(file)
		    .done(function(result){
		    	window.cropper = new Cropper(window.image, {
				  aspectRatio: 1 / 1,
				});

		    	$('.trigger-crop, .trigger-cancel').removeClass('sr-only')
				$('.trigger-upload').addClass('sr-only');
		    })
		});

		$('.trigger-upload, .preview-avatar.noimage').on('click', function(){
			$('#avaupload').trigger('click')
		})
		
		$('.trigger-cancel').on('click', function(){
    		cropDestroy();
    		var data = $('.preview-avatar').data();
    		$('#avaupload').val('')
	    	$('.preview-avatar').addClass('noimage').attr('src', data.src)
	    	$('.trigger-crop, .trigger-cancel, .trigger-recrop').addClass('sr-only')
			$('.trigger-upload').removeClass('sr-only');
		})

		$('.trigger-crop').on('click', function(){
    		var a = window.cropper.getCroppedCanvas();
    		window.cropper.blobData = a;

    		a = a.toDataURL();
    		cropDestroy();
			$('.preview-avatar').attr('src', a);
	    	$('.trigger-recrop, .trigger-cancel').removeClass('sr-only')
	    	$('.trigger-crop').addClass('sr-only')
		})

		$('.trigger-recrop').on('click', function(){
			$('#avaupload').each(function(){
				var value = $(this).val(),
			    	$this = $(this)

			    window.image = $('.preview-avatar')[0]
	    		cropDestroy();
	    		

			    if(value == '')
			    {
			    	$('.preview-avatar').addClass('noimage').removeAttr('src')
			        return false;
			    }
			       
			    var file = $(this)[0].files[0];
			    previewImage(file)
			    .done(function(result){
			    	window.cropper = new Cropper(window.image, {
					  aspectRatio: 1 / 1,
					});

			    	$('.trigger-crop').removeClass('sr-only')
					$('.trigger-upload, .trigger-recrop').addClass('sr-only');
			    })
			
			});
		});

		var birthYear = $('#birth_year')
		.fdatepicker({
			format: 'yyyy',
			startView:4,
			startDate: '1950',
			minView: 4,
			maxView:4,
			leftArrow: '<i class="material-icons">keyboard_arrow_left</i>',
			rightArrow: '<i class="material-icons">keyboard_arrow_right</i>',
		})
		var birthMonth = $('#birth_month')
		.fdatepicker({
			format: 'mm',
			startView:3,
			startDate: '1950-01-01',
			minView: 3,
			maxView:3,
			leftArrow: '<i class="material-icons">keyboard_arrow_left</i>',
			rightArrow: '<i class="material-icons">keyboard_arrow_right</i>',
		})
		.on('show', function(e){
			birthMonth.fdatepicker('update',birthYear.val())

		})
		$('#birth_date').fdatepicker({
			format:'dd',
			startView: 2,
			leftArrow: '<i class="material-icons">keyboard_arrow_left</i>',
			rightArrow: '<i class="material-icons">keyboard_arrow_right</i>',
		})
		
	})
</script>