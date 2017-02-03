<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>
<div class="container" style="margin-top: 50px;">
	
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
</div>

	<script type="text/javascript">
		function remove_faq(id_faq)
		{
			$.post(site_url('users/process/remove/faq'), {id_faq: id_faq})
			.done(function(){
				window.faqList.ajax.reload();
			})
		}

		window.faqList = $('.table').DataTable({
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
						if(parseInt(cookie.level) == 1)
						{
							json[a]['action'] += '<a href="'+site_url('faq/edit/'+b.id_faq)+'" class="btn btn-warning btn-xs"> edit </a> '
							json[a]['action'] += '<button onclick="remove_faq('+b.id_faq+')" class="btn btn-danger btn-xs"> Hapus </button> '
						}
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
