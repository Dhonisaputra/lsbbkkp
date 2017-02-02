<div class="form-group">
	<button class="btn btn-warning mdl-button mdl-js-button" data-toggle="modal" data-target="#modal--new-scope">
	  <i class="material-icons">add</i> New Scope
	</button>
</div>

<table class="table-hover table-stripped table-bordered" id="certification-list--scope" style="width:100%;">
	<thead>
		<tr>
			<th>Scope Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

<div class="legend-group">
	
	<div class="legend-item block">
		<div class="legend-symbol" style=""> <i class="material-icons material-icons-middle">edit</i> </div>
		<div class="legend-description">Edit Scope.</div>
	</div>
	<div class="legend-item block">
		<div class="legend-symbol" style=""> <span class="label label-primary">active</span> </div>
		<div class="legend-description">Status Scope active.</div>
	</div>
	<div class="legend-item block">
		<div class="legend-symbol" style=""> <span class="label label-danger">revoked</span> </div>
		<div class="legend-description">Status scope "revoke".</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal--new-scope" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			<h4 class="modal-title" id="myModalLabel">Insert New Scope</h4>
      		</div>
		    <div class="modal-body">
				<form onsubmit="submitNewScope(event, this)">
					<div class="form-group">
						<label>Scope Name</label>
						<input type="text" name="commodity_name" placeholder="Scope Name" class="form-control" required>
					</div>
					<div class="form-group sr-only">
						<label>Scope Subcommodity</label>
						<input type="text" name="subcommodity" class="form-control" placeholder="Scope Subcommodity">
					</div>
					<div class="form-group">
						<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">
							<span class="glyphicon glyphicon-floppy-disk"></span> Submit 
						</button>
					</div>
				</form>	      	
		    </div>
      
    	</div>
  	</div>
</div>

<div class="modal fade" id="modal--edit-scope" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    			<h4 class="modal-title" id="myModalLabel">Insert New Scope</h4>
      		</div>
		    <div class="modal-body">
				<form id="panel--editScope" onsubmit="submitEditScope(event, this)">
					<input type="hidden" name="id_scope">					
					<div class="form-group">
						<label>Scope Name</label>
						<input type="text" name="commodity_name" placeholder="Scope Name" class="form-control" required autocomplete="false">
					</div>
					
					<div class="form-group">
						<button class="mdl-button mdl-js-button btn btn-primary" type="submit">
							<span class="glyphicon glyphicon-floppy-disk"></span> Simpan 
						</button>
					</div>
				</form>	      	
		    </div>
      
    	</div>
  	</div>
</div>

<script type="text/javascript">
	function submitNewScope(event, ui)
	{
		event.preventDefault();
		var data = $(ui).serializeArray();
		$.post( site_url('certification/process/post/new_scope'), data )
		.done(function(res){
			Snackbar.show('Ruang Lingkup berhasil ditambahkan!')
			window.scopeList.ajax.reload();
			$('#modal--new-scope').modal('hide');
			ui.reset();
		})
		.error(function(res){

		})

	}

	function submitEditScope(event, ui)
	{
		swal({title: 'Memperbarui Ruang Lingkup', text:'sedamg Memperbarui Ruang Lingkup', type: 'info', showConfirmButton:false, allowEscapeKey:false});
		event.preventDefault();
		var data = $(ui).serializeArray();
		$.post( site_url('scope/process/update'), data )
		.done(function(res){
			swal({title: 'Memperbarui Ruang Lingkup', text:'Ruang Lingkup berhasil diperbarui', type: 'success', allowEscapeKey:false});
			window.scopeList.ajax.reload();
			$('#modal--edit-scope').modal('hide');
			ui.reset();
		})
		.error(function(res){
			swal('Kesalahan saat memperbarui Ruang Lingkup','Terdapat kesalahan saat memperbarui Ruang Lingkup. Kemungkinan dikarenakan koneksi internat anda atau server yang tidak stabil. Silahkan reload halaman ini lalu ulangi memperbarui Ruang Lingkup!','error')
		})
	}

	function editDataScope(ui)
	{
		var $this = $(ui),
			$parents = $this.parents('tr'),
			data = window.scopeList.row($parents).data(),
			defer = $.Deferred();
		$('#modal--edit-scope').find('form [name="id_scope"]').val(data.id_commodity)
		$('#modal--edit-scope').find('form [name="commodity_name"]').val(data.commodity_name)
		$('#modal--edit-scope').modal('show');
	}

	/*
	|
	| status == boolean. 0 for release revoke, 1 for set revoke
	*/
	function scope_revoke_status(ui, status)
	{
		swal({title: 'Mencabut Ruang Lingkup', text:'Melakukan proses pencabutan Ruang Lingkup. Silahkan tunggu!', type: 'info', showConfirmButton:false, allowEscapeKey:false});
		var $this = $(ui),
			$parents = $this.parents('tr'),
			data = window.scopeList.row($parents).data(),
			defer = $.Deferred();
		$.post( site_url('scope/process/update/status_revoke_scope'), {id_scope: data.id_commodity, status_revoke:status} )
		.done(function(res){
			if(status == 1)
			{
				swal({title: 'Mencabut Ruang Lingkup', text:'Ruang Lingkup berhasil dicabut / revoke', type: 'success', allowEscapeKey:false});
			}else
			{
				swal({title: 'Ruang Lingkup diaktifkan', text:'Ruang Lingkup telah diaktifkan kembali', type: 'success', allowEscapeKey:false});

			}
			window.scopeList.ajax.reload(function(){
        		componentHandler.upgradeAllRegistered()
			});
		})
		.error(function(res){
			swal('Kesalahan saat melakukan pembaruan status Ruang Lingkup','Terdapat kesalahan saat memperbarui status Ruang Lingkup. Kemungkinan dikarenakan koneksi internat anda atau server yang tidak stabil. Silahkan reload halaman ini lalu ulangi memperbarui Ruang Lingkup!','error')
		})
	}

	/*
	|
	| revoke toggle
	|
	*/
	function toggleRevoke(ui)
	{
		var $isCheck = $(ui).is(':checked');
		console.log($isCheck);
		if(!$isCheck)
		{
			scope_revoke_status(ui, 0)
		}else
		{
			scope_revoke_status(ui, 1)
		}
	}

	$(document).ready(function(){
		window.scopeList = $('#certification-list--scope').DataTable({
			info: false,
	        lengthChange: false,
	        searching: false,
	        ajax: {
				url: site_url('certification/process/get/certificate/scope'),
	            type: 'POST',
	            dataSrc: function(json)
	            {
	                json = (json.data)? json.data : json;
	                var i = 1;
	                if(!json){return false; }
	                console.log(json)
	                $.each(json, function(a,b){
	                	$isRevoke = (b.revoke_scope == '0')? false : true;
	                	$checked = ($isRevoke)? 'checked' : '';
	                	$revokeStatus = ($isRevoke)? '<span class="label label-danger">Revoked</span>' : '<span class="label label-primary">active</span>';
		                $Toggle = '<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="toggle-revoke-scope-'+b.id_commodity+'" style="display:inline;">'
									  +'<input type="checkbox" id="toggle-revoke-scope-'+b.id_commodity+'" class="mdl-switch__input" onchange="toggleRevoke(this)" '+$checked+'>'
									  +'<span class="mdl-switch__label">'+$revokeStatus+'</span>'
									+'</label>'
	                	json[a]['no'] = i;
	                	json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--icon bs-tooltip" data-bs="tooltip" title="edit" onclick="editDataScope(this)"> <i class="material-icons">create</i> </button> '+$Toggle;
	                	i++;
	                })
	                return json;
	            }
	        },
	        columns:[
	            {data: 'commodity_name'},
	            {data: 'action'},
	        ],
	        initComplete: function()
	        {
	        	initializeTooltip();
            	componentHandler.upgradeAllRegistered()

	        }
		});
	})
</script>