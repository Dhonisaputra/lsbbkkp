<style type="text/css">
	p
	{
		word-break: break-word;
		word-wrap: break-word;
	}
</style>

<div class="panel panel-default">
	<div class="panel-body" style="word-break: break-word;word-wrap: break-word;">
		<h3 class="text-center">perusahaan <?php echo $_POST['company_name'] ?></h3>
		<hr>
		<div class="col-md-12">
			<p> Pada 2016-05-16, perusahaan <?php echo $_POST['company_name'] ?> mendaftarkan sertifikasi sebagai berikut : </p>
			<div class="certification-request--list"></div>	
		</div>
	</div>
</div>

<script type="text/javascript">
		
	function status__change(event, id_a0_cat, type)
	{

		var parents = $(event.target).parents('li.list-group-item'),
			explanation = $('#explanation-fail-'+id_a0_cat).length > 0 ? $('#explanation-fail-'+id_a0_cat).val() : '';
			status = $('input[type="radio"][name="new_status_'+id_a0_cat+'"]').val();
			
		if(status !== 'fail')
		{
			$.post(site_url('certification/create_certificate'), { 'new_status': status, 'explanation': explanation, 'type': type, 'id_a0_cat': id_a0_cat })
			.done(function(res){
				$(event.target).parents('.parent--tab').remove();

				window.assignedassessment.ajax.reload();
				window.conductedassessment.ajax.reload();
				window.waitingresult.ajax.reload();
			})
		}else
		{

		}
	}

	function fail(ui,id_a0_cat)
	{
		var parents = $(ui).parents('li.list-group-item'),
			thisparent = $(ui).parents('div.radio');
		console.log(thisparent, $('#fail-'+id_a0_cat));
		if($('#explanation-fail-'+id_a0_cat).length < 1)
		{
			$(thisparent).after('<div class="form-group box-explain-fail-'+id_a0_cat+'"> <textarea name="explanation-fail-'+id_a0_cat+'" id="explanation-fail-'+id_a0_cat+'" class="form-control" placeholder="Lampiran status"></textarea></div>')
		}

	}

	function status_success(id_a0_cat)
	{
		$('.box-explain-fail-'+id_a0_cat).remove()
	}

	$.post(site_url('certification/datatable__assessment_progress'))
	.done(function(res){
		res = JSON.parse(res);
		res = res.filter(function(e){ return e.id_a0 == '<?php echo $_POST["id_a0"] ?>' })

		var panel = '<div class="panel panel-default parent--tab"> <div class="panel-heading" data-toggle="collapse" data-target="#collapseCertification-::id_a0_cat::" aria-expanded="false" aria-controls="collapseCertification-::id_a0_cat::" style="cursor:pointer;">Certifiction ::type:: </div> <div class="panel-body panel-body-::id_a0_cat:: collapse" id="collapseCertification-::id_a0_cat::"> <ul class="list-group"></ul> </div> </div>';
		Tools.write_data({
			records: res,
			template: panel,
			target: $('.certification-request--list'),
			success: function(event, ui, data)
			{
				 $.post(site_url('assessment/get__a0_cat_details'),{id_a0_cat: data.id_a0_cat})
				.done(function(response){
					response = JSON.parse(response);

					// var options = ' <select name="new_status" onchange="status__change(event, ::id_a0_cat::, \'::type::\')"> <option value="progress">Progress</option> <option value="success">success</option> <option value="fail">fail</option> </select>';
					
					Tools.write_data({
						records: response,
						template: '<li class="list-group-item"><span>::name::</span> <hr> <div>Komodity: ::commodity_name::</div> <div>Brand: ::brand_name::</div> </li>',
						target: $(ui).find('ul')
					}).done(function(response){
						var data = $(response.ui).data();
						$(response.ui).parents('.list-group').append('<div class="radio"><label><input type="radio" name="new_status_'+data.id_a0_cat+'" value="success" onclick="status_success('+data.id_a0_cat+')">success</label></div> <div class="radio"><label><input type="radio" name="new_status_'+data.id_a0_cat+'" value="fail" onclick="fail(this,'+data.id_a0_cat+')">Fail</label></div> <div class="form-group"><button class="mdl-button mdl-js-button btn btn-primary" onclick="status__change(event, '+data.id_a0_cat+', \''+data.type+'\')">Update</button></div>');
					})
				})
			}
		})
	})
</script>