	

<!-- Square card -->
<style>
	body:before
	{
		background-image: url('http://www.ecoinstitution.co.uk/wp-content/uploads/2016/08/image-4.jpg');
		background-repeat: no-repeat;
		background-size: cover;
		-webkit-filter: blur(5px);
		-moz-filter: blur(5px);
		-o-filter: blur(5px);
		-ms-filter: blur(5px);
		filter: blur(5px);
		content: " ";
		position: fixed;
		width: 100%;
		height: 100vh;
		z-index: -1;
		transform: scale(1.1);
		top: 0;
		left: 0;
		/*background-color: #52B3D9;*/
	}

	.login-container
	{
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		height: 100vh;
		align-content: space-between;
	}
	.demo-card-square {
		height: 350px;
		background-color: #efefef;
		margin-top: 50px;
	}
		.img-logo
		{
			width: 300px;
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
		color: #03C9A9;
	}
	.demo-card-square > .mdl-card__title {
		/*color: #fff;*/
	}
</style>
<div class="login-container container">
	<img class="img-responsive img-logo"  src="<?php echo site_url('application/components/images/logo_yoqa.png'); ?>">
	<div class="panel panel-default demo-card-square text-center col-md-5 col-lg-4 col-sm-8 col-xs-12">
		<div class="mdl-card__supporting-text">
			<i class="material-icons material-icon-preview">verified_user</i>
		</div>
		<div class="panel-body">
			<form action="users/process/authentication" type="post" onsubmit="login(event)" class="ui form" autocomplete="off">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Username" required name="username" autocomplete="off">
					
					<input type="password" class="form-control" placeholder="password" required name="password" autocomplete="off">
				</div>

				<button class="btn btn-primary btn-block flat mdl-button mdl-js-button" type="submit">Masuk</button>
			</form>
			<div>  
				<div> <a class="mdl-button mdl-js-button " href="#"> <i class="material-icons">priority_high</i> Lupa password </a> </div>
			</div>
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
				
				response = JSON.parse(response);
				if(response.is_auth == true && !response.forbidden)
				{
					// SET COOKIE
					Cookies.set('authentication', response);
		
					swal('Login berhasil','Akses diterima. Selamat datang '+response.data.username, 'success')
					window.location.href = site_url(response.redirect);
				}else
				{
					swal('login gagal','Akses ditolak', 'error')
					return false;
				}
			})
		.error(function(res){
			login_company(data);
		})
	}

	function login_company(data)
	{
		$.post(site_url('company/process/authentication'), data)
		.done(function(response){
				
				response = JSON.parse(response);


				if(response.is_auth == true)
				{
					// SET COOKIE
					Cookies.set('authentication', response);

					swal('Login berhasil','Akses diterima. Selamat datang '+response.data.username, 'success')
					var url = (URL.get().query.callback)? URL.get().query.callback : URL.get().query['callback=http'];
					if(url)
					{
						window.location.replace(url)
					}else {					
						window.location.href = site_url('company/dashboard');
					}
				}else
				{
					swal('Login gagal','Akses ditolak. password atau username tidak cocok ', 'error')
				}
			})
		.error(function(res){
			console.log(res, 'error company');
				// swal('Kesalahan sistem','Mohon maaf terdapat kesalahan pada sistem kami. silahkan tanyakan pada admin LSBBKKP untuk keterangan lebih lanjut!', 'error')
				login_auditor(data);
			})
	}

	function login_auditor(data)
	{
		$.post(site_url('auditor/get_login_status'), data)
		.done(function(e){
			console.log(e)
			e = JSON.parse(e);
			

			if(e.is_auth)
			{
				// SET COOKIE
				Cookies.set('authentication', e);
				
				swal('Login berhasil','Akses diterima. Mengalihkan halaman silahkan tunggu!','success')
				Snackbar.manual({message:'Selamat datang '+e.data.username+'. Mengalihkan halaman anda menuju auditor panel!'});
				setTimeout(function(){
					window.location.href = site_url('auditor/panel');
				},2000)
			}else
			{
				swal('kesalahan login', 'password dan username yang anda masukkan tidak cocok!', 'error');
			}
		})
		.fail(function(e){
			swal('kesalahan login', 'terdapat kesalahan pada server. silahkan reload halaman ini!', 'error')
			console.log(e)
		})
	}
</script>