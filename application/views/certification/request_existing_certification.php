	
<div class="panel panel-default">
	<div class="panel-body">
		<div>
			  <!-- Tab panes -->
			<div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="existing--detail">
			    	<form id="form-detail-request" name="form-detail-auditor">
			    		
				    	<div class="form-group">
				    		<label>Tanggal assessment</label>
				    		<input type="date" name="assessment_date_start" class="form-control">
				    	</div>
				    	<div class="form-group">
	                        <label> Jumlah hari audit </label>
				    		<input type="number" name="assessment_date_finish" class="form-control">
	                    </div>

				    	<div class="form-group">
	                        <label>Pilih Resiko </label>
	                        <div class="radio"> <label> <input type="radio" name="risk" value="High"> High </label></div>
	                        <div class="radio"> <label> <input type="radio" name="risk" value="Medium"> Medium </label></div>
	                        <div class="radio"> <label> <input type="radio" name="risk" value="Low"> Low </label></div>
	                    </div>

	                    <fieldset>
	                    	<legend>Tambah auditor </legend>
					    	<div class="form-group">
					    		<div class="">
					    			<button class="btn btn-primary" type="button" onclick="openAuditorPicker()"> Tambah auditor </button>
					    		</div>
					    		<div class="auditor-assigned list-group" style="margin-top: 40px;">
					    			
					    		</div>
					    	</div>
	                    </fieldset>
				    	<div class="form-group">
				    		<button class="mdl-button mdl-js--button btn-primary" href="#existing--request" aria-controls="profile" role="tab" data-toggle="tab"> Selanjutnya <i class="material-icons">chevron_right</i> </button>
				    	</div> 
			    	</form>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="existing--request">
					<?php 
						$this->load->view('certification/request_certification', array('id_company' => $id_company) );
					?>
			    </div>
			</div>

		</div> <!-- end div after panel body -->

	</div>
</div>
<script type="text/javascript">
	function _process_insert_new_request()
	{
		$('.new-request--resave-request').addClass('sr-only')
        $('.new-request--save-request>.material-icons').removeClass('sr-only')
        swal({
            title: 'Menyimpan sertifikasi yang telah terbit sertifikasi',
            text: '<?php echo $this->load->view("templates/others/template--swetalert--new-a0-last-alert","",true) ?>',
            type: 'info',
            allowEscapeKey: false,
            showConfirmButton: false,
            html: true
        })

        var data_assessment_date_start = $('[name="assessment_date_start"]').val();
        var data_assessment_date_finish = $('[name="assessment_date_finish"]').val();
        var data_auditor_assigned = $('[name="auditor_assigned[]"]').serializeArray().map(function(res){return res.value})
        var data_as_leader = $('[name="as_leader"]:checked').val();
        var data_risk = $('[name="risk"]:checked').val();

        var data = {
        	request: $.jsdata_accreditation_request.records(), 
        	detail: {
        		audit_time_start 	: data_assessment_date_start, 
        		audit_time_finish 	: data_assessment_date_finish, 
        		auditor_assigned 	: data_auditor_assigned, 
        		as_leader 			: data_as_leader,
        		risk 				: data_risk 
        	} 
        }
        
        save_new_request({
            data:  data ,
            action: site_url('certification/insert_existing_certificate'),
            error: function(res)
            {
             	$('.new-request--resave-request').removeClass('sr-only').attr('href','javascript: _process_insert_new_request()')
                $('.new-request--save-request>.material-icons').addClass('sr-only')
                Snackbar.show('Simpan permintaan gagal. Silahkan check koneksi anda!')
                window._confirm__request_certification__saving_data_status = false;
            },
        })
        .done(function(res){
            res = JSON.parse(res);
            $('.new-request--save-request>.material-icons').removeClass('spinning').text('done').css({'color':'#4183D7'})
        	$('.new-request--resend-email').addClass('sr-only')
            $('.new-request--send-email>.material-icons').removeClass('spinning').text('done_all').css({ 'color':'#4183D7'})
            $('.new-request--save-request>.material-icons').removeClass('spinning').text('done_all')
            $('.new-request--done').removeClass('sr-only');
            window.location.href = site_url('certification/exist/detail/'+res.id_company+'/'+res.id_a0)
        })
	}

	function openAuditorPicker(requestUI)
	{
		var url = site_url('auditor/picker')+'?media=window&callback=exchange_auditor_picker_records';
		window.win = Tools.popupCenter(url,"pickAuditor",700,500)		
	}

	function exchange_auditor_picker_records(data)
	{
		console.log(data)
		$.each(data, function(a,b){
			$('.auditor-assigned').append('<div class="list-group-item list-group-item-auditor" style="min-height:50px;"> <button class="mdl-button mdl-js--button mdl-button--icon pull-right" onclick="removeAuditor(this)" type="button"> <i class="material-icons">clear</i> </button> <input type="hidden" class="list-auditor-assigned" name="auditor_assigned[]" value="'+b.id_auditor+'.'+b.jabatan+'"> <span>'+b.fullname+'</span>  <div class="radio"> <label> <input type="radio" name="as_leader" value="'+b.id_auditor+'"> as leader</label> </div>  </div>')
		})

	}
	function removeAuditor(ui)
	{
		$(ui).closest('.list-group-item-auditor').remove()
	}
	$(document).ready(function(){

		// ubah tombol batal pada addcertification jadi kembali
		$('section.navbar button:nth(0)').each(function(){
			$(this).addClass('btn-warning')
			$(this).html('<i class="material-icons">chevron_left</i> Kembali')
			$(this).attr('href','#existing--detail')
			$(this).attr('data-toggle','tab')
			$(this).removeAttr('onclick')
		})
	})
</script>