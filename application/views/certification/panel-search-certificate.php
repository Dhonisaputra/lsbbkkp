<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<div class="table-responsive">
	<div class="form-group">
		<label>Search</label>
		<input type="search" name="search_cert" id="search_cert" class="form-control">
	</div>
	<table class="table table-stripped table-hovered table-bordered" id="tableSearchCert">
		<thead>
			<tr>
				<th>No sertifikat</th>
				<th>No sertifikat lama</th>
				<th>Perusahaan</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach ($certificate as $key => $value) { 
					$class_status = ($value['certificate_status'] == 'active')? 'text-primary' : 'text-warning';
					$class_status = ($value['certificate_status'] == 'revoke' || $value['certificate_status'] == 'resign' )? 'text-danger' : $class_status;
			?>
				<tr>
					<td><?php  echo $value['id_certificate']; ?></td>
					<td><?php  echo ($value['old_reference'] != '')? $value['old_reference'] : 'tidak ada data'; ?></td>
					<td> <a href="<?php echo site_url('company/'.$value['id_company']) ?>"> <?php  echo $value['company_name']; ?> <i class="material-icons">launch</i> </a> </td>
					<td> <span class="<?php echo $class_status; ?>"> <?php  echo $value['certificate_status']; ?> </span> </td>
					<td> <a href="<?php echo site_url('certification/view/'.$value['certificate_md5'].'/'.$value['id_a0_cat']) ?>" class="mdl-button mdl-js--button" target="_blank"> Detail <i class="material-icons">launch</i> </a> </td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var certTable = $('#tableSearchCert').dataTable();

		$('#search_cert').on('keyup', function(){
      		certTable.search($(this).val()).draw() ;
		})
	})
</script>