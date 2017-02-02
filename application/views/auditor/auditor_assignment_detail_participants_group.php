
<section class="navbar">
	<button onclick="window.close();" class="btn btn-warning mdl-button mdl-button-js"> <i class="material-icons">chevron_left</i> close </button>
	<button href="#auditor-assignment--tab--auditor-choose" aria-controls="auditor choose" data-tab="" role="tab" data-toggle="tab" class="btn btn-primary mdl-button mdl-button-js pull-right"> Next <i class="material-icons">chevron_right</i> </button>
</section>

<div style="margin-top:10px;"></div>
<?php 
	foreach ($data['datasource'] as $key => $value) {
//print_r($value);
	
?>
	<div class="list-group">
		<div class="list-group-item active"><?php echo $value['company']['company_name'] ?></div>
		<div class="list-group-item">
			<p> <strong> Type : <?php echo $value['a0_cat'][0]['type'] ?></strong></p>
			<p> <strong> Requested As : <?php echo implode(', ', $value['unique_type_requested']) ?></strong></p>
			<p> <strong> Brand Requested :</strong> <?php echo !empty($value['brand_requested'])? implode(', ', $value['brand_requested']) : 'N/A'; ?> </p>
			<p> <strong> Nomor Sertifikat :</strong> <?php echo $value['a0_cat'][0]['id_certificate'] ?> </p>
			<p> <strong> Scope :</strong> <?php echo !empty($value['scope_requested'])? implode(', ', $value['scope_requested']) : 'N/A' ?> </p>
			<p> <strong> Product Line :</strong> <?php echo !empty($value['product_line_requested'])? implode(', ', $value['product_line_requested']) : 'N/A' ?> </p>
			<p> <strong> Nace :</strong> <?php echo !empty($value['nace_requested'])? implode(', ', $value['nace_requested']) : 'N/A' ?> </p>
			
		</div>
	</div>
	<script type="text/javascript">
	$.fn.auditor_placement.company_add({id_company:'<?php echo $value["company"]["id_company"] ?>', id_a0: "<?php echo $value['a0']['id_a0'] ?>", id_rs: "<?php echo $value['rs']['id_rs'] ?>", id: "<?php echo $value['rs']['id_rs'] ?>", type_schedule: 're assessment', 'company_name':'<?php echo $value["company"]["company_name"] ?>'})
	</script>
<?php } ?>