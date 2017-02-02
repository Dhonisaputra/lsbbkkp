<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<div class="row">
	<div class="col-md-5">
		<form class="" onsubmit="add_new_level(event, this)">
			<div class="form-group">
				<label>Kode level</label>
				<input type="number" maxlength="5" name="id_userlevel" class="form-control" required>
			</div>
			<div class="form-group">
				<label>keterangan level</label>
				<textarea name="userlevel_description" class="form-control" required></textarea>
			</div>
			<div class="form-group">
				<label>Default redirect setelah login</label>
				<input type="text" name="userlevel_redirect" class="form-control" required>
			</div>
			<div class="form-group">
				<button class="btn btn-primary flat" type="submit"> Simpan Level </button>
			</div>
		</form>
	</div>
	<div class="col-md-7">
		
	</div>
</div>
<div class="table-responsive">
	<div class="alert alert-danger flat"> Untuk edit silahkan klik dua kali pada kolom yang akan di edit. </div>
	<table class="table table-bordered table-hovered table-stripped" id="table-master-level">
		<thead>
			<th>No.</th>
			<th>Userlevel</th>
			<th>keterangan</th>
			<th>Redirect</th>
			<th>Action</th>
		</thead>
	</table>
</div>

<script type="text/javascript">
	function add_new_level(e, ui)
	{
		e.preventDefault();
		var data = $(ui).serializeArray();
		$.post(site_url('users/add_new_master_level'), data)
		.done(function(){
			$(ui).find('input').val('')
			window.master_level.ajax.reload();
		})
	}
	$(document).ready(function(){
		window.master_level = $('#table-master-level').DataTable({
			ajax: {
				url : site_url('users/get_master_level'),
				dataSrc: function(json){

					if(json.length < 1) return false;

					i = 1;
					$.each(json, function(a,b){
						json[a]['no'] = i;
						json[a]['action'] = i;

						i++;
					})
					return json;
				}
			},
			columns: [
				{
					name: 'no',
					data: 'no'
				},
				{
					name: 'id_userlevel',
					data: 'id_userlevel'
				},
				{
					name: 'userlevel_description',
					data: 'userlevel_description'
				},
				{
					name: 'userlevel_redirect',
					data: 'userlevel_redirect'
				},
				{
					name: 'action',
					data: 'action'
				},
			]
		})

		$('#table-master-level tbody').delegate('td','dblclick', function(e){
			// console.log(e)
			$('#table-master-level tbody td').removeAttr('contenteditable')
			if(e.target.localName !== 'td')
			{

			}
			$(e.target).prop('contenteditable',true)
			$(e.target).focus();

		})
		
		$('#table-master-level tbody').delegate('td[contenteditable]','focusout', function(e){
			var tr 		= $(this).closest('tr'),
				idx 	= window.master_level.cell( this ),
				columns = window.master_level.settings().init().columns,
				column 	= window.master_level.cell(this).index().column,
				data 	= window.master_level.row(tr).data(),
				value 	= $(this).text(),
				nameUpd = columns[column].name

			if(data[nameUpd] != value)
			{

				Snackbar.manual({message: 'Memperbarui data', spinner: true})			
				var nData = {update:{}, where:{}}
					nData.update[nameUpd] = value;
					nData.where['id_userlevel'] = data.id_userlevel;

					$.post( site_url('users/update_master_level'), nData )
					.done(function(res){
						$(this).removeAttr('contenteditable')
						Snackbar.show('Data selesai diperbarui')			
					})	
			}
		})
		$('#table-master-level tbody').delegate('td[contenteditable]','keypress', function(e){
			

			if(e.keyCode == 13)
			{
				e.preventDefault();
				$(this).blur()
				
			}

		})
	})
</script>