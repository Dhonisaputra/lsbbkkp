<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>
<div class="row" style="margin-top: 20px;">
	<div>

	  	<!-- Nav tabs -->
	  	<ul class="nav nav-tabs" role="tablist" style="padding-left:20px;">
	    	<li role="presentation" class="active"><a class="text-uppercase" href="#certificate-overview--all-certificate" aria-controls="home" role="tab" data-toggle="tab">All Certificate</a></li>
	    	<li role="presentation"><a class="text-uppercase" href="#certificate-overview--scope" aria-controls="profile" role="tab" data-toggle="tab">Scope</a></li>
	    	<li role="presentation"><a class="text-uppercase" href="#certificate-overview--product-line" aria-controls="profile" role="tab" data-toggle="tab">Product Line</a></li>
	    	<li role="presentation"><a class="text-uppercase" href="#certificate-overview--nace" aria-controls="profile" role="tab" data-toggle="tab">NACE</a></li>
	  	</ul>

	  	<!-- Tab panes -->
	  	<div class="tab-content" style="padding: 20px;">
	    	<div role="tabpanel" class="tab-pane active" id="certificate-overview--all-certificate">
	    		<?php $this->load->view('certification/panel/panel-overview--all-certificate') ?>
	    	</div>
	    	<div role="tabpanel" class="tab-pane" id="certificate-overview--scope">
	    		<?php $this->load->view('certification/panel/panel-overview--scope') ?>
	    	</div>
	    	<div role="tabpanel" class="tab-pane" id="certificate-overview--product-line">
	    		<?php $this->load->view('certification/panel/panel-overview--product-line') ?>
	    	</div>
	    	<div role="tabpanel" class="tab-pane" id="certificate-overview--nace">
	    		<?php $this->load->view('certification/panel/panel-overview--nace') ?>
	    	</div>
	  	</div>

	</div>
</div>