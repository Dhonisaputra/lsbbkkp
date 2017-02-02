	

	<!-- Square card -->
	<style>
	.login-container
	{
	    display: flex;
	    height: 100vh;
	}
	.demo-card-square.mdl-card {
	  width: 370px;
	  height: 350px;
	  margin: auto;
	  background-color: #efefef;
	}
	
	.demo-card-square .mdl-card__supporting-text
	{
		width: 100%;
	}
	.demo-card-square .form-control
	{
		border-radius: 0px;
	}

	.material-icon-preview
	{
		font-size: 120px;
	}
	.demo-card-square > .mdl-card__title {
	  /*color: #fff;*/
	}
	</style>
	<div class="login-container">
		<div class="demo-card-square mdl-card mdl-shadow--2dp text-center">
			
		  	<div class="mdl-card__supporting-text">
				<i class="material-icons material-icon-preview">domain</i>
		  	</div>
		  	<div style="font-size: 25px; margin-top: -30px; margin-bottom: 30px;">
		  		Login Perusahaan
		  	</div>
		  	<div class="mdl-card__actions mdl-card--border">
		    	<form action="company/process/authentication" type="post" onsubmit="login(event)" class="ui form" autocomplete="off">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username  / Email" required name="username" autocomplete="off">
					
						<input type="password" class="form-control" placeholder="password" required name="password" autocomplete="off">
					</div>

					<button class="btn btn-primary btn-block flat mdl-button mdl-js-button" type="submit">Login</button>
				</form>
		  	</div>
		</div>
	</div>

	<script type="text/javascript">
		function destruction()
		{
			var def = 90;
			setInterval(function(){
				$('#destructionCountdownSwal').text(def);
				def--;
			}, 1000)
		}
		function login(event)
		{
			event.preventDefault();

			var data = $(event.target).serializeArray(), action = $(event.target).attr('action');
			$.post(site_url(action), data)
			.done(function(response){
				// console.log(response); return false;
				
				response = JSON.parse(response);
				if(response.is_auth == true)
				{
					swal('Login berhasil','Akses diterima. Selamat datang '+response.data.username, 'success')
					var url = (URL.get().query.callback)? URL.get().query.callback : URL.get().query['callback=http'];
					console.log(url)
					if(url)
					{
						window.location.replace(url)
					}else {					
						window.location.href = site_url('');
					}
				}else
				{
					swal('Login gagal','Akses ditolak. password atau username tidak cocok ', 'error')
				}
			})
			.error(function(res){
				console.log(res);
				swal('Kesalahan sistem','Mohon maaf terdapat kesalahan pada sistem kami. silahkan tanyakan pada admin LSBBKKP untuk keterangan lebih lanjut!', 'error')
			})

			
		}
	</script>