<?php echo $this->load->component('js','js/library.certification.js'); ?>
<?php echo $this->load->component('js','js/library.company.js'); ?>
<?php echo $this->load->component('js','js/library.commodity.js'); ?>
<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
<!-- Flat button -->
	<a href="<?php echo isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER'] : site_url('company/'.$id_company) ?>" class="mdl-button mdl-js-button mdl-button--icon">
	  <i class="material-icons">keyboard_backspace</i>
	</a>
</div>
<div class="mdl-grid">
	<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--5-col mdl-grid">

			<form class="" type="post" id="brandForm" name="brandForm" action="<?php echo site_url('company/process/create/brand') ?>" onsubmit="submitBrand(event)">
				<input type="hidden" name="id_company" value="<?php echo $id_company ?>">
				<div class="form-group">
					<label>Name of Your Brand</label>
					<input class="form-control" type="text" placeholder="name for your brand" name="brand_name" onchange="checkBrandName(event)" required>
					<span id="helpBlock" class=""></span>

				</div>

				<div class="" id="checkbox-list-commodity">
					
				</div>

				<!-- <label class="mdl-switch mdl-switch-using-certification mdl-js-switch mdl-js-ripple-effect" for="switch-to-use-certification">
				  	<input type="checkbox" id="switch-to-use-certification" class="mdl-switch__input" name="is_certification" onchange="useCertification(event)" value="1">
				  	<span class="mdl-switch__label"> want to obtain a certificate for it as well?</span>
				</label>
				<span id="helpBlock" class="help-block">System secara otomatis akan menambahkan Brand ini untuk di sertifikasi.</span> -->
				<div class="form-group">
					<!-- Colored raised button -->
					<button type="submit" form="brandForm" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
						add this brand.
					</button>

				</div>
			</form>

			<!-- <form id="useCertification" class="sr-only hidden" type="post">
				<div class="form-group">
					<label>Certification</label>
					<select name="certification[]" id="certification_category" class="form-control" multiple required>
						
					</select>
					<span id="helpBlock" class="help-block">Pilih 1 atau lebih sertifikasi yang di inginkan.</span>
				</div>
			</form> -->

	</div>
	<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--7-col">
			<table class="table table-striped table-hover table-bordered" style="width:100%;" id="tableBrand">
				<thead>
					<tr>
						<td>No.</td>
						<td>Brand Name</td>
						<td>Commodity</td>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		<!-- <div class="list-group">
			<div class="list-group-item"> <strong>Name :</strong> <?php echo $data_company['company_name']?> </div>
			<div class="list-group-item"> <strong>Address :</strong> <?php echo $data_company['company_address']?> </div>
			<div class="list-group-item"> <strong>Email :</strong> <?php echo $data_company['email']?> </div>
			<div class="list-group-item"> <strong>Telephone :</strong> <?php echo $data_company['telephone']?> </div>
		</div> -->
	</div>
</div>

<datalist id="datalist-commodity" name="datalist-commodity"> 

</datalist>

<script type="text/javascript">
	var is_checked = false;

	/*check availabe of brand name*/
	function checkBrandName(event)
	{
		var brand_name = $(event.target).val(),
			id_company = "<?php echo $data_company['id_company']?>";
		$.when( Company.input.check_availability_brand({id_company: id_company, brand_name: brand_name}) ).done(function(res){
			if(res.is_available)
			{
				$('[name="brand_name"]').siblings().eq(1).removeClass('text-success').addClass('text-danger').text('sorry. this brand not available. please check your brand list first.')
				$('[name="brand_name"]').focus();				
			}else
			{
				$('[name="brand_name"]').siblings().eq(1).removeClass('text-danger').addClass('text-success').text('This brand is available');
			}
		})
	}

	function useCertification(event)
	{
		var target = $(event.target);
		is_checked = target.is(':checked');

		if(is_checked)
		{
			$('form#useCertification').removeClass('sr-only hidden').addClass('shown').show();
		}else if(!is_checked)
		{
			$('form#useCertification').addClass('sr-only hidden').removeClass('shown').hide();

		}
	}

	function submitBrand(event)
	{
		event.preventDefault();

		var data = (!is_checked)? $(event.target).serializeArray() : $('form#brandForm, form#useCertification').serializeArray(),
			action = $(event.target).attr('action');

			// $.post(action, data)
			// .done(function(response){
			// 	response = JSON.parse(response);
			// 	event.target.reset();
			// })
			console.log(data)
			Company.save_brand({
				action: action, 
				data:data, 
				done: function(response){
					response = JSON.parse(response);

					if(response.success)
					{
						event.target.reset();
						window.tableBrand.ajax.reload();
						// $('label.mdl-switch-using-certification').removeClass('is-checked');
						// $('form#useCertification').hide();
					}
				}
			})

	}

	$(function(){
		/*datatable brand*/
		window.tableBrand = $('#tableBrand').DataTable({
			searching: false,
			lengthChange: false,
			ajax: 
			{
				url: site_url('company/get_brand/<?php echo $data_company["id_company"]?>/datatable'),
			    dataSrc: function ( json ) {
			    	if(json.length < 1 || (json.data && json.data.length < 1)) return false;
				    return json.data;
			    }
			},

		});


		// render commodity
		Commodity.render.commodity_list({
            template: '<div class="form-group"><label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-::id_commodity::"> <input type="radio" id="option-::id_commodity::" class="mdl-radio__button" name="id_commodity" value="::id_commodity::" > <span class="mdl-radio__label">::commodity_name::</span> </label></div>',
            target: $('#checkbox-list-commodity'),
        })
        componentHandler.upgradeAllRegistered();
	})
</script>