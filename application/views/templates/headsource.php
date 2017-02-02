<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?php echo isset($title)?$title:'admin panel'; ?> </title>
	

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700">

	<!-- standard JQUERY -->
	<?php echo $this->load->component('js', 'js/jquery/jquery-1.11.3.min.js') ?>	

	<!-- material designs -->
	<?php echo $this->load->component('css', 'plugins/gmdl/material.indigo-pink.min.css') ?>
	<?php echo $this->load->component('css', 'plugins/gmdl/icon.css') ?> 
	<?php echo $this->load->component('js', 'plugins/gmdl/material.min.js') ?>
	
	<!-- Tools -->
	<?php echo $this->load->component('js', 'js/Engine.tools.js') ?>
	<?php echo $this->load->component('js', 'js/jstools/modal.helper.js') ?>
	
	<!-- manipulation URL -->
	<?php echo $this->load->component('js', 'js/manipulation.url.js') ?>

	<!-- manipulation Pushstate -->
	<?php echo $this->load->component('js', 'js/manipulation.pushstate.js') ?>

	<!-- JSDATA -->
	<?php echo $this->load->component('js', 'jsdata/Users.js') ?>
	<?php echo $this->load->component('js', 'jsdata/jsdata.Notification.js') ?>

	<?php echo $this->load->component('js', 'js/jstools/snackbar.helper.js') ?>
	
	<?php echo $this->load->component('js', 'js/manipulation.serversent.js') ?>
	<?php echo $this->load->component('js', 'js/library.notification.js') ?>

	<?php echo $this->load->component('css', 'plugins/swal/sweetalert.css') ?>
	<?php echo $this->load->component('js', 'plugins/swal/sweetalert.min.js') ?> 

	<?php echo $this->load->component('js', 'plugins/momentjs/moment.js') ?> 

	<?php echo $this->load->component('js', 'plugins/jscookie/js.cookie.js') ?>


	<!-- CSS Style For this Apps -->
	<?php echo $this->load->component('css', 'css/yoqa.main.css') ?>
	<?php echo $this->load->component('css', 'css/module.css') ?>
	<?php echo $this->load->component('js', 'js/jstools/jquery.doctab.js') ?>


	<!-- Bootstrap -->
	<?php echo $this->load->component('js', 'plugins/bootstrap/dist/js/bootstrap.min.js') ?>
	<?php echo $this->load->component('css', 'plugins/bootstrap/dist/css/bootstrap.css') ?>

	<?php echo $this->load->component('css', 'css/navbar.css') ?>

	<?php echo $this->load->component('css', 'css/template--mdl-styles.css') ?>

	<?php echo $this->load->component('js', 'js/yoqa.main.js') ?>

	<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

	<?php
		if(isset($css))
		{
			$css = is_array($css)? $css : array($css);
			foreach ($css as $value) {
				echo '<link rel="stylesheet" type="text/css" href="'.$value.'">';			
			}
		}

		if(isset($js))
		{
			$js = is_array($js)? $js : array($js);
			foreach ($js as $value) {
				echo '<script type="text/javascript" src="'.$value.'"></script>';			
			}
		}
	?>
	<?php #echo $this->load->component('js', '../libraries/profiling/profiling.authority.js') ?>

	<script type="text/javascript">
		
		// requirement Notification enabled
		if (Notification.permission !== 'denied') {
		    Notification.requestPermission(function (permission) {
		      
		    });
	  	}

		function base_url(url)
		{
			url = (url)? url : '';
			return '<?php echo base_url("'+url+'") ?>'
		}

		function site_url(url)
		{
			url = (url)? url : '';
			return '<?php echo site_url("'+url+'") ?>'
		}

		function initializeTooltip()
		{
			$('[data-toggle="tooltip"], [data-bs="tooltip"], [tooltip], .bs-tooltip').tooltip();
		}

		$(document).ready(function(){
			
			window.notif = new Notif('https://infinite-dusk-57108.herokuapp.com/')

			$(document).delegate('.preventDefault', 'click', function(e){
				e.preventDefault();
			})

			initializeTooltip();

			<?php if(isset($_SESSION['is_login'])){ ?>

    			window.cookie = Cookies.getJSON('authentication').data;
				
				fetching_notification();

				socket_listener('<?php echo $_SESSION["level"] ?>', '<?php echo $_SESSION["id_users"] ?>');
			<?php } ?>

		})
		
	</script>
</head>