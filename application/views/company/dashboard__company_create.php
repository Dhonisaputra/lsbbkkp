<section class="navbar">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?php echo isset($_GET['create_company'])? '' : 'active' ?>">
            <a class="text-uppercase" href="#panel--company--company-list" data-engine="pushstate" engine-attr="data-href" data-href="<?php echo site_url('company') ?>" engine-config='{"extend":"false"}' aria-controls="home" role="tab" data-toggle="tab"><i class="material-icons material-icons-middle">format_list_numbered</i> Perusahaan terdaftar </a>
        </li>
        <li role="presentation" class="<?php echo isset($_GET['create_company'])? 'active' : '' ?>">
            <a class="text-uppercase" class="btn btn-default flat" href="<?php echo site_url('company/signup') ?>"><i class="material-icons material-icons-middle">add</i> Perusahaan baru</a>
        </li>
        <a data-engine="pushstate" data-target="#document-actual-tab" title="" class="btn btn-default flat" href="<?php echo site_url('company/upload_company_by_excel') ?>"> Upload perusahaan </a>

    </ul>
</section>



<div>

    <!-- Tab panes -->
    <div class="tab-content">
        
        <div role="tabpanel" class="tab-pane <?php echo isset($_GET['create_company'])? '' : 'active' ?>" id="panel--company--company-list" style="margin-top:15px;">
            <?php $this->load->view('company/dashboard') ?>
        </div>
        <div role="tabpanel" class="tab-pane <?php echo isset($_GET['create_company'])? 'active' : '' ?>" id="panel--company--add-company" style="margin-top:15px;">
            <?php $this->load->view('company/company_create--index') ?>
        </div>
        <div role="tabpanel" class="tab-pane active" id="panel--company--certification">
            
        </div>

    </div>

</div>