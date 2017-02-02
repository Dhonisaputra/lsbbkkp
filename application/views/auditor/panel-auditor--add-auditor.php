
<?php echo $this->load->component('js', 'js/zebra_datepicker/javascript/zebra_datepicker.js') ?>
<?php echo $this->load->component('css', 'js/zebra_datepicker/css/default.css') ?>
<?php echo $this->load->component('css', 'plugins/cropperjs/cropper.min.css') ?>
<?php echo $this->load->component('js', 'plugins/cropperjs/cropper.min.js') ?>
<style type="text/css">
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
<div class="tab-content">

    <div role="tabpanel" class="tab-pane " id="add-auditor--common">
		
		<form id="add-auditor--form--common" class='form-new-auditor' name="add-auditor--form--common" onsubmit="common_submit(event, this)">
			
			<section class="navbar">
				<button class="mdl-button mdl-js-button btn btn-danger" type="button" onclick="Doctab.hide();" >  <i class="material-icons">clear</i> Cancel </button>
				<button class="mdl-button mdl-js-button btn btn-warning pull-right" >  Next <i class="material-icons">chevron_right</i> </button>
			</section>

			<div class="alert alert-default">
				Sign (<strong class="text-danger" style="font-size:18px;">*</strong>) must be fill!
			</div>
			<!-- Full Name -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group required">
						<label>Nama lengkap</label>
						<input class="form-control" name="fullname" placeholder="Fullname" required>
					</div>
				</div> <!-- end of col-md-6 -->
			</div> <!-- end of row -->

			<!-- tempat lahir -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group required">
						<label>Tempat lahir</label>
						<input class="form-control" name="birth_place" placeholder="Birth Place" required>
					</div>
				</div> <!-- end of col-md-6 -->
			</div> <!-- end of row -->

			<!-- Tanggal Lahir -->
			<div class="row">
				<div class="col-md-4">
					<div class="form-group required">
						<label>Tahun lahir</label>
						<input type="year" id="birth_year" class="form-control" placeholder="Birth Year example: 1980" pattern="(?:19|20)[0-9]{2}" required>
					</div>
				</div> <!-- end of col-md-6 -->
				<div class="col-md-4">
					<div class="form-group required">
						<label>Bulan lahir</label>
						<input type="text" id="birth_month" class="form-control" placeholder="example: 01 for January" pattern="(0[1-9]|1[012])" required>
					</div>
				</div> <!-- end of col-md-6 -->
				<div class="col-md-4">
					<div class="form-group required">
						<label>Tanggal lahir</label>
						<input type="text" id="birth_date" class="form-control" placeholder="Fill date from 01 until 31" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])" required>
					</div>
				</div> <!-- end of col-md-6 -->
			</div> <!-- end of row -->

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Agama</label>
						<select class="form-control" name="religion">
							<option value="islam">Islam</option>
							<option value="kristen">Kristen</option>
							<option value="katolik">Katolik</option>
							<option value="hindu">Hindu</option>
							<option value="budha">Budha</option>
							<option value="konghuchu">Konghuchu</option>
							<option value="protestan">protestan</option>

						</select>
					</div>
				</div> <!-- end of col-md-6 -->
			</div> <!-- end of row -->

			<!-- Desa-->
			<div class="row">
				<div class="col-md-3">
					<div class="form-group required">
						<label>Desa</label>
						<input class="form-control" name="desa" placeholder="desa" required>
					</div>
				</div> <!-- end of col-md-3 -->
				<div class="col-md-3">
					<div class="form-group required">
						<label>Kecamatan</label>
						<input class="form-control" name="kecamatan" placeholder="Kecamatan" required>
					</div>
				</div> <!-- end of col-md-3 -->
				<div class="col-md-3">
					<div class="form-group required">
						<label>Kabupaten</label>
						<input class="form-control" name="kabupaten" placeholder="Kabuoaten" required>
					</div>
				</div> <!-- end of col-md-3 -->
			</div> <!-- end of row -->

			<div class="row">
				<div class="col-md-3">
					<div class="form-group required">
						<label>Kota</label>
						<input class="form-control" name="kota" placeholder="Kota" required>
					</div>
				</div> <!-- end of col-md-3 -->
				<div class="col-md-3 ">
					<div class="form-group required">
						<label>Provinsi</label>
						<input class="form-control" name="provinsi" placeholder="Provinsi" required>
					</div>
				</div> <!-- end of col-md-3 -->
				<div class="col-md-3">
					<div class="form-group">
						<label>Kodepos</label>
						<input class="form-control" name="postal" placeholder="Kodepos">
					</div>
				</div> <!-- end of col-md-3 -->
			</div> <!-- end of row -->

			<!-- address -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group ">
						<label>Alamat lengkap</label>
						<textarea class="form-control" name="address" placeholder="Seperti nama jalan, No Rumah, Gang, dll" ></textarea>
					</div>
				</div> <!-- end of col-md-6 -->
			</div> <!-- end of row -->

			<div class="">

				<div class="form-group required">
					<label>Jenis Kelamin</label>
					<div class="checkbox" required>
						<label><input type="radio" name="gender" value="L">Laki-laki</label>
					</div>
					<div class="checkbox" required>
						<label><input type="radio" name="gender" value="P">Perempuan</label>
					</div>
				</div>
			</div> <!-- end of row -->

		</form>
	</div>
		<!-- AUDITOR DETAIL -->
    <div role="tabpanel" class="tab-pane" id="add-auditor--detail">

		<form id="add-auditor--form--detail" class="form-new-auditor" enctype="multipart/form-data" name='add-auditor--form--detail'>
	    	<section class="navbar">
				<button class="mdl-button mdl-js-button btn btn-warning" type="button" href="#add-auditor--common" aria-controls="home" role="tab" data-toggle="tab" >  <i class="material-icons">chevron_left</i> Kembali </button>
				
				<button class="mdl-button mdl-js-button btn btn-primary pull-right" type="button" href="#add-auditor--form--account" aria-controls="home" role="tab" data-toggle="tab" >  <i class="material-icons">chevron_right</i> Selanjutnya </button>

				<!-- <button class="mdl-button mdl-js-button btn btn-primary pull-right">  Simpan auditor </button> -->
			</section>

	    	<div class="row">
				<div class="col-md-6">
					<div class="form-group required">
						<label>NPWP</label>
						<input class="form-control" name="npwp" placeholder="NPWP" required>
					</div>
				</div> <!-- end of col-md-6 -->
			</div> <!-- end of row -->

			<!-- martial status -->
			<div class="">
				<div class="form-group required">
					<label>Status perkawinan</label>
					<div class="checkbox" required>
						<label><input type="radio" name="martial_status" value="menikah">Menikah</label>
					</div>
					<div class="checkbox" required>
						<label><input type="radio" name="martial_status" value="bujang">Lajang</label>
					</div>
				</div>
			</div> <!-- end of row -->

			<!-- Email -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group required">
						<label>Email</label>
						<input class="form-control" type="email" name="email" placeholder="somemail@domain.com" required>
					</div>
				</div> <!-- end of col-md-6 -->
			</div> <!-- end of row -->

			<!-- Telephone -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nomor telephone rumah (e.g Home)</label>
						<input class="form-control" name="telephone_number" placeholder="contoh: (0351) ### ###" >
					</div>
				</div> <!-- end of col-md-6 -->
			</div> <!-- end of row -->

			<!-- mobile phone -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group required">
						<label>Nomor handphone (e.g Handphone)</label>
						<input class="form-control" name="phone_number" placeholder="contoh : 0851-####-####" required>
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

			<!-- kompetensi -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Kompetensi</label>
						<input class="form-control" name="competency" placeholder="Kompetensi Auditor" >
					</div>
				</div> <!-- end of col-md-6 -->
			</div> <!-- end of row -->

			<!-- Jabatan -->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input class="form-control" type="hidden" name="jabatan" value="<?php echo $id_jabatan ?>" required>
					</div>
				</div> <!-- end of col-md-6 -->
			</div> <!-- end of row -->
		</form>

    </div> <!-- end of tabPanel -->

    <div role="tabpanel" class="tab-pane active" id="add-auditor--form--account">
    	<div class="">
    		<section class="navbar">
				<button class="mdl-button mdl-js-button btn btn-warning" type="button" href="#add-auditor--form--detail" aria-controls="home" role="tab" data-toggle="tab" >  <i class="material-icons">chevron_left</i> Kembali </button>
				

				<button class="mdl-button mdl-js-button btn btn-primary pull-right" onclick="detail_submit()">  Simpan auditor </button>
			</section>

			<div class="avatar-box">
				<div class="container-preview-avatar">
	    			<img class="preview-avatar img-responsive noimage">
				</div>
	    		<center style="margin-top: 10px;"> 
	    			<button class="  mdl-button mdl-js-button text-uppercase trigger-crop sr-only"> Selesai </button> 
	    			<button class="  mdl-button mdl-js-button text-uppercase trigger-recrop sr-only"> <i class="material-icons">crop</i> Crop</button> 
	    			<button class=" mdl-button mdl-js-button mdl-button--icon text-uppercase trigger-upload"><i class="material-icons">add_a_photo</i></button> 
	    			<button class=" mdl-button mdl-js-button text-uppercase trigger-cancel sr-only"> Cancel <i class="material-icons">close</i></button> 
	    		</center>
	    		<input type="file" class="sr-only" id="avaupload" accept="image/*">
			</div>
			<hr>

			<div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Password</label>
							<input class="form-control" type="password">
						</div>

						<div class="form-group">
						  	<label class="control-label" for="auditor_password">Ulangi password</label>
						  	<input type="text" class="form-control" id="auditor_password" name="auditor_password" aria-describedby="auditor_password_helpBlock2">
						 	<span id="auditor_password_helpBlock2" class="help-block">Silahkan ulangi password yang anda isikan</span>
						</div>
					</div>
				</div>
			</div>
    	</div>
    </div> <!-- end of tabPanel -->

</div> <!-- end of tab-content -->

<script type="text/javascript">
	function common_submit(e, ui)
	{
		e.preventDefault();

		$('<a href="#add-auditor--detail"></a>').tab('show');
	}

	function detail_submit()
	{
		Snackbar.manual({message: 'Save auditor!', spinner:true});
		var data = $('#add-auditor--form--common, #add-auditor--form--detail ').serializeArray()
		var y = $('#birth_year').val();
		var m = $('#birth_month').val();
		var d = $('#birth_date').val();
		var formData = new FormData();
		
		data.push({name: 'birth_date', value:y+'-'+m+'-'+d})
		$.each(data, function(a, b){
			formData.append(b.name, b.value);
		})

		window.cropper.blobData.toBlob(function (blob) {
			formData.append('avatar', blob);

			$.ajax(site_url('auditor/process/post/new_auditor'), {
		    	method: "POST",
		    	data: formData,
		    	processData: false,
		    	contentType: false,
		    	success: function (res) {
		    		console.log(res)
		    	},
		    	error: function (res) {
		    		console.log(res)
		    	}
		  	});

		})

		/*$.post( site_url('auditor/process/post/new_auditor'), data )
		.done(function(res){
			// console.log(res);
			Snackbar.hide('#snackbarTemp');
			panel_auditor__auditor_data();
			Doctab.hide();

		})*/
	}

	(function ( $ ) {
 
	    $.fn.requiredFormLabel = function()
	    {
	    	$(this).each(function(){
		    	var textBefore = $(this).text();
		    	textBefore +=' <strong class="text-danger" style="font-size:18px;">*</strong>';
		    	$(this).html(textBefore);
	    	})
	    }
	 
	}( jQuery ));

	$('.form-new-auditor').find('.form-group.required>label').requiredFormLabel();

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

	$(document).ready(function(){

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
    		$('#avaupload').val('')
	    	$('.preview-avatar').addClass('noimage').removeAttr('src')
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



		$('#birth_year').Zebra_DatePicker({
		  	view: 'years',
		  	format: 'Y',
		  	start_date: '1980',
		  	readonly_element: false,
		  	show_icon: false,
		});
		$('#birth_month').Zebra_DatePicker({
		  	view: 'months',
		  	format: 'm',
		  	start_date: 'January',
		  	readonly_element: false,
		  	show_icon: false,
		});
	})

</script>
