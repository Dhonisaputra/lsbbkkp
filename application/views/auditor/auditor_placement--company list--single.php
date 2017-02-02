<div class="col-md-6 auditor_placement--selected-company-list" id="selected-company--<?php echo $company['id_company'] ?>"> 
	<div class="form-group"> 
		<div class="checkbox"> 
			<button class="mdl-button mdl-js-button mdl-button--icon" data-toggle="collapse" data-target="#collapse-auditor-placement--<?php echo $company['id_company'] ?>" aria-expanded="true" aria-controls="collapse-auditor-placement--<?php echo $company['id_company'] ?>" onclick="if( $(this).attr('aria-expanded') == 'true' ){ $(this).find('.material-icons').text('keyboard_arrow_right') }else{ $(this).find('.material-icons').text('keyboard_arrow_down') }">
				<i class="material-icons">keyboard_arrow_down</i>
			</button> 
			<label style="padding-left:0px;"> 
				<input class="sr-only placement_company_list" type="checkbox" name="placement_company_list[]" value="<?php echo $company['id_company'] ?>" onChange="selectCompanyPlacement(this)"> 
				<strong>
					<span class="material-icons sign">check_box_outline_blank</span>  
					<span class="company_name"> <?php echo $company['company_name'] ?> </span>
				</strong>  
				<span class="sign-text"></span> 
			</label>  
			<div class="detail-placement-company collapse in" id="collapse-auditor-placement--<?php echo $company['id_company'] ?>">

				<?php 
					foreach ($a0_cat as $a => $b) {
						# code...
						foreach ($b['certification_request'] as $c => $d) {
							# code...
							$tNace 		= $d['nace'] !== '' ? '<p><strong>NACE:</strong> '.implode(', ', $d['nace_detail_title']).'</p>' : '';
							$tScope 	= $d['scope'] !== ''? '<p><strong>Ruang Lingkup:</strong> '.implode(', ', $d['scope_detail_title'] ).'</p>' : '';
							$tBrand 	= !empty($d['brand_name']) ? '<p><strong>Merek:</strong> '.$d['brand_name'].'</p>' : '';
							$tPrdLine 	= !empty($d['product_line'])? '<p><strong>Lini Produk:</strong> '.$d['product_line'].'</p>' : '';
							$tAudit 	= !empty($d['audit_reference'])? '<p><strong>Jenis sertifikat:</strong> '.implode(', ', $d['audit_reference_title']).'</p>' : '';
							$type 		= $b['type'];

							echo <<<EOF
							<div>
								<h5 style="color:#d35400"><u>#$type</u></h5>
								$tNace
								$tScope
								$tBrand
								$tPrdLine
								$tAudit
							</div>
EOF;
						}

					}
					// echo $t;
				?>	
			</div>

		</div>  
	</div> 
</div>