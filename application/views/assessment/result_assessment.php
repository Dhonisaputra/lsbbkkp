<style type="text/css">
	p
	{
		word-break: break-word;
		word-wrap: break-word;
	}
</style>

<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col" style="word-break: break-word;word-wrap: break-word;">
	<h3 class="text-center">perusahaan <?php echo $_POST['company_name'] ?></h3>
	<hr>
	<div class="mdl-grid">
		<p> Pada 2016-05-16, perusahaan <?php echo $_POST['company_name'] ?> meminta LSBBKKP-YOQA untuk mensertifikasi bagian-bagian berikut : </p>
		<div class="tab"></div>	
	</div>

</div>


<script type="text/javascript">
		
	function status__change(event, id_a0_cat, type)
	{
		$.post(site_url('certification/create_certificate'), { 'new_status': $(event.target).val(), 'type': type, 'id_a0_cat': id_a0_cat })
		.done(function(res){
			$(event.target).parents('.parent--tab').remove();
			window.tableAssessment1.ajax.reload();
		})
	}

	$.post(site_url('certification/datatable__assessment_progress'))
	.done(function(res){
		res = JSON.parse(res);
		res = res.filter(function(e){ return e.id_a0 == '<?php echo $_POST["id_a0"] ?>' })
		console.log(res)
		$.each(res, function(a,b){

			var is_success = (b.status == 'success')? 'selected' : '';
			var is_fail = (b.status == 'fail')? 'selected' : '';
			var is_progress = (b.status == 'progress')? 'selected' : '';
			// =====================
			var panel = '<div class="panel panel-default" type="button" data-toggle="collapse" data-target="#collapseCertification-'+b.id_a0_cat+'" aria-expanded="false" aria-controls="collapseCertification-'+b.id_a0_cat+'"> <div class="panel-heading">Certifiction '+b.type+'</div> <div class="panel-body"> ';
			
			var options = ' <select name="new_status" onchange="status__change(event, '+b.id_a0_cat+', \''+b.type+'\')"> <option value="progress" '+is_progress+'>Progress</option> <option value="success" '+is_success+'>success</option> <option value="fail" '+is_fail+'>fail</option> </select>';

			options = (b.assessment_date)? options : '<span class="text-danger"> not update assessment date yet. </span>'

			var tab = '<div class="collapse" id="collapseCertification-'+b.id_a0_cat+'"><div class="well"> <ul> </ul> '+options+'</div>  </div>';

			panel += tab+'</div> </div>'
			$('.tab').append('<div class="col-md-12 parent--tab">'+panel+'</div>');
			// =====================

			$.post(site_url('certification/get_data_a0_cat/'+b.id_a0_cat), {type: b.type})
			.done(function(res){
				res = JSON.parse(res);
				$.each(res, function(c,d){
					var name = (d.brand_name)?d.brand_name:d.commodity_name;
					var li = '<li>'+name+'</li>';
					$('#collapseCertification-'+b.id_a0_cat).find('ul').append(li)

				})
			})
		})

	})
</script>