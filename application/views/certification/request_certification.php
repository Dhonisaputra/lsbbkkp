<script type="text/javascript">
    switch (document.readyState) {
        case "loading":
            swal({   title: "Menyiapkan permintaan sertifikasi",   text: "Sedang mempersiapkan data permintaan sertifikasi. Silahkan tunggu!",   type: "info",   showConfirmButton: false});
         break;
    }
</script>
<?php echo $this->load->component('js','jsdata/jsdata.accreditation_request.js'); ?>
<?php echo $this->load->component('js','js/jstools/jstools.accreditation_request.js'); ?>
<?php echo $this->load->component('js','js/jstools/jquery.commodity.js'); ?>
<?php echo $this->load->component('js','js/jstools/jquery.nace.js'); ?>
<?php echo $this->load->component('js','js/jstools/jquery.product_line.js'); ?>
<?php echo $this->load->component('js','js/jstools/jquery.certification.js'); ?>
<?php echo $this->load->component('js','js/jstools/jquery.request_assessment.js'); ?>
<?php echo $this->load->component('js','jsdata/jsdata.product_line.js'); ?>
<style type="text/css">
    .checkbox-childrens
    {
        border-left: 2px #e0dfdf solid;
        padding-left: 20px;
    }
    .collapsable-checkbox
    {
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .sign
    {
        font-size: 11px;
        color: #333;
    }
    .divider-navbar
    {
        height: 60px;
    }

    .tab-pane
    {
        padding-top: 10px;
    }
    .collapsable-checkbox a.collapsed .arrow
    {
        font-family: 'Material Icons';
        content: "add";
        -webkit-font-feature-settings: 'liga';
    }
    .collapsable-checkbox a:not(.collapsed) .arrow
    {
        font-family: 'Material Icons';
        content: "remove";
        -webkit-font-feature-settings: 'liga';
    }
</style>

<ul class="sr-only" role="tablist">
    <li role="presentation" class=""><a href="#tab-request" aria-controls="tab-request" role="tab" data-toggle="tab">Request</a></li>
    <li role="presentation" class=""><a href="#tab-summary-request" aria-controls="tab-request--JECA" role="tab" data-toggle="tab">Summary</a></li>
</ul>
<div class="tab-content">
    
    <div role="tabpanel" class="tab-pane active" id="tab-request">
        <section class="navbar">
            <button class="mdl-button mdl-js-button" onclick="window.close();"> <i class="material-icons">clear</i> Batal </button> 
            <button href="#"  role="tab" data-toggle="tab" class="mdl-button mdl-js-button btn btn-primary pull-right" onclick='open_summary()'>
                Selanjutnya <i class="material-icons">chevron_right</i>
            </button>
        </section>
        <form id="helper-form--request-certification" name="helper-form--request-certification" action="<?php echo site_url('company/process/request/certification') ?>"></form>
        <div class="divider-navbar hidden-md hidden-lg"></div>
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs " role="tablist">
                <li role="presentation" class="presentation presentation-YQ active"><a href="#tab-request--YQ" aria-controls="tab-request--YQ" role="tab" data-toggle="tab">YQ-005-IDN</a></li>
                <li role="presentation" class="presentation presentation-JECA"><a href="#tab-request--JECA" aria-controls="tab-request--JECA" role="tab" data-toggle="tab">JECA-004-IDN</a></li>
                <li role="presentation" class="presentation presentation-JPA"><a href="#tab-request--JPA" aria-controls="tab-request--JPA" role="tab" data-toggle="tab">JPA-009-IDN</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <!-- YQ -->
                <div role="tabpanel" class="tab-pane active" id="tab-request--YQ">
                    <?php $this->load->view('certification/request_certification_yq') ?>
                </div>

                <!-- JECA -->
                <div role="tabpanel" class="tab-pane" id="tab-request--JECA">
                    <?php $this->load->view('certification/request_certification_jeca') ?>
                </div>
                
                <!-- JPA -->
                <div role="tabpanel" class="tab-pane" id="tab-request--JPA">
                    <?php $this->load->view('certification/request_certification_jpa') ?>
                </div>
                

                <!-- clone section -->
                <div role="tabpanel" class="tab-pane" id="tab-request--clone">
                    
                    <!-- clone brand item -->
                    <div class="list-group clone-brand-item mdl-shadow--2dp list-group--brand-item open" data-brand="" _="">
                        <div class="list-group-item" >
                            <button class="mdl-button mdl-js-button mdl-button--icon btn-remove--brand pull-right" onclick="removeBrandItem(this)" style="z-index:2;position:absolute; top:0px; right:0px;"><i class="material-icons">clear</i></button>

                            <div class="brand--editor">
                                        
                                <div class="form-group has-warning has-feedback">
                                    <label>Nama Merk</label>
                                    <input type="text" class="form-control list-brand--form-component has-feedback" id="" name="" oninput="checkInput(this)" onchange="changeBrandName(this)" placeholder="Nama merek">
                                    <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block">Pisahkan antar merek dengan koma ','</div>
                                </div>
                                    
                                <div class="checkbox"> <label><input class="" type="checkbox" onchange="if( $(this).prop('checked') ){$(this).parents('.checkbox').siblings('.form-lampiran').removeClass('sr-only') }else{$(this).parents('.checkbox').siblings('.form-lampiran').addClass('sr-only')}"> Silahkan tandai jika anda ingin menambahkan data importir!. </label> </div>
                                <div class="sr-only form-lampiran">
                                    <div class="form-group ">
                                        <label>Silahkan tulis importir</label>
                                        <textarea class="form-control list-brand--form-component" id="" name="" placeholder="information holder of trademark"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="mdl-button mdl-js-button btn btn-primary" onclick="changeBrandlampiran(this)">Simpan importir</button>
                                    </div>
                                </div>
                            </div>

                            <div class="brand--overview">
                                <div> <strong>Merek : </strong> <span class="brand--overview--item-text"></span> </div>
                                <div> 
                                    <p><strong>Importir : </strong></p>
                                    <div class="brand--overview--item-lampiran">Tidak tersedia</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end clone brand item -->

                    <div class="clone-product-item" role-certificate="JPA-009">
                        <div class="certification" id="jpa-product-line"></div>

                        <div class="row">
                            <div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="jpa-iso-certification" class="tab-jpa-item" aria-controls="ISO" role="tab" data-toggle="tab">Lini Produk</a></li>
                                    <li role="presentation"><a href="jpa-brand-certification" class="tab-jpa-item" aria-controls="brand" role="tab" data-toggle="tab">Merek</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                   

                                    <div role="tabpanel" class="tab-pane active" id="jpa-iso-certification">
                                        <div class="col-md-12">
                                            <div class="certification" id="jpa-product-line"></div>
                                        </div>
                                    </div>

                                    <div role="tabpanel" class="tab-pane " id="jpa-brand-certification">
                                        
                                        <div class="list-group list-group--jpa--brand" id="list-group--jpa--brand">
                                            <div class="list-group-item list-group-item--brand">
                                                <button class="mdl-button mdl-js-button mdl-button--icon pull-right" onclick=""> <i class="material-icons">clear</i> </button>
                                                <div class="form-group">
                                                    <label>Merek</label>
                                                    <input type="text" class="form-control input-sm" name="brand" oninput="data_brand(this)">
                                                    <span class="help-block text-warning">Pisahkan antar merek dengan koma ',' </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            
                        </div> <!-- end of row -->

                    </div> <!-- end of clone product item -->

                    <!-- clone jpa template -->
                    <!-- list-group -->
                    <div class="list-group section--certification section--certification-jpa clone clone-jpa"> 
                        <div class="list-group-item flat">
                            <div class="tab-content" id="section--certification-jpa">

                                <!-- tab product line -->
                                <div role="tabpanel" class="tab-pane active tab-pane--akreditasi" id="jpa-audit-baru--certification">
                                    <div class="row" >
                                        <div class="col-md-8">
                                            <div class="certification" id="jpa-product-line--new"></div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="list-group list-group-flat">
                                                <div class="list-group-item active"> <center>Jenis sertifikat</center> </div>
                                                <div class="list-group-item list-group-if-no-certification" id="jpa-certification"> <center> Pilih Lini Produk terlebih dahulu </center></div>

                                            </div>
                                        </div>
                                    </div> <!-- end of row -->
                                    <div class="divider"></div>
                                    <button href="#jpa-audit-baru--brand" role="tab" data-toggle="tab" class="btn btn-warning mdl-button mdl-js-button btn-tambah-brand">
                                        <i class="material-icons">label</i> Tambah Merek
                                    </button>
                                    <button  class="btn-danger mdl-button mdl-js-button btn-remove-jpa pull-right mdl-button--icon">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </div>
                                <!-- end tab product line -->

                                <!-- tab brand -->
                                <div role="tabpanel" class="tab-pane tab-pane--brand" id="jpa-audit-baru--brand">
                                    <div class="">
                                        <a href="#jpa-audit-baru--certification"  role="tab" data-toggle="tab" class="mdl-button mdl-js-button btn btn-default btn-tambah-akreditasi" >
                                            <i class="material-icons">chevron_left</i> Kembali
                                        </a>
                                        <div class="pull-right">
                                            <button class="mdl-button mdl-js-button btn btn-primary" onclick="insertNewBrand(this)">
                                                 Sisipkan merek <i class="material-icons">local_offer</i>
                                            </button>
                                            <button class="mdl-button mdl-js-button mdl-button--icon" onclick="clearAllBrand(this)"  data-toggle="tooltip" data-placement="top" title="Clear All Brand">
                                                <i class="material-icons">clear_all</i>
                                            </button>
                                        </div>
                                    </div>
                                    <hr>

                                    <center style="margin-top:20px;opacity:.3;" class="sign sign-brand"><h2>Silahkan sisipkan merek</h2><br><span class="material-icons">local_offer</span></center>
                                    <div class="" id="list-group-brand">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end list-group -->

                </div> <!-- end of #tab-request clone -->

            </div> <!-- end of tab-content -->
             
        </div>

    </div> <!-- end tab request -->

    <div role="tabpanel" class="tab-pane" id="tab-summary-request">
        <section class="navbar">
            <!-- Flat button -->
            <button class="mdl-button mdl-js-button" href="#" role="tab" data-toggle="tab" onclick="open_request()">
                <span class="glyphicon glyphicon-menu-left"></span> Back
            </button>

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right" id="simpan_permintaan" onclick="SubmitCertificationRequested()">
                Simpan permintaan <span class="material-icons">send</span>
            </button>

        </section>
        <?php $this->load->view('certification/request_certification_summary') ?>
    </div>
</div>

<script type="text/javascript">
   
     // YANG DIGUNAKAN ADALAH YANG DIBAWAH INI. 

     /*
    |--------------------
    | Fungsi untuk Create Object request
    |--------------------
    */
    var a0 = $.jsdata_accreditation_request.request('YQ-005', true)
    var a1 = $.jsdata_accreditation_request.request('JECA-004', true)
    function yq_onchange_type(type)
    {
        // taambahkan key pada yq request
        $('#section--certification-yq').attr('key',a0.key);

        if(!type)
        {
            $.fn.request_assessment.self_announcement('YQ-005',true);$('#section--certification-yq').addClass('sr-only')
            a0.is_self_announcement = true;
        }else if(type === 'LSBBKKP') {
            $.fn.request_assessment.self_announcement('YQ-005',false);$('#section--certification-yq').removeClass('sr-only')
            a0.is_self_announcement = false;
        }
    }

    function jeca_onchange_type(type)
    {
        // taambahkan key pada yq request
        $('#section--certification-jeca').attr('key',a1.key);

        if(!type)
        {
            $.fn.request_assessment.self_announcement('JECA-004',true);$('#section--certification-jeca').addClass('sr-only')
            a1.is_self_announcement = true;
        }else if(type === 'LSBBKKP') {
            $.fn.request_assessment.self_announcement('JECA-004',false);$('#section--certification-jeca').removeClass('sr-only');
            a1.is_self_announcement = false;
        }
    }
    var processDefer = $.Deferred();
    processDefer.always(endprocess);

    $.fn.request_assessment.company('<?php echo $id_company ?>');

    function open_request()
    {
        $('a[href="#tab-request"]').tab('show')
    }
    
    function SubmitCertificationRequested()
    {
        swal({
            title: 'Kirim permintaan sertifikasi',
            text: 'Apakah permintaan sertifikasi anda sudah selesai? Aksi ini akan mengirimkan permintaan sertifikasi anda dan anda tidak dapat membatalkannya.',
            showCancelButton: true,
            closeOnConfirm: false, 
            closeOnCancel: true, 
            type: 'info',
            confirmButtonText: 'submit',
            cancelButtonText: 'cancel',
        }, function(){
            _process_insert_new_request()
        })
    }

    function _process_insert_new_request()
    {
        $('.new-request--resave-request').addClass('sr-only')
        $('.new-request--save-request>.material-icons').removeClass('sr-only')
        swal({
            title: 'Menyimpan permintaan sertifikasi',
            text: '<?php echo $this->load->view("templates/others/template--swetalert--new-a0-last-alert","",true) ?>',
            type: 'info',
            allowEscapeKey: false,
            showConfirmButton: false,
            html: true
        })
        save_new_request({
            data: $.jsdata_accreditation_request.records(),
            error: function(res)
            {
                $('.new-request--resave-request').removeClass('sr-only').attr('href','javascript: _process_insert_new_request()')
                $('.new-request--save-request>.material-icons').addClass('sr-only')
                Snackbar.show('Simpan permintaan gagal. Silahkan check koneksi anda!')
                window._confirm__request_certification__saving_data_status = false;
            },
        })
        .done(function(res){
            $('.new-request--save-request>.material-icons').removeClass('spinning').text('done').css({'color':'#4183D7'})
            res = JSON.parse(res);
            console.log(res);
            _process_kirim_email(res);
            $('.new-request--done').removeClass('sr-only');
            // nav.back();
        })
    }
    function _process_kirim_email(res)
    {
        $('.new-request--resend-email').addClass('sr-only')
        $('.new-request--send-email>.material-icons').removeClass('sr-only').addClass('spinning')


        $.post(site_url('company/resend_email_confirmation_request'), res)
        .done(function(){
            $('.new-request--send-email>.material-icons').removeClass('spinning').text('done_all').css({ 'color':'#4183D7'})
            $('.new-request--save-request>.material-icons').removeClass('spinning').text('done_all')
            swal({title: 'Permintaan berhasil', text:'Permintaan anda telah diterima. mengarahkan ke panel permintaan. Silahkan tunggu', allowEscapeKey:false, showConfirmButton:false})
    
            // MENGIRIMKAN NOTIFIKASI KE ADMIN LSBBKKP
            // get Cookies
            var cookie = Cookies.getJSON('authentication').data;
            Notify.send({notification_for_level:3, notification_text: cookie.username+' telah mendaftarkan permintaan sertifikasi baru. '})
            .done(function(){  
                // MENGALIHKAN KE HALAMAN TRACKER REQUEST
                window.location.href = site_url('company/tracker_request/'+res.id_company+'/'+res.id_permintaan_sertifikasi)
            })
        })
        .fail(function(res){
            $('.new-request--resend-email').removeClass('sr-only').attr('href','javascript: _process_kirim_email()')
            $('.new-request--send-email>.material-icons').addClass('sr-only')
            window._confirm__request_certification__sending_email_status = false;
            console.log(res)
        })
    }
    function submit_request_has_done()
    {
        if(window._confirm__request_certification__saving_data_status == false)
        {
            swal({
                title: 'Apakah anda yakin ingin keluar?',
                text: 'Proses simpan permintaan baru belum selesai atau gagal. jika anda keluar, semua data akan hilang',
                type: 'warning',
                showCancelButton: true,
                allowEscapeKey: false,
            }, function(e){
                if(e)
                {
                    window.close()
                }else
                {
                    swal.close();
                    return false;
                }
            })
        }else if(window._confirm__request_certification__sending_email_status == false)
        {
            if( alert('Apakah anda yakin ingin keluar? Proses pengiriman email belum selesai atau gagal. jika anda keluar, email tidak akan terkirim ke client. apakah anda yakin?') )
            {
                window.close()
            }
        }else
        {
            window.close();
        }

    }
    function endprocess()
    {
        Snackbar.show('Pengumpulan data telah selesai!')
    }

    function save_new_request(options)
    {
        // parameters needed
        var deff = $.Deferred();
        options = $.extend({
            data: $.fn.request_assessment.data,
            action: $('form').attr('action'),
            success: function(response){
                
                console.log(response)
            },
            error: function(response)
            {
                swal('Terdapat kesalahan', 'Email tidak terkirim!', 'error');
            }
        }, options)

        $.post(options.action, {sertifikasi:options.data, id_company:'<?php echo $id_company ?>'} )
        .done(function(res){
            deff.resolve(res);            
        })
        .error(function(res){
            console.log(res);
            options.error(res);
        })

        return $.when(deff.promise())
    }
</script>
<?php echo $this->load->component('js','js/jspage/jspage.certification_request.js'); ?>
