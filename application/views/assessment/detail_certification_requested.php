<style type="text/css">
	body{
		overflow: auto;
	}
</style>
<?php

	if(isset($value['scope']) === TRUE)
	{
		$scope = array_map(function($r){
			return $r['commodity_name'];
		}, $value['scope']);
		$scope = implode(', ', $scope);
	}

	if(isset($value['data_brand']) === TRUE)
	{
		$brand = array_map(function($r){
			return $r['brand_name'];
		}, $value['data_brand']);
		$brand = implode(', ', $brand);
	}

	if(isset($value['nace']) === TRUE)
	{
		$nace = array_map(function($r){
			return $r['nace_name'].' <strong>'.$r['nace_item'].'</strong>';
		}, $value['nace']);
		$nace = implode(', ', $nace);
	}

	if(isset($value['certification']) === TRUE)
	{
		$audit_reference = array_map(function($r){
			return '<li class="detail-certification-requested--certification">'.$r['certificate_title'].' <strong>'.$r['name'].'</strong></li>';
		}, $value['certification']);
		$audit_reference = implode(', ', $audit_reference);
	}

	if(isset($value['product_line']) === TRUE)
	{
		$pl 	= array_map(function($r){
			return $r['product_line_data']['product_line_name'];
		}, $value['product_line']);
		$pl = array_unique($pl);

		$pl2 = array_map(function($r){
			return $r['text'];
		}, $value['product_line']);
		$pl2 = array_unique($pl2);
		
		$pl2 	= implode(', ', $pl2);
		$pl2 	= (!empty($pl2))? '( '.$pl2.' )' : '';
		$pl 	= implode(', ', $pl).$pl2;
	}

?>

<ul class="list-group">
	<li class="list-group-item flat">
		<center><h3><?php echo $value['company']['company_name'] ?></h3></center>
		<p><strong>	Email 	:	</strong> <?php echo $value['company']['email'] ?> </p>
		<p><strong>	Alamat 	:	</strong> <?php echo $value['company']['company_address'] ?> </p>
		<p><strong>	Jumlah pekerja 	:	</strong> <?php echo $value['company']['company_employee'] ?> pekerja</p>
		
		<p class="divider row"></p>
		<center><h3>Sertifikasi yang diajukan</h3></center>
		<p><strong>	Type 	: 	<?php echo $value['a0_cat']['type'] ?></strong></p>
		<p><strong>	Sertifikat : 	<?php echo isset($value['certificate'])? $value['certificate']['id_certificate'] : 'N/A' ?></strong></p>
		<p><strong>	Type permintaan 	:	</strong> <?php echo isset($value['text_type_request'])? $value['text_type_request'] : 'N/A' ?></p>
		<p><strong>	Merek / Brand 	:	</strong> <?php echo isset($value['data_brand'])? $brand : 'N/A' ?></p>
		<p><strong>	Ruang Lingkup / Scope 	:	</strong> <?php echo isset($value['scope'])? $scope : 'N/A' ?></p>
		<p><strong>	Komoditas / Product Line :</strong> <?php echo isset($value['product_line'])? $pl : 'N/A' ?></p>
		<p><strong>	NACE 	:	</strong> <?php echo isset($value['nace'])? $nace : 'N/A' ?></p>
		<p><strong>	Jenis sertifikasi yang diajukan :</strong> </p>
		<?php echo isset($value['certification'])? '<ul>'.$audit_reference.'</ul>' : 'N/A' ?>
		
	</li>
</ul>
