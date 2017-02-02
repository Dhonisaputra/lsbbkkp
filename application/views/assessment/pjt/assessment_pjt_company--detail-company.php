<div class="list-group">
			<div class="list-group-item text-center">
				<h1><?php echo $a0[0]['data_detail'][0]['company']['company_name'] ?> </h1>
				<div><?php echo $a0[0]['data_detail'][0]['company']['company_address'] ?></div>
				<div><?php echo $a0[0]['data_detail'][0]['company']['country_name'] ?></div>
			</div>
			<div class="list-group-item">
				<p><strong>	Email 	:	</strong> <?php echo $a0[0]['data_detail'][0]['company']['email'] ?> </p>
				<p><strong>	Alamat 	:	</strong> <?php echo $a0[0]['data_detail'][0]['company']['company_address'] ?> </p>
				<p><strong>	Jumlah pekerja 	:	</strong> <?php echo $a0[0]['data_detail'][0]['company']['company_employee'] ?> pekerja</p>
			</div>
			<center><h3>Sertifikasi yang diajukan</h3></center>
			<?php foreach ($a0 as $key => $value) { ?>
				<?php

					if(isset($value['data_detail'][0]['scope']) === TRUE)
					{
						$scope = array_map(function($r){
							return $r['commodity_name'];
						}, $value['data_detail'][0]['scope']);
						$scope = implode(', ', $scope);
					}

					if(isset($value['data_detail'][0]['data_brand']) === TRUE)
					{
						$brand = array_map(function($r){
							return $r['brand_name'];
						}, $value['data_detail'][0]['data_brand']);
						$brand = implode(', ', $brand);
					}

					if(isset($value['data_detail'][0]['nace']) === TRUE)
					{
						$nace = array_map(function($r){
							return $r['nace_name'].' <strong>'.$r['nace_item'].'</strong>';
						}, $value['data_detail'][0]['nace']);
						$nace = implode(', ', $nace);
					}

					if(isset($value['data_detail'][0]['certification']) === TRUE)
					{
						$audit_reference = array_map(function($r){
							return '<li class="detail-certification-requested--certification">'.$r['certificate_title'].' <strong>'.$r['name'].'</strong></li>';
						}, $value['data_detail'][0]['certification']);
						$audit_reference = implode(', ', $audit_reference);
					}

					if(isset($value['data_detail'][0]['product_line']) === TRUE)
					{
						$pl 	= array_map(function($r){
							return $r['product_line_data']['product_line_name'];
						}, $value['data_detail'][0]['product_line']);
						$pl = array_unique($pl);

						$pl2 = array_map(function($r){
							return $r['text'];
						}, $value['data_detail'][0]['product_line']);
						$pl2 = array_unique($pl2);
						
						$pl2 	= implode(', ', $pl2);
						$pl2 	= (!empty($pl2))? '( '.$pl2.' )' : '';
						$pl 	= implode(', ', $pl).$pl2;
					}

				?>

				<div class="list-group-item list-group-item-request list-group-item-request--<?php echo $value['data_detail'][0]['a0_cat']['id_a0_cat']; ?>" data-id="<?php echo $value['data_detail'][0]['a0_cat']['id_a0_cat']; ?>" >
					<input type="hidden" class="input-risk" value="<?php echo $value['data_detail'][0]['a0_cat']['risk'] ?>">
					<input type="hidden" class="input-type" value="<?php echo $value['data_detail'][0]['a0_cat']['type'] ?>">
					<input type="hidden" class="input-id_a0_cat" value="<?php echo $value['data_detail'][0]['a0_cat']['id_a0_cat'] ?>">

					<p>
						<strong>	
							Type : 	
							<?php echo $value['data_detail'][0]['a0_cat']['type'] ?>
						</strong>
					</p>
					<p>
						<strong>	
							Sertifikat : 	
							<?php echo isset($value['data_detail'][0]['certificate'])? $value['data_detail'][0]['certificate']['id_certificate'] : 'N/A' ?>
						</strong>
					</p>
					<p>
						<strong>
							Type permintaan :	
						</strong> 
						<?php echo isset($value['data_detail'][0]['text_type_request'])? $value['data_detail'][0]['text_type_request'] : 'N/A' ?>
					</p>
					<p>
						<strong>
							Merek / Brand :	
						</strong> 
						<?php echo isset($value['data_detail'][0]['data_brand'])? $brand : 'N/A' ?>
					</p>
					<p>
						<strong>
							Ruang Lingkup / Scope :	
						</strong> 
						<?php echo isset($value['data_detail'][0]['scope'])? $scope : 'N/A' ?>
					</p>
					<p>
						<strong>
							Komoditas / Product Line :
						</strong> 
						<?php echo isset($value['data_detail'][0]['product_line'])? $pl : 'N/A' ?>
					</p>
					<p>
						<strong>
							NACE :	
						</strong> 
						<?php echo isset($value['data_detail'][0]['nace'])? $nace : 'N/A' ?>
					</p>
					<p>
						<strong>
							Jenis sertifikasi yang diajukan :
						</strong> 
					</p>
					<?php echo isset($value['data_detail'][0]['certification'])? '<ul>'.@$audit_reference.'</ul>' : 'N/A' ?>
				</div>
			<?php } ?>

		</div>