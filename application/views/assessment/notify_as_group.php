	<?php echo $this->load->component('css', 'plugins/datetimepicker/jquery.datetimepicker.css') ?>
	<?php echo $this->load->component('js', 'plugins/datetimepicker/jquery.datetimepicker.min.js') ?>
	<?php echo $this->load->component('css', 'plugins/easyautocomplete/easy-autocomplete.min.css') ?>
	<?php echo $this->load->component('js', 'plugins/easyautocomplete/jquery.easy-autocomplete.min.js') ?>




	<form name="form-notify-as-group" id="form-notify-as-group" onsubmit="submit_notify_as_group(event, this)"></form>
	<a href="#notify-as-group--tab-coordinator" role="tab" data-toggle="tab" class="sr-only"></a>

<div class="container-fluid">
	
	<div class="tab-content">

		<div role="tabpanel" class="tab-pane active" id="notify-as-group--tab-home">
			<!-- navbar button -->
			<section class="navbar">
				
				<button class="mdl-button mdl-js-button btn-primary pull-right"  onclick="check_configuration()">
					Setting Email Koordinator <i class="glyphicon glyphicon-menu-right"></i>
				</button>
			</section>
			<!-- end navbar button -->

			<div class="row alert alert-danger">Silahkan pilih batas tanggal konfirmasi. </div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>Batas Akhir konfirmasi assessment bersama / group</label>
						<div class="input-group">
							<input type="text" class="form-control" name="assessment_collectif_date" id="assessment_collectif_date" placeholder="Pick Deadline Date Assessment Collective">
					      	<span class="input-group-btn">
								<button class="mdl-button mdl-js-button mdl-button--icon" onclick="$('#assessment_collectif_date').focus()"><i class="material-icons">today</i></button>
					      	</span>
					    </div><!-- /input-group -->
				    	<span class="help-block">Klik icon kalender untuk menampilkan tanggal.</span>
					
					</div>
				</div>
			</div>
			<div class="content-notify-as-group"></div>
			

		</div>
		<div role="tabpanel" class="tab-pane" id="notify-as-group--tab-coordinator">
			<!-- navbar button -->
			<section class="navbar">
				<button class="mdl-button mdl-js-button" href="#notify-as-group--tab-home" data-toggle="tab">
					<i class="glyphicon glyphicon-menu-left"></i> Kembali
				</button>
				<button class="mdl-button mdl-js-button btn-primary pull-right" href="#notify-as-group--tab-client-email" role="tab" data-toggle="tab">
					Setting email perusahaan <i class="glyphicon glyphicon-menu-right"></i>
				</button>
			</section>
			<!-- end navbar button -->

			<div class="row alert alert-info"> Email ini akan dikirimkan ke koordinator. </div>
			
			<div class="form-group">
				<label>Nama Koordinator</label>
				<input type="text" name="coordinator-name-notify-as-group" id="input-coordinator-name-notify-as-group" class="form-control" placeholder="Coordinator Name" form="form-notify-as-group">
				<span id="helpBlock" class="help-block">Anda dapat mengisi koordinator dari perusahaan yang terdaftar / dari pihak ke-3.</span>
			</div>
			<div class="form-group">
				<label>Email koordinator</label>
				<input type="email" name="email-coordinator-notify-as-group" id="input-email-coordinator-notify-as-group" class="form-control" placeholder="Email Koordinator" form="form-notify-as-group">
			</div>
			<div class="form-group">
				<label></label>
				<textarea name="email-text-coordinator-notify-as-group" id="email-text-coordinator-notify-as-group" placeholder="Content email that will send to coordinator" class="form-control" form="form-notify-as-group"></textarea>
				<span id="helpBlock" class="help-block"></span>
			</div>
			<div class="form-group">
				

			</div>

		</div>

		<div role="tabpanel" class="tab-pane" id="notify-as-group--tab-client-email">
			<section class="navbar">
				<button class="mdl-button mdl-js-button" href="#notify-as-group--tab-coordinator" data-toggle="tab">
					<i class="glyphicon glyphicon-menu-left"></i> Kembali 
				</button>
				<button class="mdl-button mdl-js-button btn-primary pull-right" href="#notify-as-group--tab-finishing" role="tab" data-toggle="tab">
					Review <i class="glyphicon glyphicon-menu-right"></i>
				</button>
			</section>
			<div class="row alert alert-info"> Email ini akan dikirimkan kepada perusahaan. </div>

			<!-- <div class="tabs-container" id="content-editor-participant-notify-as-group--tab">
				<ul class="nav nav-tabs" role="tablist"></ul>
				<div class="tab-content"></div>
			</div> -->
			<div class="" id="content-editor-participant-notify-as-group">
				<ul class="nav nav-tabs" role="tablist"></ul>
				<div class="tab-content"></div>
			</div>
			<div class="form-group">
				<!-- Colored raised button -->
				<!-- <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" href="#notify-as-group--tab-finishing" role="tab" data-toggle="tab">
					Selanjutnya 
				</button>
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" href="#notify-as-group--tab-coordinator" role="tab" data-toggle="tab">
					Edit Coordinator Email Content 
				</button> -->

			</div>
		</div>

		<div role="tabpanel" class="tab-pane" id="notify-as-group--tab-finishing">
			<section class="navbar">
				<button class="mdl-button mdl-js-button" href="#notify-as-group--tab-client-email" data-toggle="tab">
					<i class="glyphicon glyphicon-menu-left"></i> Kembali 
				</button>
				<button class="mdl-button mdl-js-button btn-primary pull-right" type="submit" form="form-notify-as-group">
					Simpan <i class="material-icons">done_all</i>
				</button>
			</section>
			<div class="panel panel-default">
				<div class="panel-body">

					<div class="list-group">
						<div class="list-group-item active">Detail</div>  
						<div class="list-group-item">  
							<a href="#notify-as-group--tab-coordinator" role="tab" data-toggle="tab" class="pull-right" style="color:#333;"><i class="glyphicon glyphicon-pencil"></i></a>
							Koordinator : <span class="fixed_coordinator_name">Silahkan isi koordinator!</span> <<span class="fixed_coordinator_email"></span>> 
						</div>
						
					</div>
					
				</div>
			</div>

			<div class="list-group list-group--notify-as-group--finishing-client-list">
				<div class="list-group-item active"> 
					<a href="#notify-as-group--tab-home" role="tab" data-toggle="tab" class="pull-right" style="color:white;"><i class="glyphicon glyphicon-pencil"></i></a>
					Client Assessment
				</div>
			</div>

			<div class="form-group">
				<!-- Colored raised button -->
				<!-- <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" form="form-notify-as-group">
					Selesai
				</button> -->

			</div>
		</div>
	</div>

	<!-- /////////////////////// sr only -->
	<div class="sr-only">

		<div class="text-email-coordinator">
			<p>Halo,  <strong class="fixed_coordinator_name"></strong></p>
			<p>Dengan ini, kami memberitahukan bahwa anda telah ditunjuk oleh badan sertifikasi LSBBKKP-YOQA sebagai koordinator assessment kolektif. </p>
			<p>Berikut kami beritahukan perusahaan yang akan menjalani assessment secara kolektif</p>
			<table class="table-email--company-list table table-bordered table-hover table-striped" style="border: 1px solid black; border-collapse: collapse;padding:5px;">
				<thead>
					<tr>
						<th style="border: 1px solid black; border-collapse: collapse;padding:5px;">Perusahaan</th>
						<th style="border: 1px solid black; border-collapse: collapse;padding:5px;">email</th>
						<th style="border: 1px solid black; border-collapse: collapse;padding:5px;">No Telp</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<p>Batas akhir dilakukan assessment kolektif adalah <span class="fixed_assessment_collectif_date"></span> </p>
			<p>Mohon kepada koordinator untuk dapat mengkoordinasikan perusahaan-perusahaan yang telah tercantum didalam daftar diatas. </p>
		</div>

		<div class="text-email-client">
			<p>kami memberitahukan bahwa perusahaan anda telah ditambahkan dalam assessment secara kolektif.</p>
			<p>Assessment secara kolektif ini juga diikuti oleh beberapa perusahaan berikut.</p>
			<table class="table-email--company-list table table-bordered table-hover table-striped" style="border: 1px solid black; border-collapse: collapse;padding:5px;">
				<thead>
					<tr>
						<th style="border: 1px solid black; border-collapse:collapse; padding:5px;">Perusahaan</th>
						<th style="border: 1px solid black; border-collapse:collapse; padding:5px;">email</th>
						<th style="border: 1px solid black; border-collapse:collapse; padding:5px;">No Telp</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<p>Dalam assessment kali ini, kami menunjuk <strong class="fixed_coordinator_name"></strong>  (<a href="#"><span class="fixed_coordinator_email"></span></a>)  sebagai koordinator assessment kolektif ini. silahkan berkoordinasi tentang tanggal  diadakan assessment secara kolektif dengan koordinator yang telah ditunjuk.</p>
			<p>Jika ada kesalahan, pertanyaan, kritik dan saran. silahkan hubungi costumer service kami.</p>
		</div>
	</div>

</div> <!-- end of container-fluid -->


	<?php echo $this->load->component('js', 'js/jspage/jspage.notify_as_group.js') ?>


