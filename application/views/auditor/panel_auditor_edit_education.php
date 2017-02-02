<!-- FAB button -->
<!-- Raised button -->
<section class="navbar">
	<div class="form-group">
		<!-- Icon button -->
		<button href="#content--auditor-profile--overview" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-warning mdl-button mdl-js-button ">
		  <i class="material-icons">keyboard_arrow_left</i> Kembali
		</button>

		<!-- <button class="btn btn-default mdl-button mdl-js-button btn btn-info" onclick="addDraftEducationForm()">
			<i class="material-icons">add</i> Add Education
		</button> -->
		<button class="btn btn-primary mdl-button mdl-js-button pull-right" type="submit" form="form-auditor-profile--edit--education">
			<i class="material-icons">save</i> Simpan
		</button>
	</div>
</section>

<center style="margin-top:10px;">
	<div class="active edit-education--tab edit-education--tab--formal-education sr-only">
		<div class="">
			<button class="mdl-button mdl-js-button mdl-button--fab" data-type_riwayat="0">
			  	<i class="material-icons">school</i>
			</button>
		</div>
		<div class="sub-text">Pendidikan Formal</div>
	</div>
	<div class="edit-education--tab edit-education--tab--unformal-education sr-only">
		<div class="">
			<button class="mdl-button mdl-js-button mdl-button--fab" data-type_riwayat="1">
			  	<i class="material-icons">group</i>
			</button>
		</div>
		<div class="sub-text">Pendidikan Non-formal</div>
	</div>
	<div class="edit-education--tab edit-education--tab--teach-education sr-only">
		<div class="">
			<button class="mdl-button mdl-js-button mdl-button--fab" data-type_riwayat="2">
			  	<i class="material-icons">record_voice_over</i>
			</button>
		</div>
		<div class="sub-text">Teaching <i>(e.g Pembicara)</i></div>
	</div>
	
</center>


<form id="form-auditor-profile--edit--education" name="form-auditor-profile--edit--education" onsubmit="updateEducationDraft(event, this)">


<!-- <div class="">
	<button class="mdl-button mdl-js-button pull-right" onclick="clearAllDraftEducationForm()">
		<i class="material-icons">clear_all</i> Reset Form
	</button>
</div> -->

	<div class="col-md-12">
		
		<div class="auditor-profile--add--education">
			<div class="checkbox sr-only"> <label><input type="radio" name="type_riwayat" class='type_riwayat type_riwayat_0' form="form-auditor-profile--edit--education" value="0" checked> Formal </label> </div>
			<div class="checkbox sr-only"> <label><input type="radio" name="type_riwayat" class='type_riwayat type_riwayat_1' form="form-auditor-profile--edit--education" value="1"> non-Formal </label> </div>
			<div class="checkbox sr-only"> <label><input type="radio" name="type_riwayat" class='type_riwayat type_riwayat_2' form="form-auditor-profile--edit--education" value="2"> Teach </label> </div>
			<input type="hidden" name="id_riwayat_pendidikan_auditor" form="form-auditor-profile--edit--education">
			<input type="hidden" name="id_auditor" form="form-auditor-profile--edit--education">
			<div class="form-needed ">
				<div class="form-group">
					<label class="label-instansi">School's Name / Academy/ Perguruan Tinggi </label>
					<input class="form-control" type="text" name="pendidikan" form="form-auditor-profile--edit--education" placeholder="School / Academy / college name" required>
				</div>
			</div>
			<div class="form-needed ">
				<div class="form-group">
					<label class="label-jurusan">Jurusan</label>
					<input class="form-control" type="text" name="jurusan" form="form-auditor-profile--edit--education" placeholder="School major / department" required>
				</div>
			</div>
			<div class="form-needed form-tahun-masuk sr-only">
				<div class="form-group">
					<label class="label-tahun-masuk">Tahun masuk</label>
					<input class="form-control form-formal-education--tahunmasuk" type="text" name="tahun_masuk" form="form-auditor-profile--edit--education"  placeholder="" style="width:200px;" required>
				</div>
			</div>
			<div class="form-needed ">
				<div class="form-group">
					<label class="label-tahun-lulus">Tahun Lulus</label>
					<input class="form-control form-formal-education--tahunlulus" type="text" name="tahun_lulus" form="form-auditor-profile--edit--education"  placeholder="" value="<?php echo date('Y-m-d') ?>" style="width:200px;" required>
				</div>
			</div>
			<div class="form-needed form-jenjang">
				<div class="form-group">
					<label class="table-jenjang">Jenjang</label>
					<input class="form-control" type="text" name="jenjang" form="form-auditor-profile--edit--education" placeholder="School level e.g (D3 / S1 / S2, ..." >
				</div>
			</div>
			<div class="col-md-1 section-remove-education-draft view--hide">
				<button class="mdl-button mdl-js-button mdl-button--icon btn-remove-education-draft" onclick="removeEducationDraft(this)">
					<i class="material-icons">clear</i>
				</button>
			</div>

		</div>
	</div>
</form>

<script type="text/javascript">
	var $FORM = $('#form-auditor-profile--edit--education');

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
		$FORM.find(ui).closest('.list-group-item-draft-education-form').remove();
	}

	function clearAllDraftEducationForm()
	{
		$FORM.find('.auditor-profile--add--education').find('input').val('')
		$FORM.find('.list-group-item-draft-education-form:not(:first-child)').remove();
	}

	function updateEducationDraft(e, ui)
	{
		e.preventDefault();
		// var validate = 
		var validateType = $FORM.find('.type_riwayat:checked').val(),
			validateData = { 0:['pendidikan','jurusan','tahun_lulus','jenjang'], 1:['pendidikan','jurusan','tahun_lulus'], 2:['pendidikan','jurusan','tahun_masuk', 'tahun_lulus'] },
			validateSelected = validateData[validateType],
			validateMiss = [];

		$.each(validateSelected, function(a,b){
			if( $(ui).find('.form-needed [name="'+b+'"] ').val() === "" )
			{
				validateMiss.push(b);
			}
		})

		if(validateMiss.length > 0)
		{  
			swal('Lengkapi data pendidikan','Mohon isi dan lengkapi form tambah pendidikan auditor.','error');
			$(ui).find('.form-needed [name="'+validateMiss[0]+'"] ').focus();
			return false;
		}


		var data = $('#form-auditor-profile--edit--education').serializeArray();
		var Fd 	= new FormData();
		var id_auditor = '<?php echo $profile["id_auditor"] ?>';
		var defer = $.Deferred()
		$.each(data,function(key,input){
	        Fd.append(input.name,input.value);
	    });
		Fd.append('id_auditor', id_auditor);
		Snackbar.manual({message:'Memperbarui data pendidikan auditor. silahkan tunggu!', spinner:true})
		$.ajax({
		    url: site_url('auditor/process/post/update_education'),
		    data: Fd,
		    contentType: false,
		    processData: false,
		    type: 'POST',
		    success: function(res){
		    	console.log(res);
				window.auditorEducation.ajax.reload()
				window.auditorInformalEducation1.ajax.reload()
				window.auditorInformalEducation2.ajax.reload()
				// clearAllDraftEducationForm();
				defer.resolve();
		    },
		    error: function(res)
		    {
		    	swal('error', res.statusText, 'error');
		    	Snackbar.hide('#snackbarTemp')
				console.log(res);
		    }
		});

		defer.done(function(){
	    	Snackbar.show('Pendidikan auditor telah selesai diperbarui')	
	    	$('<a href="#content--auditor-profile--overview" data-toggle="tab"></a>').tab('show');	
		})

	}
	$(document).ready(function(){
		$FORM.find('.form-formal-education--tahunmasuk').Zebra_DatePicker({
			format:'Y-m-d',
		  	direction: false,
			pair: $FORM.find('.form-formal-education--tahunlulus')

		});
		$FORM.find('.form-formal-education--tahunlulus').Zebra_DatePicker({
		  	format: 'Y-m-d',
		  	direction: false,
			pair: $FORM.find('.form-formal-education--tahunmasuk')

		});

        $('.edit-education--tab').delegate('button', 'click', function(){
            $(this).parents('.edit-education--tab').addClass('active').siblings().removeClass('active')
            var data = $(this).data(),
            	dataTahunLulus = $FORM.find('.form-formal-education--tahunlulus').data('Zebra_DatePicker'),
            	dataTahunMasuk = $FORM.find('.form-formal-education--tahunmasuk').data('Zebra_DatePicker');

            $FORM.find('.type_riwayat_'+data.type_riwayat).trigger('click');
            $FORM.find('.form-needed input').val('');
            $FORM.find('.form-formal-education--tahunlulus').val('<?php echo date("Y-m-d") ?>')

            switch(data.type_riwayat)
            {
            	case 0:
            		$FORM.find('.label-instansi').text('School / academy / college name')
            		$FORM.find('.label-instansi').siblings('input').attr('placeholder','School / academy / college name')

            		$FORM.find('.label-jurusan').text('School major / department')
            		$FORM.find('.label-jurusan').siblings('input').attr('placeholder','School major / department')

            		$FORM.find('.label-tahun-masuk').text('Year entry')
            		$FORM.find('.label-tahun-masuk').siblings('input').attr('placeholder','year you register')

            		$FORM.find('.label-tahun-lulus').text('Graduate year')
            		$FORM.find('.label-tahun-lulus').siblings('input').attr('placeholder','The Year you graduate')


            		$FORM.find('.form-tahun-masuk').addClass('sr-only')
            		$FORM.find('.form-jenjang').removeClass('sr-only')

            		dataTahunMasuk.update({
						format:'Y-m-d',
            		})
            		dataTahunLulus.update({
						format:'Y-m-d',

            		})
            		break;

            	case 1:
            		$FORM.find('.label-jurusan').text('Subject')
            		$FORM.find('.label-jurusan').siblings('input').attr('placeholder','Subject')

            		$FORM.find('.label-instansi').text('Place')
            		$FORM.find('.label-instansi').siblings('input').attr('placeholder','Place ')

            		$FORM.find('.label-tahun-masuk').text('Start at')
            		$FORM.find('.label-tahun-masuk').siblings('input').attr('placeholder','The date of activity start')

            		$FORM.find('.label-tahun-lulus').text('Finish at')
            		$FORM.find('.label-tahun-lulus').siblings('input').attr('placeholder','The date of activity finish')


            		$FORM.find('.form-tahun-masuk').val('').addClass('sr-only')
            		
            		$FORM.find('.form-jenjang').addClass('sr-only')

            		dataTahunMasuk.update({
						format:'Y-m-d',
            		})
            		dataTahunLulus.update({
						format:'Y-m-d',


            		})
            		break;

            	case 2:
            		$FORM.find('.label-instansi').text('Place / Tempat')
            		$FORM.find('.label-instansi').siblings('input').attr('placeholder','Place / Tempat Kegiatan')

            		$FORM.find('.label-jurusan').text('Subject')
            		$FORM.find('.label-jurusan').siblings('input').attr('placeholder','Subject')

            		$FORM.find('.label-tahun-masuk').text('Start at')
            		$FORM.find('.label-tahun-masuk').siblings('input').attr('placeholder','The date of activity start')

            		$FORM.find('.label-tahun-lulus').text('Finish at')
            		$FORM.find('.label-tahun-lulus').siblings('input').attr('placeholder','The date of activity finish')

            		$FORM.find('.form-tahun-masuk').removeClass('sr-only')
            		$FORM.find('.form-jenjang').addClass('sr-only')

            		dataTahunMasuk.update({
						format:'Y-m-d',
            		})
            		dataTahunLulus.update({
						format:'Y-m-d',
            		})

            		break;
            }
        })
	})
</script>
