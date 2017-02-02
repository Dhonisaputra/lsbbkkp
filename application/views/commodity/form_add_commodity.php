<div class="col-md-5">	
	<form onsubmit="form__submit_add_commodity(event)" action="<?php echo site_url('commodity/process/add/list') ?> ">
		
		<div class="form-group">
			<label>Commodity name</label>
			<input type="text" class="form-control" name="commodity_name">
		</div>
		
		<!-- <div class="radio">
			<label class="">
				<input type="radio" name="commodity_type" value="JPA-009"> JPA-009
			</label>
		</div>

		<div class="radio">
			<label class="">
				<input type="radio" name="commodity_type" value="YQ-005"> YQ-005
			</label>
		</div>

		<div class="radio">
			<label class="">
				<input type="radio" name="commodity_type" value="JECA-004"> JECA-004
			</label>
		</div> -->

		<div class="form-group">
			<!-- Colored raised button -->
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">
				<i class="material-icons">add</i> Tambah
			</button>

		</div>
	</form>
</div>

<script type="text/javascript">
	function form__submit_add_commodity(event)
	{
		event.preventDefault();
		var url = $(event.target).attr('action'),
			data = $(event.target).serializeArray();
		$.post(url, data)
		.done(function(res){
			event.target.reset();
			window.tableCommodity__complete.ajax.reload()
		})
	}
</script>