<style type="text/css">
	div[nace-item-for]
	{
	}
	.toggler--parent:before, .toggler--menu
	{
		display:inline-block;
	}
	.toggler--parent.nace--name
	{
		font-size: 16px;
	}
	.button-toggle--menu
	{
		min-height: 10px;
		min-width: 10px;
		height: 20px;
		width: 20px;
	}
	.nace-tree--parent
	{
		margin-top: 16px;
		margin-bottom: 16px;
		margin-left: 16px;
		color: #27292b;
	}
	.nace-tree--nace_item:last-child
	{
		margin-bottom: 20px;
	}
	.nace-tree--parent .toggler--parent.collapsed:before
	{
		font-family: 'Material Icons';
	  	content: "chevron_right" !important;
	  	-webkit-font-feature-settings: 'liga';
  	    vertical-align: middle;
	}

	.nace-tree--parent .nace--child
	{
		border-left: 1px solid #BFBFBF;
	}
	.nace-tree--parent .toggler--parent:not(.collapsed):before
	{
		font-family: 'Material Icons';
	  	content: "keyboard_arrow_down";
	  	-webkit-font-feature-settings: 'liga';
  	    vertical-align: middle;
	}
</style>


<!-- Modal -->
<div class="modal fade" id="modalNewNaceItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">New Nace Item</h4>
      		</div>
      		<div class="modal-body">
      			<form onsubmit="newNaceItemSubmit(event, this)">
	      			<div class="row">
	      				<div class="col-lg-6">
						    <div class="input-group">
							  	<span class="input-group-addon" class="nace-parent--code" id="nace-parent--code">0.</span>
							  	<input type="hidden" class="nace-parent--code" name="new_nace_parent_code" value="0">
							  	<input type="hidden" class="" name="new_nace_parent_type" value="nace_category">
							  	<input type="text" class="form-control" placeholder="New Nace Code" name="new_nace_item_code" aria-describedby="" pattern="^[0-9.]{1,}$">
							</div>
					  	</div><!-- /.col-lg-6 -->
	      			</div>
					<span id="helpBlock" class="help-block text-info">hanya titik "." dan angka yang diperbolehkan. jika parent = 0, maka item baru berlaku sebagai category.</span>
	      			<div class="row">
	      				<div class="col-md-12">
	      					<div class="form-group">
	      						<label>Nace Name</label>
	      						<input type='text' name="new_nace_item_name" placeholder="new Nace Name" class="form-control">
	      					</div>
	      				</div>
	      			</div>

	      			<div class="form-group">
	      				<button class="mdl-button mdl-js-button btn btn-primary" type="submit"> Simpan </button>
	      			</div>
      			</form>
      		</div>
      		
    	</div>
  	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditNaceItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Edit Nace Item</h4>
      		</div>
      		<div class="modal-body">
      			<form onsubmit="updateNaceItemSubmit(event, this)">
	      			<div class="row">
	      				<div class="col-lg-6">
						    <div class="input-group">
							  	<!-- <span class="input-group-addon" class="nace-parent--code" id="nace-parent--code">0.</span> -->
							  	<input type="hidden" class="" name="new_nace_parent_type" value="nace_category">
							  	<input type="hidden" class="form-control" placeholder="New Nace Code" name="new_nace_item_code" aria-describedby="" pattern="^[0-9.]{1,}$">
							</div>
					  	</div><!-- /.col-lg-6 -->
	      			</div>
					<!-- <span id="helpBlock" class="help-block text-info">hanya titik "." dan angka yang diperbolehkan. jika parent = 0, maka item baru berlaku sebagai category.</span> -->
	      			<div class="row">
	      				<div class="col-md-12">
	      					<div class="form-group">
	      						<label>Nace Name</label>
	      						<input type='text' name="new_nace_item_name" placeholder="new Nace Name" class="form-control">
	      					</div>
	      				</div>
	      			</div>

	      			<div class="form-group">
	      				<button class="mdl-button mdl-js-button btn btn-primary" type="submit"> Update </button>
	      			</div>
      			</form>
      		</div>
      		
    	</div>
  	</div>
</div>

<div class="data-nace--tree">
	<div class="" nace-item-for="0"></div>
</div>

<div class="section--cloned--nace">
	<!-- parentTop -->
	
</div>

<script type="text/javascript">
	/*
	|------------------------- PENTING ---------------------------
	*/
	var $CAN_REMOVE = false,
		$CAN_REVOKE = true
	/*
	|-------------------------------------------------------------
	*/

	/*
	|----------------------------------------
	| Function save new nace item 
	|----------------------------------------
	*/
	function newNaceItemSubmit(e, ui)
	{
		e.preventDefault();
		swal({
			title:'Menyimpan data Nace baru',
			text: 'Menyimpan data Nace yang baru. silahkan tunggu beberapa saat.',
			type: 'info',
			allowEscapeKey: false,
			showConfirmButton: false
		})
		var data = $(ui).serializeArray();

		$.post( site_url('nace/process/post/insert/new/item'), data )
		.done(function(res){
			swal('Menyimpan data Nace baru', 'Sukses menyinpan data Nace baru.', 'success');
			write_nace_list();
			$('#modalNewNaceItem').modal('hide')
		})
		.error(function(res){
			swal('Kesalahan saat menyimpan data Nace yang baru', res.statusText, 'error');
		})
	}

	/*
	|----------------------------------------
	| Function revoke nace item 
	|----------------------------------------
	*/
	function revoke_nace_item(ui)
	{
		swal({
			title:'Mencabut Nace',
			text: 'Sedang mencabut Nace terpilih. Silahkan tunggu beberapa saat!',
			type: 'info',
			allowEscapeKey: false,
			showConfirmButton: false
		})

		var $this = $(ui),
			$parent = $this.closest('.nace-tree--parent'),
			$data = $parent.data()
			console.log($data, $parent)


		var dataRevoke = $data.revoke_nace == '0'? '1':'0';
		$.post( site_url('nace/process/post/update/revoke/item'), {revoke: dataRevoke, nace_item: $data.nace_item} )
		.done(function(res){
			swal('Mencabut Nace', 'Sukses mencabut Nace terpilih', 'success');
			write_nace_list();
		})
		.error(function(res){
			console.log(res)
			swal('Kesalahan saat mencabut Nace terpilih', res.statusText, 'error');
		})
	}

	/*
	|----------------------------------------
	| Function open modal edit nace 
	|----------------------------------------
	*/
	function edit_nace_item(ui)
	{
		var $this = $(ui),
			$parent = $this.closest('.nace-tree--parent'),
			$data = $parent.data()
		console.log($data);

		// $('#modalEditNaceItem').find('#nace-parent--code').text($data.nace_item)
		$('#modalEditNaceItem').find('input[name="new_nace_item_code"]').val($data.nace_item)
		// $('#modalEditNaceItem').find('input[name="new_nace_parent_type"]').val($data.nace_type)
		$('#modalEditNaceItem').find('input[name="new_nace_item_name"]').val($data.nace_name)

		$('#modalEditNaceItem').modal('show')
	}

	/*
	|----------------------------------------
	| Function Update Nace Item 
	|----------------------------------------
	*/
	function updateNaceItemSubmit(e, ui)
	{
		e.preventDefault();
		swal({
			title:'Memperbarui Nace',
			text: 'Memperbarui Nace. Silahkan tunggu beberapa saat!',
			type: 'info',
			allowEscapeKey: false,
			showConfirmButton: false
		})
		var data = $(ui).serializeArray();

		$.post( site_url('nace/process/post/update/edit/item'), data )
		.done(function(res){
			swal('Memperbarui Nace', 'Nace telah diperbarui.', 'success');
			// update nace list
			write_nace_list();
			// hide modal
			$('#modalEditNaceItem').modal('hide')
		})
		.error(function(res){
			swal('Kesalahan saat memperbarui Nace',''+res.statusText, 'error');
		})
	}

	/*
	|----------------------------------------
	| Function write data nace 
	|----------------------------------------
	*/
	function write_nace(data, parents)
	{
		var defer = $.Deferred();
			// ambil data paling depan
		var $TOPDATA 	= data.shift(),
			// replace nace item. e.g 10.2.3 => 10-2-3
			$ID 		= $TOPDATA.nace_item.replace(/\./g, '-'),
			// replace nace parent. e.g 10.2.3 => 10-2-3
			$ID_PARENT 	= $TOPDATA.nace_parent.replace(/\./g, '-'),
			// target append
			$TARGET_PARENT = $('.data-nace--tree').find('[nace-item-for="'+$TOPDATA.nace_parent+'"]'),
			$IS_REVOKE 	= '',
			// main template
			$TEMPLATE 	= '<div class="nace-tree--parent nace-tree--'+$TOPDATA.nace_type+'" data-nace-type="'+$TOPDATA.nace_type+'">'+
								'<div class="toggler--parent collapsed" data-toggle="collapse" data-target="#'+$ID+'" aria-expanded="false" aria-controls="'+$ID+'"> '+
									'<div class="toggler--menu">'+$IS_REVOKE+
										'<span class="nace--item" style=""></span>'+
										'<span class="nace--name" style=""></span>'+
										'<div class="btn-group btn-group--vert-nace-menu" style="display:inline-block;">'+
											'<button type="button" class="mdl-button mdl-js-button mdl-button--icon dropdown-toggle button-toggle--menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">'+
											   	'<i class="material-icons" style="font-size:18px;">more_vert</i>'+
											'</button>'+
											'<ul class="dropdown-menu">'+
											    
											'</ul>'+
										'</div>'+
									'</div>'+
							'</div>'+
							'<div class="collapse" id="'+$ID+'"><div class="nace--child" nace-item-for=""></div></div> '
			// parse tobe jquery object
			$TEMPLATE = $($TEMPLATE)

			// car nace name
			$TEMPLATE.find('.nace--name').text($TOPDATA.nace_name);
			// cari nace item
			$TEMPLATE.find('.nace--item').html('<strong>('+$TOPDATA.nace_item+')</strong>. ');
			// hide menu more_vert
			$TEMPLATE.find('.btn-group--vert-nace-menu').hide();
			// create new attribute
			$TEMPLATE.find('[nace-item-for]').attr('nace-item-for',$TOPDATA.nace_item);

			// object menu
			var menu = {
				add_category 	: '<li><a class="preventDefault" onclick="add_nace_item(this)">Tambah Item untuk NACE <strong>'+$TOPDATA.nace_item+'</strong> <span class="nace--code"></span></a></li>',
				revoke 			: ($TOPDATA.revoke_nace == '0')? '<li><a class="preventDefault" onclick="revoke_nace_item(this)">Revoke NACE <strong>'+$TOPDATA.nace_item+'</strong> <span class="nace--code"></span></a></li>' : '<li><a class="preventDefault" onclick="revoke_nace_item(this)">Un-Revoke NACE dengan Code <strong>'+$TOPDATA.nace_item+'</strong> <span class="nace--code"></span></a></li>',
				edit			: '<li><a class="preventDefault" onclick="edit_nace_item(this)">Edit NACE <strong>'+$TOPDATA.nace_item+'</strong> <span class="nace--code"></span></a></li>',
			},

			// array menu choosen
			menu_choosen = [];
			// check nace type
			switch($TOPDATA.nace_type)
			{
				case "nace_category":
					// define menu type nace_category
					menu_choosen = ['add_category','revoke', 'edit']
					break;
				case "nace_subcategory":
					// define menu type nace_subcategory
					menu_choosen = ['add_category','revoke', 'edit']
					break;
				case "nace_sub_subcategory":
					// define menu nace_sub_subcategory
					menu_choosen = ['add_category','revoke', 'edit']
					break;
				case "nace_item":
					// define menu nace_item
					menu_choosen = ['revoke','edit']
					break;
			}

			// append main template
			$TEMPLATE.appendTo($TARGET_PARENT)
			.each(function(){
				// add data
				$(this).data($TOPDATA);
				// append menu
				$.each(menu_choosen, function (a,b){
					// append menu choosen
					$TEMPLATE.find('.dropdown-menu').append(menu[b]);
					// jika revoke, tambah line-through
					if($TOPDATA.revoke_nace == '1')
					{
						$TEMPLATE.find('.nace--item,.nace--name').css({'text-decoration': 'line-through'})
					}
				})
			})
			// $TARGET_PARENT.append()

		// jika data masih ada, write_nace lagi
		if(data.length > 0)
		{
			write_nace(data)
		}else {
			defer.resolve(data);
			return $.when(defer.promise())
		}
	}

	function add_nace_item(ui)
	{
		var $this = $(ui),
			$parent = $this.closest('.nace-tree--parent'),
			$data = $parent.data()

		$('#modalNewNaceItem').find('#nace-parent--code').text($data.nace_item+'.')
		$('#modalNewNaceItem').find('input.nace-parent--code').val($data.nace_item)
		$('#modalNewNaceItem').find('input[name="new_nace_parent_type"]').val($data.nace_type)

		$('#modalNewNaceItem').modal('show')

	}

	/*
	|---------------------------
	| Get data from server
	|---------------------------
	*/
	function write_nace_list()
	{
		$.post(site_url('certification/process/get/certificate/nace'))
		.done(function(res){
			res = JSON.parse(res);
			$('.data-nace--tree [nace-item-for="0"]').html('');
			write_nace(res)
		})
	}

	$(document).ready(function(){
		/*
		|---------------------------
		| Execute::write_nace_list()
		|---------------------------
		*/
		write_nace_list();

		/*
		|---------------------------
		| event javascript::mouseenter
		|---------------------------
		*/
		$(document).delegate('.nace-tree--parent', 'mouseenter', function(){
			$('.btn-group--vert-nace-menu').hide()
			var $THIS = $(this),
				$PARENT = $THIS.closest('.nace-tree--parent')
				
				$PARENT.find('.btn-group--vert-nace-menu').first().show(); 
		})
		// $(document).delegate('.toggler--menu', 'mouseleave', function(){
		// 	var $THIS = $(this),
		// 		$PARENT = $THIS.closest('.nace-tree--parent')
		// 	$PARENT.find('.btn-group--vert-nace-menu').first().hide(); 
		// })

		
	})
</script>