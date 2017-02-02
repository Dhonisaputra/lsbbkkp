<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<div class="form-group">
	<a href="<?php echo site_url('faq/new') ?>" class="btn btn-primary"> Tambah baru </a>
</div>
<table class="table table-bordered table-hovered table-stripped">
	<thead>
		<tr>
			<th>No. </th>
			<th>Judul</th>
			<th>aksi</th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>
<script type="text/javascript">
	$('.table').DataTable({
		ajax:
		{
			url: site_url('users/process/get/faqs'),
			dataSrc: function(json)
			{
				if(json.length < 1) return false;
				var i = 1;
				$.each(json, function(a,b){
					json[a]['no'] = i;
					json[a]['action'] = '<a href="'+site_url('faq/open/'+b.id_faq)+'" class="btn btn-primary btn-xs"> Lihat </a> '
					json[a]['action'] += '<a href="'+site_url('faq/edit/'+b.id_faq)+'" class="btn btn-warning btn-xs"> edit </a> '
					i++;
				})
				return json;
			}
		},
		columns: [
			{data: 'no'},
			{data: 'faq_title'},
			{data: 'action'},
		]
	})
</script>