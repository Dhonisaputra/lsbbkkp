<style type="text/css">
	body
	{
		overflow-y: auto;
	}
</style>
<div class="container mdl-shadow--2dp" style="overflow-y: auto;">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="font-size:10px; display: table-cell;">
			<span style="font-size: 3rem;">LEMBAGA SERTIFIKASI SISTEM MANAJEMEN MUTU  BALAI BESAR KULIT, KARET DAN PLASTIK - YOQA</span>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
			<img src="<?php echo base_url('application/components/images/kemenper.png'); ?>" class="img-responsive">
		</div>
	</div>
	<hr>

	<center ><h1 style="margin:0 auto;"><strong> <?php echo $data['company']['company_name'] ?> </strong></h1></center>
	<center ><h3 style="margin:0 auto;"><strong> <?php echo $data['certificate']['id_certificate'] ?> </strong></h3></center>
	<hr>
	<div class="col-md-2 col-lg-2 col-sm-2 col-xs-2 pull-right">
		<img class="img-responsive" src="<?php echo base_url('application/clients/Companies/'.$data['company']['id_company'].'/certificates/'.sha1($data['a0_cat']['id_a0_cat']).'.png') ?>">
	</div>
	<p><strong>Company Name : </strong> <?php echo $data['company']['company_name'] ?> </p>
	<p><strong>Telephone : </strong> <?php echo $data['company']['telephone'] ?> </p>
	<p><strong>Email : </strong> <?php echo $data['company']['email'] ?> </p>
	<p><strong>Fax : </strong> <?php echo $data['company']['company_fax'] ?> </p>
	<p><strong>Address : </strong> <?php echo $data['company']['company_address'] ?> <?php echo $data['company']['company_post'] ?>, <?php echo $data['company']['company_region'] ?>, <?php echo $data['company']['company_province'] ?>, <?php echo $data['company']['country_name'] ?> </p>
	<hr>
	<h3><a href="#certificate" class="text-muted">#detail sertifikasi</a></h3>
	<p><strong> No. Certificate : </strong> <?php echo $data['certificate']['id_certificate'] ?> </p>	
	<p><strong> No. Ref : </strong> LSBBKKP/COM/<?php echo $data['company']['id_company'] ?> </p>	
	<p><strong> Sertifikat : </strong> <?php echo implode(', ', $data['audit_reference']['certificate']) ?> </p>
	<p><strong> Sertifikat awal terbit : </strong> <?php echo date('j M Y', strtotime($data['issued'][0]['issued_date'])); ?> </p>
	<p><strong> Tanggal terbit : </strong> <?php echo date('j M Y', strtotime($data['issued_terakhir']['issued_date'])); ?> </p>
	<p><strong> Tanggal perubahan sertifikat : </strong> <?php echo (count($data['audit_khusus']) < 1)? ' - ' : date('j M Y', strtotime($data['audit_khusus_terakhir']['modified_time'])); ?> </p>
	<p><strong> Tanggal berakhirnya sertifikat : </strong> <?php echo date('d F Y', strtotime("+".$data['certification_type']['use_period']." months", strtotime($data['issued_terakhir']['issued_date']))); ?> </p>

	<p><strong> Catatan : </strong> <?php echo $data['certificate']['certificate_note'] ?> </p>	
	<?php 
		if(isset($data['scope']) && count($data['scope']) > 0)
		{
	?>
		<hr>
		<h3><a href="#certificate" class="text-muted">#detail Scope</a></h3>
		<div><strong>Scope : </strong></div>
		<ol>
			<?php 
				foreach ($data['scope'] as $key => $value) {
		
					echo '<li>'.$value['commodity_name'].'</li>';
				}
			?>
		</ol>
	<?php
		}
	?>
	<?php 
		if(isset($data['nace']) && count($data['nace']) > 0)
		{
	?>
		<hr>
		<h3><a href="#nace" class="text-muted">#detail Nace</a></h3>
		<div><strong>Nace : </strong></div>
		<ol>
			<?php 
				foreach ($data['nace'] as $key => $value) {
		
					echo '<li> <strong>('.$value['nace_item'].')</strong> '.$value['nace_name'].'</li>';
				}
			?>
		</ol>
	<?php
		}
	?>

	<?php 
		if(isset($data['product_line']) && count($data['product_line']) > 0)
		{
	?>
		<hr>
		<h3><a href="#productline" class="text-muted">#Product Line</a></h3>
		<?php 
			if(isset($data['data_brand']) && count($data['data_brand']) > 0)
			{
		?>
			<div><strong>Brand : </strong></div>
			<ol>
				<?php 
			
					foreach ($data['certification_request'] as $key => $value) {
			
						echo '<li><strong> Merek : </strong> '.$value['text_brand'].' <br> <strong>Lampiran : </strong> '.$value['text_lampiran'].' </li>';
					}
				?>
			</ol>
		<?php } ?>

		<div><strong>Product Line : </strong></div>
		<ol>
			<?php 
				foreach ($data['product_line'] as $key => $value) {
		
					echo '<li>'.$value['product_line_data']['product_line_name'].'</li>';
				}
			?>
		</ol>
	<?php
		}
	?>

	<section class="navbar">
		<div class="pull-right">
			<a href="<?php echo base_url('application/clients/Companies/'.$data['company']['id_company'].'/certificates/'.$data['certificate']['certificate_md5'].'.pdf') ?>" target="_blank" class="mdl-button mdl-js-button">download PDF</a>
			<a href="<?php echo base_url('application/clients/Companies/'.$data['company']['id_company'].'/certificates/'.sha1($data['a0_cat']['id_a0_cat']).'.png') ?>" target="_blank" class="mdl-button mdl-js-button">download QR Code</a>
		</div>
	</section>
</div>

<?php //print_r($data); ?>