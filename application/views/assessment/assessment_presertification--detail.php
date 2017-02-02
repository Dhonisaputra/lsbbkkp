<?php echo $this->load->component('js', 'jsdata/jsdata.upload.js') ?>
<?php echo $this->load->component('js', 'plugins/foundation_datepicker/js/foundation-datepicker.min.js') ?>
<?php echo $this->load->component('css', 'plugins/foundation_datepicker/css/foundation-datepicker.min.css') ?>

<?php echo $this->load->component('js', 'plugins/ckeditor/ckeditor.js') ?>
<?php echo $this->load->component('js', 'plugins/ckeditor/adapters/jquery.js') ?>


<?php echo $this->load->component('css', 'css/bootstrap.tab-round-2.css') ?>

<section class="col-md-3" style="background: #fff; height: 100vh;">
    <section class="navbar">
        <button onclick="$('.sidebar-detail, .sidebar-notes').toggleClass('sr-only'); $('.sidebar-tab').toggleClass('btn-primary');" class="sidebar-tab mdl-button mdl-js-button btn-primary"> Detail </button>
        <button onclick="$('.sidebar-detail, .sidebar-notes').toggleClass('sr-only'); $('.sidebar-tab').toggleClass('btn-primary');" class="sidebar-tab mdl-button mdl-js-button tab-catatan"> Catatan <span class="badge"><?php echo count($notes) ?></span> </button>
    </section>
    <div class="sidebar-detail">
        
        <fieldset style="margin-top: 5vh; ">
            <legend>Status permintaan</legend>
            <div>
                <ul class="list-group">
                    <?php 
                        if(isset($request))
                        {
                    ?>
                    <li class="list-group-item">Permintaan sertifikasi untuk <?php echo implode(', ', $request['type_requested']) ?></li>
                    <li class="list-group-item">Tanggal pengajuan : <?php echo date('d F Y', strtotime( $kelengkapan['kelengkapan_permintaan_sertifikasi']['a0_added_on']) ); ?></li>
                    <li class="list-group-item">Tanggal Pelaksanaan : <?php echo is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date'])? ' <span class="label label-danger">Belum dipilih</span> ' : date('d F Y', strtotime( $kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date']) ); ?></li>
                    <?php } ?>
                    <!-- <li class="list-group-item">Status : <span class="label label-primary label-tracker-status"><?php echo @$status ?></span></li> -->
                   
                </ul>
            </div>
        </fieldset>
         <fieldset>
            <legend>Detail permintaan</legend>
            
            <?php 
                if(isset($request))
                {
                foreach ($request['a0_cat'] as $key => $value){
            ?>
                <div>
                    <a class="mdl-button mdl-js-button" role="button" data-toggle="collapse" href="#permintaan-<?php echo $value['id_a0_cat'] ?>" aria-expanded="false" aria-controls="collapseExample">
                       <i class="material-icons">chevron_right</i> Detail <?php echo $value['type'] ?>
                    </a>
                    <div class="collapse detail-permintaan" id="permintaan-<?php echo $value['id_a0_cat'] ?>">
                        <?php foreach ($value['certification_request'] as $key => $val): ?>
                            <div class="list-group">
                                <div class="list-group-item">Ruang Lingkup : <?php echo implode(' & ', $val['scope_detail_title']) ?> </div>
                                <div class="list-group-item">NACE : <?php echo implode(' & ', $val['nace_detail_title']) ?></div>
                                <div class="list-group-item">Sertifikat : <?php echo implode(', ', $val['audit_reference_title']) ?></div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php } 
            } ?>
           
        </fieldset>
    </div>
    <div class="sidebar-notes sr-only list-group">
        
        

    </div>
</section>

<section class="col-md-9">
    <div class="">
        <div class="row">
            <div class="board">
                <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                <div class="board-inner">
                    <ul class="nav nav-tabs tab-tracker" id="myTab">
                        <div class="liner"></div>
                        <li class="">
                            <a href="#home" data-toggle="tab" title="Upload dokumen kelengkapan sertifikasi" class="0500">
                                <span class="round-tabs one">
                                    <i class="material-icons middle tab-material-icons">backup</i>
                                </span> 
                            </a>
                        </li>
                        <!-- <li class="">
                            <a href="#new_certification" data-toggle="tab" title="Silahkan tambahkan sertifikasi" class="0501">
                                <span class="round-tabs one">
                                    <i class="material-icons middle tab-material-icons">verified_user</i>
                                </span> 
                            </a>
                        </li> -->
                        <li><a href="#settings_date" data-toggle="tab" title="Settings jumlah hari assessment" class="05021  0501 0502">
                            <span class="round-tabs three">
                                <i class="material-icons middle tab-material-icons">watch_later</i>
                            </span> </a>
                        </li>
                        <li><a href="#messages" data-toggle="tab" title="Pilih tanggal kesiapan" class="">
                            <span class="round-tabs three">
                                <i class="material-icons middle tab-material-icons">date_range</i>
                            </span> </a>
                        </li>
                        <li>
                            <a href="#profile" data-toggle="tab" title="Upload nota pembayaran" class="0503 0504">
                                <span class="round-tabs two">
                                    <i class="material-icons middle tab-material-icons">attach_money</i>
                                </span> 
                            </a>
                        </li>

                        <li class=""><a href="#settings" data-toggle="tab" title="Status permintaan" class="0505 0506 0507">
                            <span class="round-tabs four">
                                <i class="material-icons middle tab-material-icons">info</i>
                            </span> 
                        </a></li>

                        <li><a href="#doner" data-toggle="tab" title="completed" class="0508">
                            <span class="round-tabs five">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span> </a>
                        </li>

                    </ul>
                </div>
                
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">

                        <fieldset class="col-md-12">
                            <legend>Silahkan Upload dokumen awal</legend>
                            <div class="col-md-12">
                            
                                <table class="table table-hover table-bordered table-striped" id="kelengkapan-dokumen-perusahaan">
                                    <thead>
                                        <tr>
                                            <th>Dokumen</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>

                            </div>
                        </fieldset>

                    </div>
                    <div class="tab-pane fade" id="new_certification">
                        <h3 class="head text-center">Silahkan tambahkan sertifikasi</h3>
                            
                            <p class="narrow text-center">
                                Dokumen perusahaan telah lengkap, silahkan mulai menambahkan sertifikasi yang diminta oleh perusahaan dengan cara klik tombol hijau dibawah ini.
                            </p>
                            <p class="narrow text-center">
                                <a href="<?php echo site_url('certification/add/'.$company['id_company'].'/'.$kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi']) ?>" class=" btn btn-success btn-outline-rounded green" target="_blank"> Tambahkan sertifikasi </a>
                            </p>
                    </div>
                    
                    <div class="tab-pane fade" id="messages">
                        <?php if ( is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date']) ){ ?>
                            <h3 class="head text-center">Menunggu perusahaan melakukan konfirmasi tanggal pelaksanaan assessment</h3>
                            
                            <p class="narrow text-center">
                                Perusahaan belum melakukan konfirmasi tanggal pelaksanaan assessment. <br>
                                <button class="btn btn-primary">Kirim kembali email konfirmasi</button>
                            </p>

                        <?php }else{ ?>
                            <h3 class="head text-center">tanggal pelaksanaan assessment</h3>
                            <p class="narrow text-center">
                                Tanggal assessment untuk perusahaan <?php echo $company['company_name']; ?>
                            </p>
                            <p class="narrow text-center" style="    font-size: 30px; padding: 20px; background-color: beige; color: gray;">
                                <?php echo date('d F Y', strtotime( $kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date']) ); ?>
                            </p>
                            <p class="narrow text-center assessment_from_now" style="    font-size: 14px;">
                                <span class="badge"></span>
                            </p>
                        <?php } ?>

                    </div>

                    <div class="tab-pane container-fluid fade" id="settings_date">
                        <?php if ($request['a0']['pass_the_review'] < 1){ ?>
                            
                            <?php if ($request['a0']['pass_the_review'] == 0){ ?>
                            <div class="" id="section-acceptance">
                                
                                <h3 class="head text-center">Apakah LBBKKP menerima permintaan dari perusahaan <br> <?php echo $company['company_name'] ?> ? </h3>
                                <p class="narrow text-center">
                                    Silahkan klik tombol "Permintaan diterima" untuk melanjutkan kofigurasi. Pilih tombol "Permintaan ditolak" untuk tidak menerima permintaan
                                </p>
                                <center class="">
                                    
                                    <button onclick="$('#section-configuration, #section-acceptance').toggleClass('sr-only');" class="text-center margin-10 btn btn-success btn-outline-rounded green"> Terima Permintaan </button>
                                    <button onclick="$('#section-configuration-note, #section-acceptance').toggleClass('sr-only'); $('#section-configuration-note textarea').ckeditor()" class="text-center margin-10 btn btn-danger btn-outline-rounded"> Tolak Permintaan </button>
                                </center>
                            </div>

                            <?php }elseif ($request['a0']['pass_the_review'] == -1) { ?>
                            <div class="" id="section-acceptance">
                                
                                <h3 class="head text-center text-danger">Permintaan ini telah ditolak </h3>
                                <div class="alert alert-danger flat row">Silahkan check catatan yang berkaitan dengan permintaan ini dengan cara klik tombol "CATATAN" pada sidebar sebelah kiri.</div>
                                <p class="narrow text-center">
                                    Anda dapat mengaktifkan kembali permintaan ini dengan cara klik tombol "TERIMA PERMINTAAN" dibawah ini.
                                </p>
                                <center class="">
                                    <button onclick="$('#section-configuration, #section-acceptance').toggleClass('sr-only');" class="text-center margin-10 btn btn-success btn-outline-rounded green"> Terima Permintaan </button>
                                </center>
                            </div>
                            <?php } ?>
                            
                            <div class="sr-only" id="section-configuration-note">
                                <h3 class="head text-center">Silahkan isikan catatan kenapa anda menolak permintaan ini </h3>
                                 <p class="narrow text-center">
                                    Catatan ini akan dikirimkan ke perusahaan terkait untuk menjadi koreksi. 
                                </p>
                                <fieldset>
                                    <div class="form-group">
                                        <textarea class="form-control" name="a0_notes"></textarea>
                                    </div>
                                    <center>
                                        <a href="javascript: $('#section-configuration-note, #section-acceptance').toggleClass('sr-only');" class="text-center margin-10 btn btn-warning btn-outline-rounded"> Batal </a>
                                        <button class=" margin-10 btn btn-success btn-outline-rounded green" onclick="deny_request(event, <?php echo @$kelengkapan['kelengkapan_permintaan_sertifikasi']['id_a0'] ?>,-1)"> Simpan </button>
                                    </center>
                                </fieldset>
                            </div>
                            <div class="sr-only" id="section-configuration">
                                
                                <h3 class="head text-center">Silahkan konfigurasikan auditor dan jumlah hari audit</h3>
                                <p class="narrow text-center">
                                    Silahkan konfigurasikan jumlah hari audit, jumlah auditor yang dibutuhkan dan jumlah yang harus dibayarkan.
                                </p>
                                <div class="alert alert-warning"> Silahkan hitung secara manual untuk jumlah pembayaran yang harus dibayarkan oleh perusahaan lalu isikan jumlah nya pada form jumlah pembayaran yang ada di panel ini. </div>
                                <fieldset>
                                    <legend> Konfigurasi Jumlah hari audit dan auditor </legend>
                                    <?php 
                                        $this->load->view('assessment/pjt/assessment_pjt_company--days-audit-settings', array('id_a0' => $request['a0']['id_a0'], 'a0' => $request['a0']));
                                    ?>                        
                                    
                                </fieldset>

                                <fieldset>
                                    <legend> Konfigurasi jumlah pembayaran </legend>
                                    <p>
                                        <span> Jumlah yang dibayarkan sebesar : Rp.</span> <span class="preview-money"></span>,-
                                    </p>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="number" name="jumlah_pembayaran" class="form-control input-lg flat" placeholder="jumlah yang harus dibayarkan" style="background-color: beige;">
                                        </div>
                                    </div>
                                </fieldset>
                                <hr>
                                <div class="text-center">
                                    <center>
                                        <div class="alert alert-warning"> Dengan anda melakukan "SIMPAN KONFIGURASI" berarti anda telah menerima permintaan sertifikasi oleh perusahaan ini. <strong>Apakah anda yakin?</strong></div>
                                        <a href="javascript: $('#section-configuration, #section-acceptance').toggleClass('sr-only');" class="text-center margin-10 btn btn-warning btn-outline-rounded"> Batal </a>
                                        <button class=" margin-10 btn btn-success btn-outline-rounded green" onclick="accept_request(event, <?php echo @$kelengkapan['kelengkapan_permintaan_sertifikasi']['id_a0'] ?>,1)"> Simpan konfigurasi </button>
                                    </center>
                                </div>
                            </div>

                        <?php }elseif ($request['a0']['pass_the_review'] > 0) { ?>
                            <h3 class="head text-center">Jumlah auditor dan jumlah hari audit telah ditetapkan</h3>
                            <p class="narrow text-center">
                                Jumlah auditor dan jumlah hari telah ditetapkan. Sistem menunggu perusahaan melakukan pembayaran
                            </p>
                        <?php } ?>

                    </div>
                    
                    <div class="tab-pane fade" id="profile">

                        <?php if (is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice']) || count($payment) < 1){ ?>
                                
                            <h3 class="head text-center"> Menunggu konfirmasi pembayaran dari perusahaan </h3>
                            <p class="narrow text-center">
                                Menunggu konfirmasi pembayaran dari perusahaan.
                            </p>
                             <div class="text-center" style="">
                                 <div class="alert-place alert alert-danger flat"> Pembayaran belum dilakukan oleh perusahaan <br><button class="btn btn-danger btn-sm">Kirim ulang email konfirmasi</button> </div>
                            </div>

                        <?php }elseif($kelengkapan['kelengkapan_permintaan_sertifikasi']['status_paid'] == 0){ ?>


                            <h3 class="head text-center"> Pemeriksaan nota pembayaran </h3>
                            <p class="narrow text-center">
                                Nota anda telah kami terima dan sedang kami periksa. kami akan memberitahukan hasil dari pemeriksaan nota melalui email perusahaan.
                            </p>
                             <hr>
                            <p class="flex temporary-image" style="justify-content: space-around; flex-wrap: wrap;">
                                <?php foreach ($payment as $key => $value): ?>
                                    <img src="<?php echo site_url('application/clients/Companies/'.$company['id_company'].'/files/'.$value['file_name']) ?>" class="thumbnail" style="height: 100px;">
                                <?php endforeach ?>
                            </p>
                            <hr>
                            <div class="text-center" style="">
                                 <div class="alert-place alert alert-warning flat"> Nota sedang dalam pemeriksaan. silahkan tunggu </div>
                            </div>
                        <?php }else{?>
                             <h3 class="head text-center"> Nota pembayaran diterima </h3>
                            <p class="narrow text-center">
                                Nota anda telah kami terima.
                            </p>
                             <hr>
                            <p class="flex temporary-image" style="justify-content: space-around;  flex-wrap: wrap;">
                                <?php foreach ($payment as $key => $value): ?>
                                    <img src="<?php echo site_url('application/clients/Companies/'.$company['id_company'].'/files/'.$value['file_name']) ?>" class="thumbnail" style="height: 100px;">
                                <?php endforeach ?>
                            </p>
                            <hr>
                            <div class="text-center" style="">
                                 <div class="alert-place alert alert-info flat"> Nota pembayaran telah diterima </div>
                            </div>
                        <?php }?>

                    </div>

                    <div class="tab-pane fade " id="settings">
                        <h3 class="head text-center">Status permintaan!</h3>
                        <p class="narrow text-center">
                            Silahkan anda monitor panel ini untuk melihat proses sertifikasi yang sedang dilaksanakan.
                        </p>

                        <div class="col-md-12">
                            
                           <fieldset class="col-md-12">
                                <legend>Proses LSBBKKP</legend>
                                <div class="col-md-12">
                            
                                    <table class="table table-hover table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Dokumen</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($kelengkapan['detail_system'] as $key => $value): 
                                                $status = !is_null($value['id_files'])? '<span class="text-primary"> Sudah di unggah <i class="material-icons middle icon-active">check_circle</i> </span> <button class="btn btn-danger btn-xs" onclick="upload_dokumen(event, '.$kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'].','.$value['id_master_kelengkapan_permintaan'].', '.$company['id_company'].')">Ganti</button>'  : '<span class="text-danger"> <a href="#" class="text-danger" onclick="upload_dokumen(event, '.$kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'].','.$value['id_master_kelengkapan_permintaan'].', '.$company['id_company'].')"> Unggah file </a> <i class="material-icons middle icon-danger">error</i> </span>';
                                                $required = ($value['is_important'] == 1)? '<span class="text-danger">*) harus diisi</span>' : '';
                                            ?>
                                                <tr id="master-<?php echo $value['id_master_kelengkapan_permintaan'] ?>">
                                                    <td><?php echo $value['nama_dokumen'].' '.$required ?></td>
                                                    <td class="master-permintaan-status"><?php echo $status ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                            
                                        </tbody>
                                    </table>

                                </div>
                            </fieldset>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="doner">
                        <div class="text-center">
                            <i class="img-intro icon-checkmark-circle"></i>
                        </div>
                        <h3 class="head text-center">thanks for staying tuned! <span style="color:#f48260;">♥</span> Bootstrap</h3>
                        <p class="narrow text-center">
                            Lorem ipsum dolor sit amet, his ea mollis fabellas principes. Quo mazim facilis tincidunt ut, utinam saperet facilisi an vim.
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
</section>

<input type="file" class="sr-only" name="input_upload_kelengkapan_dokumen">
<input type="file" class="sr-only" name="input_upload_nota" accept="image/*">
<script type="text/javascript">
    function prepare_configuration_data_that_will_send(id_a0, pass_the_review)
    {

        var $risk       = $('[name="risk"]:checked').val(),
            $id_a0      = id_a0,
            $hari_audit = pass_the_review < 0? 0 : $('.audit_time').text(),
            $auditor    = pass_the_review < 0? 0 : $('.audit_auditor').text(),
            $pembayaran = pass_the_review < 0? 0 : $('[name="jumlah_pembayaran"]').val()

        if(pass_the_review > 0 )
        {

            if( $('[name="risk"]:checked').length < 1 
                || $hari_audit == '-' 
                || $auditor == '-' ) 
            {
                swal('error', 'Silahkan pilih Resiko terlebih dahulu!');
                return false;
            }else if($pembayaran == '')
            {
                swal('error', 'Silahkan isi jumlah yang harus dibayarkan oleh perusahaan terlebih dahulu!');
                return false;
            }
        }

        var data = {
            id_a0           : $id_a0,
            risk            : $risk,
            audit_days      : $hari_audit,
            pembayaran      : $pembayaran,
            auditor_need    : $auditor,
            pass_the_review : pass_the_review,
        }

        return data;
    }

    function accept_request(event, id_a0, pass_the_review)
    {
        event.preventDefault();
        var deff = $.Deferred();
        swal({
            title: 'Simpan konfigurasi',
            text: 'Aksi ini akan menyimpan jumlah hari audit, auditor, dan jumlah yang dibayarkan. apakah anda ingin melanjutkan?',
            type: 'warning',
            closeOnConfirm: false,
            showCancelButton: true,
            allowEscapeKey: false,
        }, function(callback){
            if(callback)
            {
                deff.resolve();
            }
        })

        $.when(deff.promise())
        .done(function(){
            var data = prepare_configuration_data_that_will_send(id_a0, pass_the_review)
            save_configuration(data)
        })

    }
    function deny_request(event, id_a0, pass_the_review)
    {
        event.preventDefault();
        var deff = $.Deferred();
        swal({
            title: 'Tolak permintaan',
            text: 'Apakah anda yakin menolak permintaan ini?',
            type: 'warning',
            closeOnConfirm: false,
            showCancelButton: true,
            allowEscapeKey: false,
        }, function(callback){
            if(callback)
            {
                deff.resolve();
            }
        })

        $.when(deff.promise())
        .done(function(){
            var data        = prepare_configuration_data_that_will_send(id_a0, pass_the_review)
            data['notes']   = $('[name="a0_notes"]').val();
            save_configuration(data)
        })
    }

    function save_configuration(data)
    {
        swal({
            title: 'Menyimpan',
            text: 'Silahkan tunggu',
            allowEscapeKey: false,
            showConfirmButton: false
        })
        $.post(site_url('assessment/update_precertification'), data )
        .done(function(res){
            console.log(res)
        
            Snackbar.show('Update sertifikasi selesai')
            swal('success', 'Permintaan telah diperbarui', 'success');
            // SEND EVENT TRIGGER AND SAVE NOTIFICATION
            Notify.send({notification_for_level:<?php echo $company['company_level'] ?>, notification_for_user: <?php echo $company['id_company'] ?>, notification_text: 'PJT telah melakukan konfirmasi tentang permintaan anda. Silahkan anda buka halaman permintaan anda'})
            .done(function(){
                // JUST SEND EVENT TRIGGER
                window.notif.send('update/tracker')
                window.location.reload();
            })         
            // nav.back();
        })
        .fail(function(res){
            swal('Proses gagal', 'konfigurasi gagal disimpan.', 'error')
            console.log(res)
        
        })
    }
    function upload_dokumen(e, id_permintaan_sertifikasi ,id_master_kelengkapan_permintaan, id_company)
    {
        e.preventDefault();
        var $input = $('[name="input_upload_kelengkapan_dokumen"]');
        $input.trigger('click');
        $input.data({
            id_permintaan_sertifikasi : id_permintaan_sertifikasi,
            id_master_kelengkapan_permintaan : id_master_kelengkapan_permintaan,
            id_company: id_company
        })
        window.target = e
    }

    function upload_nota_pembayaran(e)
    {
        e.preventDefault();
        $('[name="input_upload_nota"]').trigger('click')
    }

    function simpan_nota_pembayaran(e, id_a0)
    {
        e.preventDefault();

        $(e.target).text('menyimpan nota...').prop('disabled',true)
        
        $.Upload.submit({
            url: site_url('certification/process/upload/bukti_pembayaran'),
            data: {id_a0: id_a0}
        })
        .done(function(res){
            console.log(res)

            $(e.target).text('Simpan bukti pembayaran').prop('disabled',false).addClass('sr-only')
            $(e.target).siblings().addClass('sr-only')
            // Snackbar.show('Nota telah berhasil di unggah')
            $('.alert-place').html('<div class="alert alert-warning"> Nota telah disimpan! </div>')
            tracker_status(<?php echo $company['id_company'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'] ?>);
        
        })

        // Snackbar.manual({message: 'Mengunggah nota pembayaran', spinner:true})
        window.setTimeout(function() {
        }, 5000);
    }

    function tracker_status(id_company, id_permintaan_sertifikasi)
    {
        $('.tab-tracker li a').removeClass('disabled')
        $.post( site_url('certification/get_status_pengajuan/'+id_company+'/'+id_permintaan_sertifikasi) )
        .done(function(res){
            console.log(res)
            res = JSON.parse(res);
            var classes = (res._state == 'system')? 'label-primary' : 'label-danger';
            $('.label-tracker-status')
            .removeClass('label-primary label-danger')
            .addClass(classes)
            .text(res.status);

            $('.tab-tracker').find('.'+res._code).tab('show')

            // DISABLE ALL TAB SIBLINGS NEXT THIS TAB * NOT NEEDED ON ADMIN PAGE
            $('.'+res._code).closest('li').nextAll().each(function(){
                $(this).find('a').addClass('disabled')
            })

        })
    }

    function get_kelengkapan_dokumen(id_company, id_permintaan_sertifikasi)
    {
        $.post(site_url('certification/get_kelengkapan_dokumen'),{id_company: id_company, id_permintaan_sertifikasi: id_permintaan_sertifikasi})
        .done(function(res){ 
            res = JSON.parse(res)
            var target = $('#kelengkapan-dokumen-perusahaan tbody')
            target.find('tr').remove();

            $.each(res.detail_kelengkapan_permintaan_sertifikasi, function(a,b){

                var $confirm        = b.status_kelengkapan <= 0 && b.id_files? ' <button onclick="confirm_document('+b.id_detail_permintaan_sertifikasi+', '+b.id_a0+', 1, '+b.id_files+', \''+b.nama_dokumen+'\')" class="btn btn-primary btn-xs"> Terima </button> <button onclick="confirm_document('+b.id_detail_permintaan_sertifikasi+', '+b.id_a0+', -1, '+b.id_files+', \''+b.nama_dokumen+'\')" class="btn btn-danger btn-xs"> Tolak </button> ' : ' <button onclick="confirm_document('+b.id_detail_permintaan_sertifikasi+', '+b.id_a0+', 0, '+b.id_files+', \''+b.nama_dokumen+'\')" class="btn btn-danger btn-xs"> Batal Terima</button> ';
                var $status         = b.id_files ? $confirm : '<span class="text-danger"> belum di unggah <i class="material-icons middle icon-danger">error</i> </span>';
                var $required       = (b.is_important == 1)? '<span class="text-danger">*) harus diisi</span>' : '';
                var $urlDownload    = b.id_files? '<a href="'+site_url('files/download_file/'+b.id_files)+'" class="btn btn-warning btn-xs"> unduh <span class="glyphicon glyphicon-download"></span> </a>' : '';
                
                var template    = '<tr id="master-'+b.id_master_kelengkapan_permintaan+'">'
                                +'<td>'+b.nama_dokumen+' '+$required+'</td>'
                                +'<td class="master-permintaan-status">'
                                +$status
                                +$urlDownload
                                +'</td>'
                                +'</tr>'
                $(target).append(template);
            })
        })
    }

    function get_catatan_a0(id_a0)
    {
        $.post(site_url('certification/get_catatan_a0'),{id_a0: id_a0})
        .done(function(res){
            var records  = JSON.parse(res);
            var template = '<div class="list-group-item row flat">'
                            +'<div class="form-group">'
                            +'<span class="text-muted pull-right btn-xs"> <span class="sidebar-notes--time-inserted"> ::notes_addtime::  </span> <i class="material-icons btn-xs middle">access_time</i>'
                            +'</div>'
                            +'<div class="sidebar-notes--subject text-primary" style="margin-bottom: 5px;">'
                            +'Subject : <br> <strong> ::notes_subject:: </strong>'
                            +'</div>'
                            +'<div class="sidebar-notes--subject">'
                            +'::notes_content::'
                            +'</div>'
                            +'</div>'
            Tools.write_data({
                template: template,
                target: $('.sidebar-notes'),
                overwrite: true,
                records: records,
            })
            .done(function(){
                // CHANGE NOTES TIME AS HUMAN READABLE
                $('.sidebar-notes--time-inserted').each(function(){
                    var text    = $(this).text();
                    var readable= moment(text).fromNow();
                    $(this).text(readable)
                })
                $('.sidebar-tab.tab-catatan span.badge').text(records.length)
            })
        })

    }

    function confirm_document(id_detail_permintaan_sertifikasi, id_a0, status, id_files, requirement_name)
    {
        var deff = $.Deferred();
        if(status < 0)
        {
            swal({
                title           : 'Tolak dokumen ini?',
                text            : 'Silahkan isikan alasan anda menolak dokumen ini',
                showCancelButton: true, 
                allowEscapeKey  : false,
                animation       : "slide-from-top",
                inputPlaceholder: "Alasan anda menolak",
                type            : 'input',
            }, function(res){
                if(res)
                {
                    deff.resolve(res)
                    Notify.send({notification_for_level:<?php echo $company['company_level'] ?>, notification_for_user: <?php echo $company['id_company'] ?>, notification_text: 'LSBBKKP Menolak dokumen anda. Silahkan check catatan anda untuk melihat catatan terakhir.'})
                    .done(function(){
                       window.notif.send('update/tracker/catatan')
                    })
                    
                }
            })
        }else
        {
            deff.resolve();
        }

        $.when(deff.promise())
        .done(function(alasan){
            $.post(site_url('certification/update_status_detail_kelengkapan_dokumen'),{requirement_name: requirement_name, id_a0: id_a0, id_detail_permintaan_sertifikasi: id_detail_permintaan_sertifikasi, status: status, id_files: id_files, notes: alasan})
            .done(function(res){
                console.log(res)
                get_kelengkapan_dokumen(<?php echo $company['id_company'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'] ?>);
                get_catatan_a0(<?php echo $request['a0']['id_a0'] ?>);
            })
        })

    }
    $(document).ready(function(){
        
        // TRACKER STATUS
        tracker_status(<?php echo $company['id_company'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'] ?>);
        get_kelengkapan_dokumen(<?php echo $company['id_company'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'] ?>);
        
        // ambil catatan
        get_catatan_a0(<?php echo $request['a0']['id_a0'] ?>);
        

        $('.assessment_date').fdatepicker({
            leftArrow: '<i class="material-icons">keyboard_arrow_left</i>',
            rightArrow: '<i class="material-icons">keyboard_arrow_right</i>',
        });

        $('[name="input_upload_kelengkapan_dokumen"]').on('change', function(){
            var $this = $(this);

            $.Upload( $this )
            .done(function(res){
                console.log(res);
                $.Upload.submit({
                    url: site_url('certification/insert_kelengkapan_dokumen'),
                    data: $this.data()
                })
                .done(function(res){
                    $this.val('');
                    $('#master-'+$this.data('id_master_kelengkapan_permintaan')).find('.master-permintaan-status').html('<span class="text-primary"> Sudah di unggah <i class="material-icons middle icon-active">check_circle</i> </span>')
                })
            })
        })

        $('[name="input_upload_nota"]').on('change', function(){
            var $this = $(this);

            $.Upload( $this )
            .done(function(res){
                $.Upload.read_image($this[0])
                .done(function(img){
                    $('.img-nota').removeClass('sr-only')
                    $('.img-nota').attr('src', img.target.result)
                    $this.val('');
                    $('.btn-save-nota').removeClass('sr-only')
                })
            })
        })

        
        $(document).on('show.bs.tab', 'a.disabled[data-toggle="tab"]', function (e) {
            e.preventDefault();
            e.target // newly activated tab
            e.relatedTarget // previous active tab
            $(e.relatedTarget).tab('show');
            swal('Kesalahan', 'tidak dapat membuka panel ini. silahkan lengkapi terlebih dahulu panel sebelumnya.', 'error')
        })

        $('.assessment_from_now span').html('Assessment akan dilaksanakan '+ moment('<?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date'] ?>').fromNow() );

        $('a[title]').tooltip();

        $('[name="jumlah_pembayaran"]').on('input', function(){
            var value = $(this).val(), currency;
            if(value == '')
            {
                currency = '-';
            }else{
                currency = parseInt(value).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
            }
            $('.preview-money').text(currency)
        })

        // READ EVENT SOCKET IO
        notif.listen('update/dokumen_pengajuan', function(data){
            tracker_status(<?php echo $company['id_company'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'] ?>);
            get_kelengkapan_dokumen(<?php echo $company['id_company'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'] ?>);
        });

        notif.listen('update/tracker', function(data){
            tracker_status(<?php echo $company['id_company'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'] ?>);
        })  

        // READ SOCKET IO
        notif.listen('update/tracker/catatan', function(data){
            get_catatan_a0(<?php echo $request['a0']['id_a0'] ?>);
        })  
    })

</script>


   