<!-- standard Angular -->

<?php echo $this->load->component('js','js/library.company.js'); ?>

<?php #echo $this->load->component('js', 'plugins/angular/angular.min.js');  ?>
<?php #echo $this->load->component('js', 'js/jstools/angular.company_registration.js') ?>


<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="profile-company--home">
        <?php $this->load->view('company/profile_company'); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile-company--edit-company">
        <?php $this->load->view('company/edit_company'); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile-company--edit-brand">
        <?php $this->load->view('company/edit_brand'); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile-company--edit-assessment">
        <?php $this->load->view('company/edit_assessment'); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile-company--add-certification">
        <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <button href="#profile-company--home" role="tab" data-toggle="tab"  class="mdl-button mdl-js-button mdl-button--icon">
                <i class="material-icons">keyboard_backspace</i>
            </button>
        </div>
        <?php #$this->load->view('certification/request_certification', array('id_company' => $company['id_company']) ); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile-company--detail-certificate">
        <section class="navbar">    
            <div class="btn-group" role="group" aria-label="...">
                <!-- Icon button -->
                <a href="#profile-company--home" role="tab" data-toggle="tab" class="mdl-button mdl-js-button mdl-button--icon" onclick="window.history.back(2)">
                    <i class="material-icons">keyboard_backspace</i>
                </a>
            </div>
            <!-- Single button -->
            <div class="btn-group pull-right">
                <button type="button" class="mdl-button mdl-button--icon mdl-js-button dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="material-icons">more_vert</span>
                </button>
                <ul class="dropdown-menu certificate-panel--status-list">
                    <li><a class="certificate-panel--status-list--active" data-status="active" onclick="changeStatusCertificate(this,'active')">active  </a></li>
                    <li><a class="certificate-panel--status-list--icebox" data-status="icebox" onclick="changeStatusCertificate(this,'icebox')">Ice Box</a></li>
                    <li><a class="certificate-panel--status-list--revoke" data-status="revoke" onclick="changeStatusCertificate(this,'revoke')">Revoke </a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="certificate-panel--status-list--remidial" data-status="resign" onclick="changeStatusCertificate(this,'resign')">Resign</a></li>
                </ul>
            </div>
        </section>
        <div class="alert alert-info row flat">
            <i class="material-icons material-icons--middle">info</i> Anda dapat mengganti status sertifikat melalui tombol <i class="material-icons material-icons--middle">more_vert</i> yang berada disebelah kanan atas.
        </div>

        <?php $this->load->view('certification/detail_certificate'); ?>

        <script type="text/javascript">
            /*
            |
            | Change Status Certificate
            |
            */
            function changeStatusCertificate(ui, status)
            {
                swal({
                    title: 'Memperbarui status sertifikat',
                    text: 'Sedang memperbarui sertifikat. Mohon tunggu sebentar!',
                    allowEscapeKey: false,
                    showConfirmButton: false,
                })
                var $this = $(ui),
                $data = $this.data()

                console.log($this);

                $.post(site_url('certification/process/post/update/certificate/status'), {status: status, certificate_md5: $data.certificate_md5} )
                .done(function(res){
                    console.log(res);
                    swal({ title:'Sertifikat telah di perbarui', text:'Sertifikat telah diperbarui!', type:'success', allowEscapeKey: false, function(confirm){
                        if(confirm)
                        {
                            window.certificateTable.ajax.reload();
                            $('a[href="#profile-company--home"]').tab('show')
                        }
                    }});
                })
                .error(function(res){
                    swal('Kesalahan saat memperbarui sertifikat','Status sertifikat gagal di perbarui. Silahkan reload halaman ini lalu ulangi kembali!','error');
                })

            }
        </script>

    </div>
</div>