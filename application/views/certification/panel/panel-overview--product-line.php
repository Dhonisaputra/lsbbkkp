<style type="text/css">
	.collapse--category
	{
		margin-bottom: 10px;
	}
	.collapsable-item
	{
		border-left: 1px solid #eee;
	}
	.trigger-showOnHover
	{
		color: #22313F;
		margin:  15px 0px;
	}
	.trigger-showOnHover:hover
	{
		text-decoration: none;
	}

</style>

<div class="row">
	<div class="col-md-12">
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="openFormNewProductLine('category',0,0)">
			Add Category
		</button>
	</div>
</div>
<div class="row"><hr></div>
<?php  foreach ($product_line['category'] as $a0) { ?>
	<div class="row collapse--category">
		<div class="col-md-12 " style="padding-top: 7px; padding-bottom: 7px;">
			<a class="trigger-showOnHover" role="button" data-toggle="collapse" href="#product-line--category--<?php echo $a0['product_line_number'] ?>" aria-expanded="false" aria-controls="collapseExample"> <span class="arrow">&#9658;</span> <strong>( <?php echo $a0['product_line_number'] ?> )</strong> <?php echo $a0['product_line_name'] ?></a>
			
		  	<div class="btn-group showOnHover sr-only">
			  	<button type="button" class="dropdown-toggle mdl-button mdl-js-button mdl-button--icon " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
			    	<span class="material-icons" style="font-size:17px;">more_vert</span>
			  	</button>
			  	<ul class="dropdown-menu">
			    	<li><a href="#" class="sr-only">Detail</a></li>
			    	<li><a href="#" class="preventDefault" onclick="openFormNewProductLine('subcategory', '<?php echo $a0["product_line_id"] ?>', '<?php echo $a0['product_line_number'] ?>')">Tambah Product Line Subcategory</a></li>
			  	</ul>
			</div>
			<div class="collapse collapsable" id="product-line--category--<?php echo $a0['product_line_number'] ?>" >
			  	<div class="col-md-12 collapsable-item">
			    	
			    	<?php 
			    		foreach ($product_line['all'] as $a1) {
			    			
			    			if($a1['product_line_parent'] == $a0['product_line_number'])
			    			{
			    	?>
						<div class="row" style="margin-top:10px;">
							<div class="col-md-12 collapsable-item">
								<a class="trigger-showOnHover" role="button" data-toggle="collapse" href="#product-line--subcategory--<?php echo $a1['product_line_id'] ?>" aria-expanded="false" aria-controls="collapseExample"> <span class="arrow">&#9658;</span> <strong>( <?php echo $a1['product_line_number'] ?> )</strong>  <?php echo $a1['product_line_name'] ?></a>
								
							  	<div class="btn-group showOnHover sr-only">
								  	<button type="button" class="dropdown-toggle mdl-button mdl-js-button mdl-button--icon " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
								    	<span class="material-icons" style="font-size:17px;">more_vert</span>
								  	</button>
								  	<ul class="dropdown-menu">
								    	<li><a href="#" class="sr-only">Detail</a></li>
								    	<li><a href="#" class="preventDefault" onclick="openFormNewProductLine('item', '<?php echo $a1["product_line_id"] ?>', '<?php echo $a1['product_line_number'] ?>')">Tambah Product Line Item</a></li>
								  	</ul>
								</div>

								<div class="collapse collapsable" id="product-line--subcategory--<?php echo $a1['product_line_id'] ?>"> 
									<div class="collapsable-item">
								    	<?php 
								    		foreach ($product_line['all'] as $a2) {
								    			if($a2['product_line_parent'] == $a1['product_line_number'])
								    			{
								    	?>
												<div class="product-line-item--parent" style="margin-top:10px;"> 
													<span class="trigger-showOnHover product-line-item--<?php echo $a2['product_line_id'] ?>" style="margin-left: 24px;"> <?php echo $a2['product_line_name'] ?> </span> 
													<div class="btn-group showOnHover sr-only">
													  	<button type="button" class="dropdown-toggle mdl-button mdl-js-button mdl-button--icon " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
													    	<span class="material-icons" style="font-size:17px;">more_vert</span>
													  	</button>
													  	<ul class="dropdown-menu">
													    	<li><a href="#" class="sr-only">Edit</a></li>
													    	<li><a href="#" class="preventDefault" onclick="detailItemProductLine(this, '<?php echo $a2["product_line_id"] ?>','item')">Edit</a></li>
													    	<li role="separator" class="divider"></li>
													    	<li><a href="#" class="preventDefault" onclick="removeItemProductLine(this, '<?php echo $a2["product_line_id"] ?>','item')">Remove</a></li>
													  	</ul>
													</div>
												</div>

										<?php }} ?>
								 	 </div>
								</div>
							</div>
						</div>

					<?php }} ?>

			 	 </div>
			</div>
		</div>
	</div>
<?php } ?>



<script type="text/javascript">
	
	var dataProductLine = JSON.parse('<?php echo json_encode($product_line); ?>'),
		REMOVE_PRODUCT_LINE_ITEM = false;
	
	function openFormNewProductLine(type, product_line_id, product_line_number)
	{
		var data = {product_category_id: product_line_id, product_line_id: product_line_id, product_line_parent: product_line_number }
		Doctab.show({
			load:{
				url:site_url('certification/panel/new/product_line')+'?type='+type,
				data: data
			}
		})
	}

	function detailItemProductLine(ui, product_line_id, type)
	{
		var data = dataProductLine.all.filter(function(res){
			return res.product_line_id == product_line_id && res.product_line_type == type
		})[0]
		Doctab.show({
			load:{
				url:site_url('certification/panel/edit/product_line')+'?type='+type,
				data: data
			}
		})
	}

	function removeItemProductLine(ui, product_line_id, type)
	{
		if(REMOVE_PRODUCT_LINE_ITEM == false)
		{
			swal({
				title: 'Akses ditolak',
				text: 'Maaf anda tidak diperbolehkan menghapus Product Line !',
				type: 'error',
			})
			return false;
		}
		swal({
			title: 'Menghapus Product Line',
			text: 'Aksi ini akan menghapus Product Line. apakah anda yakin ingin menghapusnya?',
			type: 'warning',
			showCancelButton: true,
			closeOnCancel: true,
		},
		function(isConfirm){
			$.post(site_url('product_line/process/post/delete/item'),{product_line_id: product_line_id, type: type})
			.done(function(res){
				console.log(res);
				swal({
					title: 'Menghapus Product Line',
					text: 'Product Line telah dihapus',
					type: 'success'
				}, function(){
					// window.location.reload();
					$(ui).parents('.product-line-item--parent').remove();
				})
			})
			.error(function(res){
				console.log(res);
				swal('Gagal menghapus Product Line','Kesalahan saat menghapus Product Line. kemungkinan karena masalah koneksi atau server yang kurang stabil.','error');
			})
		})
	}

	// initialize tooltip
	$('[data-toggle="tooltip"]').tooltip();

	$('.collapsable').on('show.bs.collapse', function (e) {
	  	$(e.target).siblings('a').find('span.arrow').html('&#9660;')
	})
	$('.collapsable').on('hide.bs.collapse', function (e) {
	  	$(e.target).siblings('a').find('span.arrow').html('&#9658;')
	})

	
	$('#modal-insert-productline-category').on('show.bs.modal', function (e) {

	})
	
	$('.collapse--category').delegate('.trigger-showOnHover','mouseenter', function(e){
		$('.showOnHover').addClass('sr-only')
		var $this = $(this)
			$siblings = $this.siblings('.showOnHover')

		$siblings.removeClass('sr-only')
	})

</script>