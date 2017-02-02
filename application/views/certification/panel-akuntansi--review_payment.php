
<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>
<?php echo $this->load->component('js', 'js/library.notification.js') ?>


<div class="container-fluid">
	<form class="form-inline row" onsubmit="filteringTablePayment(event)">
		<div class="form-group col-lg-7">
			<input type="search" name="search_payment_company" class="form-control" placeholder="masukkan nama perusahaan" style="width:100%;" data-toggle="tooltip" title="Isikan pencarian" data-trigger="focus" data-placement="bottom">
		</div>
		<div class="form-group">
			<button class="btn-primary btn-sm btn" type="submit"> Cari </button>
		</div>
		<div class="form-group">
			<button class="btn-warning btn-sm btn" type="reset" onclick="resetFiltering()"> clear </button>
		</div>
	</form>
	<dir class="table-responsive no-padding">
		<table class="table table-bordered table-hover table-stripped" id="table--review-payment">
			<thead>
				<tr>
					<th class="col-md-2">Perusahaan</th>
					<th class="col-md-1">Permintaan</th>
					<th class="col-md-1">Permintaan masuk</th>
					<th class="col-md-2">tanggal assessment</th>
					<th class="col-md-1">upload nota?</th>
					<th class="col-md-1">Status pembayaran</th>
					<th class="col-md-4">Aksi</th>
				</tr>
			</thead>
		</table>

	</dir>
</div>
<script type="text/javascript">
	function resetFiltering()
	{
		window.setTimeout(function() {
			window.review_payment.ajax.reload();
		}, 500);
	}
	function filteringTablePayment(e)
	{
		e.preventDefault();
		Snackbar.manual({message: 'mencari data', spinner: true})
		
		window.review_payment.ajax.reload(function(){
			Snackbar.show('Pencarian data selesai')
		});
	}
	function konfirmasiPembayaran(id_invoice, pay_status, already_paid, amount_paid, other)
	{
		var deff = $.Deferred();
		var tr = $('#table--review-payment').find('#btn-see-'+id_invoice).closest('tr');
		var data = window.review_payment.row(tr).data();
		var notes = other && other.notes? other.notes : '';
		
		$.post(site_url('certification/konfirmasi_bukti_pembayaran'), {update: {already_paid: already_paid, status_paid: pay_status}, where: {id_invoice: id_invoice} })

		.done(function(res){
			swal.close();
			window.review_payment.ajax.reload();
			Snackbar.show('Data telah diperbarui')
			switch(pay_status)
			{
				case '-1':
	            	Notify.send({notification_for_level: data.company_level, notification_for_user: data.id_company, notification_text: 'Pembayaran anda ditolak oleh LSBBKKP'})
					$.post(site_url('certification/update_a0_notes'), {id_a0: data.id_a0, subject: 'Pembayaran anda ditolak', notes: notes} )
                   	window.notif.send('update/tracker/catatan')
					
					break;
				case '-2':
					var kekurangan = amount_paid - already_paid;
	            	Notify.send({notification_for_level: data.company_level, notification_for_user: data.id_company, notification_text: 'Pembayaran anda kurang '+kekurangan+' Rupiah'})
                   	window.notif.send('update/tracker/catatan')
					
					break;
				case '1':
	            	Notify.send({notification_for_level: data.company_level, notification_for_user: data.id_company, notification_text: 'Pembayaran anda telah diterima oleh LSBBKKP'})
					break;
			}
/*			if(pay_status < 0)
			{
	            Notify.send({notification_for_level: data.company_level, notification_for_user: data.id_company, notification_text: 'Pembayaran anda ditolak oleh LSBBKKP'})
			}else if(pay_status > 0)
			{
	            Notify.send({notification_for_level: data.company_level, notification_for_user: data.id_company, notification_text: 'Pembayaran anda telah diterima oleh LSBBKKP'})

			}*/
			deff.resolve(data, res);
		})

		return $.when( deff.promise() );
	}

	function openDetailInvoice(id_a0)
	{
		Tools.popupCenter(site_url('certification/detail_invoice/'+id_a0))
	}


	$(document).ready(function(){

		window.review_payment = $('#table--review-payment').DataTable({
			"processing": true,
			ajax: 
			{
				url: site_url('certification/get_payment_requested_assessment'),
				type: 'POST',
				data: function(d){
					return $('[name="search_payment_company"]').serializeArray()
				},
				dataSrc: function(json)
				{
					$.each(json, function(a,b){
						// TOMBOL KONFIRMASI PEMBAYARAN DISETUJUI
						var OK_confirm	= 'onclick="konfirmasiPembayaran('+b.id_invoice+',1)"';
						var btn_OK 	= (b.status_paid < 1 && !moment(moment().format('Y-M-d')).isAfter(b.assessment_date) )? '<button class="btn btn-primary btn-xs" '+OK_confirm+'> Terima </button>' : '';
						// TOMBOL KONFIRMASI PEMBAYARAN DITOLAK
						var NO_confirm	= 'onclick="konfirmasiPembayaran('+b.id_invoice+',-1)"';
						var btn_NO 	= (b.status_paid > -1 && !moment(moment().format('Y-M-d')).isAfter(b.assessment_date))? '<button id="btn-see-'+b.id_invoice+'" class="btn btn-danger btn-xs" '+NO_confirm+'> Tolak </button>' : '';

						// TOMBOL DETAIL
						var btn_detail 	= '<button class="btn btn-primary btn-xs" id="btn-see-'+b.id_invoice+'" onclick="openDetailInvoice('+b.id_a0+')"> <i class="glyphicon glyphicon-info-sign"></i> Konfirmasi </button>'

						
						json[a]['action'] 	=  btn_detail
						json[a]['permintaan_masuk'] = moment(b.a0_added_on).format('DD MMM YYYY');    
						json[a]['do_assessment'] 	= moment(b.assessment_date).isValid() ? moment(b.assessment_date).format('DD MMM YYYY') : 'belum ditentukan';    
						json[a]['isUpload'] = b.jumlah_nota < 1 ? 'belum' : 'sudah <i class="icon-active pull-right material-icons">check_circle</i>'
						

						var isConfirm = b.status_paid == '0' ? 'Belum disetujui' : 'Diterima';
						isConfirm = b.status_paid == '-1' ? 'Pembayaran Ditolak' : isConfirm;
						json[a]['isConfirm'] = b.status_paid == '-2' ? 'Pembayaran Kurang' : isConfirm;
					})
					return json;
				}
			},
			columns: [
				{data: 'company_name'},
				{data: 'permintaan'},
				{data: 'permintaan_masuk'},
				{data: 'do_assessment'},
				{data: 'isUpload'},
				{data: 'isConfirm'},
				{data: 'action'},
			],
			createdRow: function ( row, data, index ) {
				console.log(data)
				switch(data.status_paid)
				{
					case '-1': 
					case '-2': 
	                	$(row).addClass('alert alert-warning');
						break;
					case '0': 
	                	$(row).addClass('alert alert-danger');
						break;
					case '1': 
	                	$(row).addClass('alert alert-success');
						break;
				}
	        }
		});

		

		// SHORTCUT
		// register the handler 
		$(document).on('keydown', function(event){
		    if (event.ctrlKey && event.keyCode == 70) {
				event.preventDefault();
		        // call your function to do the thing
		        $('[name="search_payment_company"]').focus()
		    }
		})

		notif.listen('update/akuntansi/pembayaran', function(data){
			window.review_payment.ajax.reload();
        })  
	})
</script>