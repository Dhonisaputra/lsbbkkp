<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>
<?php echo $this->load->component('js', 'jsdata/jsdata.auditor.js') ?>
<style type="text/css">
	.auditor-name
	{
		font-size: 20px;
	    font-family: "Roboto Condensed";
	    color: #484747;
	}
	.auditor-property, .auditor-property .material-icons
	{
		font-size: 15px !important; 
		color: #827f7f;
	}

	.auditor-property .material-icons
	{
	    font-size: 15px;
    	vertical-align: middle;
	}

	.list-group-auditor
	{
		cursor: pointer;
	}
	.list-group-item-auditor
	{
		padding-top: 20px;
		padding-bottom: 20px;

	}
	.list-group-item-auditor:hover, .list-group-item-auditor.active
	{
		background-color: #e6e6e6 !important;
		border-color: #e6e6e6 !important;
	}
	.btn-auditor-profile
	{
		position: absolute;
	    top: 0;
	    right: 0;
	    height: 100%;
	    border-radius: 0px;
	}
	.btn-auditor-profile>.material-icons
	{
		line-height: 3;
	}
</style>
<section class="navbar">

	<!-- Single button -->
	<div class="btn-group">
	  	<button type="button" class=" mdl-button mdl-js-button btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    	Add Auditor <span class="caret"></span>
	  	</button>
	  	<ul class="dropdown-menu dropdown-menu--add-auditor">
	  	</ul>
	</div>
</section>
<div class="row" style="margin-top:10px; ">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-tabs-jabatan-auditor" role="tablist" style="padding-left: 15px;">
  
  </ul>

  <!-- Tab panes -->
  <div class="tab-content tab-content-jabatan-auditor" style="margin-top:10px; padding:0px 15px;">
    
  </div>

</div>

<script type="text/javascript">

	$(document).ready(function(){
		// write jabatan as tab
		panel_auditor__auditor_data();
	})

</script>

<script type="text/javascript">
	function show_pensiun(ui)
	{
		var id_jabatan = $(ui).val();
		window['group_auditor_'+id_jabatan].ajax.reload();
	}
	function add_new_auditor(event, id_jabatan)
	{
		Doctab.show({
			load:{ url: site_url('auditor/create/new/'+id_jabatan) }
		})
	}

	function aBtnAuditorProfile(ui)
	{
		var data = $(ui).data();
		openAuditorProfiles(data);
		
	}

	function openAuditorProfiles(data)
	{
		var auditorProfile = site_url('auditor/panel/profile/'+data.id_auditor);
		Snackbar.manual({message: 'Memuat. Silahkan tunggu!', spinner: true})
		nav.toUrl({
			url: auditorProfile,
			load: {
				target: '#document-actual-tab'
			}
		})
		.done(function(){
			Snackbar.show('Halaman berhasil dimuat')
		})
		// Doctab.show({
			// load:{ url: auditorProfile, data: data }
			/*onShow: function(e){
				$(e.tabContent).load( auditorProfile , data, function(){

				})
			}*/ // end onShow
	
		//}) // end of doctab
	}

	function panel_auditor__auditor_data()
	{
		$('.nav-tabs-jabatan-auditor').html('')
		var JabatanDeff = $.Deferred();
		$.JabatanAuditor({
			target: '.nav-tabs-jabatan-auditor',
			template: '<li role="presentation" class="">  <a href="#nav-tab-content-::id_jabatan::" class="text-uppercase" aria-controls="::nama_jabatan::" role="tab" data-toggle="tab">::nama_jabatan::</a> </li>',
			
		})
		// after done create tab, create content as well
		.done(function(res, r){

			// write menu 
			$('.dropdown-menu--add-auditor').html('');
			$.each(res, function(a,b){
				var u = '<li><a href="#" class="preventDefault" onclick="add_new_auditor(event,'+b.id_jabatan+')">'+b.nama_jabatan+'</a></li>';
				$('.dropdown-menu--add-auditor').append(u);
			})

			// hapus jabatan
			$('.tab-content-jabatan-auditor').html('');

			// append auditor
			Tools.write_data({
				records: res,
				target: '.tab-content-jabatan-auditor',
				template: '<div role="tabpanel" class="tab-pane" id="nav-tab-content-::id_jabatan::"> '+
				'<div class="form-group"><button class="btn btn-primary mdl-button mdl-js-button btn-sm" onclick="add_new_auditor(event,::id_jabatan::)"> <i class="material-icons">add</i> Add Auditor ::nama_jabatan:: </button> </div>'+
				'<div class="list-group list-group-auditor list-group-auditor-::id_jabatan::">' +
				' <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-show-pensiun-::id_jabatan::">'+
				' 	<input type="checkbox" id="checkbox-show-pensiun-::id_jabatan::" value="::id_jabatan::" class="mdl-checkbox__input show-pensiun show-pensiun-::id_jabatan::" onchange="show_pensiun(this)">'+
				'		<span class="mdl-checkbox__label">Pensiun</span>' +
				'	</label> ' +
				' <table class="table table-group-auditor table-bordered table-hover table-striped"  id="table-group-auditor-::id_jabatan::" data-jabatan="::id_jabatan::" style="width:100%;"> <thead> <tr> <td>Nama</td> <td>Telephone</td> <td>Email</td> <td>Status Dinas</td> <td>Kompetensi</td> <td>Aksi</td> </tr> </thead></tbody></tbody> </table> '+
				'</div> </div>',
				afterAppend: function(e, target, data){
					
					window['group_auditor_'+data.id_jabatan] = $('#table-group-auditor-'+data.id_jabatan).DataTable({
			            info: false,

			            lengthChange: false,
	            		
	            		ajax: {
		                	url: site_url('auditor/process/get/auditor'),
		                	dataSrc: function(json){
			                    json = (json.data)? json.data : json;
			                    if( json.length < 1 ) return false;
			                    
			                    json = json.filter(function(a0){
			                    	return a0.jabatan == parseInt(data.id_jabatan)
			                    })
			                    $.each(json, function(a,b){
			                    	var avatar = (b.avatar) ? b.avatar : 'application/components/images/user.jpg'
			                    	json[a]['action'] = '<button class="btn btn-primary mdl-button mdl-js-button" data-id_auditor="'+b.id_auditor+'" onclick="aBtnAuditorProfile(this)"> Buka <i class="material-icons">keyboard_arrow_right</i> </button>';
			                    	json[a]['text_status_dinas'] = (b.status_dinas == 1)? 'aktif' : 'pensiun';
			                    	json[a]['kompetensi'] = '';
			                    	json[a]['name'] = '<img class="img-responsive img-thumbnail" src="'+avatar+'" style="width:40px;"> '+b.fullname;
			                    })

			                    var show_pensiun = $('#checkbox-show-pensiun-'+data.id_jabatan).is(':checked')
			                    console.log(show_pensiun)
			                    if( show_pensiun )
			                    {
			                    	json = json.filter(function(a0){
			                    		return a0.status_dinas == 0;
			                    	})
			                    }
			                    return json;
		                	}
		                },
		                columns: [
			                {data: 'name'},
			                {data: 'telephone_number'},
			                {data: 'email'},
			                {data: 'text_status_dinas'},
			                {data: 'kompetensi'},
			                {data: 'action'},
			            ],
			            initComplete: function(res){
			                // deferCompleteSchedules.resolve(res);
			            }
					})
				}				
			})
			.done(function(res, ui){
				$('.nav-tabs-jabatan-auditor a:first').tab('show');
				JabatanDeff.resolve(res)
				
			})
		})

		/*// data auditor
		JabatanDeff.pipe(function(response){
			$.Auditor()
			.done(function(res){
				$.each(res, function(a,b){
					var phone = (!b.phone_number || b.phone_number == '' || b.phone_number == 'null' )? 'not available' : b.phone_number,
						telephone = (!b.telephone_number || b.telephone_number == '' || b.telephone_number == 'null')? 'not available' : b.telephone_number,
						dom = '<div class="list-group-item list-group-item-auditor list-group-item-auditor-'+b.id_auditor+'">'+
					// ' <button class="mdl-button mdl-js-button mdl-button--icon pull-right"><i class="material-icons">create</i></button> '+
					'<div class="auditor-name"> <span>'+b.fullname+'<span></div>'+
					'<div class="auditor-property"> <span class="auditor-phone-number"> <i class="material-icons">smartphone</i> '+phone+' </span> &middot; <span class="auditor-phone-number"> <i class="material-icons">phone</i> '+telephone+' </span> </div>' +
					'<button class="btn btn-primary mdl-button mdl-js-button btn-auditor-profile" onclick="aBtnAuditorProfile(this)"> <i class="material-icons">keyboard_arrow_right</i> </button>'+
					'</div> '
					dom = $(dom);
					$(dom).appendTo('.list-group-auditor-'+b.jabatan)
					.each(function(){
						$(this).data(b);
					})
				})
			})
		})*/
	}

	$(document).delegate('.list-group-item-auditor', 'click', function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active')
	})


	$(document).delegate('.list-group-item-auditor', 'dblclick', function(){
		var data = $(this).data();
		openAuditorProfiles(data);

	})

</script>