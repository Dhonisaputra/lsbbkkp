<style type="text/css">
	.company-profile-item
	{
		margin-top: 10px;
	}
	.auditor-list--item.selected .auditor-list--name
	{
		opacity: .5;
	}
</style>
<div>
	<div class="company-profile-description">
		<h4>Company </h4>
		<div class="divider"></div>
		<div class="company-profile-item"><strong>Perusahaan: </strong> <?php echo $company['company_name'] ?> </div>
		<div class="company-profile-item"><strong>Alamat: </strong> <?php echo $company['company_address'] ?></div>
		<div class="company-profile-item"><strong>Email: </strong> <?php echo $company['email'] ?></div>
		<div class="company-profile-item"><strong>Telephone: </strong> <?php echo $company['telephone'] ?></div>
	</div>

	<div class="accreditation-choosen" style="margin-top:40px;">
		<h4>Jadwal sertifikasi</h4>
		<div class="divider"></div>

		<div>

		  	<!-- Nav tabs -->
		  	<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a class="text-uppercase" href="#list-conducted--assessment" aria-controls="home" role="tab" data-toggle="tab">Permintaan baru</a></li>
				<li role="presentation"><a class="text-uppercase" href="#list-conducted--reassessment" aria-controls="profile" role="tab" data-toggle="tab">Surveilen</a></li>
				<li role="presentation"><a class="text-uppercase" href="#list-conducted--audit-khusus" aria-controls="messages" role="tab" data-toggle="tab">Audit Khusus</a></li>
		  	</ul>

		  	<!-- Tab panes -->
		  	<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="list-conducted--assessment">
					<?php  foreach ($new_assessment as $a0key => $a0value) {  ?>

					<div class="list-group list-group--assessment">
						<div  class="list-group-item" role="button" href="#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>" data-toggle="collapse" aria-expanded="false"> <span class="sign sign-close"> &#9658; </span> <span><?php echo $a0value['requested'] ?></span> </div>
						
						<div class="collapse" id="conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>">
							<div class="list-group-item list-group-item--conducted">
								
								<p class="company-profile-item"><strong>Akreditasi Terpilih: </strong> <?php echo $a0value['requested'] ?> </p>
								<p> <strong> Merek :</strong> <?php echo isset($a0value['data_detail']['text_brand'])? $a0value['data_detail']['text_brand'] : 'N/A'; ?> </p>
								<p> <strong> Nomor Sertifikat :</strong> <?php echo $a0value['id_certificate'] ?> </p>
								<p> <strong> Ruang Lingkup :</strong> <?php echo isset($a0value['data_detail']['text_scope'])? $a0value['data_detail']['text_scope'] : 'N/A' ?> </p>
								<p> <strong> Lini Produk :</strong> <?php echo isset($a0value['data_detail']['text_product_line'])? $a0value['data_detail']['text_product_line'] : 'N/A' ?> </p>
								<p> <strong> NACE :</strong> <?php echo isset($a0value['data_detail']['text_nace'])? $a0value['data_detail']['text_nace'] : 'N/A' ?> </p>
								
								<div class="company-profile-item"><strong>Ditinjau pada: </strong> <?php echo $a0value['assessment_date'] ?> </div>
								<div class="company-profile-item"><strong>Status Terakhir: </strong> <span class="badge"> <?php echo $a0value['status'] ?> </span> </div>
							  	
							  	<div class="divider"></div>

							  	<div class="pull-right ">
							  		
							  		<div class="dropdown">
									  	<button class="mdl-button mdl-js-button mdl-button--icon" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    		<span class="material-icons">more_vert</span>
									  	</button>
									  	<ul class="dropdown-menu" aria-labelledby="dLabel" style="left:-100px;">
									    	<li><a href="#" class="preventDefault conducted-options--add-auditor " onclick="conducted_list_add_auditor('#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>'); return false;">Tambahkan auditor</a></li>
									    	<li><a href="#" class="preventDefault conducted-options--edit-auditor " onclick="editAuditorConducted(this, '#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>'); return false;">Edit Auditor</a></li>
									  	</ul>
									</div>
								  	
								  	<!-- 
								  	<button class="mdl-button mdl-js-button btn btn-primary btn-sm btn-insert-auditor" onclick="conducted_list_add_auditor('#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>')"> Tambah Auditor <i class="material-icons">add</i></button>
								  	<button class="mdl-button mdl-js-button btn btn-warning btn-sm btn-edit-auditor" onclick="editAuditorConducted(this, '#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>')"> <i class="glyphicon glyphicon-pencil"></i></button> -->
							  	</div>
							  	
							  	<h3>Auditor</h3>
							  	<div id="conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>--auditor-list" class="auditor-list">
								  	<?php 
								  		$no = 1; 
								  		foreach ($a0value['data_auditor'] as $a1key => $a1value) { 
								  	?>
								  		<div class="auditor-list--item" data-item="<?php echo $a1value['id_auditor'] ?>" style="font-size:15px;"><strong><?php echo '<span class="auditor-list--no">'.$no.'</span>. <span class="auditor-list--name">'.$a1value['fullname'] ?></span></strong> as <span class="badge"><?php echo $a1value['nama_jabatan'] ?></span></div>
								  	<?php $no++;} ?>
							  	</div>
							  	<button class="btn-block mdl-button mdl-js-button btn btn-info btn-sm btn-save-insert-auditor sr-only" onclick="saveNewDraftAuditor('#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>', <?php echo $a0value['id_a0'] ?>,'assessment')"> <i class="material-icons">save</i> Update </button>
							  	<button class="btn-block mdl-button mdl-js-button btn btn-primary btn-sm btn-edit-auditor sr-only" onclick="removeSelectedAuditor(this, '#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>', <?php echo $a0value['id_a0'] ?>, 'assessment')" disabled> <i class="material-icons">delete</i> Hapus yang ditandai </button>
							  	<button class="btn-block mdl-button mdl-js-button btn btn-danger btn-sm btn-edit-auditor--cancel sr-only" onclick="cancelit(event)"> <i class="material-icons">clear</i> Cancel</button>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="list-conducted--reassessment">
					<?php  foreach ($reassessment as $a0key => $a0value) {  ?>

					<div class="list-group list-group--assessment">
						<div  class="list-group-item" role="button" href="#conducted-list--accreditation--1--<?php echo $a0value['id_rs'] ?>" data-toggle="collapse" aria-expanded="false"> <span class="sign sign-close"> &#9658; </span> <span><?php echo $a0value['id_certificate'] ?></span>  </div>
						
						<div class="collapse" id="conducted-list--accreditation--1--<?php echo $a0value['id_rs'] ?>">
							<div class="list-group-item list-group-item--conducted">
								
								<p> <strong> Type : <?php echo $a0value['type'] ?></strong></p>
								<p> <strong> Merek :</strong> <?php echo isset($a0value['data_detail']['text_brand'])? $a0value['data_detail']['text_brand'] : 'N/A'; ?> </p>
								<p> <strong> Nomor Sertifikat :</strong> <?php echo $a0value['id_certificate'] ?> </p>
								<p> <strong> Ruang Lingkup :</strong> <?php echo isset($a0value['data_detail']['text_scope'])? $a0value['data_detail']['text_scope'] : 'N/A' ?> </p>
								<p> <strong> Lini Produk :</strong> <?php echo isset($a0value['data_detail']['text_product_line'])? $a0value['data_detail']['text_product_line'] : 'N/A' ?> </p>
								<p> <strong> NACE :</strong> <?php echo isset($a0value['data_detail']['text_nace'])? $a0value['data_detail']['text_nace'] : 'N/A' ?> </p>

								<div class="company-profile-item"><strong>di tinjau pada: </strong> <?php echo $a0value['survey_date'] ?> </div>
								<div class="company-profile-item"><strong>Status Terakhir: </strong> <span class="badge"> <?php echo $a0value['rs_status'] ?> </span> </div>
							  	
							  	<div class="divider"></div>

							  	<div class="pull-right ">
							  		
							  		<div class="dropdown">
									  	<button class="mdl-button mdl-js-button mdl-button--icon" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    		<span class="material-icons">more_vert</span>
									  	</button>
									  	<ul class="dropdown-menu" aria-labelledby="dLabel" style="left:-100px;">
									    	<li><a class="preventDefault conducted-options--add-auditor" onclick="conducted_list_add_auditor('#conducted-list--accreditation--1--<?php echo $a0value['id_rs'] ?>'); return false;">Tambahkan auditor</a></li>
									    	<li><a class="preventDefault conducted-options--edit-auditor" onclick="editAuditorConducted(this, '#conducted-list--accreditation--1--<?php echo $a0value['id_rs'] ?>'); return false;">Edit Auditor</a></li>
									  	</ul>
									</div>
								  	
								  	<!-- 
								  	<button class="mdl-button mdl-js-button btn btn-primary btn-sm btn-insert-auditor" onclick="conducted_list_add_auditor('#conducted-list--accreditation--1--<?php echo $a0value['id_rs'] ?>')"> Tambah Auditor <i class="material-icons">add</i></button>
								  	<button class="mdl-button mdl-js-button btn btn-warning btn-sm btn-edit-auditor" onclick="editAuditorConducted(this, '#conducted-list--accreditation--1--<?php echo $a0value['id_rs'] ?>')"> <i class="glyphicon glyphicon-pencil"></i></button> -->
							  	</div>
							  	
							  	<h3>Auditor</h3>
							  	<div id="conducted-list--accreditation--1--<?php echo $a0value['id_rs'] ?>--auditor-list" class="auditor-list">
								  	<?php 
								  		$no = 1; 
								  		foreach ($a0value['data_auditor'] as $a1key => $a1value) { 
								  	?>
								  		<div class="auditor-list--item" data-item="<?php echo $a1value['id_auditor'] ?>" style="font-size:15px;"><strong><?php echo '<span class="auditor-list--no">'.$no.'</span>. <span class="auditor-list--name">'.$a1value['fullname'] ?></span></strong> as <span class="badge"><?php echo $a1value['nama_jabatan'] ?></span></div>
								  	<?php $no++;} ?>
							  	</div>
							  	<button class="btn-block mdl-button mdl-js-button btn btn-info btn-sm btn-save-insert-auditor sr-only" onclick="saveNewDraftAuditor('#conducted-list--accreditation--1--<?php echo $a0value['id_rs'] ?>', <?php echo $a0value['id_rs'] ?>,'reassessment')"> <i class="material-icons">save</i> Simpan </button>
							  	<button class="btn-block mdl-button mdl-js-button btn btn-primary btn-sm btn-edit-auditor sr-only" onclick="removeSelectedAuditor(this, '#conducted-list--accreditation--1--<?php echo $a0value['id_rs'] ?>', <?php echo $a0value['id_rs'] ?>, 'reassessment')" disabled> <i class="material-icons">delete</i> Hapus yang ditandai </button>
							  	<button class="btn-block mdl-button mdl-js-button btn btn-danger btn-sm btn-edit-auditor--cancel sr-only" onclick="editAuditorConducted(this, '#conducted-list--accreditation--1--<?php echo $a0value['id_rs'] ?>')"> <i class="material-icons">clear</i> Batal</button>
							</div>
						</div>
					</div>
				<?php } ?>

				</div>
				<div role="tabpanel" class="tab-pane" id="list-conducted--audit-khusus">
					<?php  foreach ($audit_khusus as $a0key => $a0value) {  ?>

					<div class="list-group list-group--assessment">
						<div  class="list-group-item" role="button" href="#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>" data-toggle="collapse" aria-expanded="false"> <span class="sign sign-close"> &#9658; </span> <span><?php echo $a0value['id_certificate'] ?></span> <span class="badge">New Assessment</span> </div>
						
						<div class="collapse" id="conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>">
							<div class="list-group-item list-group-item--conducted">
								<p> <strong> Merek :</strong> <?php echo isset($a0value['data_detail']['text_brand'])? $a0value['data_detail']['text_brand'] : 'N/A'; ?> </p>
								<p> <strong> Nomor Sertifikat :</strong> <?php echo $a0value['id_certificate'] ?> </p>
								<p> <strong> Ruang Lingkup :</strong> <?php echo isset($a0value['data_detail']['text_scope'])? $a0value['data_detail']['text_scope'] : 'N/A' ?> </p>
								<p> <strong> Lini Produk :</strong> <?php echo isset($a0value['data_detail']['text_product_line'])? $a0value['data_detail']['text_product_line'] : 'N/A' ?> </p>
								<p> <strong> NACE :</strong> <?php echo isset($a0value['data_detail']['text_nace'])? $a0value['data_detail']['text_nace'] : 'N/A' ?> </p>

								<div class="company-profile-item"><strong>Akreditasi Terpilih: </strong> <?php echo $a0value['id_certificate'] ?> </div>
								<div class="company-profile-item"><strong>di tinjau pada: </strong> <?php echo $a0value['assessment_date'] ?> </div>
								<div class="company-profile-item"><strong>Status Terakhir: </strong> <span class="badge"> <?php echo $a0value['status'] ?> </span> </div>
							  	
							  	<div class="divider"></div>

							  	<div class="pull-right ">
							  		
							  		<div class="dropdown">
									  	<button class="mdl-button mdl-js-button mdl-button--icon" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    		<span class="material-icons">more_vert</span>
									  	</button>
									  	<ul class="dropdown-menu" aria-labelledby="dLabel" style="left:-100px;">
									    	<li><a href="#" class="preventDefault conducted-options--add-auditor " onclick="conducted_list_add_auditor('#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>'); return false;">Tambahkan auditor</a></li>
									    	<li><a href="#" class="preventDefault conducted-options--edit-auditor" onclick="editAuditorConducted(this, '#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>'); return false;">Edit Auditor</a></li>
									  	</ul>
									</div>
								  	
								  	<!-- 
								  	<button class="mdl-button mdl-js-button btn btn-primary btn-sm btn-insert-auditor" onclick="conducted_list_add_auditor('#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>')"> Tambah Auditor <i class="material-icons">add</i></button>
								  	<button class="mdl-button mdl-js-button btn btn-warning btn-sm btn-edit-auditor" onclick="editAuditorConducted(this, '#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>')"> <i class="glyphicon glyphicon-pencil"></i></button> -->
							  	</div>
							  	
							  	<h3>Auditor</h3>
							  	<div id="conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>--auditor-list" class="auditor-list">
								  	<?php 
								  		$no = 1; 
								  		foreach ($a0value['data_auditor'] as $a1key => $a1value) { 
								  	?>
								  		<div class="auditor-list--item" data-item="<?php echo $a1value['id_auditor'] ?>" style="font-size:15px;"><strong><?php echo '<span class="auditor-list--no">'.$no.'</span>. <span class="auditor-list--name">'.$a1value['fullname'] ?></span></strong> as <span class="badge"><?php echo $a1value['nama_jabatan'] ?></span></div>
								  	<?php $no++;} ?>
							  	</div>
							  	<button class="btn-block mdl-button mdl-js-button btn btn-info btn-sm btn-save-insert-auditor sr-only" onclick="saveNewDraftAuditor('#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>', <?php echo $a0value['id_a0'] ?>,'assessment')"> <i class="material-icons">save</i> Simpan </button>
							  	<button class="btn-block mdl-button mdl-js-button btn btn-primary btn-sm btn-edit-auditor sr-only" onclick="removeSelectedAuditor(this, '#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>', <?php echo $a0value['id_a0'] ?>, 'assessment')" disabled> <i class="material-icons">delete</i> Hapus yang ditandai </button>
							  	<button class="btn-block mdl-button mdl-js-button btn btn-danger btn-sm btn-edit-auditor--cancel sr-only" onclick="editAuditorConducted(this, '#conducted-list--accreditation--0--<?php echo $a0value['id_a0'] ?>')"> <i class="material-icons">clear</i> Batal</button>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
		  	</div>

		</div>
		
	</div>
</div>
  	



<script type="text/javascript">
	// get id ao
	var id_a0 = URL.get().hash.a0;

	// using PIN 
	var usingAuthenticationPassword = true;

	function conducted_list_open_accreditation(ui)
	{
		var uihref = $(ui).attr('href'),
			href = URL.get().href+' '+uihref;

		Doctab.show({
			load: {url:href},
		})
	}

	function get_data_auditor_conducted()
	{
		$.post( site_url('auditor/get_auditor_assigned/'+id_a0) )
	    .done(function(res){
			var body = $('#auditor-assignment--conductor-auditor-list'),
	        	template = '<div class="list-group-item list-group-conductor-assigned conductor-assigned-::id_auditor::" data-filter="::nama_jabatan::"> <div class="" style="display:inline;">  <i class="material-icons" style="vertical-align:middle;">account_circle</i> ::fullname:: <span class="badge" style="float:none!important;">::nama_jabatan::</span>  </div>  </div>';
	        $(body).html('');

	        res = JSON.parse(res);

	    	Tools.write_data({
	            template: template,
	            target: $(body),
	            records: res
	        })
		    
	    })
	}

	function outfromeditor()
	{
		$('#conducted-modal--edit-auditor-body ').html('');
		// get_data_auditor_conducted();
	}

	function verifyAccount(password)
	{
		var deff = $.Deferred();
		var data = { password: password }

		$.post( site_url('users/verify_password'),  data)
		.done(function(res){
			res = JSON.parse(res);
			deff.resolve(res)
		})
		.error(function(res){
			deff.resolve({found:false});
			console.log(res);
		})

		return $.when( deff.promise() );
	}

	/*
	|------------------------
	| Function pick auditor
	|------------------------
	*/
	var Authdeff = $.Deferred();
	var a0Deff = $.Deferred();
	function conducted_list_add_auditor(requestUI)
	{		
		a0Deff.resolve(requestUI);
		window.a0Deffui = requestUI;

		if( usingAuthenticationPassword )
		{
			openAuthenticPIN(requestUI)
			
		}else
		{
			openAuditorPicker(requestUI);

			// Tools.popupCenter(url,"pickAuditor",700,500)
		}

		// window.open(url,"pickAuditor", 'width=700,height=500');
	}

	/*
	|
	|
	|
	*/
	function openAuditorPicker(requestUI)
	{
		var url = site_url('auditor/picker')+'?media=window&callback=exchange_auditor_picker_records';
		window.win = Tools.popupCenter(url,"pickAuditor",700,500)		
	}

	/*
	|---------------
	| Fire this function after auditor picker was closed
	|---------------
	*/
	function auditoPickerOnHide(event, data)
	{
		if(data.length < 1)
		{
			$('.conducted-options--edit-auditor').show();
		}

	}

	/*
	|
	|
	|
	*/
	function openAuthenticPIN(requestUI)
	{

		swal({   
			title: "Isikan password anda",   
			text: "",   
			type: "input",   
			inputType: "password",
			showCancelButton: true,   
			closeOnConfirm: false,   
			animation: "slide-from-top",   
			inputPlaceholder: "Konfirmasikan password anda!" 
		}, function(inputValue){   
			
			if (inputValue === false) return false;      
			
			if (inputValue === "") {     
				swal.showInputError("Mohon untuk melakukan Konfirmasi password anda!");     
				return false   
			}

			verifyAccount(inputValue)
			.done(function(res){

				if(res.found)
				{
					swal({   
						title: "Password benar",   
						text: "Akses untuk menambah auditor diterima!",   
						type: "success",   
						showCancelButton: false,   
						closeOnConfirm: true 
					}, function(){    	
						// buka auditor picker
						openAuditorPicker(requestUI);
					});
				}else
				{
					// tampilkan akses ditolak
					swal({   
						title: "Password salah",   
						text: "Akses menambahkan auditor gagal!",   
						type: "error",   
						showCancelButton: false,   
						closeOnConfirm: false, 
					}, function(){    	
						// buka kembali cconducted add auditor
						conducted_list_add_auditor(requestUI);
					});
				}
				Authdeff.resolve(res);
			})
			.fail(function(){
				conducted_list_add_auditor(requestUI);
			})

			return $.when( Authdeff.promise() )  
			// console.log()
			// swal("Nice!", "You wrote: " + inputValue, "success"); 
		});
	}

	/*
	|-----------------------
	| Function to get data from auditor pricker
	|-----------------------
	*/
	function exchange_auditor_picker_records(data)
	{

		var defer = $.Deferred();
		var ui = window.a0Deffui;
		// window.throughDone = false;
		// a0Deff.done(function(ui){
			var dataFilter = checkExistence_ExchangeData(ui, data);

			if( dataFilter.isExist )
			{
				/*var auditorText = '<ul>';
				$.each(datafilter.data, function(a,b){
					auditorText += '<li>'+b.auditor+'</li>';
				})
				auditorText += '</ul>';*/

				swal({   
					title: "Terdapat beberapa auditor telah ditambahkan",   
					text: "Terdapat beberapa auditor telah ditambahkan. apakah anda ingin tetap menambahkan auditor yang dipilih? auditor yang sudah ada tidak akan ditambahkan",   
					html: true ,
					type: 'info' ,
					showCancelButton: true,
					closeOnConfirm: true,   
					closeOnCancel: false,
  					cancelButtonText: 'Tidak. Saya ingin memilih ulang!',
					confirmButtonText: 'Ya, Tambahkan yang sudah saya pilih!',

				}, function(isConfirm){
					if(isConfirm)
					{
						defer.resolve(ui, dataFilter.dataAfterFilter)

						// defer.resolve(ui, dataFilter.dataAfterFilter)
					}else
					{
						openAuditorPicker(ui);
						swal.close();
						return false;

					}
				});
			}else
			{
				defer.resolve(ui, data)		
			}
			
			/*console.log(window.throughDone)
			if(!window.throughDone)
			{
				defer.resolve(window.a0Deffui, data)
				console.log(window.a0Deffui, data)
			}*/
			
			defer.pipe(function(ui, data){
				window.draftNewAuditor = data;
				var dataFilter = checkExistence_ExchangeData(ui, data);
				data = (dataFilter.isExist)? dataFilter.dataAfterFilter : data;

				var auditorList = $(ui).find(ui+'--auditor-list'),
				lastCount = parseInt( $(auditorList).find('.auditor-list--no').last().text() ) + 1;

				if(data.length < 1)
				{
					Snackbar.show('Tidak ada auditor yang dipilih')
					// swal('no auditor ', 'Tidak ada data untuk ditampilkan.', 'error');
					return false;
				}

				Snackbar.show('Auditor selesai ditambahkan')
				// swal('success','Menuliskan auditor','success');

				// show cance and save button
				$(ui).find('.btn-save-insert-auditor').removeClass('sr-only');
				$(ui).find('.btn-edit-auditor--cancel').removeClass('sr-only');

				/*hide edit button auditor */
				$(ui).find('.conducted-options--add-auditor').hide();
				$(ui).find('.conducted-options--edit-auditor').hide();
				console.log(data)
				$.each(data, function(a,b){
					$(auditorList).append('<div class="auditor-list--draft auditor-list--item" data-item="'+b.id_auditor+'" data-draft="'+b.id_auditor+'" style="font-size:15px;"><strong><span class="auditor-list--no">'+lastCount+'</span>. <span class="auditor-list--name">'+b.fullname+'</span> </strong> as <span class="badge">'+b.nama_jabatan+'</span> <button class="mdl-button mdl-js-button mdl-button--icon btn-remove-draft" onclick="removeDraftAuditor(this)"> <i class="material-icons">clear</i> </button> </div>' );
											  		
					lastCount++;
				})
			})
			window.throughDone = false
		// })
		a0Deff = $.Deferred();
		// a0Deff.resolve(window.a0Deffui)
	}

	function checkExistence_ExchangeData(ui, data, isFound, noFound)
	{
		//-------------- pengecheckan data sebelum dikirim
		var isExist = [],
		dataExist = [],
		dataAfterFilter = [];
		data = (!data)? window.draftNewAuditor : data;
		$.each( data , function (a,b){
			var exs = ($(ui).find('.auditor-list--item[data-item="'+b.id_auditor+'"]:not(.auditor-list--draft)').length > 0)? true : false
			isExist.push( exs );
			if(exs)
			{
				dataExist.push(b);
			}else
			{
				dataAfterFilter.push(b);
			}
		})

		var boolIsExist = isExist.filter(function(res){ return res }).length > 0? true : false;
		return {dataFound:isExist, isExist:  boolIsExist, data: dataExist, dataAfterFilter: dataAfterFilter};
	}

	/*
	|----------------------------
	| save new draft auditor
	|----------------------------
	*/
	function saveNewDraftAuditor(ui, id_assessment, type)
	{
		var auditor = [];
		
		//-------------- pengecheckan data sebelum dikirim
		var isExist = []
		$.each(window.draftNewAuditor, function (a,b){
			var exs = ($(ui).find('.auditor-list--item[data-item="'+b.id_auditor+'"]:not(.auditor-list--draft)').length > 0)? true : false
			isExist.push( exs );
		})
		// jika ada data exist, tampilkan error.
		if( isExist.filter(function(res){return res}).length > 0 )
		{
			swal('Auditor sudah ada', 'Auditor ini sudah terdaftar anda tidak dapat menambahkan auditor yang sama dua kali.', 'error');
			return false;
		}else
		{

			// penambahan data ke dalam record untuk dikirim
			$(ui+'--auditor-list').find('.auditor-list--draft').each(function(res){
			var val = $(this).attr('data-draft');
				var i = parseInt(val);
				auditor.push( i );
			})

			var data = { assessment_type:type, id_assessment:id_assessment, auditor: auditor };
			$.post(site_url('auditor/process/post/insert/auditor_log'), data )
			.done(function(res){
				$(ui+'--auditor-list').find('.auditor-list--draft').removeAttr('data-draft')
				$(ui+'--auditor-list').find('.btn-remove-draft').remove();
				$(ui).find('.btn-save-insert-auditor').addClass('sr-only');
				$(ui).find('.btn-edit-auditor--cancel').addClass('sr-only');

				// show btn edit auditor
				$(ui+'--auditor-list').parents('.list-group-item--conducted').find('.conducted-options--edit-auditor').removeClass('sr-only').show();
				$(ui+'--auditor-list').parents('.list-group-item--conducted').find('.conducted-options--add-auditor').removeClass('sr-only').show();


			})
		}
	}

	/*
	|------------------------
	| remove item draft auditor
	|------------------------
	*/
	function removeDraftAuditor(ui)
	{
		var a0 = $(ui).parents('.list-group-item--conducted');
		$(ui).parents('.auditor-list--draft').remove()
		var len = $(a0).find('.auditor-list--draft').length;
		var i = $(a0).find('.auditor-list--draft').attr('data-draft');
		
		// remove in draft
		i = window.draftNewAuditor.map(function(res){
			return res.id_auditor
		}).indexOf(parseInt(i));

		window.draftNewAuditor.splice(i,1);

		if(len < 1)
		{
			// show btn edit auditor
			$(a0).find('.conducted-options--edit-auditor').show();
			$(a0).find('.conducted-options--add-auditor').show();

			// hide btn insert auditor
			$(a0).find('.btn-save-insert-auditor,.btn-edit-auditor--cancel').addClass('sr-only');
		}
	}

	/*
	|
	|
	|
	*/
	function editAuditorConducted(ui, parent)
	{

		$(parent).find('.btn-insert-auditor').addClass('sr-only');
		$(parent).find('.btn-edit-auditor--cancel, .btn-edit-auditor').removeClass('sr-only');
		var len = $(parent+'--auditor-list').find('.btn-edit-auditor-conducted').length
		var btn = '<button class="mdl-button mdl-js-button mdl-button--icon btn-edit-auditor-conducted" onclick="markEditAuditorConducted(this)"><i class="material-icons">check_box_outline_blank</i></button>'
		if(len < 1)
		{
			/*manipulate text*/
			$(parent).find('.conducted-options--edit-auditor').text('Cancel')

			// hide btn add auditor
			$(parent).find('.conducted-options--add-auditor').hide();

			$(parent+'--auditor-list').find('.auditor-list--item').each(function(){
				$(this).prepend(btn);
			})
		}else
		{
			cancelEditAuditorConducted(parent)
		}
	}

	function cancelEditAuditorConducted(parent)
	{
		/*manipulate text*/
			$(parent).find('.conducted-options--edit-auditor').text('Edit auditor')

			// show btn add auditor
			$(parent).find('.conducted-options--add-auditor').show();

			// reset data auditor
			$(parent).find('.selected').removeClass('selected')

			$(parent).find('.btn-edit-auditor-conducted').remove();
			
			$(parent).find('.btn-insert-auditor').removeClass('sr-only');
			$(parent).find('.btn-edit-auditor--cancel, .btn-edit-auditor').addClass('sr-only');
	}

	/*
	|
	|
	|
	*/
	function markEditAuditorConducted(ui)
	{
		var item = $(ui).parents('.auditor-list--item'),
			name = $(item).find('auditor-list--name'),
			isSelected = $(item).hasClass('selected');
		if( isSelected )
		{
			$(item).removeClass('selected');
			$(item).find('.material-icons').text('check_box_outline_blank')
		}else
		{
			$(item).addClass('selected');
			$(item).find('.material-icons').text('check_box')
		}

		// jika ndak ada yang ditandai, stay disabled
		var siblingSelected = $(item).siblings('.selected');
		console.log(isSelected, siblingSelected, $(ui))
		if( !isSelected || siblingSelected.length > 0)
		{
			$(ui).parents('.list-group--assessment').find('.btn-edit-auditor').prop('disabled',false)
		}else
		{
			$(ui).parents('.list-group--assessment').find('.btn-edit-auditor').prop('disabled',true)

		}

	}

	/*
	|
	|
	|
	*/
	function removeSelectedAuditor(ui, container, id_assessment, assessment_type)
	{
		var selected = $(container).find('.auditor-list--item.selected'),
			selectedRec = [];

		$(selected).each(function(){
			var item = parseInt( $(this).attr('data-item') );
			selectedRec.push(item);
		})

		$.post( site_url('auditor/process/post/remove/auditor_log'), {item: selectedRec, id_assessment: id_assessment, assessment_type:assessment_type} )
		.done(function(res){
			$(selected).remove();
			cancelEditAuditorConducted(container)
		})
	}

	function cancelit(e)
	{
		var $this  = e.target;

		$($this).addClass('sr-only')
		var parent = $($this).parents('.list-group-item--conducted'),
			newInsertDraft = $(parent).find('.btn-remove-draft')
		if( newInsertDraft.length > 0 )
		{
			$(newInsertDraft).each(function(){
				$($this).trigger('click');
			})
		}

		cancelEditAuditorConducted(parent)
	}

	// get_data_auditor_conducted();

	$(document).ready(function(){
		exchange_auditor_picker_records();

		/*$(document).on( 'click', '.btn-edit-auditor--cancel',function(event){
			$(this).addClass('sr-only')
			var parent = $(this).parents('.list-group-item--conducted'),
				newInsertDraft = $(parent).find('.btn-remove-draft')
			if( newInsertDraft.length > 0 )
			{
				$(newInsertDraft).each(function(){
					$(this).trigger('click');
				})
			}

			cancelEditAuditorConducted(parent)


		})*/
	})

</script>