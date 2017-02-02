<div>

	<!-- Nav tabs -->
	<ul class="nav nav-tabs sr-only" role="tablist">
		<li role="presentation" class="active"><a href="#company-create--index" aria-controls="home" role="tab" data-toggle="tab">Index form</a></li>
		<li role="presentation"><a href="#company-create--hq" aria-controls="profile" role="tab" data-toggle="tab">Company HQ</a></li>
		<li role="presentation"><a href="#company-create--employe" aria-controls="messages" role="tab" data-toggle="tab">company employee</a></li>
		<li role="presentation"><a href="#company-create--summary" aria-controls="settings" role="tab" data-toggle="tab">company account</a></li>
	</ul>

	<!-- Tab panes -->
	<form action="<?php echo site_url('company/process/create/company') ?>" type="post" id="form-new--company" onsubmit="prepareNewCompany(event)" class="col-md-12 padding-bottom--20">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="company-create--index">
				<section class="navbar row"> 
					<div class="pull-right ">
						<label class="mdl-button mdl-js-button"> Langkah 1/4 </label>
						<button type="button" class="mdl-button mdl-js-button pull-right btn-primary flat mdl-button mdl-js-button" href="#company-create--hq" data-toggle="tab"> Selanjutnya <i class="material-icons middle">chevron_right</i> </button> 
					</div>
				</section>
				<!-- content -->
				<div class=" container-fluid"> <?php echo $this->load->view('company/company_create--common') ?> </div>
			</div>
			<div role="tabpanel" class="tab-pane" id="company-create--hq">
				<section class="navbar row"> 
					<button type="button" class="btn-warning flat mdl-button mdl-js-button" href="#company-create--index" data-toggle="tab"><i class="material-icons middle">chevron_left</i> Kembali </button> 
					<div class="pull-right ">
						<label class="mdl-button mdl-js-button"> Langkah 2/4 </label>
						<button type="button" class="btn-primary flat mdl-button mdl-js-button" href="#company-create--employe" data-toggle="tab"> Selanjutnya <i class="material-icons middle">chevron_right</i></button> 
					</div>
				</section>
				<!-- content -->
				<div class=" container-fluid"> <?php echo $this->load->view('company/company_create--HQ') ?> </div>

			</div>
			<div role="tabpanel" class="tab-pane" id="company-create--employe">
				<section class="navbar row"> 
					<button type="button" class="btn-warning flat mdl-button mdl-js-button" href="#company-create--hq" data-toggle="tab"> <i class="material-icons middle">chevron_left</i> Kembali </button> 
					<div class="pull-right ">
						<label class="mdl-button mdl-js-button"> Langkah 3/4 </label>
						<button type="button" class="btn-primary flat mdl-button mdl-js-button pull-right" href="#company-create--summary" data-toggle="tab"> Selanjutnya <i class="material-icons middle">chevron_right</i></button> 
					</div>
				</section>
				<!-- content -->
				<div class=" container-fluid"> <?php echo $this->load->view('company/company_create--employee') ?> </div>
			</div>
			<div role="tabpanel" class="tab-pane" id="company-create--summary">
				<section class="navbar row"> 
					<button type="button" class="btn-primary flat mdl-button mdl-js-button" href="#company-create--employe" data-toggle="tab"> <i class="material-icons middle">chevron_left</i> Kembali </button> 
					<div class="pull-right ">
						<label class="mdl-button mdl-js-button"> Langkah 4/4 </label>
					</div>
				</section>
				<!-- content -->
				<div class=" container-fluid"> <?php echo $this->load->view('company/company_create--summary') ?> </div>
			</div>
		</div>
	</form>

</div>

<div class="sr-only" id="components-content">

	<div class="row list-group-contact">
		<div class="col-md-4">
			<div class="form-group">
				<label>Contact Person #<span class="contact_no">1</span> </label>
				<input class="form-control form-required" name="company_cp_name[]" placeholder="Nama " autocomplete="off" >
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label>No. telephone *</label>
				<input class="form-control form-required" name="company_cp_phone[]" placeholder="No. Telephone" autocomplete="off" >
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label>Ext</label>
				<input class="form-control" name="company_cp_ext[]" placeholder="Ext" autocomplete="off" >
			</div>
		</div>
		<div class="col-md-1">
			<!-- Icon button -->
			<div class="form-group">
				<label style="height: 20px;"></label>
				<button class="mdl-button mdl-js-button mdl-button--icon" onclick="$(this).parents('.list-group-contact').remove()">
					<i class="material-icons">clear</i>
				</button>
			</div>

		</div>
	</div>

</div>

<datalist id="datalist--country"> </datalist>
<datalist id="datalist--province"> </datalist>
<datalist id="datalist--city"> </datalist>
<?php echo $this->load->component('js', 'js/jspage/jspage.company_create.js') ?>