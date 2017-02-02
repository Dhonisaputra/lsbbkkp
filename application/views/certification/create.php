<?php echo $this->load->component('js', 'js/zebra_datepicker/javascript/zebra_datepicker.js') ?>
<?php echo $this->load->component('css', 'js/zebra_datepicker/css/default.css') ?>

<form class="" action="<?php echo site_url('certification/process/create'); ?>">

	<div class="form-group">
		<label>Issued Date</label>
		<input class="form-control" type="date">
	</div>

</form>

<script type="text/javascript">
	
	$(function(){
		$('input[type="date"]').Zebra_DatePicker({
		});
	})

</script>