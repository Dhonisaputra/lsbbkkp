<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">

    
    <div class="btn-group" role="group" aria-label="...">
        <!-- Icon button -->
		<a href="#profile-company--home" role="tab" data-toggle="tab" class="mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back(2)">
			<i class="material-icons">keyboard_backspace</i>
		</a>

    </div>

</div>

<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
	<form name="edit-brand" id="edit-brand" action="<?php echo site_url('brand/process/update'); ?>" onsubmit="updateBrand(event)">
		<input type="hidden" name="id_brand" id="id_brand">
		<div class="form-group">
			<label>Brand Name</label>
			<input type="text" class="form-control" placeholder="brand name" name="brand_name" id="brand_name">
		</div>

		<div class="form-group">
			<label>Brand Commodity</label>
			<select name="brand_commodity" class="form-control" id="brand_commodity">
				<option value="null">-- select commodity --</option>
			</select>
		</div>

		<div class="">
			<!-- Colored raised button -->
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
				Save Brand
			</button>
		</div>

	</form>
</div>


<div id="alert-brand-update" class="mdl-js-snackbar mdl-snackbar">
  	<div class="mdl-snackbar__text"></div>
  	<button class="mdl-snackbar__action" type="button"></button>
</div>

<script type="text/javascript">
	function updateBrand(event)
	{
		event.preventDefault();
		var ui = $(event.target),
			action = ui.attr('action'),
			data = ui.serializeArray();

		$.post(action, data)
		.done(function(res){
			window.brandTable.ajax.reload()
			var snackbarContainer = document.querySelector('#alert-brand-update');
			var data = {message: 'Merek berhasil ditambahkan'};
			snackbarContainer.MaterialSnackbar.showSnackbar(data);
		})
	}


	function fetch_data_brand()
	{
		var id_brand = URL.get().hash.id;
		$.post(site_url('company/get__brand_by/id_brand/'+id_brand), {return_in: 'json'})
		.done(function(res){
			res = JSON.parse(res)[0];
			$('#brand_name').val(res.brand_name);
			$('#id_brand').val(res.id_brand);
			$('#brand_commodity').val(res.id_commodity);
			if( res.commodity_name == null )
			{
				$('#brand_commodity').val('null');
			}

		})
	}

	function get_commodity()
	{
		$('option.list-commodity').remove();

		$.post(site_url('commodity/get_commodity'))
		.done(function(res){
			res = JSON.parse(res);
			Tools.write_data({
				records: res,
				target: '#brand_commodity',
				template: '<option class="list-commodity" value="::id_commodity::">::commodity_name::</option>'
			})
		})
	}

	$(function(){
		// fetch_data_brand();
		get_commodity();
	})
</script>