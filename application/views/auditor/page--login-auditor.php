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
			<i class="material-icons material-icon-preview">account_circle</i>
			
		  	<div class="mdl-card__supporting-text">
		  	</div>
		  	<div class="mdl-card__actions mdl-card--border">
		    	<form action="<?php echo site_url('auditor/get_login_status') ?>" type="post" onsubmit="login(event)" class="ui form" autocomplete="off">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username" required name="username" autocomplete="off">
					
						<input type="password" class="form-control" placeholder="password" required name="password" autocomplete="off">
					</div>

					<button class="btn btn-primary btn-block flat mdl-button mdl-js-button" type="submit">Masuk</button>
				</form>
		  	</div>
		</div>
	</div>

	<script type="text/javascript">
			function login(event)
			{
				event.preventDefault();
				var $this = $(event.target);
				var formData = $this.serializeArray();
				$.post($this.attr('action'), formData)
				.done(function(e){
					console.log(e)
					e = JSON.parse(e);
					if(e.is_auth)
					{
						Snackbar.manual({message:'Selamat datang '+e.data.username+'. Mengalihkan halaman anda menuju auditor panel!'});
						window.location.reload();
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