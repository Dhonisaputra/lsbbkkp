<div class="row" style="margin-top: 20px;">
	
	<div class="col-md-12" id="detail_request">
		
		<div class="audit-days-container flex" style="flex-direction: column; justify-content: space-between;">
			
			<p class="padding-10 flex flex-distributed">
				<strong style="font-size: 30px;">Jumlah waktu audit : </strong> &nbsp;<span style="font-size: 30px; padding-left: 10px;" class="audit_time">-</span>
			</p>
			<p class="padding-10 flex flex-distributed">
				<strong style="font-size: 30px;">Jumlah auditor : </strong> &nbsp;<span style="font-size: 30px; padding-left: 10px;" class="audit_auditor">-</span>
			</p>
		</div>
		<hr>
		<div class="configure_audit_days">
			<div class="form-group">
				<label>Resiko</label>
				<div class="radio">
					<label>
						<input type="radio" name="risk" value="High"> High
					</label>
				</div>

				<div class="radio">
					<label>
						<input type="radio" name="risk" value="Medium"> Medium
					</label>
				</div>

				<div class="radio">
					<label>
						<input type="radio" name="risk" value="Low"> Low
					</label>
				</div>
			</div> <!-- end of form group -->
			<div class="form-group">
				<button class="btn mdl-button mdl-js-button btn-primary" onclick="configure_audit_days(event)">
					<i class="material-icons">done</i> Hitung Hari Audit
				</button>
			</div>
		</div>
	</div> <!-- end of col-md-9 -->

</div>

<script type="text/javascript">
	

	function configure_audit_days(event)
	{
		event.preventDefault();
		var $risk = $('[name="risk"]:checked').val(),
			$id_a0 = <?php echo $id_a0 ?>

		Snackbar.manual({message: 'Sedang menghitung hari audit', spinner: true });

		$.post(site_url('assessment/AJAX_audit_time_configuration'), {id_a0: $id_a0, risk: $risk})
		.done(function(res){
			Snackbar.show('Penghitungan hari audit selesai')
			res = JSON.parse(res);

			$('.audit_time').text(res.detail.audit_time)
			$('.audit_auditor').text(res.detail.fixed_auditor)

			// focus on id
			// window.location.replace(URL.get().access_url+'#result_configuration_audit_days')
		})
		.fail(function(res){
			Snackbar.show('Penghitungan hari audit gagal. Silahkan check koneksi internet anda!')
			console.log(res)
		})
	}

</script>