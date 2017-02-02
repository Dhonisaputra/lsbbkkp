<div class="overview-education">
	<div>

		<?php if( $_SESSION['level'] == 1 || $_SESSION['level'] == 100 ){ ?>	
		  	<!-- Nav tabs -->
		  	<ul class="nav nav-tabs" role="tablist">
		    	<li role="presentation" class="active"><a href="#competency--listed" aria-controls="home" role="tab" data-toggle="tab">Kompetensi Terdaftar</a></li>
		    	<li role="presentation"><a href="#competency--requested" aria-controls="profile" role="tab" data-toggle="tab">Permintaan kompetensi</a></li>
		  	</ul>
		<?php } ?>

	  	<!-- Tab panes -->
	  	<div class="tab-content">
	    	<div role="tabpanel" class="tab-pane active" id="competency--listed">
	    		
				<!-- Icon button -->
				<div class="" style="margin: 15px 0px;">
					<button class="mdl-button mdl-js-button " style="color:white; background-color:#4183D7" onclick="add_competency(<?php echo $profile['id_auditor'] ?>)"> <i class="material-icons">add</i> Tambah </button>
				</div>
				<table class="table table-stripped table-hover table-bordered table-auditor-profile-overview--competency" id="table-auditor-profile-overview--competency" style="width:100%;">
					<thead>
						<tr>
							<th>Kompetensi</th>
							<th>Nama</th>
			                <?php if( $_SESSION['level'] == 1 || $_SESSION['level'] == 100 ){ ?>
							<th>aksi</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody></tbody>
				</table>

	    	</div> <!-- end tabppanel -->
	    	<div role="tabpanel" class="tab-pane" id="competency--requested">
	    		<div class="form-group">
	    			<button class="btn btn-primary flat" onclick="window.auditorCompetency.ajax.reload()"> reload </button>
	    		</div>
	    		<?php if( $_SESSION['level'] == 1 || $_SESSION['level'] == 100 ){ ?>
					<table class="table table-stripped table-hover table-bordered table-auditor-profile-overview--competency" id="table-auditor-profile-overview--competency-moderator" style="width:100%;">
						<thead>
							<tr>
								<th>Kompetensi</th>
								<th>Nama</th>
								<th>aksi</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				<?php } ?>
	    	</div> <!-- end of tabpanel -->
	  	</div> <!-- end of tabcontent -->

	</div> 
	
</div> <!-- end of overview-education -->

<script type="text/javascript">
	function add_competency(id_auditor)
	{

        /*Doctab.show({
			load:{
                url: site_url('auditor/profile/add/kompetensi/'+id_auditor),
				data: {}
			}
		})*/
		nav.toUrl({
            url: site_url('auditor/profile/add/kompetensi/'+id_auditor), 
            title: '',
            load:
            {
                target: '#document-actual-tab'
            }
        })
	}

	function confirm_competency(ui, id_auditor, competency, status)
	{
		$.post( site_url('auditor/update_auditor_competency'), {confirmation: status, id_auditor: id_auditor, competency: competency} )
		.done(function(res){
			console.log(res)
			window.auditorCompetencyModerator.ajax.reload()
			window.auditorCompetency.ajax.reload()
			Snackbar.show('Kompetensi auditor telah di perbarui')
			if(status < 0)
			{
                Notify.send({notification_for_level: <?php echo $profile['auditor_level']; ?>, notification_for_user: <?php echo $profile['id_auditor']; ?>,  notification_text: ' Permintaan anda terkait data kompetensi tidak disetujui oleh LSBBKKP.'  })

			}else
			{
                Notify.send({notification_for_level: <?php echo $profile['auditor_level']; ?>, notification_for_user: <?php echo $profile['id_auditor']; ?>,  notification_text: ' Permintaan anda terkait data kompetensi disetujui oleh LSBBKKP. Data kompetensi anda akan segera diperbarui'  })
			}
		})
		.fail(function(res){
			console.log(res)
			Snackbar.show('Gagal memperbarui kompetensi auditor')
		})
	}

	$(document).ready(function(){
		window.auditorCompetency = $('#table-auditor-profile-overview--competency').DataTable({
	        info: false,
	        lengthChange: false,
	        ajax: {
	            url: site_url('auditor/process/get/competency'),
	            type: 'POST',
	            data: function(d){
	                return {id_auditor: '<?php echo $profile["id_auditor"] ?>'}
	            },
	            dataSrc: function(json)
	            {
	                json = (json.data)? json.data : json;
	                var i = 1;
	                if(!json){return false; }

	                <?php if( $_SESSION['level'] == 1 || $_SESSION['level'] == 100 ){ ?>
		                $.each(json, function(a,b){
		                    json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--icon" onclick="remove_competency(this)" style="background-color:#EF4836;"><i class="material-icons" style="font-size:20px;color:white;">clear</i></button>';
		                })
	                <?php } ?>
	                return json;
	            }
	        },
	        columns:[
	            {data: 'name'},
	            {data: 'certificate_title'},
                <?php if( $_SESSION['level'] == 1 || $_SESSION['level'] == 100 ){ ?>
	            {data: 'action'},
                <?php } ?>
	        ],
	    })

	    window.auditorCompetencyModerator = $('#table-auditor-profile-overview--competency-moderator').DataTable({
	        info: false,
	        lengthChange: false,
	        ajax: {
	            url: site_url('auditor/process/get/competency'),
	            type: 'POST',
	            data: function(d){
	                return {id_auditor: '<?php echo $profile["id_auditor"] ?>', is_approved:0}
	            },
	            dataSrc: function(json)
	            {
	                json = (json.data)? json.data : json;
	                var i = 1;
	                if(!json){return false; }

	                $.each(json, function(a,b){
	                    json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--icon btn-danger" onclick="confirm_competency(this,'+b.id_auditor+','+b.competency+',-1)" style=""><i class="material-icons" style="font-size:20px;color:white;">clear</i></button> <button class="mdl-button mdl-js-button mdl-button--icon btn-primary" onclick="confirm_competency(this,'+b.id_auditor+','+b.competency+',1)" ><i class="material-icons" style="font-size:20px;color:white;">done</i></button>';
	                    i++;
	                })
	                return json;
	            }
	        },
	        columns:[
	            {data: 'name'},
	            {data: 'certificate_title'},
	            {data: 'action'},
	        ],
	    })
	})
</script>

		