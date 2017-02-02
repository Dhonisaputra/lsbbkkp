	
	<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">


		<div class="mdl-cell mdl-cell--12-col ">
			<div class="list-group">
				<div class="list-group-item "> <strong>No Certificate :</strong> <span id="detail-assessment--no_certificate"></span> </div>
				<div class="list-group-item "> <strong>Certification :</strong> <span id="detail-assessment--name"></span> </div>
				<div class="list-group-item "> <strong>Type Certificate :</strong> <span id="detail-assessment--type"></span>  </div>
				<div class="list-group-item "> <strong>Issued :</strong> <span id="detail-assessment--issued_date"></span> </div>
				<div class="list-group-item "> <strong>Status :</strong> <span id="detail-assessment--certificate_status" class="badge"></span> </div>
			</div>
		</div>

		


		<div class="mdl-cell mdl-cell--12-col">
			<ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#detail-certificate--schedule-rs" aria-controls="home" role="tab" data-toggle="tab">Schedules</a></li>
			    <li role="presentation" class=""><a href="#detail-certificate--jpa-brand" aria-controls="home" role="tab" data-toggle="tab">Brands</a></li>
			    <li role="presentation"><a href="#detail-certificate--settings" aria-controls="profile" role="tab" data-toggle="tab"> Settings </a></li>
			    <!-- <li role="presentation"><a href="#detail-certificate--notes" aria-controls="profile" role="tab" data-toggle="tab"> Notes </a></li> -->
			    <!-- <li role="presentation"><a href="#detail-certificate--settings-date" aria-controls="profile" role="tab" data-toggle="tab"> Notes </a></li> -->
			</ul>

			<div class="tab-content">

		    	<div role="tabpanel" class="tab-pane active" id="detail-certificate--schedule-rs">
							
							<table class="table table-stripped table-hover" id="table--certification-schedules" style="width:100%;">
								<thead>
									<tr>
										<th>No.</th>
										<th>reassessment Deadline</th>
										<th>reassessement on</th>
										<th>status</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						
		    	</div>

		    	<div role="tabpanel" class="tab-pane " id="detail-certificate--jpa-brand">
							
							<table class="table table-stripped table-hover" id="table--detail-certificate-brand" style="width:100%;">
								<thead>
									<tr>
										<th>No.</th>
										<th>Brand Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						
		    	</div>

		    	<div role="tabpanel" class="tab-pane" id="detail-certificate--settings">
		    		<div class="list-group">
		    			<div class="list-group-item">
		    				<div>

		    				</div>
	    					<div class="pull-left form-group">
	    						<label>Risk Management</label>
	    						<p> <span class="detail-assessment--risk"></span> (current)</p>
	    						<p> <span class="detail-assessment--suggested_risk"></span></p>
	    					</div>
		    			</div>
		    		</div>
		    	</div>
		    	<div role="tabpanel" class="tab-pane" id="detail-certificate--notes">
		    		<div class="list-group list-group-flat list-group-notes">

		    		</div>
		    	</div>
		    	<div role="tabpanel" class="tab-pane" id="detail-certificate--settings-date">


			        <form class="" id="profile-company--form-edit-schedule" name="profile-company--form-edit-schedule" onsubmit="updateFormEditRsDeadline(event, this)">

            			<input type="hidden" class="detail-certificate--form-schedule-component" data-schedule-for="id_rs" name="id_rs">

			            <div class="row">
			                <div class="col-md-12">
			                    <div class="form-group">
			                        <label>Date</label>
			                        <div>
			                            <div style="display:inline-block;">
			                                <input class="form-control" name="deadline_date" id="detail-certificate--schedule--edit-date" type="date" required>
			                            </div> 
			                            <div style="display:inline-block; vertical-align: middle; cursor:pointer;">
			                                <i class="material-icons" onclick="$('#detail-certificate--schedule--edit-date').datetimepicker('show');">date_range</i>
			                            </div>
			                        </div>

			                        <span class="help-block">Klik <a onclick="$('#detail-certificate--schedule--edit-date').datetimepicker('show');" style="cursor:pointer;">disini</a> / icon kalender untuk ganti tanggal.</span>
			                    
			                    </div>
				            	<div class="form-group">
			           				 <a  href="#detail-certificate--schedule-rs" aria-controls="profile-company--table" role="tab" data-toggle="tab" class="mdl-button mdl-js-button btn btn-warning"> <i class="material-icons">clear</i> Cancel </a>
				            		<button class="mdl-button mdl-js-button btn btn-primary " type="submit"> Simpan </button>
				            	</div>
			                </div>
			            </div>
			        </form>

		    	</div> <!-- end tabpanel -->
		  	</div>

		</div>

	</div>
	


<script type="text/javascript">
	
	/*
	|
	| Fetch Data Brand in JPA
	|
	*/
	function fetch_data_brand(id_a0_cat)
	{
		window.tableDetailBrand = $('#table--detail-certificate-brand').DataTable({
			ajax: 
			{
				url 	: site_url('brand/brand_company'),
    			type 	: "POST",
				data 	: 
				{
					id_a0_cat: id_a0_cat,
				},
				dataSrc : function(json)
				{
					json = (json.data)? json.data : json;

					// hanya tampilkan data yang belum success / fail
                    json = json.filter(function(res){ return res.rs_status !== 'success' && res.rs_status !== 'fail' })
                    if(json.length < 1 ) return false;

					var i = 1;
					$.each(json, function(a,b){
						json[a]['no'] = i;
						json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--icon" title="Revoke" data-toggle="tooltip" style="color:#D91E18;" onclick="revokeBrand(this)"><i class="material-icons">clear</i></button>';

						i++;
					})
					return json;
				}
			},
			columns: [
                {data: 'no'},
                {data: 'brand_name'},
                {data: 'action'},
            ]
		})
	}
	/*
	* fetch data certificate
	*/
	function fetch_data_certificate()
	{

		// get data url
		var uri = URL.get();

		// get certificate table
		var dataProp = window.certificateTable.data()
		dataProp = dataProp.filter(function(res){ return res.id_a0_cat == parseInt(uri.hash.id) })[0]
		$.each(dataProp, function(a,b){
			$('#detail-assessment--'+a).text(b);
		});

		$('.certificate-panel--status-list [data-status]').data(dataProp)
		$('.certificate-panel--status-list').find('.sign').remove()
		$('.certificate-panel--status-list [data-status="'+dataProp.certificate_status+'"]').addClass('active')
		$('.certificate-panel--status-list [data-status="'+dataProp.certificate_status+'"]').append('<i class="material-icons material-icons--middle pull-right sign" style="color:#4183D7">check</i>')

		$('#btn-audit-khusus').attr('href', site_url('certification/'+dataProp.certificate_md5+'/audit_khusus') )
		
		if(dataProp.type !== 'JPA-009')
		{
			$('a[href="#detail-certificate--jpa-brand"]').hide();
		}else {
			if ( $.fn.DataTable.isDataTable( '#table--detail-certificate-brand' ) ) {
				window.tableDetailBrand.destroy();
			}
			$('a[href="#detail-certificate--jpa-brand"]').show();
			fetch_data_brand(dataProp.id_a0_cat)
		}

		if ( $.fn.DataTable.isDataTable( '#table--certification-schedules' ) ) {
			window.tableDetailCertificate.destroy();
		}

		window.tableDetailCertificate = $('#table--certification-schedules').DataTable({
			ajax: 
			{
				url 	: site_url('assessment/detail_reassessment'),
    			type 	: "POST",
				data 	: 
				{
					id_certificate: dataProp.no_certificate
				},
				dataSrc : function(json)
				{
					json = (json.data)? json.data : json;

					// hanya tampilkan data yang belum success / fail
                    json = json.filter(function(res){ return res.rs_status !== 'success' && res.rs_status !== 'fail' })
                    if(json.length < 1 ) return false;

					var i = 1;
					$.each(json, function(a,b){
						json[a]['no'] = i;
						json[a]['deadline'] = b.deadline_date+' ';
						json[a]['surveying_date'] = moment(b.survey_date).isValid() ?  moment(b.survey_date, 'YYYY-MM-DD').fromNow()+' ('+b.survey_date+')' : 'not time yet!';
						json[a]['status'] = (b.rs_status) ?  b.rs_status : 'N/A';

						i++;
					})
					return json;
				}
			},
			columns: [
                {data: 'no'},
                {data: 'deadline'},
                {data: 'surveying_date'},
                {data: 'status'},
            ]
		});

		$('[data-toggle="tooltip"], [data-bs="tooltip"], [tooltip], .bs-tooltip').tooltip();

	}

	function updateFormEditRsDeadline(event, ui)
	{
		event.preventDefault();
		var data = $(ui).serializeArray();
		$.post( site_url('assessment/update_rs_deadline'), data )
		.done(function(res){
			Snackbar.show('tanggal re-assessment berhasil diubah');
			$('a[href="#detail-certificate--schedule-rs"]').tab('show')
			window.tableDetailCertificate.ajax.reload();
		})
	}

	function revokeBrand(ui)
	{
		var $this = $(ui),
			$row = $this.closest('tr'),
			$data = window.tableDetailBrand.row($row).data()

		swal({
			title: 'Cabut merek',
			text: 'Aksi ini akan melakukan pencabutan nama merek dari sertifikat ini. Apakah anda tetap ingin melanjutkan?',
			showCancelButton:true,
			closeOnCancel:true,
			type: 'warning',
		},function(){
			swal({
				title: 'Cabut merek',
				text: 'Merek sedang dicabut. silahkan tunggu beberapa saat!',
				allowEscapeKey: false,
				type: 'info',
			})
			$.post(site_url('certificate/brand/revoke'), {id_certification_request: $data.id_certification_request})
			.done(function (e){
				swal('Cabut merek', 'Pencabutan merek berhasil', 'success')
				window.tableDetailBrand.ajax.reload()
			})
		})
	}
	

	$(document).ready(function(){

		$('#detail-certificate--schedule--edit-date').datetimepicker({
	        timepicker:false,
	        format:'Y-m-d',
	        lang: 'id',
	        minDate:0,

	    });


		var uri = URL.get();
		

		
	})

</script>