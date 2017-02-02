<div id="content" style="line-height: 1.5; margin: 0 auto; width:90%;padding:10px; box-shadow: 0px 0px 2px #000;">
	<?php 
		echo $this->load->view('templates/email/template--email-header','',true);
	?>
	<div style="margin-top: 20px;">
		
		<div> Halo <?php echo @$companyName ?> </div>
		<div>Sistem kami telah menerima pengajuan sertifikasi yang anda isikan pada <?php echo date('l, d F Y', $timestamp) ?>. Silahkan ikuti poin-poin dibawah ini sebagai panduan</div>
		<div>
			<ul>
				<li>Silahkan kirimkan persyaratan dan dokumen yang akan kami gunakan sebagai alat penunjang sertifikasi ke email <a href="mailto:bbkkp_jogja@gmail.com">bbkkp_jogja@gmail.com</a> </li>
				<li>Konfirmasikan kepada kami melalui telephone bahwa anda telah mengirimkan persyaratan dan dokumen yang dibutuhkan</li>
				<li>LSBBKKP akan melakukan verifikasi syarat dan dokumen. Jika syarat dan dokumen perusahaan anda kami terima, maka sistem akan mengirimkan alamat tautan untuk konfirmasi tanggal assessment. </li>
				<li>Silahkan isikan tanggal assessment untuk konfirmasi kesanggupan tanggal assessment. </li>
			</ul>
		</div>
		<div>Jika anda merasa tidak melakukan pengajuan sertifikasi, segera konfirmasikan kepada kami bahwa anda tidak melakukan pengajuan.</div>
	</div>
	<div style="display: flex; justify-content:flex-end; margin-right: 20px;margin-top: 50px;">
		Tertanda LSBBKKP
	</div>

</div>