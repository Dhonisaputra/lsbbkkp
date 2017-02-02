<table class="table table-striped table-condensed table-bordered table-hover">

	<thead>
		<tr>
			<th>No.</th>
			<th>Username</th>
			<th>level</th>
			<th>Action</th>
			<th>deactive it</th>
		</tr>
	</thead>
	<tbody>
			<?php 
				$i = 1;
				foreach ($users as $key => $value) {
					$username = $value['username'];
					$level = $value['level'];
					$iduser = $value['id_users'];
					$is_active = ($value['active'])?'deactive this account.' : 'activate this account';
echo <<<EOF
<tr>	
	<td>$i</td>
	<td>$username</td>
	<td>$level</td>
	<td>  
		<div class="btn-group" role="group" aria-label="..."><a href="#" type="button" class="btn btn-default">Edit</a><a href="#" type="button" class="btn btn-default">remove</a></div>
	</td>
	<td> 
		<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-$iduser">
  			<input type="checkbox" id="switch-$iduser" class="mdl-switch__input" checked>
  			<span class="mdl-switch__label">$is_active</span>
		</label>
	</td>
</tr>
EOF;
$i++;
				}

			?>
	</tbody>

</table>

