<?php echo $this->load->component('js','js/library.company.js'); ?>
<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.material.min.js"></script>


<?php echo $this->load->component('css', 'plugins/datetimepicker/jquery.datetimepicker.css') ?>
<?php echo $this->load->component('js', 'plugins/datetimepicker/jquery.datetimepicker.min.js') ?>

<style type="text/css">
	.like-password
	{
		-webkit-text-security: disc;
	}
	.list-group-setting
	{
		min-height: 58px;
	}
	body
	{
		overflow: auto;
	}
</style>
<div class="container-system">
	<section class="navbar">
		<!-- Nav tabs -->
	  	<div class="pull-left list-group">
	  		<a href="#" class="preventDefault" onclick="openHome()" style="cursor:pointer; text-decoration:none;"> <span class="text-muted text-uppercase" style="font-size: 25px;"><?php echo $company['company_name'] ?> </span> <span class="label label-default" style="font-size:10px;">Home</span> </a>
	  	</div>
	  	<div class="btn-group pull-right">
		  	<button type="button" class="mdl-button mdl-js-button mdl-button--icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    	<span class="material-icons">more_vert</span>
		  	</button>
		  	<ul class="dropdown-menu">
		    	
		    	<li><a onclick="openSetting()">Settings</a></li>
		    	<li><a href="#">Edit Detail Perusahaan</a></li>
		    	<li role="separator" class="divider"></li>
		    	<li><a href="<?php echo site_url('users/logout').'?callback=perusahaan/login'; ?>">logout</a></li>
		  	</ul>
		</div>
	</section>
	<div class="" style="margin-top: 20px;">
		
		<div>

		  	<!-- Nav tabs -->
		  	<ul class="nav nav-tabs sr-only" role="tablist">
		    	<li class="" role="presentation" class="active"><a href="#home--perusahaan" aria-controls="home" role="tab" data-toggle="tab"></a></li>
		    	<li class="" role="presentation"><a href="#settings--perusahaan" aria-controls="profile" role="tab" data-toggle="tab"></a></li>
		    	<li class="" role="presentation"><a href="#settings--detail-certificate" aria-controls="profile" role="tab" data-toggle="tab"></a></li>
		    	
		  	</ul>

		  	<!-- Tab panes -->
		  	<div class="tab-content">
		    	<div role="tabpanel" class="tab-pane active" id="home--perusahaan">
		    		
	    			
	    			<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
	                    <div class="mdl-tabs__tab-bar">
	                        <a href="#certification-panel" class="mdl-tabs__tab is-active">Daftar Sertifikat anda</a>
	                        <a href="#schedules-panel" class="mdl-tabs__tab"> Daftar Permintaan Anda </a>
	                    </div>


	                    <div class="mdl-tabs__panel is-active table-responsive" id="certification-panel">
	                        <table id="certification-list" class="table table-hover table-stripped table-bordered" style="width:100%;">
	                            <thead>
	                                <tr>
	                                    <th class="col-md-1">No.</th>
	                                    <th class="col-md-3">permintaan</th>
	                                    <th class="col-md-1">Type</th>
	                                    <th class="col-md-2">Nomor Sertifikat</th>
	                                    <th class="col-md-2">Tanggal terbit</th>
	                                    <th class="col-md-1">status</th>
	                                    <th class="col-md-2">Aksi</th>
	                                </tr>
	                            </thead>
	                            <tbody ></tbody>
	                        </table>
	                    </div>
	                    
						<div class="mdl-tabs__panel table-responsive" id="schedules-panel">
	                        <div class="table-responsive col-md-12" style=" margin-top:20px;">
				                <table class="table table-stripped  table-hover" id="assigned-assessment-table" style="width:100%;">
				                    <thead>
				                        <tr>
		                                    <th>No.</th>
		                                    <th>Type</th>
		                                    <th>Akan dilaksanakan pada</th>
		                                    <th>aksi</th>
		                                </tr>
				                    </thead>
				                </table>
				            </div>
	                    </div>	                    

	                    

	                </div>
		    	</div>
		    	
		    	<div role="tabpanel" class="tab-pane" id="settings--detail-certificate">
					
					<section class="navbar"><button class="mdl-button mdl-js-button mdl-button--icon" onclick="openHome()"><i class="material-icons">chevron_left</i></button></section>

        			<?php $this->load->view('company/company_certificates_detail'); ?>
		    	</div>

		    	<div role="tabpanel" class="tab-pane" id="settings--perusahaan">
					<section class="navbar"><button class="mdl-button mdl-js-button mdl-button--icon" onclick="openHome()"><i class="material-icons">chevron_left</i></button></section>
		    		
		    		<div class="list-group row flat">
		    			<div class="list-group-item flat list-group-setting">
		    				<div><span>Password :</span> <span class="like-password">*********</span> <button class="mdl-button mdl-js-button mdl-button--icon pull-right" onclick="" data-toggle="modal" data-target="#myModal_change_password"> <i class="material-icons">create</i> </button> </div>
		    			</div>
		    		</div>
		    		<div class="">
		    		</div>
		    	</div>
		  	</div>

		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal_change_password" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Modal title</h4>
      		</div>
      		<div class="modal-body">
    			<form class="" id="formupdatePassword" name="formupdatePassword" >
	    			<div class="form-group">
	    				<label>Old Password</label>
	    				<input type="password" class="form-control input-sm" name="old_password" placeholder="old password">
	    				<span class="help-block">Masukkan password lama anda. kami akan check terlebih dahulu password anda!. kami tidak akan mengubah sampai password yang anda masukkan benar.</span>
	    			</div>
	    			<div class="form-group">
	    				<label>new Password</label>
	    				<input type="password" class="form-control input-sm" id="checker_password" placeholder="New password">
	    			</div>
	    			<div class="form-group">
	    				<input type="password" class="form-control input-sm" name="newPassword" id="change-password--repeat" placeholder="repeat new password">
	    				<span class="help--block">Ulangi password anda</span>
	    			</div>   
    			</form>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        		<button  class="btn btn-primary" type="submit" form="formupdatePassword">Update Password</button>
      		</div>
    	</div>
  	</div>
</div>

<script type="text/javascript">
	
	function openSetting()
	{
		$('<a href="#settings--perusahaan"></a>').tab('show')
	}

	function openHome()
	{
		$('<a href="#home--perusahaan"></a>').tab('show')
	}

	function set_assigned_assessment()
    {
        window.assignedassessment = $('#assigned-assessment-table').DataTable({
            "searching": true,
            info: false,
            paging: true,
            lengthChange: false,
            ajax: 
            {
                url: site_url('assessment/get__schedule'),
                type: 'POST',
                data: function(d){
                    var id_company = parseInt('<?php echo $company["id_company"] ?>')
                    var data = $.extend({},d, {id_company: id_company} )
                    return data;
                },
                dataSrc: function(json)
                {
                    json = (json.data)? json.data : json;i=1;
                    if( json.length < 1 ) 
                    {
                        return false
                    }else
                    {
                        $.each(json, function(a,b){
                            var typeDetail 	= 'assessment';
                            var id 			= b.id_a0_cat;
                            var status 		= (b.pass_the_review == 0)? '<span class="badge"> masih dalam review </span>' : '<span class="badge"> Silahkan konfirmasi jadwal </span>';

                            typeDetail 		= (b.type_report == 'assessment')? 'a0' : typeDetail; 
                            
                            id = (b.type_report == 'assessment')? b.id_a0 : id;

                            var url 			= site_url('assessment/data_detail_certification/'+typeDetail+'/'+id);
                            var idconfirm 		= (b.type_report === 'assessment')? b.id_a0 : b.id_assessment;// bisa id_a0 / id_rs_schedule
                            json[a]['no'] 		= i;
                            json[a]['sign'] 	= b.type_report+' '+b.type;
                            json[a]['date'] 	= (b.assessment_date)? 'di assessment pada '+b.assessment_date : status;
                            json[a]['action'] 	= '<a href="'+site_url('company/tracker_request/'+b.id_company+'/'+b.id_permintaan_sertifikasi)+'" target="_blank" class="text-uppercase btn btn-warning btn-xs"> tracker </a>';
                            json[a]['action'] += ' <button class="preventDefault btn btn-xs btn-info text-uppercase" onclick="Tools.popupCenter(\''+url+'\',\'detailRequest\',500,500)"> info </button>'
                            i++;
                        })
                        console.log(json)
                        return json;
                    }
                }
            },
            columns: [
                {data: 'no'},
                {data: 'type_report'},
                {data: 'date'},
                {data: 'action'},
            ],
            initComplete: function( settings, json ) {
            }
        })

    }

	$(document).ready(function($) {
		var deferCertification = $.Deferred();
		var deferSchedules = $.Deferred();

		set_assigned_assessment();

		/*table certificate active*/
        window.certificateTable = $('#certification-list').DataTable({
            "searching": true,
            info: false,
            paging: true,
            lengthChange: false,
            ajax: 
            {
                url: site_url('certification/get_certification_active_in_company/<?php echo $company["id_company"] ?>'),
                dataSrc: function(json)
                {
                    json = (json.data)? json.data : json;var i = 1;
                    if( json.length < 1 ) 
                    {
                        return false
                    }else
                    {
                        $.each(json, function(a,b){
                            json[a]['no'] = i;
                            var certReqEd = b.certification_requested.split(',')
                            var certReqArr = []
                            $.each(certReqEd, function(c,d){
                            	certReqArr.push( '<span class="badge" style="margin-top:5px;">'+d+'</span>' )
                            })
                            certReqEd = certReqArr.join(' ');
                            json[a]['certification_requested_edited'] = certReqEd;
                            json[a]['no_certificate_edited'] = (!b.no_certificate)? 'Dalam proses' : b.no_certificate;
                            json[a]['issued_date_edited'] = (!b.issued_date)? 'Dalam proses' : b.issued_date;
                            json[a]['certificate_status_edited'] = (!b.certificate_status)? 'Dalam proses' : b.certificate_status;

                            var btnTrack = (!b.no_certificate)? '<a target="_blank" href="'+site_url('company/tracker_request/'+b.id_company+'/'+b.id_permintaan_sertifikasi)+'" class="btn btn-xs btn-warning"> Tracker </a>' : '';
                            json[a]['action'] = '<a href="#settings--detail-certificate" data-role="pushstate" data-href="" ref-attribute="#!certificate/detail/'+b.id_a0_cat+'&id='+b.id_a0_cat+'&fn=true&fn_name=fetch_data_certificate" role="tab" data-toggle="tab" class="btn btn-edit btn-primary btn-xs text-uppercase"> Detail </a> '+btnTrack;
                            i++;
                        })
                        return json;
                    }
                }
            },
            columns: [
                {data: 'no'},
                {data: 'certification_requested_edited'},
                {data: 'type'},
                {data: 'no_certificate_edited'},
                {data: 'issued_date_edited'},
                {data: 'certificate_status_edited'},
                {data: 'action'},
            ],
            initComplete: function( settings, json ) {
                deferCertification.resolve(json);
            }
        })

        
	});

	$('#formupdatePassword').on('submit', function(e){
		e.preventDefault();
		var $this = $(this),
			$data = $this.serializeArray(),
			$pair = $('#checker_password'),
			$pass = $('#change-password--repeat')

			if($pass.val() !== $pair.val())
			{
				swal('Password tidak cocok', 'Password tidak cocok. Silahkan ulangi lagi penulisan password anda!', 'error');
				return false;
			}

		$.post(site_url('company/change_password_perusahaan'), $data)
		.done(function(res){
			swal('Password diperbarui', 'Password telah diperbarui', 'success');			
		})	
		.error(function(res){
			swal('Gagal dalam pembaruan password', 'Pembaruan password anda gagal. kemungkinan karena masalah koneksi atau server yang tidak stabil. Silahkan refresh dan ulang kembali perintah anda!.', 'error')
		})	

	})

	$('#change-password--repeat').on('keyup', function(){
		var $pair = $('#checker_password'),
			$this = $(this)

		if($pair.val() !== $this.val())
		{
			$this.siblings('.help--block').removeClass('text-success').addClass('text-danger').text('password tidak cocok!');
		}else {
			$this.siblings('.help--block').removeClass('text-danger').addClass('text-success').text('password cocok!');
		}
	})
</script>