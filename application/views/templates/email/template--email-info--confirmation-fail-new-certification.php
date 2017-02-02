<div id="content" style="line-height: 1.5; margin: 0 auto; width:90%;padding:10px; box-shadow: 0px 0px 2px #000;">
	<?php 
		echo $this->load->view('templates/email/template--email-header','',true);
	?>
	<div style="margin-top: 20px;">
		
		<div> Halo <?php echo @$companyName ?> </div>
		<div> Kami menginformasikan bahwa permintaan anda tidak memenuhi syarat untuk melanjutkan ke tingkat assessment. Silahkan ikuti poin dibawah ini untuk mengetahui apa yang terjadi.</div>
		<div>
			<ul >
				<li>Konsultasikan dengan lembaga sertifikasi tentang kekurangan perusahaan anda.</li>
				<li>Perbaiki syarat-syarat untuk melanjutkan ke tingkat assessment.</li>
			</ul>
		</div>
		<div>Jika anda merasa tidak melakukan pengajuan sertifikasi, segera konfirmasikan kepada kami bahwa anda tidak melakukan pengajuan.</div>
	</div>
	<div style="display: flex; justify-content:flex-end; margin-right: 20px;margin-top: 50px;">
		Tertanda LSBBKKP
	</div>


</div>