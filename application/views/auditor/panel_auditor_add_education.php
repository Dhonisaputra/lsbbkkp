<!-- FAB button -->
<!-- Raised button -->
<section class="navbar">
	<div class="form-group">
		<!-- Icon button -->
		<button href="#content--auditor-profile--category-education" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-warning mdl-button mdl-js-button ">
		  <i class="material-icons">keyboard_arrow_left</i> Kembali
		</button>

		<!-- <button class="btn btn-default mdl-button mdl-js-button btn btn-info" onclick="addDraftEducationForm()">
			<i class="material-icons">add</i> Add Education
		</button> -->
		<button class="btn btn-primary mdl-button mdl-js-button pull-right" type="submit" form="form-auditor-profile--add--education">
			<i class="material-icons">save</i> Simpan
		</button>
	</div>
</section>

<center style="margin-top:10px;">
	<div class="active add-education--tab add-education--tab--formal-education">
		<div class="">
			<button class="mdl-button mdl-js-button mdl-button--fab" data-type_riwayat="0">
			  	<i class="material-icons">school</i>
			</button>
		</div>
		<div class="sub-text text-uppercase">Formal Education</div>
	</div>
	<div class="add-education--tab add-education--tab--unformal-education">
		<div class="">
			<button class="mdl-button mdl-js-button mdl-button--fab" data-type_riwayat="1">
			  	<i class="material-icons">group</i>
			</button>
		</div>
		<div class="sub-text text-uppercase">Non-Formal Education</div>
	</div>
	<div class="add-education--tab add-education--tab--teach-education">
		<div class="">
			<button class="mdl-button mdl-js-button mdl-button--fab" data-type_riwayat="2">
			  	<i class="material-icons">record_voice_over</i>
			</button>
		</div>
		<div class="sub-text text-uppercase">Teaching <i>(e.g Pembicara)</i></div>
	</div>
	
</center>


<form id="form-auditor-profile--add--education" name="form-auditor-profile--add--education" onsubmit="saveEducationDraft(event, this)"></form>


<!-- <div class="">
	<button class="mdl-button mdl-js-button pull-right" onclick="clearAllDraftEducationForm()">
		<i class="material-icons">clear_all</i> Reset Form
	</button>
</div> -->

<div class="col-md-12">
	
	<div class="auditor-profile--add--education">
		<div class="checkbox sr-only"> <label><input type="radio" name="type_riwayat" class='type_riwayat type_riwayat_0' form="form-auditor-profile--add--education" value="0" checked> Formal </label> </div>
		<div class="checkbox sr-only"> <label><input type="radio" name="type_riwayat" class='type_riwayat type_riwayat_1' form="form-auditor-profile--add--education" value="1"> non-Formal </label> </div>
		<div class="checkbox sr-only"> <label><input type="radio" name="type_riwayat" class='type_riwayat type_riwayat_2' form="form-auditor-profile--add--education" value="2"> Teach </label> </div>
		<div class="form-needed ">
			<div class="form-group">
				<label class="label-instansi">Nama Sekolah / Akademi/ Perguruan Tinggi </label>
				<input class="form-control" type="text" name="pendidikan" form="form-auditor-profile--add--education" placeholder="School / academy / college name" required>
			</div>
		</div>
		<div class="form-needed ">
			<div class="form-group">
				<label class="label-jurusan">Jurusan</label>
				<input class="form-control" type="text" name="jurusan" form="form-auditor-profile--add--education" placeholder="School Major / department" required>
			</div>
		</div>
		<div class="form-needed form-tahun-masuk sr-only">
			<div class="form-group">
				<label class="label-tahun-masuk">Tahun masuk</label>
				<input class="form-control form-formal-education--tahunmasuk" type="text" name="tahun_masuk" form="form-auditor-profile--add--education"  placeholder="" style="width:200px;" required>
			</div>
		</div>
		<div class="form-needed ">
			<div class="form-group">
				<label class="label-tahun-lulus">Tahun Lulus</label>
				<input class="form-control form-formal-education--tahunlulus" type="text" name="tahun_lulus" form="form-auditor-profile--add--education"  placeholder="" value="<?php echo date('Y-m-d') ?>" style="width:200px;" required>
			</div>
		</div>
		<div class="form-needed form-jenjang">
			<div class="form-group">
				<label class="table-jenjang">Jenjang</label>
				<input class="form-control" type="text" name="jenjang" form="form-auditor-profile--add--education" placeholder="School level ex. (D3 / S1 / S2, ..." >
			</div>
		</div>
		<div class="col-md-1 section-remove-education-draft view--hide">
			<button class="mdl-button mdl-js-button mdl-button--icon btn-remove-education-draft" onclick="removeEducationDraft(this)">
				<i class="material-icons">clear</i>
			</button>
		</div>

	</div>
</div>

<script type="text/javascript">
	function addDraftEducationForm()
	{
		var clone = $('.list-group-item-draft-education-form:first-child').clone();
		clone = $(clone)
		$(clone).appendTo('.auditor-profile--add--education.list-group').each(function(){
			$(this).find('input').val('');
			$(this).find('.section-remove-education-draft').removeClass('view--hide')
			$(this).find('.form-formal-education--tahunlulus').Zebra_DatePicker({
			  format: 'Y'
			});
		})
	}

	function removeEducationDraft(ui)
	{
		$(ui).closest('.list-group-item-draft-education-form').remove();
	}

	function clearAllDraftEducationForm()
	{
		$('.auditor-profile--add--education').find('input').val('')
		$('.list-group-item-draft-education-form:not(:first-child)').remove();
	}

	function saveEducationDraft(e, ui)
	{
		e.preventDefault();
		// var validate = 
		var validateType = $('.type_riwayat:checked').val(),
			validateData = { 0:['pendidikan','jurusan','tahun_lulus','jenjang'], 1:['pendidikan','jurusan','tahun_lulus'], 2:['pendidikan','jurusan','tahun_masuk', 'tahun_lulus'] },
			validateSelected = validateData[validateType],
			validateMiss = [];

		$.each(validateSelected, function(a,b){
			if( $('.form-needed [name="'+b+'"] ').val() === "" )
			{
				validateMiss.push(b);
			}
		})

		if(validateMiss.length > 0)
		{  
			swal('Lengkapi data pendidikan','Mohon isi dan lengkapi form tambah pendidikan auditor.','error');
			$('.form-needed [name="'+validateMiss[0]+'"] ').focus();
			return false;
		}


		var data = $('#form-auditor-profile--add--education').serializeArray();
		var Fd 	= new FormData();
		var id_auditor = '<?php echo $profile["id_auditor"] ?>';
		var defer = $.Deferred()
		$.each(data,function(key,input){
	        Fd.append(input.name,input.value);
	    });
		Fd.append('id_auditor', id_auditor);

		Snackbar.manual({message:'Menambahkan pendidikan auditor. silahkan tunggu!', spinner:true})
		$.ajax({
		    url: site_url('auditor/process/post/add_education'),
		    data: Fd,
		    contentType: false,
		    processData: false,
		    type: 'POST',
		    success: function(res){
		    	res = JSON.parse(res)
            	/*Tools.popupCenter(site_url('auditor/panel/add/education/documents/'+res.data.id_riwayat_pendidikan_auditor+'/?ajax=1'), 'Tambahkan dokumen kompetensi', '700', '500');*/
				
				// defer.resolve(res);
				window.auditorEducation.ajax.reload()
				window.auditorInformalEducation1.ajax.reload()
				window.auditorInformalEducation2.ajax.reload()
				$('.auditor-profile--add--education').find('input:not([type="radio"])').val('')
				$('.list-group-item-draft-education-form:not(:first-child)').remove();
		    	Snackbar.show('Pendidikan auditor telah selesai ditambahkan')

	            Notify.send({notification_for_level: 1,  notification_text: window.cookie.username+' menambahkan pendidikan. Silahkan klik pemberitahuan untuk membuka halaman moderasi', notification_link: site_url('auditor/panel/profile/'+window.cookie.id_users+'?openTab=content--auditor-profile--category-education,content--auditor-profile--category-education--education-requested') })
            	nav.toUrl({
		            url: site_url('auditor/panel/add/education/documents/'+res.data.id_riwayat_pendidikan_auditor+'/?ajax=1'), 
		            title: 'asdasd',
		            load:
		            {
		                target: '#document-actual-tab'
		            }
		        })
		    },
		    error: function(res)
		    {
		    	swal('error', res.statusText, 'error');
		    	Snackbar.hide('#snackbarTemp')
				console.log(res);
		    }
		});

		defer.done(function(res){
				

		})

	}
	$(document).ready(function(){
		$('.form-formal-education--tahunmasuk').Zebra_DatePicker({
			format:'Y-m-d',
		  	direction: false,

		});
		$('.form-formal-education--tahunlulus').Zebra_DatePicker({
		  	format: 'Y',
		  	direction: false,
			pair: $('.form-formal-education--tahunmasuk')

		});

        $('.add-education--tab').delegate('button', 'click', function(){
            $(this).parents('.add-education--tab').addClass('active').siblings().removeClass('active')
            var data = $(this).data(),
            	dataTahunLulus = $('.form-formal-education--tahunlulus').data('Zebra_DatePicker'),
            	dataTahunMasuk = $('.form-formal-education--tahunmasuk').data('Zebra_DatePicker');

            $('.type_riwayat_'+data.type_riwayat).trigger('click');
            $('.form-needed input').val('');
            $('.form-formal-education--tahunlulus').val('<?php echo date("Y-m-d") ?>')

            switch(data.type_riwayat)
            {
            	case 0:
            		$('.label-instansi').text('Nama sekolah / universitas / Perguruan Tinggi')
            		$('.label-instansi').siblings('input').attr('placeholder','Nama sekolah / universitas / Perguruan Tinggi')

            		$('.label-jurusan').text('Jurusan')
            		$('.label-jurusan').siblings('input').attr('placeholder','Jurusan')

            		$('.label-tahun-masuk').text('Tahun masuk')
            		$('.label-tahun-masuk').siblings('input').attr('placeholder','Tahun masuk')

            		$('.label-tahun-lulus').text('Tahun Lulus')
            		$('.label-tahun-lulus').siblings('input').attr('placeholder','Tahun lulus')


            		$('.form-tahun-masuk').addClass('sr-only')
            		$('.form-jenjang').removeClass('sr-only')

            		dataTahunMasuk.update({
						format:'Y-m-d',
            		})
            		dataTahunLulus.update({
						format:'Y-m-d',

            		})
            		break;

            	case 1:
            		$('.label-jurusan').text('Jurusan')
            		$('.label-jurusan').siblings('input').attr('placeholder','Jurusan')

            		$('.label-instansi').text('Lokasi')
            		$('.label-instansi').siblings('input').attr('placeholder','Lokasi')

            		$('.label-tahun-masuk').text('Tanggal kegiatan mulai')
            		$('.label-tahun-masuk').siblings('input').attr('placeholder','Tanggal kegiatan mulai')

            		$('.label-tahun-lulus').text('Tanggal kegiatan selesai')
            		$('.label-tahun-lulus').siblings('input').attr('placeholder','Tanggal kegiatan selesai')


            		$('.form-tahun-masuk').val('').addClass('sr-only')
            		
            		$('.form-jenjang').addClass('sr-only')

            		dataTahunMasuk.update({
						format:'Y-m-d',
            		})
            		dataTahunLulus.update({
						format:'Y-m-d',


            		})
            		break;

            	case 2:
            		$('.label-instansi').text('Lokasi')
            		$('.label-instansi').siblings('input').attr('placeholder','Lokasi')

            		$('.label-jurusan').text('Jurusan')
            		$('.label-jurusan').siblings('input').attr('placeholder','Jurusan')

            		$('.label-tahun-masuk').text('Kegiatan mulai')
            		$('.label-tahun-masuk').siblings('input').attr('placeholder','Tanggal kegiatan mulai')

            		$('.label-tahun-lulus').text('Kegiatan selesai')
            		$('.label-tahun-lulus').siblings('input').attr('placeholder','Tanggal kegiatan selesai')

            		$('.form-tahun-masuk').removeClass('sr-only')
            		$('.form-jenjang').addClass('sr-only')

            		dataTahunMasuk.update({
						format:'d/m/Y',
            		})
            		dataTahunLulus.update({
						format:'d/m/Y',
            		})

            		break;
            }
        })
	})
</script>
