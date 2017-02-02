<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">

    
    <div class="btn-group" role="group" aria-label="...">
        <!-- Icon button -->
		<button href="#profile-company--home" role="tab" data-toggle="tab" class="mdl-button mdl-js-button mdl-button--icon" onclick="nav.back()">
			<i class="material-icons">keyboard_backspace</i>
		</button>

    </div>

</div>

<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
	<form name="edit-company" id="edit-company" action="<?php echo site_url('company/process/update'); ?>" onsubmit="updateCompany(event)">

		<input type="hidden" name="id_company" id="id_company">
		
		<div class="form-group">
			<label>company name</label>
			<input class="form-control" name="company_name" placeholder="company_name" autocomplete="off" >
		</div>
		<div class="form-group">
			<label>company address</label>
			<textarea class="form-control" name="company_address" placeholder="company address" autocomplete="off" ></textarea>
		</div>
		<div class="form-group">
			<label>company postzip</label>
			<input class="form-control" name="company_post" placeholder="company postzip" autocomplete="off" >
		</div>
		<div class="form-group">
			<label>Email</label>
			<input class="form-control" name="email" placeholder="company email" autocomplete="off" type="email">
		</div>
		<div class="form-group">
			<label>Telephone</label>
			<input class="form-control" name="telephone" placeholder="company telephone" autocomplete="off" type="tel" >
		</div>

		<div class="">
			<!-- Colored raised button -->
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
				Update Company
			</button>
		</div>

	</form>
</div>

<script type="text/javascript">
	function get_company()
	{
		$.post(site_url('company/get_all_company'))
		.done(function(res){
			res = JSON.parse(res);
			var id_company = URL.get().hash.id_company
			res = res.filter(function(r){ return r.id_company == id_company })[0];
			$.each(res, function(a,b){
				$('#edit-company').find('[name="'+a+'"]').val(b);
			})
		})
	}

	function updateCompany(event)
	{
		event.preventDefault();
		var action = $(event.target).attr('action'),
			data = $(event.target).serializeArray();

		$.post(action, data)
		.done(function(res){
			
		})
	}

</script>