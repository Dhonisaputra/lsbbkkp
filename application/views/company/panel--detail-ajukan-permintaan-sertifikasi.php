<?php echo $this->load->component('js', 'jsdata/jsdata.upload.js') ?>
<?php echo $this->load->component('js', 'plugins/foundation_datepicker/js/foundation-datepicker.min.js') ?>
<?php echo $this->load->component('css', 'plugins/foundation_datepicker/css/foundation-datepicker.min.css') ?>

<?php echo $this->load->component('css', 'plugins/fullcalendar/fullcalendar.min.css') ?>
<?php echo $this->load->component('js', 'plugins/fullcalendar/fullcalendar.min.js') ?>

<?php echo $this->load->component('css', 'css/bootstrap.tab-round-2.css') ?>
<style type="text/css">
    .fc-sun {
        background-color: #e89479 !important;
        border-color: white !important;
    }
    .scheduled--fullcalendar
    {
        background-color: #E87E04 !important;
        border-color: #F4B350 !important;
        padding: 5px;
    }
    .event--rendered
    {
        background: #A2DED0 !important;
        border-color: white !important;
    }
    .no-event--rendered
    {
        background: #EC644B !important;
        border-color: white !important;
    }
</style>
<input type="hidden" name="is_paid" value="<?php echo (is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice']) || count($payment) < 1 || $kelengkapan['kelengkapan_permintaan_sertifikasi']['status_paid'] < 1)? 0 : 1; ?>">

<section class="col-md-3" style="background: #fff; height: 100vh;">
    <section class="navbar">
        <button onclick="$('.sidebar-detail, .sidebar-notes').toggleClass('sr-only'); $('.sidebar-tab').toggleClass('btn-primary');" class="sidebar-tab mdl-button mdl-js-button btn-primary"> Detail </button>
        <button onclick="$('.sidebar-detail, .sidebar-notes').toggleClass('sr-only'); $('.sidebar-tab').toggleClass('btn-primary');" class="sidebar-tab mdl-button mdl-js-button tab-catatan"> Catatan <span class="badge"><?php echo count($notes) ?></span> </button>
    </section>

    <div class="sidebar-detail" style="margin-top: 5vh; ">    
        <fieldset>
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
                    <li class="list-group-item">Status : <span class="label label-primary label-tracker-status"><?php echo @$status ?></span></li>
                   
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
    
    <div class="sidebar-notes sr-only list-group"></div>

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
                            <a href="#home" data-toggle="tab" title="Upload dokumen kelengkapan sertifikasi" class="0500 0501">
                                <span class="round-tabs one">
                                    <i class="material-icons middle tab-material-icons">backup</i>
                                </span> 
                            </a>
                        </li>
                        <li><a href="#messages" data-toggle="tab" title="Pilih tanggal kesiapan" class="0502 0503 05021">
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

                        <li class=""><a href="#settings" data-toggle="tab" title="Dokumen hasil assessment" class="0505 0506 0507">
                            <span class="round-tabs four">
                                <i class="material-icons middle tab-material-icons">info</i>
                            </span> 
                        </a></li>

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
                                        <?php 
                                            foreach ($kelengkapan['detail_kelengkapan_permintaan_sertifikasi'] as $key => $value): 
                                            $status = isset($value['id_files']) && !is_null($value['id_files'])? '<span class="text-primary"> Sudah di unggah <i class="material-icons middle icon-active">check_circle</i> </span>' : '<span class="text-danger"> <a href="#" class="text-danger" onclick="upload_dokumen(event, '.$kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'].','.$value['id_master_kelengkapan_permintaan'].', '.$company['id_company'].')">belum di unggah</a> <i class="material-icons middle icon-danger">error</i> </span>';
                                            $required = ($value['is_important'] == 1)? '<strong class="text-danger">*) Wajib diisi</strong>' : '';
                                            $classes = isset($value['id_files']) && !is_null($value['id_files'])? '' : 'not-uploaded';
                                            $classes_required = ($value['is_important'] == 1)? 'document-required' : '';
                                        ?>
                                            <tr id="master-<?php echo $value['id_master_kelengkapan_permintaan'] ?>" class="dokumen-perusahaan <?php echo $classes.' '.$classes_required ?>">
                                                <td><?php echo $value['nama_dokumen'].' '.$required ?></td>
                                                <td class="master-permintaan-status"><?php echo $status ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        
                                    </tbody>
                                </table>

                            </div>
                        </fieldset>
                    </div>
                    
                    <div class="tab-pane fade" id="messages">
                       
                        <?php if ( is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date']) ){ ?>
                            <h3 class="head text-center">Silahkan pilih tanggal pelaksanaan assessment</h3>
                            
                            <p class="narrow text-center">
                                Silahkan pilih tanggal kesanggupan dilaksanakannya assessment pada perusahaan anda. Proses sertifikasi akan kembali diproses setelah perusahaan melakukan konfirmasi dilaksanakannya assessment. 
                                
                            </p>

                            <div id="datetimepicker-container" class="flex flex-center">
                                <form type="post" class="flex flex-center form-inline" action="<?php echo site_url('assessment/process/confirmation/date') ?>" name="formsubmitAssessmentDate" id="formsubmitAssessmentDate">
                                    <input type="hidden" name="action" value="assessment_date">
                                    <input type="hidden" name="id_company" value="<?php echo $request['a0']['id_company']; ?>">
                                    <input type="hidden" name="token" value="<?php echo $request['a0']['token']; ?>">
                                    <input type="hidden" name="id_a0" value="<?php echo $request['a0']['id_a0']; ?>">
                                </form>
                            </div>
                            <hr>
                            <?php if (is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice']) || count($payment) < 1 || $kelengkapan['kelengkapan_permintaan_sertifikasi']['status_paid'] < 1){ ?>
                            
                                <div class="alert alert-danger flat">
                                    <strong class="text-uppercase">perhatian!</strong><br>
                                    Anda tidak dapat memilih tanggal assessment dari tabel di bawah ini sebelum anda melakukan pembayaran. Anda hanya dapat melihat apakah tanggal yang anda kehendaki tersedia atau tidak.
                                    <br>
                                    <button class="btn btn-flat btn-danger" href="#profile" data-toggle="tab" onclick="$('.0502[href=\'#messages\']').parent('li').removeClass('active')"> Lakukan pembayaran <i class="material-icons middle">chevron_right</i> </button>
                                </div>

                            <?php } ?>
                            <div class="col-md-12">
                                <div id="fullcalendar"></div>
                            </div>
                            
                            <p class="text-center">
                                <button class="btn btn-success btn-outline-rounded green" name="" form="formsubmitAssessmentDate" type="submit"> Konfirmasi tanggal </button>
                            </p>
                        <?php }else{ ?>
                            <h3 class="head text-center">tanggal pelaksanaan assessment</h3>
                            <p class="narrow text-center">
                                Tanggal assessment untuk perusahaan anda 
                            </p>
                            <p class="narrow text-center" style="    font-size: 30px; padding: 20px; background-color: beige; color: gray;">
                                <?php echo date('d F Y', strtotime( $kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date']) ); ?>
                            </p>
                            <p class="narrow text-center assessment_from_now" style="    font-size: 14px;">
                                <span class="badge"></span>
                            </p>
                           


                        <?php } ?>
                    </div>

                    <div class="tab-pane fade" id="profile">

                        <?php if (is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice']) || count($payment) < 1 || $kelengkapan['kelengkapan_permintaan_sertifikasi']['status_paid'] < 1){ ?>
                                
                            <h3 class="head text-center">Silahkan upload nota pembayaran </h3>
                            <p class="narrow text-center">
                                Silahkan lakukan pembayaran untuk sertifikasi ini. Proses sertifikasi akan kembali diproses setelah perusahaan melaporkan bukti pembayaran melalui panel ini.
                            </p>

                            <hr>
                                <p class="flex temporary-image" style="justify-content: space-around; flex-wrap: wrap;"></p>
                            <hr>

                            <p class="text-center">
                                <center><img src="" class="img-responsive img-nota sr-only" width="200px"></center>
                            </p>
                            <div class="text-center" style="">
                                <center>
                                    <button class="block margin-10 btn btn-success btn-outline-rounded green" onclick="upload_nota_pembayaran(event)"> Upload bukti pembayaran </button>
                                    <button class="block margin-10 btn btn-outline-rounded btn btn-primary sr-only btn-save-nota" onclick="simpan_nota_pembayaran(event, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_a0'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice'] ?>)"> Simpan bukti pembayaran </button>
                                    <a href="#" class="block">Detail pembayaran</a>
                                </center>
                                 <div class="alert-place"></div>
                            </div>

                        <?php }elseif($kelengkapan['kelengkapan_permintaan_sertifikasi']['status_paid'] == 0){ ?>


                            <h3 class="head text-center"> Pemeriksaan nota pembayaran </h3>
                            <p class="narrow text-center">
                                Nota anda telah kami terima dan sedang kami periksa. kami akan memberitahukan hasil dari pemeriksaan nota melalui email perusahaan.
                            </p>
                            
                            <hr>
                            <p class="flex temporary-image" style="justify-content: space-around;  flex-wrap: wrap;">
                                <?php foreach ($payment as $key => $value): ?>
                                    <img src="<?php echo site_url('application/clients/Companies/'.$company['id_company'].'/files/'.$value['file_name']) ?>" class="thumbnail" style="height: 100px;">
                                <?php endforeach ?>
                            </p>
                            <hr>
                             <p class="text-center">
                                <center><img src="" class="img-responsive img-nota sr-only" width="200px"></center>
                            </p>
                            <div class="text-center" style="">
                                <center>
                                    <button class="block margin-10 btn btn-success btn-outline-rounded green" onclick="upload_nota_pembayaran(event)"> Upload bukti pembayaran </button>
                                    <button class="block margin-10 btn btn-outline-rounded btn btn-primary sr-only btn-save-nota" onclick="simpan_nota_pembayaran(event, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_a0'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice'] ?>)"> Simpan bukti pembayaran </button>
                                </center>
                            </div>
                            <div class="alert-place text-center">
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
                            Silahkan anda monitor halaman ini untuk mengetahui dokumen yang telah diterbitkan. 
                        </p>
                        <p class="narrow text-center">
                            Anda dapat mengetahui status sertifikat yang akan diterbitkan pada halaman admin perusahaan. untuk menuju halaman admin perusahaan, silahkan klik tautan berikut <a href="<?php echo site_url() ?>"> Menuju Halaman admin</a>
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
                                            $status = !is_null(@$value['id_files'])? '<span class="text-primary"> Selesai <i class="material-icons middle icon-active">check_circle</i> </span> <a href="'.site_url('files/download_file/'.$value['id_files']).'" class="btn btn-primary btn-xs">Download</a>'  : '<span class="text-danger"> Proses  <i class="material-icons middle icon-danger">error</i> </span>';
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

<div id="snackbarTemp" class="mdl-snackbar mdl-js-snackbar" style=""> 
    <div class="mdl-spinner mdl-js-spinner is-active sr-only" style="margin-top: 9px;margin-left: 7px;"></div>
    <div class="mdl-snackbar__text"></div> 
    <button type="button" class="mdl-snackbar__action"></button> 
</div>

<input type="file" class="sr-only" name="input_upload_kelengkapan_dokumen">
<input type="file" class="sr-only" name="input_upload_nota" accept="image/*">
<script type="text/javascript">
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

    function simpan_nota_pembayaran(e, id_a0, id_invoice)
    {
        e.preventDefault();

        $(e.target).text('menyimpan nota...').prop('disabled',true)
        
        $.Upload.submit({
            url: site_url('certification/process/upload/bukti_pembayaran'),
            data: {id_a0: id_a0, id_invoice: id_invoice}
        })
        .done(function(res){

            // SEMBUNYIKAN TOMBOL SIMPAN NOTA
            $(e.target).text('Simpan bukti pembayaran').prop('disabled',false).addClass('sr-only')
            // SEMBUNYIKAN IMG
            $('.img-nota').addClass('sr-only')
            // COPY IMG DAN APPEND KE .TEMPORARY-IMAGE
            var src = $('.img-nota').attr('src');
            $('.temporary-image').append('<img src="'+src+'" class="thumbnail img-responsive margin-10" style="height:100px;" >')

            $('.alert-place').html('<div class="alert alert-warning"> Nota telah disimpan! </div>')
            
            tracker_status(<?php echo $company['id_company'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'] ?>);

            Notify.send({notification_for_level: 5, notification_text: cookie.username+' telah melakukan konfirmasi pembayaran. '})
            .done(function(){
                window.notif.send('update/akuntansi/pembayaran')
            })
            
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

            // DISABLE ALL TAB SIBLINGS NEXT THIS TAB
            $('.'+res._code).closest('li').nextAll().each(function(){
                $(this).find('a').addClass('disabled')
            })

        })
    }
    function pilihSlotJadwal(e, ui)
    {
        
    }
    function getDisplayedCalendar(calendar){
      return $(calendar).fullCalendar('getDate');
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

    $(document).ready(function(){

         // ambil catatan
        get_catatan_a0(<?php echo $request['a0']['id_a0'] ?>);

        // SET LANGUAGE MOMENT INTO INDONESIAN LANGUAGE
        moment.locale('id')

        // CHANGE NOTES TIME AS HUMAN READABLE
        $('.sidebar-notes--time-inserted').each(function(){
            var text    = $(this).text();
            var readable= moment(text).fromNow();
            $(this).text(readable)
        })

        // UPDATE TRACKER STATUS
        tracker_status(<?php echo $company['id_company'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'] ?>);

        // CHANGE TEXT WITH READABLE TIME
        $('.assessment_from_now span').html('Assessment akan dilaksanakan '+ moment('<?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date'] ?>').fromNow() );

        // ACTIVATE TITLE ROUND MENU TOOLTIP
        $('a[title]').tooltip();

        // FULLCALENDAR.JS RENDERED WHEN TAB #MESSAGES SHOWN
        $('a[href="#messages"][data-toggle="tab"]').on('shown.bs.tab', function (e) {
            // CAN BE ADD AFTER THIS DAY
            var MINIMUM_CAN_BE_ADD = 3; // days

            // DEFINE ELEMENT
            var $calendar = $('#fullcalendar');
            // RENDER FULLCALENDAR
            $calendar.fullCalendar({
                // SHOW FIRST DAY IS SUNDAY
                firstDay: 1,
                // put your options and callbacks here
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month'
                },
                overlap: false,
                // EVENTS WHEN FULLCALENDAR SHOWN / WHEN CHANGE MONTH
                events: function(start, end, timezone, callback){
                    var cal = getDisplayedCalendar($calendar);
                    var start = moment();
                    var today = start.format('YYYY-MM-DD');
                    var aftarMinimumDate = moment().add(MINIMUM_CAN_BE_ADD,'days').format('YYYY-MM-DD');
                    var diff = moment(aftarMinimumDate).diff(today, 'days')
                    var CakeData = Cookies.getJSON('client')

                    start.add(1, 'd');
                    for (var i = 1; i < diff; i++) {
                        var dataToFind = start.format('YYYY-MM-DD');
                        $("td[data-date='"+dataToFind+"']").addClass('no-event--rendered')
                        $("td[data-date='"+dataToFind+"']").append('<div class="content"> <i class="material-icons text-danger" style="color:white;">clear</i> <br> <span style="color:white; font-size:12px;">Silahkan pilih selain hari ini.</span> </div>')
                        start.add(1, 'd');
                    }

                    if(CakeData)
                    {
                        CakeData = CakeData.assessment_date;
                        var events = [];
                        events.push({
                            id:'temporary', 
                            title: '', 
                            start: CakeData.start, 
                            end: CakeData.end,                            
                            backgroundColor: 'rgba(255,255,255,0)',
                            borderColor: 'rgba(255,255,255,0)',
                            textColor: 'rgb(255,255,255)',
                        });
                        callback(events);
                    }

                    // GET AVAILABLE DATE AND WRITE IN CALENDAR
                    /*$.post( site_url('assessment/get_available_date'), {startDate: cal.format('YYYY/MM'), finishDate: cal.format('YYYY/MM'), id_a0: <?php echo $request['a0']['id_a0']; ?> } )
                    .done(function(res){
                        res = JSON.parse(res);
                        var events = [];
                        $.each(res, function(a,b){
                            events.push({
                                id: 'scheduled-'+a,
                                start: b.startDate,
                                end: b.finishDate,
                                className: 'scheduled--fullcalendar',
                                title: b.title+' ( '+b.length+' hari )',
                                priority: 5,
                            });
                        })
                        callback(events);
                    })*/
                },
                // EVENT WHEN DAY CLICK. ITS WILL FIRE CREATE NEW EVENT.
                dayClick: function(date, jsEvent, view) {

                    var isSameOrAfter = moment(date.format('YYYY-MM-DD')).isSameOrAfter(moment().add(MINIMUM_CAN_BE_ADD, 'days').format('YYYY-MM-DD')); // true
                    if(!isSameOrAfter)
                    {
                        if(  moment(date.format('YYYY-MM-DD')).isAfter(moment().format('YYYY-MM-DD')) )
                        {
                            swal('kesalahan', 'Anda tidak boleh memilih '+MINIMUM_CAN_BE_ADD+' setelah hari ini. silahkan pilih tanggal yang tidak terdapat tanda silang.', 'error')
                        }else
                        {
                            swal('kesalahan', 'Tidak diperbolehkan memilih tanggal yang telah terlewat. ', 'error')
                        }
                        return false;
                    }

                    Snackbar.manual({message: 'Melihat ketersediaan', spinner:true})
                    
                    $.post( site_url('assessment/get_forecasting_schedule') ,{length: <?php echo isset($request['a0_cat'][0]['a0_cat_audit_length'])? $request['a0_cat'][0]['a0_cat_audit_length'] : 0 ?>, startDate: date.format('YYYY-MM-DD'), id_a0: <?php echo $request['a0']['id_a0']; ?> })
                    .done(function(res){

                        res = JSON.parse(res);
                        if(!res.is_available)
                        {
                            swal('Tanggal tidak diperbolehkan', 'Anda tidak dapat memilih tanggal ini. kemungkinan karena tidak tersedianya auditor. silahkan memilih tanggal lain.', 'error')
                            Snackbar.show('Gagal menambah event')
                            return false;
                        }

                        $calendar.fullCalendar('removeEvents', 'temporary');
                        var startDate = res.records.work_days.shift();
                        var lastDate = (res.records.work_days.length > 0)? moment(res.records.work_days.pop()).add(1,'days').format('YYYY-MM-DD') : startDate;
                        $calendar.fullCalendar('renderEvent', {
                            id:'temporary', 
                            title: '', 
                            start: startDate, 
                            end: lastDate,                            
                            backgroundColor: 'rgba(255,255,255,0)',
                            borderColor: 'rgba(255,255,255,0)',
                            textColor: 'rgb(255,255,255)',

                        })
                        
                    })
                },
                // EVENT FIRE AFTER DAYCLICK DONE
                eventRender: function(event, element, view)
                {
                    Snackbar.show('Event telah dibuat')
                    $('.event--rendered').each(function(){
                        $(this).removeClass('event--rendered')
                        $(this).find('.content').remove()
                    });
                    var mStart = moment(event.start);
                    var start = mStart.format('YYYY-MM-DD');
                    var end = moment(event.end).isValid()? moment(event.end).format('YYYY-MM-DD') : start;

                    if(moment(event.end).isValid())
                    {
                        console.log(element)    

                        var diff = moment(event.end).diff(mStart, 'days')
                        for (var i = 0; i < diff; i++) {
                            var dataToFind = mStart.format('YYYY-MM-DD');
                            $("td[data-date='"+dataToFind+"']").addClass('event--rendered')
                            $("td[data-date='"+dataToFind+"']").append('<div class="content"> <i class="material-icons pull-left">turned_in</i> </div>')
                            mStart.add(1, 'd');
                        }
                        /*while( start != end ){
                        }*/
                    }else{
                        $("td[data-date='"+start+"']").addClass('event--rendered')
                    }

                    // SAVE TO COOKIES
                    Cookies.set('client', {assessment_date: {start: start, end: end } } );
                },

            })
        })

        $('.assessment_date').fdatepicker({
            format: 'yyyy-mm-dd',
            leftArrow: '<i class="material-icons">keyboard_arrow_left</i>',
            rightArrow: '<i class="material-icons">keyboard_arrow_right</i>',
            startView: 'year',
            minView: 'year',
            format: 'yyyy/mm'
        });

        // READ WHEN INPUT UPLOAD KELENGKAPAN DOKUMEN CHANGED
        $('[name="input_upload_kelengkapan_dokumen"]').on('change', function(){
            var $this = $(this);

            $.Upload( $this )
            .done(function(res){
                $.Upload.submit({
                    url: site_url('certification/insert_kelengkapan_dokumen'),
                    data: $this.data()
                })
                .done(function(res){

                    $this.val('');
                    $('#master-'+$this.data('id_master_kelengkapan_permintaan')).find('.master-permintaan-status').html('<span class="text-primary"> Sudah di unggah <i class="material-icons middle icon-active">check_circle</i> </span>')
                    $('#master-'+$this.data('id_master_kelengkapan_permintaan')).toggleClass('not-uploaded')
                    var isRequired = $('#master-'+$this.data('id_master_kelengkapan_permintaan')).hasClass('document-required')
                    
                    tracker_status(<?php echo $company['id_company'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'] ?>);
                    

                    // TRIGGER TRACKER TO UPDATE DATA DOKUMEN PENGAJUAN
                    window.notif.send('update/dokumen_pengajuan')

                    if( isRequired && $('#kelengkapan-dokumen-perusahaan .not-uploaded.document-required').length == 0 )
                    {
                        Notify.send({notification_for_level:3, notification_text: cookie.username+' telah melengkapi dokumen perusahaan. '})
                    }
                })
            })
        })

        // WHEN INPUT UPLOAD NOTA READ THERE ARE CHANGE IN VALUE
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

        // WHEN DISABLED ROUND MENU CLICKED
        $(document).on('show.bs.tab', 'a.disabled[data-toggle="tab"]', function (e) {
            e.preventDefault();
            e.target // newly activated tab
            e.relatedTarget // previous active tab
            $(e.relatedTarget).tab('show');
            console.log(e)
            swal('Kesalahan', 'tidak dapat membuka panel ini. silahkan lengkapi terlebih dahulu panel sebelumnya.', 'error')
        })

        // READ FORM WHEN SUBMITTED
        $('#formsubmitAssessmentDate').on('submit', function(event){
            event.preventDefault();
            var events = $('#fullcalendar').fullCalendar('clientEvents','temporary')[0]
            var startDate = events.start.format('YYYY/MM/DD')
            

            var is_paid = $('[name="is_paid"]').val(),
                form = $(this)

            if(is_paid < 1)
            {
                swal('Silahkan lakukan pembayaran', 'Anda tidak dapat melakukan proses ini. silahkan lakukan pembayaran terlebih dahulu untuk dapat memilih jadwal yang tersedia.', 'error')
                return false;
            }



            var data = $(form).serializeArray(), 
                action = $(form).attr('action');
            data.push({name: 'assessment_date', value: startDate})
            // console.log(data); return false
            
            var assessment_date = data.filter(function(res){
                return res.name == 'assessment_date'
            })[0]

            if(assessment_date.value === '')
            {
                swal('Isikan tanggal assessment','Silahkan isi tanggal dilaksanakan assessment! Tanggal assessment tidak boleh dibiarkan kosong', 'error');
                return false;
            }
            // console.log(data);return false;

            swal({
                'title': 'Menyimpan tanggal assessment',
                'text': 'Aksi ini akan menyimpan tanggal assessment untuk jadwal ini. Silahkan cek apakah tanggal yang anda isikan sudah benar karena halaman ini tidak dapat diakses kembali setelah tanggal diupdate.',
                type: 'warning',
                showCancelButton: true,
                closeOnCancel: true,
                closeOnConfirm: false
            }, function(res){
                if(res)
                {
                    swal({
                        title: 'Menyimpan tanggal assessment',
                        showConfirmButton: false,
                        allowEscapeKey: false,
                    })
                    $.post(action, data)
                    .done(function(response){
                        response = JSON.parse(response);
                        if(response.success)
                        {
                            Cookies.getJSON('client',{assessment_date: undefined})
                            window.location.reload();
                        }else
                        {
                            alert('Ada kesalahan saat konfirmasi tanggal assessment. mohon load ulang halaman. jika masih kesalahan, silahkan laporkan pada administrator');
                        }
                    })
                    .error(function(res){
                        swal('Ada kesalahan saat konfirmasi tanggal assessment', 'Ada kesalahan saat konfirmasi tanggal assessment. mohon load ulang halaman. jika masih kesalahan, silahkan laporkan pada administrator');
                    })

                } /*end of res*/
            })

            console.log(tr, data, e, ui)
        })

        // READ SOCKET IO
        notif.listen('update/tracker', function(data){
            tracker_status(<?php echo $company['id_company'] ?>, <?php echo $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_permintaan_sertifikasi'] ?>);
        })  

        // READ SOCKET IO
        notif.listen('update/tracker/catatan', function(data){
            get_catatan_a0(<?php echo $request['a0']['id_a0'] ?>);
        })  
    })

</script>