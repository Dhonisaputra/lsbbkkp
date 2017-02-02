<style type="text/css">
    .form-item-rs .form-group
    {
        margin-right: 10px; 
    }
</style>

<?php echo $this->load->component('js', 'jsdata/jsdata.upload.js') ?>
<!-- datepicker -->
<?php echo $this->load->component('js', 'plugins/foundation_datepicker/js/foundation-datepicker.min.js') ?>
<?php echo $this->load->component('css', 'plugins/foundation_datepicker/css/foundation-datepicker.min.css') ?> 

<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>
<!-- <section class="navbar">
    <button class="btn btn-primary pull-right"> Simpan </button>
</section> -->
<div style="margin-top: 20px;">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs certification-tabs" role="tablist">
    <?php foreach ($a0_cat as $key => $value) { ?>
    <li role="presentation" class=""><a href="#a0_cat_<?php echo $value['id_a0_cat'] ?>" aria-controls="home" role="tab" data-toggle="tab"> <?php echo $value['id_certificate'] ?></a></li>
    <?php } ?>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <?php foreach ($a0_cat as $key => $value) { ?>
    <div role="tabpanel" class="tab-pane" id="a0_cat_<?php echo $value['id_a0_cat'] ?>">
        <div class="container-fluid" style="margin-top: 10px;">
            <fieldset class="panel panel-default">
                <div class="panel-body">
                    <legend> Referensi nomor sertifikat </legend>
                    <form onsubmit="updateExistedDetail(event, this)">
                        <input type="hidden" name="has_old" value="<?php echo isset($reference[$value['id_certificate']] )? 1 : 0 ?>">
                        <div class="form-group">
                            <label>Sertifikat sekarang</label>
                            <input type="text" class="form-control" name="id_certificate" value="<?php echo $value['id_certificate'] ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Referensikan sertifikat ke <i class="text-danger"> *) nomor sertifikat saat diterbitkan </i></label>
                            <input type="text" class="form-control" name="old_certificate" value="<?php echo isset($reference[$value['id_certificate']] )? $reference[$value['id_certificate']]['old_reference'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"> Update detail sertifikat <?php echo $value['id_certificate'] ?> </button>
                        </div>
                    </form>
                </div>
            </fieldset>
            <fieldset class="panel panel-default">
                <div class="panel-body">
                    <legend> Sertifikat terbit </legend>
                    <div>

                          <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#rs-tab--add" aria-controls="home" role="tab" data-toggle="tab">Tambah data surveilen</a></li>
                            <li role="presentation"><a href="#rs-tab--list" aria-controls="profile" role="tab" data-toggle="tab">daftar surveilen</a></li>
                            
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="rs-tab--add">
                            
                                <form class="" onsubmit="tambahIssued(event)">
                                    <input type="hidden" name="type" value="<?php echo $value["type"] ?>">
                                    <div class="form-group">
                                        <label>Tanggal terbit <span class="text-danger">*) Tanggal terbit pertama kali</span></label>
                                        <input type="date" name="tanggal_terbit" class="form-control" placeholder="Tanggal terbit" value="2008-02-02">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal habis pakai <span class="text-danger">*) pada sertifikat terakhir diterbitkan</span></label>
                                        <input type="text" name="tanggal_selesai" class="form-control" placeholder="Tanggal habis pakai" value="2018-02-02">
                                    </div>
                                    <div class="form-group">
                                        <button class="mdl-button mdl-js-button btn-primary"> <i class="material-icons">straighten</i> Hiitung waktu terbit sertifikasi (issued) </button>
                                    </div>
                                </form>
                                <form class="row" onsubmit="saveIssued(event, <?php echo $value['id_a0_cat'] ?>)">
                                    <input type="hidden" name="id_certificate" value="<?php echo $value["id_certificate"] ?>">

                                    <div class="col-lg-12">
                                        <div id="exist--issued-generate"></div>
                                        <div class="form-group">
                                            <button class="mdl-button mdl-js-button btn-primary btn-update-issued sr-only"> <i class="material-icons">done</i> Simpan </button>
                                        </div>
                                    </div>
                                </form>

                            </div> <!-- end tab panel -->
                            <div role="tabpanel" class="tab-pane" id="rs-tab--list">
                                <div class="table-responsive">
                                    
                                    <table class="table table-bordered table-hover table-stripped table--data-surveilen" data-id_a0_cat="<?php echo $value['id_a0_cat'] ?>" id="table--data-surveilen--<?php echo $value['id_a0_cat'] ?>">
                                        <thead>
                                            <tr>
                                                <th>Tanggal diterbitkan sertifikat</th>
                                                <th>tanggal dilaksanakan surveilen</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Isikan dokumen kelengkapan</legend>
                <!-- <button></button> -->
            </fieldset>

                    <!-- <div class="form-group">
                        <label> Upload dokumen </label>
                        <br>
                        <button class="btn btn-primary" onclick="$('#document-<?php echo $value['id_a0_cat'] ?>').trigger('click')"> Upload dokumen </button>
                        <input type="file" class="sr-only upload-files" data-id="<?php echo $value['id_a0_cat'] ?>" id="document-<?php echo $value['id_a0_cat'] ?>" name="documents[<?php echo $value['id_a0_cat'] ?>]" multiple>
                        <div class="files-<?php echo $value['id_a0_cat'] ?> files-container" style="margin-top: 20px;display: flex; flex-direction: column; width: 400px;">
                            
                        </div>
                    </div> -->

                </div>
            </div>
            <?php } ?>
        </div>

    </div>

    <script type="text/javascript">
        function tambahIssued(e, type)
        {  
            e.preventDefault();
            $('#exist--issued-generate').html('')
            var data = $(e.target).serializeArray();

            $.post(site_url('certification/generate_issues_existing_certificate'),data )
            .done(function(res){

                res = JSON.parse(res);

                $.each(res.data, function(a,b){
                    var template = '<div class="list-group">'
                    +'<div class="list-group-item active"> ISSUED '+a+' </div>'
                    +'<div class="list-group-item"> <div class="form-group"> <label>Tanggal terbit sertifikat <span class="text-danger">*)</span> </label> <input class="form-control rs-input" type="text" placeholder="tanggal terbit sertifikat" name="rs_issued['+a+']" required> </div> </div>'
                    $.each(b, function(c,d){
                        var i = c+1;
                        template +='<div class="list-group-item form-inline form-item-rs">'
                        +'<div class="form-group"> <label>Tgl penjadwalan</label> <input type="text" class="form-control rs-date rs-'+a+'-'+c+'" data-issued="'+a+'" data-rs="'+c+'" name="rs['+a+']['+d.resurvey_counter+'][scheduled]" placeholder="tanggal assessment" readonly value="'+d.resurvey_date+'"> </div>'
                        if(moment(d.resurvey_date).isBefore(res.now) )
                        {
                            template +='<div class="form-group"> <label>Tgl dilaksanakan <span class="text-danger">*)</span></label> <input type="text" class="form-control rs-input rs-date rs-'+a+'-'+c+'" data-issued="'+a+'" data-rs="'+d.resurvey_counter+'" name="rs['+a+']['+d.resurvey_counter+'][issued]" placeholder="tanggal assessment" required> </div>'
                        }else
                        {
                            template +='<div class="form-group"> <label>Tgl dilaksanakan</label> <span class="text-danger"> *) belum pernah dilaksanakan surveilen</span> </div>'

                        }
                        template +='</div>'
                    })
                    template +='</div>';
                    $('#exist--issued-generate').append(template)
                })

                $('.rs-input ')
                .fdatepicker({
                    format: 'yyyy-mm-dd',
                    startView:4,
                    leftArrow: '<i class="material-icons">keyboard_arrow_left</i>',
                    rightArrow: '<i class="material-icons">keyboard_arrow_right</i>',
                })
                
                $('.btn-update-issued').removeClass('sr-only')
                console.log(res);
            })

        }

        function saveIssued(e, id_a0_cat)
        {
            e.preventDefault();
            Snackbar.manual({message:'Menambahkan data surveilen. silahkan tunggu!', spinner:true})
            var data = $(e.target).serializeArray()
            console.log(data)
            $.post(site_url('certification/save_existing_certification_issue'),data )
            .done(function(res){
                console.log(res)
                $('#exist--issued-generate').html('')
                $('.btn-update-issued').addClass('sr-only')
                Snackbar.show('Data surveilen telah berhasil ditambahkan')
                window['surveilen'+id_a0_cat].ajax.reload()
            })


        }

        function updateExistedDetail(event, ui)
        {
            event.preventDefault();
            var data = $(event.target).serializeArray()

            $.post(site_url('certification/add_old_certificate'), data)
            .done(function(res){
                $(event.target).find('[name="has_old"]').val(1);

                swal('referensi berhasil ditambahkan', 'Referensi berhasil ditambahkan.', 'success');
                Snackbar.show('Referensi untuk sertifikat yang telah terbit berhasil ditambahkan.')
            })
            .fail(function(res){
                swal('error', 'Kesalahan saat menambahkan referensi. silahkan diulangi kembali.', 'error');
                console.log(res);
            })
            console.log(data);

        }
    // remove file uploaded
    function removeFile(filename)
    {
        $.Upload.delete(filename)
        .done(function(res){
            $('.files-container').find('#file-uploaded-'+res.value.key).remove();
        })

    }

    $(document).ready(function(){
        // render data surveilen
         $('.table--data-surveilen').each(function(){
            var data = $(this).data();
            window['surveilen'+data.id_a0_cat] = $('#table--data-surveilen--'+data.id_a0_cat).DataTable({
                ajax: 
                {
                    url: site_url('certification/detail_existing_certification__data_surveilen/'+data.id_a0_cat),
                    dataSrc: function(res){
                        console.log(res)
                        $.each(res, function(a,b){
                            res[a]['terbit'] = a+1;
                            res[a]['surveilen_ke'] = 'SURVEILEN ke '+b.rs_description;
                        })
                        return res;
                    }
                },
                columns:[
                    {data: 'issued_date'},
                    {data: 'survey_date'},
                    {data: 'surveilen_ke'},
                ]
            })
            
         })
        // render datepicker
        $('[name="tanggal_selesai"]')
        .fdatepicker({
            format: 'yyyy-mm-dd',
            startView:4,
            leftArrow: '<i class="material-icons">keyboard_arrow_left</i>',
            rightArrow: '<i class="material-icons">keyboard_arrow_right</i>',
        })

        $('.certification-tabs a:nth(0)').tab('show')
        // onchange input
        $('.upload-files').on('change', function(event){
            var $this = $(this)
            var $data = $this.data()

            console.log($data)
            
            $.Upload( $this )
            .done(function(res){
                // tulis data file uploaded
                Tools.write_data({
                    target: '.files-'+$data.id,
                    records: res,
                    template: '<div class="list-group-item--attachment" data-id="'+$data.id+'" id="file-uploaded-::key::" style=""> ::name:: <button class=" mdl-button mdl-js-button mdl-button--icon pull-right" onclick="removeFile(\'::name::\')"><span class="material-icons">clear</span> </button> </div>'
                })

                // reset input type file
                $this.val('');
            })

        })
    })

</script>