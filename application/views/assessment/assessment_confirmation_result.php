
<style type="text/css">
	blockquote:before,
	blockquote:after
	{
		content: "" !important;
	}

	.collapse-toggle[aria-expanded="false"] span.sign:before
	{
		content: "\25BA";
	}

	.collapse-toggle[aria-expanded="true"] span.sign:before
	{
		content: "\25BC";
	}
	.list-assessment-result
	{
		border-bottom: 1px solid #eee;
		padding-bottom: 10px;
	}
	
</style>
<?php echo $this->load->component('css', 'css/bootstrap.tab-round-2.css') ?>


<input type="file" class="sr-only" id="confirmation-assessment--input-upload" multiple>

<div class="row">
    <div class="board">
        <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
        <div class="board-inner">
            <ul class="nav nav-tabs tab-tracker" id="myTab">
                <div class="liner"></div>
                <li class="active">
                    <a href="#home" data-toggle="tab" title="Upload dokumen kelengkapan sertifikasi" class="0500 0501">
                        <span class="round-tabs one">
                            <i class="material-icons middle tab-material-icons">backup</i>
                        </span> 
                    </a>
                </li>
                
                <li><a href="#verify" data-toggle="tab" title="completed" class="0508">
                    <span class="round-tabs two">
                    	<i class="material-icons middle tab-material-icons">verified_user</i>
                    </span> </a>
                </li>

            </ul>
        </div>

        <div class="tab-content">
	        <div class="tab-pane fade in active" id="home">
	        	<h3 class="head text-center">Dokumen hasil assessment!</h3>
                <p class="narrow text-center">
                    Silahkan Upload dokumen hasil dari assessmen yang telah dilaksanakan
                </p>

                <div class="row">
                    
                   <fieldset class="col-md-12">
                        <legend>Proses LSBBKKP</legend>
                        <div class="col-md-12">
                    
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Dokumen</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($kelengkapan['detail_system'] as $key => $value): 
                                        $status = !is_null($value['id_files'])? '<span class="text-primary"> Sudah di unggah <i class="material-icons middle icon-active">check_circle</i> </span> <button class="btn btn-danger btn-xs" onclick="upload_dokumen(event, '.$kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'].','.$value['id_master_kelengkapan_permintaan'].', '.$company['id_company'].')">Ganti</button>'  : '<span class="text-danger"> <a href="#" class="text-danger" onclick="upload_dokumen(event, '.$kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'].','.$value['id_master_kelengkapan_permintaan'].', '.$company['id_company'].')"> Unggah file </a> <i class="material-icons middle icon-danger">error</i> </span>';
                                        $required = ($value['is_important'] == 1)? '<span class="text-danger">*) harus diisi</span>' : '';
                                    ?>
                                        <tr id="master-<?php echo $value['id_master_kelengkapan_permintaan'] ?>">
                                            <td><?php echo $value['nama_dokumen'].' '.$required ?></td>
                                            <td class="master-permintaan-status"><?php echo $status ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                    
                                </tbody>
                            </table>

                        </div>
                    </fieldset>
                </div>
	        </div>
	        <div class="tab-pane fade in" id="verify">
	        	<div class="row">	

					<div class="col-md-12">

					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs nav-tabs-assessment-result" role="tablist">
					    <li role="presentation" class="active"><a class="text-uppercase" href="#assessment-result--new-assessment" aria-controls="home" role="tab" data-toggle="tab"> Permintaan baru <span class="mdl-badge badge-assessment" data-badge="<?php echo count($unconfirmed_a0) ?>"></span></a> </li>
					    <li role="presentation"><a class="text-uppercase" href="#assessment-result--reassessment" aria-controls="profile" role="tab" data-toggle="tab">Surveilen <span class="mdl-badge badge-reassessment" data-badge="<?php echo count($unconfirmed_rs) ?>"></span></a></li>
					    <li role="presentation"><a class="text-uppercase" href="#assessment-result--audit-khusus" aria-controls="profile" role="tab" data-toggle="tab">Audit Khusus <span class="mdl-badge badge-audit-khusus" data-badge="<?php echo count($audit_khusus) ?>"></span></a></li>
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content" style="padding-top:20px;">
					    <div role="tabpanel" class="tab-pane no-padding active" id="assessment-result--new-assessment">
					    	<?php $this->load->view('assessment/assessment_confirmation_result_assessment', array('unconfirmed_a0' => $unconfirmed_a0)) ?>
					    </div>

					    <!-- RS -->
					    <div role="tabpanel" class="tab-pane no-padding" id="assessment-result--reassessment">
					    	<?php $this->load->view('assessment/assessment_confirmation_result_reassessment', array('unconfirmed_rs' => $unconfirmed_rs)) ?>
					    </div>

					    <!-- audit Khusus -->
					    <div role="tabpanel" class="tab-pane no-padding" id="assessment-result--audit-khusus">
					    	<?php $this->load->view('assessment/assessment_confirmation_result_audit_khusus', array('audit_khusus' => $audit_khusus)) ?>
					    </div>
					</div>

					</div>
				</div>

	        </div>
        </div>

    </div> <!-- end of board -->
</div>

<?php echo $this->load->component('js', 'jsdata/jsdata.upload.js') ?>

<script type="text/javascript">

	function status__change(event, id_a0_cat, type, typeassessment)
	{

		swal({   title: "Memperbarui hasil sertifikasi",   text: "Memperbarui hasil sertifikasi. Silahkan tunggu sebentar!", allowEscapeKey:false,   type: "info",   showConfirmButton: false});

		var parents 	= $(event.target).parents('li.list-group-item'), // parants
			explanation = $('#explanation-fail-'+id_a0_cat).length > 0 ? $('#explanation-fail-'+id_a0_cat).val() : ''; // explanation
			certificate_note = $('#success-notes-'+id_a0_cat).length > 0 ? $('#success-notes-'+id_a0_cat).val() : ''; // explanation
			status 		= $('input[type="radio"][name="new_status_'+id_a0_cat+'"]:checked').val(); // new status
			if(!status || status == undefined || $('input[type="radio"][name="new_status_'+id_a0_cat+'"]:checked').length < 1)
			{
				console.log(status)
				swal('Hasil assessment tidak boleh kosong','Silahkan pilih salah satu status sertifikasi!','error');
				return false;
			}
			// open snackbar manual
			Snackbar.manual({message:'Memberbarui status sertifikasi. Silahkan tunggu!', spinner: true});
			
			// send ajax files with other parameters

			// old post
			// $.post(site_url('certification/create_certificate'), { 'new_status': status, 'explanation': explanation, 'type': type, 'id_a0_cat': id_a0_cat })
			
			// new ajax send. using formData; FormData inside $.Upload.data_submit();
			$.ajax({
			    url 	: site_url('certification/create_certificate'),
			    data 	: $.Upload.data_submit({ 'new_status': status, 'explanation': explanation, 'certificate_note': certificate_note, 'type': type, 'id_a0_cat': id_a0_cat }),
			    cache 	: false,
			    contentType : false,
			    processData : false,
			    type 		: 'POST',
			})

			.done(function(res){
				console.log(res);

				swal('Sertifikasi telah berhasil diperbarui','', 'success')

				// refresh table
				window.assignedassessment.ajax.reload();
				window.conductedassessment.ajax.reload();
				window.waitingresult.ajax.reload();

				// show snackbar
				Snackbar.show('Sertifikasi telah berhasil diperbarui!');

				// reset uploaded file
				if( Object.keys($.Upload.records).length > 0 )
				{
					$('.list-group-item--attachment-confirmation').remove();
					$.Upload.reset();
				}

				// status
				if( status === 'success' )
				{
					swal('Sertifikasi telah diterbitkan','Sertifikasi telah sukses diterbitkan!','success');
				}else if(status === 'fail')
				{
					swal('Kesalahan saat menerbitkan sertifikasi', 'Terdapat kesalahan saat menerbitkan hasil sertifikasi. Silahkan reload halaman ini lalu silahkan ulangi langkah menerbitkan sertifikasi!', 'error');
				}
				if(status === 'success' || status === 'fail')
				{
					// hide snackbar
					Snackbar.hide('#snackbarTemp');

					// remove accordion
					$(event.target).parents('.parent--tab').remove();

					switch(typeassessment)
					{
						case 'assessment':
							var badge = $('.badge-assessment');
							var latestBadge =  parseInt( $(badge).attr('data-badge') );
							latestBadge = latestBadge - 1;
							$(badge).attr('data-badge',latestBadge)
							break;

						case 'audit-khusus':
							var badge = $('.badge-audit-khusus');
							var latestBadge =  parseInt( $(badge).attr('data-badge') );
							latestBadge = latestBadge - 1;
							$(badge).attr('data-badge',latestBadge)

							break;
					}

					// if( $('.parent--tab-assessment').length < 1 )
					// {
					// 	Doctab.hide()
					// }

				}else
				{
					// collapse in
					$('.panel-body-'+id_a0_cat).removeClass('in');
					
					// explanation fail
					$('#explanation-fail-'+id_a0_cat).val('');
					
					// get notes
					$.post(site_url('notes/get_notes'),{ returnAs:'json', params: {notes_reference_id: id_a0_cat, notes_for_type:0} })
					.done(function(res){

						res = JSON.parse(res);

						$('.list-group-notes-'+id_a0_cat).html('');
					
						// write notes
						Tools.write_data({
							template: '<div class=""> <div><strong>Latest Status</strong>: <span class="badge">::notes_status::</span> </div> <div class="text-muted" style="font-size:13px; padding-bottom:10px;">::notes_addtime::</div> <div>::notes_content::</div> <div class="notes--files list-group">  </div> </div> <hr> ',
							records: res,
							target: $('.list-group-notes-'+id_a0_cat),
							afterAppend: function(event, ui, data)
							{
								var files = '';
								if(data.files)
								{
									$.each(data.files, function(a,b){
										var url = site_url('files/download/'+b.file_id);
										files += '<div><a href="'+url+'" target="_blank">'+b.client_name+'</a></div>'
									})
									$(ui).find('.notes--files').append(files)
								}
							}
						})
					
					})
				}

				// check jumlah .list-assessment-result
				if($('.list-assessment-result').length <= 0)
				{
					Doctab.hide();
				}
			})
			.error(function(res){
				console.log(res);
				swal('Terdapat kesalahan', res.textStatus, 'error');
			})
	}

	/*
	* function to trigger input upload confirmation
	*/
	function upload_confirmation_assessment(ui)
	{
		window.triggeredUpload = ui;
		console.log(ui)
		$('#confirmation-assessment--input-upload').trigger('click');
	}

	// remove file uploaded
	function removeFile(filename)
	{
		$.Upload.delete(filename)
		.done(function(res){
			$('#upload-confirmation-result').find('#file-uploaded-'+res.value.key).remove();
		})

	}

	// onchange input
	$('#confirmation-assessment--input-upload').on('change', function(event){
		var ui = $(this)
		var btnTrigger = $(window.triggeredUpload);
		var target= $(btnTrigger).parents('.list-assessment-result').find('.upload-confirmation-result')
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

	$(document).ready(function(){
	})
</script>
<?php #print_r($unconfirmed_a0); ?>