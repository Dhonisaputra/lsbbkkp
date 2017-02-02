<!-- 
<?php echo $this->load->component('js', 'js/zebra_datepicker/javascript/zebra_datepicker.js') ?>
<?php echo $this->load->component('css', 'js/zebra_datepicker/css/default.css') ?> 
-->

<?php echo $this->load->component('js', 'plugins/foundation_datepicker/js/foundation-datepicker.min.js') ?>
<?php echo $this->load->component('css', 'plugins/foundation_datepicker/css/foundation-datepicker.min.css') ?> 


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

	
		<div class="container">
			<div class="col-md-7 col-md-offset-3">
				<div class="alert alert-info"> <span class="material-icons material-icons--middle">info</span> Silahkan isi tanggal dibawah untuk konfirmasi jadwal!</div>
				<div class="alert alert-warning"> <span class="material-icons material-icons--middle">warning</span> Anda hanya dapat mengisi tanggal ini 1 kali. Setelah anda pilih submit, tautan ini tidak dapat digunakan lagi!</div>
				<form type="post" action="<?php echo site_url('assessment/process/confirmation/date') ?>" id="formsubmitAssessment">
					<input type="hidden" name="action" value="assessment_date">
					<input type="hidden" name="id_company" value="<?php echo $assessment['id_company']; ?>">
					<input type="hidden" name="token" value="<?php echo $assessment['token']; ?>">
					<input type="hidden" name="id_a0" value="<?php echo $assessment['id_a0']; ?>">

					<div class="form-group">
						<label>Date</label>
						<div class="input-group">
					      	<span class="input-group-addon material-icons"> date_range </span>
							<input type="text" class="form-control" name="assessment_date" placeholder="assessment date" required readonly>
					    </div><!-- /input-group -->
					</div>
					
					<div id="renderCaptcha"></div>
					
					<button class="mdl-button mdl-js-button mdl-button--raised flat btn btn-primary" type="submit" id="" >Konfirmasikan tanggal assessment</button>
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

			/*$('input[name="assessment_date"]').Zebra_DatePicker({
				direction: 1
			});*/
			var nowTemp = new Date();
			var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
			var checkin = $('input[name="assessment_date"]').fdatepicker({
				leftArrow: '<i class="material-icons">keyboard_arrow_left</i>',
				rightArrow: '<i class="material-icons">keyboard_arrow_right</i>',
				format: 'yyyy-mm-dd',
				onRender: function (date) {
					return date.valueOf() < now.valueOf() ? 'disabled' : '';
				}
			})

			
			$('#formsubmitAssessment').on('submit', function(event){
				event.preventDefault();
				var data = $(this).serializeArray(), 
					action = $(this).attr('action');
					
				var assessment_date = $(this).serializeArray().filter(function(res){
					return res.name == 'assessment_date'
				})[0]

				if(assessment_date.value === '')
				{
					swal('Isikan tanggal assessment','Silahkan isi tanggal dilaksanakan assessment! Tanggal assessment tidak boleh dibiarkan kosong', 'error');
					return false;
				}

				swal({
					'title': 'Menyimpan tanggal assessment',
					'text': 'Aksi ini akan menyimpan tanggal assessment untuk jadwal ini. Silahkan cek apakah tanggal yang anda isikan sudah benar karena halaman ini tidak dapat diakses kembali setelah tanggal diupdate.',
					type: 'warning',
					showCancelButton: true,
					closeOnCancel: true,
					closeOnConfirm: false
				}, function(res){
					if(res)
					{

						var url = get_uri();
			
						// if(grecaptcha.getResponse() == '')
						// {
						// 	alert('please check the Captcha!');
						// 	return false;
						// }


						$.post(action, data)
						.done(function(response){
							response = JSON.parse(response);
							if(response.success)
							{
								window.location.reload();
							}else
							{
								alert('Ada kesalahan saat konfirmasi tanggal assessment. mohon load ulang halaman. jika masih kesalahan, silahkan laporkan pada administrator');
							}
						})
						.error(function(res){
							swal('Ada kesalahan saat konfirmasi tanggal assessment', 'Ada kesalahan saat konfirmasi tanggal assessment. mohon load ulang halaman. jika masih kesalahan, silahkan laporkan pada administrator');
						})

					} /*end of res*/
				})

				// console.log(data);

			})
		})
	</script>