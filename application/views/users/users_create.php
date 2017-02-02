<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<div class="row">
	<div class="col-md-4">
		<form action="users/process/add/user" name="formNew" id="formNew" type="post" autocomplete="off">
			<div class="form-group">
				<label>username</label>
				<input name="username" class="form-control" placeholder="username" required autocomplete="off">
			</div>
			<div class="form-group">
				<label>password</label>
				<input name="password" class="form-control" type="password" placeholder="password" required autocomplete="off">
			</div>
			<div class="form-group">
				<label>Nama Pengguna</label>
				<input name="fullname" class="form-control" placeholder="Fullname" required autocomplete="off">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input name="email" class="form-control" type="email" placeholder="email" required autocomplete="off">
			</div>
			<!-- <div class="form-group">
				<label>
				  	<input type="radio" id="option-1" class="mdl-radio__button" name="level" type="radio" value="1"> Level 1 (Perusahaan)
				</label>
			</div> -->

			<div class="form-group">
			<?php foreach ($level as $key => $value): ?>
				<div class="radio">
					<label class="">
					  	<input type="radio" id="" class="" name="level" value="<?php echo $value['id_userlevel'] ?>"> <?php echo $value['userlevel_description'] ?>
					</label>
				</div>
			<?php endforeach ?>	
			</div>
			<div class="form-group">
				<button class="btn btn-primary flat" type="submit"> Tambah pengguna </button>
			</div>
		</form>
	</div> <!-- end of row -->
	<div class="col-md-8">
		<table class="table table-bordered table-hovered table-striped" id="table-users">
			<thead>
				<th>No.</th>
				<th>Username</th>
				<th>Email</th>
				<th>level</th>
				<th>action</th>
			</thead>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		window.table_users = $('#table-users').DataTable({
			ajax: {
				url : site_url('users/get_users'),
				dataSrc: function(json){

					if(json.length < 1) return false;

					i = 1;
					$.each(json, function(a,b){
						json[a]['no'] = i;
						json[a]['action'] = '';

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
					name: 'username',
					data: 'username'
				},
				{
					name: 'email',
					data: 'email'
				},
				{
					name: 'level',
					data: 'level'
				},
				{
					name: 'action',
					data: 'action'
				},
				
			]
		})

		$('#formNew').on('submit', function(event){
			event.preventDefault();
			var action = $(event.target).attr('action'), data = $(event.target).serializeArray();
			
			$.post(site_url(action), data)
			.done(function (response){
				event.target.reset();
				Snackbar.show('Pengguna berhasil disimpan!');
				$('[name="username"]').focus();
				window.table_users.ajax.reload();
			})
		})

	})
	
</script>
