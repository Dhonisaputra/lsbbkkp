<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?php echo isset($title)?$title:'admin panel'; ?> </title>
	

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700">
	<?php echo $this->load->component('css', 'css/yoqa-web-main.css') ?>


	<!-- material designs -->
	<?php echo $this->load->component('css', 'plugins/gmdl/material.indigo-pink.min.css') ?>
	<?php echo $this->load->component('css', 'plugins/gmdl/icon.css') ?> 
	<?php echo $this->load->component('js', 'plugins/gmdl/material.min.js') ?>

	<!-- standard JQUERY -->
	<?php echo $this->load->component('js', 'js/jquery/jquery-1.11.3.min.js') ?>	

	<?php echo $this->load->component('js', 'plugins/bootstrap/dist/js/bootstrap.min.js') ?>
	<?php echo $this->load->component('css', 'plugins/bootstrap/dist/css/bootstrap.css') ?>
	

</head>
