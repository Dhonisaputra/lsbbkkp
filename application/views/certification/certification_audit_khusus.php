<?php echo $this->load->component('js','jsdata/jsdata.accreditation_request.js'); ?>
<?php echo $this->load->component('js','js/jstools/jstools.accreditation_request.js'); ?>

<?php echo $this->load->component('js','js/jstools/jquery.commodity.js'); ?>
<?php echo $this->load->component('js','js/jstools/jquery.nace.js'); ?>
<?php echo $this->load->component('js','js/jstools/jquery.product_line.js'); ?>
<?php echo $this->load->component('js','js/jstools/jquery.certification.js'); ?>
<?php echo $this->load->component('js','js/jstools/jquery.request_assessment.js'); ?>

<style type="text/css">
    .checkbox-childrens
    {
        border-left: 2px #e0dfdf solid;
        padding-left: 20px;
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
</style>
    

    <form id="helper-form--request-certification" name="helper-form--request-certification" action="<?php echo site_url('company/process/request/certification') ?>"></form>
    <div class="divider-navbar hidden-md hidden-lg"></div>
    <div>

        <a href="#tab-request--YQ" class="<?php echo ($data['type'] == 'YQ-005')? 'onAudit' : '' ?> sr-only" aria-controls="tab-request--YQ" role="tab" data-toggle="tab">YQ-005-IDN</a>
        <a href="#tab-request--JECA" class="<?php echo ($data['type'] == 'JECA-004')? 'onAudit' : '' ?> sr-only" aria-controls="tab-request--JECA" role="tab" data-toggle="tab">JECA-004-IDN</a>
        <a href="#tab-request--JPA" class="<?php echo ($data['type'] == 'JPA-009')? 'onAudit' : '' ?> sr-only" aria-controls="tab-request--JPA" role="tab" data-toggle="tab">JPA-009-IDN</a>

        <!-- Tab panes -->
        <div class="tab-content">
            <!-- YQ -->
            <?php if ($data['type'] == 'YQ-005') { ?>
            <div role="tabpanel" class="tab-pane <?php echo ($data['type'] == 'YQ-005')? 'active' : '' ?>" id="tab-request--YQ-005">
                <?php                         
                    # code...
                    $this->load->view('certification/audit_khusus_certification_yq', array('data' => $data )) 
                ?>
            </div>
            <script type="text/javascript">$.fn.request_assessment.data['YQ-005']['is_self_announcement'] = false</script>
            <?php } ?>

            <!-- JECA -->
            <?php if ($data['type'] == 'JECA-004') { ?>
            <div role="tabpanel" class="tab-pane <?php echo ($data['type'] == 'JECA-004')? 'active' : '' ?>" id="tab-request--JECA-004">
                <?php 
                    $this->load->view('certification/audit_khusus_certification_jeca', array('data' => $data )) 
                ?>
            </div>
            <script type="text/javascript">$.fn.request_assessment.data['JECA-004']['is_self_announcement'] = false</script>
            <?php } ?>
            
            <!-- JPA -->
            <?php if ($data['type'] == 'JPA-009') { ?>
            <div role="tabpanel" class="tab-pane <?php echo ($data['type'] == 'JPA-009')? 'active' : '' ?>" id="tab-request--JPA-009">
                <?php 
                    $this->load->view('certification/audit_khusus_certification_jpa', array('data' => $data )) 
                ?>
                <script type="text/javascript">$.fn.request_assessment.data['JPA-009']['is_self_announcement'] = false</script>
            </div>
            <?php } ?>
            

            <div role="tabpanel" class="tab-pane" id="tab-request--clone">
                <!-- clone brand item -->
                    <div class="list-group clone-brand-item mdl-shadow--2dp list-group--brand-item open" data-brand="" _="">
                        <div class="list-group-item" >
                            <button class="mdl-button mdl-js-button mdl-button--icon btn-remove--brand pull-right" onclick="removeBrandItem(this)" style="z-index:2;position:absolute; top:0px; right:0px;"><i class="material-icons" >clear</i></button>

                            <div class="brand--editor">

                                <div class="form-group has-warning has-feedback">
                                    <label>Nama Merk</label>
                                    <input class="form-control list-brand--form-component has-feedback" id="" name="" onchange="changeBrandName(this)" placeholder="Nama merek">
                                    <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block">Pisahkan antar merek dengan koma ','</div>
                                </div>

                                <div class="checkbox"> <label><input class="" type="checkbox" onchange="if( $(this).prop('checked') ){$(this).parents('.checkbox').siblings('.form-lampiran').removeClass('sr-only') }else{$(this).parents('.checkbox').siblings('.form-lampiran').addClass('sr-only')}"> Silahkan Centang jika anda ingin menambahkan lampiran perusahaan pemegang merk. </label> </div>
                                <div class="sr-only form-lampiran">
                                    <div class="form-group ">
                                        <label>Tuliskan importir</label>
                                        <textarea class="form-control list-brand--form-component" id="" name="" placeholder="Nama Merk"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="mdl-button mdl-js-button btn btn-primary" onclick="changeBrandlampiran(this)">Simpan merek</button>
                                    </div>
                                </div>
                            </div>

                            <div class="brand--overview">
                                <div> <strong>Merek : </strong> <span class="brand--overview--item-text"></span> </div>
                                <div> 
                                    <p><strong>Importir : </strong></p>
                                    <div class="brand--overview--item-lampiran">N/A</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end clone brand item -->
                
                <div class="clone-product-item" role-certificate="JPA-009">

                    <div class="pull-right">
                        <!-- Icon button -->
                        <button class="mdl-button mdl-js-button mdl-button--icon jpa-remove">
                          <i class="material-icons">clear</i>
                        </button>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Merek</label>
                                <input type="text" class="form-control input-sm" name="brand" oninput="data_brand(this)">
                            </div>
                        </div>
                    </div>

                    

                </div> <!-- end of clone product item -->

            </div> <!-- end of #tab-request clone -->

            <div role="tabpanel" class="tab-pane" id="tab-summary-request">
                <section class="navbar">
                    <!-- Flat button -->
                    <a class="mdl-button mdl-js-button btn btn-tab-back" href="#tab-request--<?php echo $data['type'] ?>" role="tab" data-toggle="tab" >
                        <span class="glyphicon glyphicon-menu-left"></span> kembali
                    </a>

                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored pull-right" onclick="submit_audit_khusus()">
                        Simpan permintaan <span class="glyphicon glyphicon-menu-right"></span>
                    </button>

                </section>
                <?php $this->load->view('certification/request_audit_khusus_certification_summary', array('data' => $data )) ?>
            </div>

        </div> <!-- end of tab-content -->

    </div>



<?php echo $this->load->component('js', 'js/jspage/jspage.request_certification_jpa.js') ?>

<script type="text/javascript">
$(document).ready(function(){
    
    $.fn.request_assessment.company('<?php echo $id_company ?>');
    $.fn.request_assessment.data['certificateTarget']   = '<?php echo $data["id_certificate"] ?>';
    $.fn.request_assessment.data['handling']            = 'insert brand';
    $.fn.request_assessment.data['type']                = '<?php echo $data["type"] ?>';
})

    function submit_audit_khusus(options)
    {
        // parameters needed
        var deff = $.Deferred()            

        options = $.extend({
            data: $.fn.request_assessment.data,
            action: $('form').attr('action'),
            success: function(response){
                
                // window.location.href = site_url('company');
                console.log(response)
            },
            error: function(response)
            {
                swal('Kesalahan saat mengirim email', 'Terdapat kesalahan saat mengirim email konfirmasi. kemungkinan dikarenakan koneksi anda atau server yang tidak stabil. Silahkan hubungi admin LSBBKKP untuk penjelasan lebih lanjut', 'error');
            }
        }, options)

        // snackbar mdl 
        Snackbar.manual({message: 'Menyimpan permintaan audit khusus', spinner:true });
            
        swal({
            title: 'Menyimpan permintaan audit khusus',
            text: 'Mohon tunggu beberapa saat!',
            type: 'info',
            allowEscapeKey: false,
            showConfirmButton: false
        })
        // check apakah ada self assessment yang true
        // yq self assessment?
        /*var isYQ_self_announce = options.data['YQ-005'].is_self_announcement, // check is self announce
            isJECA_self_announce = options.data['JECA-004'].is_self_announcement, // i\check is jeca self announce
            isBrandEmpty = []; // array untuk tampung isbrandEmpty. sebenarnya ndak dipake sih.. -_-"
*/
        // check data brand dengan value kosong.
        // var dataBrand = options.data['JPA-009'].filter(function(res){ return res.brand == ""})
        var dataBrand = 0
        
        // eksekusi jika kosong
        if( dataBrand > 0)
        {
            // hide snackbar dan open tab jpa
            Snackbar.hide('#snackbarTemp');

            open_jpa_request();
            // alert('Ada brand yang masih kosong!');
            swal('Kesalahan terdeteksi', 'Ada brand yang masih belum diisi. silahkan isikan terlebih dahulu, lalu ulangi langkah ini!')

            // focus cursor di nama brand yg
            $('[_="'+dataBrand[0].id+'"] [name="brand"]').focus();
            return false;
        }else
        {
            $.post(options.action, options.data)
            .done(function(res){
                Snackbar.hide();
                Snackbar.show('Permintaan audit khusus selesai ditambahkan.');
                swal({   
                    title: "Permintaan audit khusus selesai ditambahkan",   
                    text: "Permintaan audit khusus telah selesai ditambahkan. Setelah anda klik tombol OK, anda akan diarahkan ke halaman detail sertifikat",   
                    type: "success",   
                }, function(res){   
                    if(res)
                    {
                        window.close();
                        deff.resolve(res);
                    }
                });
                options.success(res);
            })
            .error(function(res){
                Snackbar.hide('#snackbarTemp');
                options.error(res);
            })
        }

        return $.when(deff.promise())
    }
    
    function open_request()
    {
        $('a[href="#tab-request"]').tab('show')
    }

    function open_previous_tab()
    {
        var href= $('a.onAudit[data-toggle="tab"] ').attr('href');

        $('a[href="'+href+'"][data-toggle="tab"] ').tab('show');
    }
    function insertProductSubmit()
    {
        $.fn.request_assessment.submit({
            success: function(res)
            {
                window.res = res;
            }
        }); // overwrite submit
    }
</script>

<script type="text/javascript">

    $(document).ready(function(){
        
        var naceDataDeff = $.Deferred();
        

        $.post(site_url('certification/process/get/used'), {id_certificate: '<?php echo $data["id_certificate"] ?>'} )
        .done(function(res){
            res = JSON.parse(res);
            naceDataDeff.resolve(res);

        })

        // remove scope used before
        _scopeDataDeff.pipe(function(res){
            naceDataDeff.done(function(res){
                if(res['scope'] && res['scope'].length > 0)
                {
                    $.each(res['scope'], function(a,b){
                        if( $('.commodity--choose-item[value="'+b+'"]').length > 0 )
                        {
                            $('.commodity--choose-item[value="'+b+'"]').parents('.checkbox').remove();
                        }                        
                    })
                }
            })            
        })

        // remove nace used before;
        $(document).delegate('.nace--choose-nace-available', 'change', function (e){
            if( $(this).is(':checked') )
            {
                naceDataDeff.done(function(res){
                    if(res['nace'] && res['nace'].length > 0)
                    {
                        $.each(res['nace'], function(a,b){
                            if( $('.nace--choose-nace-available[value="'+b+'"]').length > 0 )
                            {
                                $('.nace--choose-nace-available[value="'+b+'"]').parents('label').remove();
                            }                        
                        })
                    }
                })
            }
        })

        // remove product line used before;
        $(document).delegate('.iso--choose-product_line-available', 'change', function (e){
            if( $(this).is(':checked') )
            {
            
                _productLineDeffItem.done(function(res){
                    naceDataDeff.done(function(res){

                        if(res['product_line'] && res['product_line'].length > 0)
                        {
                            $.each(res['product_line'], function(a,b){
                                if( $('.product-line-item[value="'+b+'"]').length > 0 )
                                {
                                    $('.product-line-item[value="'+b+'"]').closest('.checkbox-childrens').remove();
                                }                        
                            })
                        }
                    })
                })

            } // end if
        })

    })
    
    // remove product line item


</script>
<?php echo $this->load->component('js','js/jspage/jspage.certification_request.js'); ?>
