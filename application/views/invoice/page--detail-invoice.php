
<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<div class="container-fluid">
	<fieldset>
		<legend>Konfirmasi nota</legend>
		<center>
			<p class="narrow text-center">
				<div style=" font-size: 30px; padding: 20px; background-color: beige; color: gray;">
                	<?php echo 'Jumlah yang harus dibayar sebesar Rp '.number_format($invoice['amount_paid'],2,',','.') ?>
				</div>
            </p>
		</center>
		<form onsubmit="confirmInvoice(event)">
			<input type="hidden" name="amount_paid" value="<?php echo $invoice['amount_paid'] ?>">
			<input type="hidden" name="id_invoice" value="<?php echo $invoice['id_invoice'] ?>">
			<div class="form-group">
				<label>Jumlah yang dibayarkan</label>
				<div class="radio">
					<label> <input type="radio" name="status_paid" value="1"> Pembayaran Lunas </label>
				</div>
				<div class="radio">
					<label> <input type="radio" name="status_paid" value="-2" id="invoice-kurang"> Pembayaran Kurang </label>
				</div>
				<div class="radio">
					<label> <input type="radio" name="status_paid" value="-1"> Tolak Pembayaran</label>
				</div>
			</div>
			<div class="form-group sr-only row" id="already_paid">
				<div class="col-md-4">
					<label>Jumlah yang sudah dibayarkan</label>
					<input type="number" name="already_paid" class="form-control input-lg" max="<?php echo $invoice['amount_paid'] ?>" placeholder="Jumlah yang sudah dibayarkan">
				</div>
			</div>

			<div class="form-group sr-only row" id="notes">
				<div class="col-md-4">
					<label>Catatan untuk pembayaran ini.</label>
					<textarea class="form-control notes" name="notes"></textarea>
				</div>
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit" data-status="1"> Konfirmasi </button>
			</div>
		</form>
	</fieldset>
	<fieldset>
		<legend> Nota yang diupload </legend>
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>Nota no.</th>
						<th>File Nota</th>
						<th>Waktu upload</th>
						<th>aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($detail_invoice as $key => $value): ?>
						<tr>
							<td><?php echo 'NLS-'.$value['id_invoice_detail'] ?></td>

							<td> 
								<?php if (strpos($value['file_type'], 'image') !== FALSE ){ ?>
								<img src="<?php echo site_url('application/clients/Companies/'.$a0['id_company'].'/files/'.$value['file_name']) ?>" class="img-responsive thumbnail" style="width:100px;" >
								<?php }else{
									echo 'Tidak ada preview';
								} ?>
							</td>
							<td> <?php echo $value['paid_time'] ?> </td>
							<td> 
								<a href="<?php echo site_url('files/download_file/'.$value['bill']) ?>" class="btn btn-primary btn-sm"> Download </a> 
								<a href="<?php echo site_url('application/clients/Companies/'.$a0['id_company'].'/files/'.$value['file_name']) ?>" target="_blank" class="btn btn-warning btn-sm"> Buka </a> 
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</fieldset>
</div>

<script type="text/javascript">
	function confirmInvoice(e)
	{
		e.preventDefault();
		var id_invoice 		= $('[name="id_invoice"]').val()
		var status_paid 	= $('[name="status_paid"]:checked').val()
		var already_paid 	= $('[name="already_paid"]').val()

		konfirmasiPembayaran(id_invoice, status_paid, already_paid)

	}

	function konfirmasiPembayaran(id_invoice, pay_status, already_paid)
	{
		var notes 		= $('[name="notes"]').val()
		var amount_paid = $('[name="amount_paid"]').val();
		if(pay_status!= 1 && already_paid >= amount_paid )
		{
			swal('Jumlah yang dibayarkan lebih besar atau sama', 'Jumlah yang dibayarkan lebih banyak atau sama dengan jumlah yang seharusnya dibayarkan. Silahkan pilih "Pembayaran Lunas" ', 'error')
			return false;
		}
		pay_status = (!pay_status)? 0 : pay_status;
		swal({
			title: 'Konfirmasi pembayaran',
			text: 'Anda yakin perusahaan ini sudah melakukan pembayaran? anda tidak dapat membatalkan proses yang akan berjalan.',
			type: 'warning',
			allowEscapeKey: false,
			showCancelButton: true,
			closeOnConfirm: false,
		}, function(){
			swal({
				title: 'Memperbarui data',
				allowEscapeKey: false,
				showConfirmButton: false
			})

			data = {notes: notes}

			window.opener.konfirmasiPembayaran(id_invoice, pay_status, already_paid, amount_paid, data)
			.done(function(data, res){
				window.opener['popup'] = res;
				window.close();
				
			})
			/*$.post(site_url('certification/konfirmasi_bukti_pembayaran'), {update: {already_paid: already_paid, status_paid: pay_status}, where: {id_invoice: id_invoice} })
			.done(function(res){
				console.log(res);
				window.opener.review_payment.ajax.reload();
			})*/
		})
	}

	$(document).ready(function(){
		$('[name="status_paid"]').on('change', function(e){
			var val = $('[name="status_paid"]:checked').val();
			var amount_paid = $('[name="amount_paid"]').val();
			
			$('div#already_paid, div#notes').addClass('sr-only')
			$('div#already_paid [name="already_paid"]').val('')
			console.log(val)
			switch(val)
			{
				case -2:
				case '-2':
					$('div#already_paid, div#notes').toggleClass('sr-only')
					break;
				case -1:
				case '-1':
					$('div#notes').toggleClass('sr-only')
					break;
				case 1:
				case '1':
					$('div#already_paid [name="already_paid"]').val(amount_paid)
					break;
			}
/*			if(val < 0)
			{
				if($(e.target).attr('id') == 'invoice-kurang')
				{
				}
			}else{
				$('div#already_paid [name="already_paid"]').val(amount_paid)
			}*/
		})
	})
</script>