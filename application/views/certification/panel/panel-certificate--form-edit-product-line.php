
<?php #print_r($_POST)  ?>
<div>
  	<!-- Nav tabs -->
  	<ul class="nav nav-tabs sr-only" role="tablist">
    	<li role="presentation" class="<?php echo ($_GET['type'] == 'category')? 'active' : ''; ?>"><a href="#form-add-product-line--category" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
    	<li role="presentation" class="<?php echo ($_GET['type'] == 'subcategory')? 'active' : ''; ?>"><a href="#form-add-product-line--subcategory" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
    	<li role="presentation" class="<?php echo ($_GET['type'] == 'item')? 'active' : ''; ?>"><a href="#form-add-product-line--item" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
  	</ul>

  	<!-- Tab panes -->
  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane <?php echo ($_GET['type'] == 'category')? 'active' : ''; ?>" id="form-add-product-line--category">

    		<form onsubmit="insertCategoryProductLine(event, this)">
    			<div class="form-group">
    				<label>Product Line Category </label>
    				<input type="text" name="product_category_name" class="form-control" required>
    			</div>
    			<div class="form-group">
    				<label> Product Line Number </label>
    				<input type="text" name="product_line_number" class="form-control" pattern="[0-9]{2,}" required>

    			</div>
    			<div class="form-group">
    				<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit"> Submit </button>
    			</div>
    		</form>

    	</div>
    	<div role="tabpanel" class="tab-pane <?php echo ($_GET['type'] == 'subcategory')? 'active' : ''; ?>" id="form-add-product-line--subcategory">



				<form class="" id="" onsubmit="insertSubcategoryProductLine(event, this)">
					<input type="hidden" name="product_line_parent" id="product_line_parent" value="<?php echo isset($_POST['product_line_parent'])? $_POST['product_line_parent'] : '' ?>">
					<input type="hidden" name="product_category_id" id="product_category_id" value="<?php echo isset($_POST['product_category_id'])? $_POST['product_category_id'] : '' ?>">
					
					<div class="form-group">
						<label>subcategory name</label>
						<input type="text" name="product_subcategory_name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Product Line Number</label>
						<div class="input-group">
						  	<span class="input-group-addon data-product_line_parent" id="basic-addon1"><?php echo $_POST['product_line_parent'] ?>.</span>
							<input type="text" name="product_line_number" class="form-control" pattern="^[0-9\.]{1,}$" required>
						</div>
					</div>

					<div class="form-group">
						<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">
							<span class="glyphicon glyphicon-floppy-disk"></span> Submit 
						</button>
					</div>

				</form>
    		
    	</div>
    	<div role="tabpanel" class="tab-pane <?php echo ($_GET['type'] == 'item')? 'active' : ''; ?>" id="form-add-product-line--item">
    		<div class="alert alert-warning alert-flat">
    			Maaf. Untuk saat ini, edit parent product line belum tersedia.
    		</div>

    		<form onsubmit="updateProductLineItem(event, this)">
				<input type="hidden" name="product_line_parent" id="product_line_parent_in_item" value="<?php echo isset($_POST['product_line_parent'])? $_POST['product_line_parent'] : '' ?>">
				<input type="hidden" name="product_line_subcategory" id="product_line_id_in_item" value="<?php echo isset($_POST['product_line_id'])? $_POST['product_line_id'] : '' ?>">
    			
    			<div class="form-group">
    				<label>Product Line Name</label>
    				<input type="text" name="product_line_name"  id="product_line_name" class="form-control" placeholder="product line name" value="<?php echo $_POST['product_line_name'] ?>" required >
    			</div>
    			<?php #print_r($_POST); ?>

    			<div class="form-group">
    				<div class="checkbox"><label><input name="product_line_note" type="checkbox" class="" value="1" id="product_line_note" <?php echo ($_POST['note'] == 0)?'':'checked' ?>> <strong>Dapat Menambahkan item...?</strong> </label></div>
    				<div class="help-block">Ini akan menjadikan product Line item harus diisi saat pengguna menambahkan Sertifikasi!</div>
    			</div>
    			<div class="panel panel-default">
    				<div class="panel-heading">

    					<!-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
						    <label class="mdl-button mdl-js-button mdl-button--icon" for="search_input_product_line_certificate_in_item">
						      	<i class="material-icons">search</i>
						    </label>
						    <div class="mdl-textfield__expandable-holder">
						      	<input class="mdl-textfield__input" type="text" id="search_input_product_line_certificate_in_item">
						      	<label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
						    </div>
						</div> -->
						<div class="row">
							<div class="col-md-12">
								<div class="radio"><label><input name="filter_view_audit_reference" class="" type="radio" onclick="$('.product_line_certificate_choosen:not(:checked)').parents('.checkbox').hide()" checked> Sertifikasi yang didaftarkan</label></div>
								<div class="radio"><label><input name="filter_view_audit_reference" class="" type="radio" onclick="$('.product_line_certificate_choosen:not(:checked)').parents('.checkbox').show()"> Semua Sertifikasi</label></div>
							</div>
						</div>
    				</div>
    				<div class="panel-body" id="product_line_certificate_in_item" style="height:400px; overflow-y: auto;">

    				</div>
    				<div class="panel-footer">
    					<p>Belum ada akreditasi nya? <a href="#" data-toggle="modal" data-target="#modal-insert-akreditasi">tambah akreditasi</a></p>
    				</div>
    			</div>

    			<div class="form-group">
					<button class="preventDefault mdl-button mdl-js-button btn btn-warning" onclick="Doctab.hide()">
						<span class="material-icons">chevron_left</span> Cancel 
					</button>
					<button class="mdl-button mdl-js-button btn btn-primary" type="submit">
						<span class="glyphicon glyphicon-floppy-disk"></span> Simpan 
					</button>
				</div>

    		</form>
    	</div>
  	</div>

</div>

<!-- Modal tambah akreditasi -->
<!-- Modal -->
<div class="modal fade" id="modal-insert-akreditasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content modal-lg">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Modal title</h4>
      		</div>
      		<div class="modal-body">
        		...
      		</div>
      		
    	</div>
  	</div>
</div>
<?php 
	
?>
<script type="text/javascript">
	var dataCertificateExist = JSON.parse('<?php echo json_encode(explode(',', $_POST["product_line_certificate"])) ?>');

	function get_certificate()
	{
		$('#product_line_certificate_in_item').html('');

		$.post( site_url('certification/process/get/list') )
		.done(function(res){
			res = JSON.parse(res);

			Tools.write_data({
				records: res,
				target: '#product_line_certificate_in_item',
				template: '<div class="checkbox" data-filter="::name:: ::certificate_title::"> <label> <input class="product_line_certificate_choosen" type="checkbox"  name="product_line_certificate_choosen[]" value="::audit_reference::"> ::name:: <strong>(::certificate_title::)</strong> </label> </div>',
				afterAppend: function(a,b,c)
				{
					var audit_reference = c.audit_reference.toString()
					if(dataCertificateExist.indexOf(audit_reference) > -1)
					{
						$(b).addClass('audit_reference_exist').removeClass('sr-only')
						$(b).find('input[type="checkbox"][value="'+c.audit_reference+'"]').prop('checked',true);
					}else
					{
						$(b).hide()
					}
				}
			})
			.done(function(){
				Tools.element.filter({trigger_using: '#search_input_product_line_certificate_in_item', target: '#product_line_certificate_in_item .checkbox' })
			})
		})
	}

	function insertCategoryProductLine(e, ui)
	{
		e.preventDefault();
		var data = $(ui).serializeArray();
		$.post( site_url('certification/process/post/insert/category'), data )
		.done(function(res){
			res = JSON.parse(res);
			// console.log(res);
			Snackbar.manual({ message: 'Product Line subcategory successfully created! create product line item!', spinner: true });
			$('#product_line_parent').val(res.product_line_number);
			$('#product_category_id').val(res.product_category_id);
			$('a[href="#form-add-product-line--subcategory"]').tab('show');	
			$('.data-product_line_parent').text(res.product_line_number);

			ui.reset();
			Snackbar.hide('#snackbarTemp');
			
		})
		.error(function(res){
			swal('error '+res.status, res.statusText, 'error');
		})
	}

	function insertSubcategoryProductLine(e, ui)
	{
		e.preventDefault();
		var data = $(ui).serializeArray();
		$.post( site_url('certification/process/post/insert/subcategory'), data )
		.done(function(res){
			res = JSON.parse(res);

			Snackbar.manual({ message: 'Product Line subcategory successfully created! create product line item!', spinner: true });
			$('#product_line_parent_in_item').val(res.product_line_number);
			$('#product_line_id_in_item').val(res.product_subcategory_id);
			$('a[href="#form-add-product-line--item"]').tab('show');					
			ui.reset();
			Snackbar.hide('#snackbarTemp');
			
		})
		.error(function(res){
			swal('error '+res.status, res.statusText, 'error');
		})
	}

	function updateProductLineItem(e, ui)
	{
		e.preventDefault();
		Snackbar.manual({message:'Adding product line!', spinner:true});

		var certificate = $(ui).find('#product_line_certificate_in_item input[type="checkbox"]:checked')
						.serializeArray()
						.map(function(res){ return res.value})
						.join(','),
			note 		= $(ui).find('#product_line_note:checked').val(),
			name 		= $(ui).find('#product_line_name').val(),
			parent 		= $(ui).find('#product_line_parent_in_item').val(),
			item 		= $(ui).find('#product_line_id_in_item').val();


		var data = {product_line_item: item, product_line_name: name, certification_category_list: certificate, product_line_note: note, product_line_parent: parent}
		$.post( site_url('certification/process/post/update/product_line_item'), data )
		.done(function(res){
			console.log(res)

			Snackbar.show('Product Line berhasil diperbarui')
			swal({title:'success', text:'Product Line berhasil diperbarui!',type:'success'},function(){
				// mengganti tulisan di product line list
				$('.product-line-item--'+item).text(name);
				Doctab.hide()
				.done(function(){
					window.location.reload();
				})
			})
			
		})
	}

	$(document).ready(function(){
		get_certificate()
		$('a[data-toggle="tab"][href="#form-add-product-line--item"]').on('show.bs.tab', function (e) {
			get_certificate()
		})

		// handling on modal modal-insert-akreditasi open
		$('#modal-insert-akreditasi').on('show.bs.modal', function (e) {
		  	var body = $(this).find('.modal-body').load( site_url('certification/panel/new/certification') )
		})
		$('#modal-insert-akreditasi').on('hide.bs.modal', function (e) {
			get_certificate();
		})
	})
</script>