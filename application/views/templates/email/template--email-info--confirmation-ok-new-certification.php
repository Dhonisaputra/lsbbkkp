<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div id="content" style="line-height: 1.5; margin: 0 auto; width:90%;padding:10px; box-shadow: 0px 0px 2px #000;">
	<?php 
		echo $this->load->view('templates/email/template--email-header','',true);
	?>
	<div style="margin-top: 20px;">
		
		<div> Halo <?php echo @$companyName ?> </div>
		<div> Kami menginformasikan bahwa permintaan anda telah kami terima. Silahkan klik tautan dibawah ini untuk mengkonfirmasikan tanggal kesanggupan dilaksakannya assessment.</div>
		<div>
			<a href="<?php echo $url_confirmation ?>" class="" style="padding:15px; background-color: #4183D7; color: white; text-decoration: none;"> Klik disini untuk konfirmasi tanggal assessment </a>
		</div>


</div>