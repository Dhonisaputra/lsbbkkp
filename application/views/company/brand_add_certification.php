<?php echo $this->load->component('js','js/library.company.js'); ?>
<?php echo $this->load->component('js','js/library.certification.js'); ?>

<!-- //////////////////////// BODY //////////////////////////// -->

<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">

    <a href="<?php echo isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER'] : site_url('company/'.$id_company) ?>" class="mdl-button mdl-js-button mdl-button--icon">
		<i class="material-icons">keyboard_backspace</i>
	</a>
    
</div>
<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--7-col mdl-grid">

	<form onsubmit="add_certification_submit(event)">
		<input type="hidden" name="id_company" value="<?php echo $id_company ?>">
		<input type="hidden" name="id_brand" value="<?php echo $id_brand ?>">
		<input type="hidden" name="is_certification" value="true">
		<div class="form-group">
			<label>Certification</label>
			<input class="form-control" type="text" list="datalist-certification" placeholder="add new Certification" oninput="add_certification(event)" >
		</div>
		<div class="list-certification form-group">

		</div>

		<!-- Colored raised button -->
		<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
		  Add This Certification
		</button>

	</form>

</div>

<datalist id="datalist-certification" name="datalist-certification">

</datalist>

<script type="text/javascript">
	var data_certification = [];
	function add_certification(event)
	{
		var ui = $(event.target),
			value = ui.val(),
			datalist = $('#datalist-certification option[value="'+value+'"]'),
			datalist_audit_reference = $(datalist).attr('value'),
			datalist_text = $(datalist).text(),
			datasave = {audit_reference: datalist_audit_reference, name: datalist_text},
			list_template = '<div class="checkbox checkbox-certification"> <label> <input type="checkbox" name="certification[]" onchange="changeStateCertification(event)" value="'+value+'" checked> '+datalist_text+' </label> </div>';

		if(value && value !== '')
		{
			data_certification.push(datasave);
			$('.list-certification').append(list_template);
			ui.val('');
			datalist.remove();
		}
	}

	function changeStateCertification(event)
	{

		var ui = $(event.target),
			onChecked = ui.is(':checked'),
			value = ui.val(),
			dataCertification = data_certification.filter(function(data){ return data.audit_reference == value });

			Certification.appendData({records: dataCertification, target: '#datalist-certification', template: '<option value="::audit_reference::"> ::name:: </option>'})
			ui.parents('.checkbox-certification').remove();

			// sort datalist
			$("#datalist-certification").html($("#datalist-certification option").sort(function (a, b) {
			    return a.value == b.value ? 0 : a.value < b.value ? -1 : 1
			}))
	}

	function add_certification_submit(event)
	{
		event.preventDefault();
		var ui = $(event.target),
			data = ui.serializeArray();

		// console.log(data);
		Company.process.add_certification_brand(data);
	}

	$(function(){
		var certification_available = Company.get_certification_available_for_brand({data:{id_brand: "<?php echo $id_brand ?>" }});

		Tools.write_data({records: certification_available, target: '#datalist-certification', template: '<option value="::audit_reference::"> ::name:: </option>'})
	})
</script>