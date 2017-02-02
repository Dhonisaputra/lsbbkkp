<?php echo $this->load->component('js', 'js/zebra_datepicker/javascript/zebra_datepicker.js') ?>
<?php echo $this->load->component('css', 'js/zebra_datepicker/css/default.css') ?>

<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">

    
    <div class="btn-group" role="group" aria-label="...">
        <!-- Icon button -->
		<a href="#profile-company--home" role="tab" data-toggle="tab" class="back-tab-button--assessment-date mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back(2)">
			<i class="material-icons">keyboard_backspace</i>
		</a>
		<a class="btn-confirm mdl-button mdl-js-button mdl-button--raised mdl-button--colored" target="_blank">
			confirm assessment
		</a>

    </div>

</div>

<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">	
	<form class="mdl-cell mdl-cell--12-col" id="formEditAssessment" type="post" action="<?php echo site_url('assessment/process/update/confirmation/date') ?>" onsubmit="update_edit_assessment_date(event)">
		<div class="form-group">
			<input name="id_a0" id="id_a0" class="form-control input" type="hidden">
			
			<label>Assessment Date</label>
			<div class="row">
				<div class="col-md-6">
					<input name="assessment_date" id="assessment_date" class="form-control input" type="date" readonly>
				</div>
				<div class="col-md-3" style="border-left: 1px solid #e3e3e3; padding:0px;">
					<button class="mdl-button mdl-js-button mdl-button--icon" type="button" onclick="edit_input_assessment_date(event)"> <i class="material-icons">mode_edit</i> </button>
				</div>
			</div>
		</div>

		<!-- Colored raised button -->
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">
			Update Assessment
		</button>


	</form>
</div>


<!-- SNACKBAR -->

<div id="snackbar--edit-assessment" class="mdl-js-snackbar mdl-snackbar">
  	<div class="mdl-snackbar__text"></div>
  	<button class="mdl-snackbar__action" type="button"></button>
</div>


<script type="text/javascript">
	function fetch_data_assessment()
	{
		$.post( site_url('company/get_certification_company/<?php echo $company["id_company"] ?>') )
		.done(function(res){
			res = JSON.parse(res)[0];
			var confirmLink = encodeURI( res.token.replace('$2y$11$','').replace('/','||') );
			console.log(res);

			$('.btn-confirm').attr('href', site_url( 'assessment/confirmation/'+res.id_a0+'/'+confirmLink ) );

			$.each(res, function(a,b){
				if(b){ $('.input#'+a).val(b) }
			})
		})
	}


	function edit_input_assessment_date(event)
	{
		$('input[name="assessment_date"]').prop('readonly',false).Zebra_DatePicker({
			direction: 1
		}).trigger('click');
	}

	function update_edit_assessment_date(event)
	{
		event.preventDefault();
		var snackbarContainer = document.querySelector('#snackbar--edit-assessment');

		var data = $(event.target).serializeArray(), action = $(event.target).attr('action');

		$.post(action, data)
		.done(function(response){
			response = JSON.parse(response);

			if(response.success)
			{

				var data = {message: 'Perbaruan tanggal assessment berhasil'};
		    	snackbarContainer.MaterialSnackbar.showSnackbar(data);

		    	$('.back-tab-button--assessment-date').trigger('click');

		    	window.assessmentTable.ajax.reload();

				// window.location.reload();
			}else
			{
				alert('sorry. there are error on confirmation. please reload this page. if there are other error appeared, please contact our administrator');
			}
		})
		// console.log(data);
	}

	$(function(){
	})

</script>