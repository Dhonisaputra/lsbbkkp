
<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>
<a class="btn btn-primary" role="button" data-toggle="collapse" href="#form-new-document" aria-expanded="false" aria-controls="collapseExample">
  Tambah data baru
</a>
<fieldset id="form-new-document" class="collapse">
	<legend>Dokumen baru</legend>
	<section class="form-column">
		<form onsubmit="submitNewDocumentList(event)">
			<div class="form-group">
				<label>Nama dokumen</label>
				<input type="text" name="nama_dokumen" class="form-control" placeholder="Nama dokumen">
			</div>
			
			<div class="form-group">
				<label>Deskripsi dokumen </label>
				<textarea class="form-control" name="deskripsi_dokumen"></textarea>
			</div>
			
			<div class="">
				<div class="form-group">
					<label>Dokumen diperuntukan : </label>
					<div class="radio">
						<label> <input type="radio" name="diperuntukan" value="perusahaan"> Perusahaan </label>
					</div>
					<div class="radio">
						<label> <input type="radio" name="diperuntukan" value="lsbbkkp"> LSBBKKP </label>
					</div>
				</div>
			</div>

			<div class="">
				<div class="form-group">
					<label>Apakah harus diisi? </label>
					<div class="radio">
						<label> <input type="radio" name="is_important" value="1"> ya </label>
					</div>
					<div class="radio">
						<label> <input type="radio" name="is_important" value="0"> tidak </label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<button class="btn btn-primary"> Simpan </button>
			</div>
		</form>
	</section>
</fieldset>
<hr>
<section class="list-column">
	<table id="table--dokumen-list" class="table table-bordered table-hovered table-stripped ">
		<thead>
			<tr>
				<th>Nama dokumen</th>
				<th>Harus diisi</th>
				<th>Dokumen untuk</th>
				<th>Aksi</th>
			</tr>
		</thead>
	</table>
</section>

<script type="text/javascript">
	function submitNewDocumentList(e)
	{
		e.preventDefault();
		var data = $(e.target).serializeArray();
		$.post(site_url('certification/insert_master_requirement_data_kelengkapan_dokumen'), data)
		.done(function(res){
			console.log(res)
			window.tableDocumentList.ajax.reload();
			e.target.reset();
			$('#form-new-document').collapse('hide')
		})

	}
	function removeKelengkapanDokumen(id)
	{
		swal({
			title: 'Menghapus data kelengkapan dokumen?',
			text: 'Apakah anda yakin ingin menghapus kelengkapan dokumen?',
			usingEscapeKey: false,
			showCancelButton: true,
		}, function(confirm){
			if(confirm)
			{

				Snackbar.manual({message: 'Menghapus data', spinner: true})

				$.post(site_url('certification/remove_data_requirement_kelengkapan_dokumen'), {id_master_kelengkapan_permintaan: id})
				.done(function(res){
					
					window.tableDocumentList.ajax.reload();
					Snackbar.show('Data telah dihapus')
				})
				
			}
		})
	}
	$(function(){
		window.tableDocumentList = $('#table--dokumen-list').DataTable({
			sort: false,
			ajax: 
			{
				url: site_url('certification/get_master_requirement_kelengkapan_dokumen'),
				dataSrc: function(json){
					if(json.length < 1) return false;
					$.each(json, function(a,b){
						json[a]['harus_diisi'] = (b.is_important == 0)? 'Tidak' : 'Ya'; 
						json[a]['action'] = '<button class="btn btn-danger btn-sm" onclick="removeKelengkapanDokumen('+b.id_master_kelengkapan_permintaan+')"> remove </button>'; 
					})
					return json;
				}
			},
			columns: [
				{data: 'nama_dokumen'},
				{data: 'harus_diisi'},
				{data: 'peruntukan'},
				{data: 'action'},
			]
		});
	})
</script>