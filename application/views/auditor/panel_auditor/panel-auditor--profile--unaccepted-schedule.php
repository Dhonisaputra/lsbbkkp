<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>


<div class="form-group">
	<a href="<?php echo site_url('auditor/panel/profile/'.$auditor['id_auditor']) ?>" class="mdl-button mdl-js-button">
		<i class="material-icons">chevron_left</i> Kembali ke panel
	</a>
	<a href="<?php echo site_url('auditor/panel/calendar/'.$auditor['id_auditor']) ?>" class="mdl-button mdl-js-button btn-primary" > <i class="material-icons">today</i> Kalender </a>
</div>

<table class="table table-hover table-bordered table-stripped" id="table-unaccepted-schedule">
	<thead>
		<tr>
			<th>Perusahaan</th>
			<th>Type</th>
			<th>Tanggal dimulai</th>
			<th>Tanggal selesai</th>
			<th>action</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

<script type="text/javascript">
	function confirmSchedule(ui, status)
	{
		var $this = $(ui),
			$row = $this.closest('tr'),
			$data = window.table_unaccepted_schedule.row($row).data()

		$.post(site_url('auditor/auditor_log_schedule_confirm'), {auditor_log_id: $data.auditor_log_id, confirmation: status} )
		.done(function(res){
			console.log(res)
			Snackbar.show('Memuat ulang data yang belum dikonfirmasi')
			window['table_unaccepted_schedule'].ajax.reload();
			switch(status)
			{
				case 1:
					Snackbar.show('Anda telah menyetujui suatu jadwal. konfirmasi tersimpan.')
					break;
				case -1:
					Snackbar.show('Anda menolak jadwal ini. konfirmasi tersimpan.')
					break;
			}
		})
		.fail(function(res){
			console.log(res)
			swal('kesalahan saat menyimpan konfirmasi', 'terdapat kesalahan dalam menyimpan konfirmasi. Silahkan reload halaman ini lalu ulangi konfirmasi.', 'error')
		})
		
	}

	window['table_unaccepted_schedule'] = $('#table-unaccepted-schedule').DataTable({
		ajax: {
			url: site_url('auditor/get_unaccepted_schedule_auditor'),
			"type": "POST",
			data: function(d){
				var data = $.extend({}, d, {id_auditor: <?php echo $auditor['id_auditor'] ?>})
				return data;
			},
			dataSrc: function(json){
				json = (json.data)? json.data : json;
				if(json.length < 1) return false;

				$.each(json, function(a,b){
					json[a]['action'] = '<button class="mdl-button mdl-js-button btn-primary mdl-button--icon" onclick="confirmSchedule(this, 1)"> <i class="material-icons">done</i> </button> <button class="mdl-button mdl-js-button btn-danger mdl-button--icon" onclick="confirmSchedule(this, -1)"> <i class="material-icons">clear</i> </button>'
				})
				console.log(json)
				json = json.filter(function(res){
					return res.schedule_confirm == 0;
					Snackbar.show('Data jadwal yang belum anda konfirmasi selesai dimuat')
				})
				return json;
			}
		},
		columns: [
            {data: 'company_name'},
            {data: 'assessment_type'},
            {data: 'audit_start'},
            {data: 'audit_end'},
            {data: 'action'},
        ],
	});
</script>