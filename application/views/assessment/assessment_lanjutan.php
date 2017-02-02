
<?php echo $this->load->component('js', 'js/zebra_datepicker/javascript/zebra_datepicker.js') ?>
<?php echo $this->load->component('css', 'js/zebra_datepicker/css/default.css') ?>

<style type="text/css">
	.need_authentication
	{
	    display: flex;
	    align-items: center;
	    justify-content: center;
	    height: 100%;
	}
</style>
	<!-- <script src='https://www.google.com/recaptcha/api.js?onload=renderCaptcha&render=explicit' async defer></script> -->
	
<div class="need_authentication authentic">
	
		<!-- <div class="need_authentication unauthentic">
			<div>Sorry, system didn't recognize you. please check your link. or please call our costumer service!</div>
		</div> -->

	
		<div class="col-md-6">
			<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
				<div class="alert alert-info">Silahkan isikan tanggal dibawah ini. anda hanya dapat mengisi tanggal ini satu kali.!</div>
				<form type="post" action="<?php echo site_url('assessment/process/confirmation/assessment/lanjutan/date') ?>" id="formsubmitAssessment">
					<input type="hidden" name="action" value="assessment_date">
					<input type="hidden" name="token" value="<?php echo $assessment['token']; ?>">
					<input type="hidden" name="id_rs" value="<?php echo $assessment['id_rs']; ?>">

					<div class="form-group">
						<label>Date</label>
						<input type="date" class="form-control" name="assessment_date" placeholder="assessment date" required>
					</div>
					
					<div id="renderCaptcha"></div>
					
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" id="" >Simpan Tanggal</button>
				</form>
			</div>
		</div>

	
</div>

<script type="text/javascript">
		var renderCaptcha = function() {
	        grecaptcha.render('renderCaptcha', {
	          'sitekey' : '6LdNYR0TAAAAAHJqMCNlVzDpZHWrit6wEYHHIyPE'
	        });
	      };

		function get_uri()
		{
			var parts = window.location.search.substr(1).split("&");
			var $_GET = {};
			for (var i = 0; i < parts.length; i++) {
			    var temp = parts[i].split("=");
			    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
			}
			return $_GET;
		}

		function getCaptchaResponse()
		{
			var def = $.Deferred();

			window.setTimeout(function(){

				def.resolve( grecaptcha.getResponse() );
			},10000)

			return def.promise();
		}
		

		$(function(){

			$('input[name="assessment_date"]').Zebra_DatePicker({
				direction: [new Date().toJSON().slice(0,10), '<?php echo $assessment["deadline_date"] ?>']
			});

			
			$('#formsubmitAssessment').on('submit', function(event){
				event.preventDefault();
				var url = get_uri();
	
				// if(grecaptcha.getResponse() == '')
				// {
				// 	alert('please check the Captcha!');
				// 	return false;
				// }

				var data = $(this).serializeArray(), action = $(this).attr('action');

				$.post(action, data)
				.done(function(response){
					response = JSON.parse(response);

					if(response.success)
					{
						window.location.reload();
					}else
					{
						alert('sorry. there are error on confirmation. please reload this page. if there are other error appeared, please contact our administrator');
					}
				})
				// console.log(data);

			})
		})
	</script>