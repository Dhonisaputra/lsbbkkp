<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>
<?php echo $this->load->component('js', 'js/zebra_datepicker/javascript/zebra_datepicker.js') ?>
<?php echo $this->load->component('css', 'js/zebra_datepicker/css/default.css') ?>
<style type="text/css">
    .add-education--tab
    {
        display: inline-block;
        width: 200px;
    }
    .add-education--tab .sub-text
    {
        margin-top: 7px;
    }

    .add-education--tab.active button
    {
        background-color: #4183D7;
    }
    .add-education--tab.active .material-icons
    {
        color: white;
    }
    .nav-menu--category
    {
        display: flex;
    }
    .nav-menu--category li
    {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .nav-menu--category li.active a
    {
        color: #22A7F0 !important;

    }
    .nav-menu--category li a
    {
        padding-top: 0px !important;
        padding-bottom: 0px !important;
    }

</style>
<section class="navbar">
    <ul class="nav nav-menu--category" role="tablist">
        <li role="presentation" class="active"> <a class="mdl-button mdl-js-button mdl-button--top-menu mdl-button--icon" data-engine="pushstate" data-target="#document-actual-tab" href="<?php echo site_url('auditor') ?>"> <i class="material-icons middle">chevron_left</i> </a> </li>
        <li role="presentation" class="active"> <a class="mdl-button mdl-js-button mdl-button--top-menu" href="#content--auditor-profile--category-overview" class="text-uppercase" aria-controls="home" role="tab" data-toggle="tab">Home</a> </li>
        <li role="presentation" class=""> <a class="mdl-button mdl-js-button mdl-button--top-menu" href="#content--auditor-profile--category-education" class="text-uppercase" aria-controls="content--auditor-profile--educational" role="tab" data-toggle="tab" >Pendidikan</a>     </li>
        <li role="presentation" class=""> <a class="mdl-button mdl-js-button mdl-button--top-menu" href="#content--auditor-profile--category-log" class="text-uppercase" aria-controls="content--auditor-profile--educational" role="tab" data-toggle="tab" >Log</a>     </li>
        <li role="presentation" class=""> <a class="mdl-button mdl-js-button mdl-button--top-menu" href="#content--auditor-profile--category-competency" class="text-uppercase" aria-controls="content--auditor-profile--educational" role="tab" data-toggle="tab" >Kompetensi</a>     </li>
        <li role="presentation" class=""> <a href="<?php echo site_url('auditor/panel_auditor_dashboard/'.$profile['id_auditor']); ?>" class="mdl-button mdl-js-button pull-right"> Jadwal </a> </li>
        <li role="presentation" class=""> <a href="<?php echo site_url('auditor/profile/settings/'.$profile['id_auditor']); ?>" class="mdl-button mdl-js-button pull-right"> <i class="material-icons">settings</i> Settings </a> </li>
    </ul>
</section>

<div class="container-fluid" style="">
    <div class="tab-content tab-content--auditor-profile--category" style="margin:10px 15px;">
        <div role="tabpanel" class="tab-pane active" id="content--auditor-profile--category-overview">
            <div class="row">
               
                <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                
                    <div class="overview-profile">
                        <p><span> <strong>Name :</strong> </span>   
                            <span> <?php echo $profile['fullname'] ?></span> 
                        </p>
                        <p>
                            <span> <strong>Position as :</strong> </span> 
                            <span> <?php echo $profile['nama_jabatan'] ?></span> 
                        </p>
                        <p>
                            <span> <strong>Phone Number :</strong> </span> 
                            <span> <?php echo $profile['phone_number'] ?></span> 
                        </p>
                        <p>
                            <span> <strong>telephone Number :</strong> </span> 
                            <span> <?php echo $profile['telephone_number'] ?></span> 
                        </p>
                        <p>
                            <span> <strong>Competency :</strong> </span> 
                            <span> <?php echo $profile['competency'] ?></span> 
                        </p>
                        <p>
                            <span> <strong>Address :</strong> </span> 
                            <span> <?php echo $profile['address'].', Ds. '.$profile['desa'].', Kec.'.$profile['kecamatan'].', Kab.'.$profile['kabupaten'].', Kota '.$profile['kota'].', '.$profile['provinsi'].' '.$profile['postal'] ?></span> 
                        </p>
                    </div> <!-- end overview-profile -->

                </div> <!-- end col -->

                 <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div class="avatar pull-right">
                        <img class="img-thumbnail img-responsive" src="<?php echo $profile['avatar'] == ''? base_url('application/components/images/user.jpg') : base_url($profile['avatar']) ?>">
                    </div>
                </div> <!-- col -->
            </div> <!-- end row -->
        </div> <!-- end tabpanel -->

        <div role="tabpanel" class="tab-pane" id="content--auditor-profile--category-education">
            <ul class="nav nav-tabs row" role="tablist">
                <li role="presentation" class="active"> <a class="mdl-button--item-category-menu" href="#content--auditor-profile--category-education--formal-education" class="text-uppercase" aria-controls="content--auditor-profile--educational" role="tab" data-toggle="tab" >Pendidikan formal</a>     </li>
                <li role="presentation" class=""> <a class="mdl-button--item-category-menu" href="#content--auditor-profile--category-education--informal-education" class="text-uppercase" aria-controls="content--auditor-profile--educational" role="tab" data-toggle="tab" >Pendidikan non-formal</a>     </li>
                <?php if( $_SESSION['level'] == 1 || $_SESSION['level'] == 100 ){ ?>
                    <li role="presentation" class=""> <a class="mdl-button--item-category-menu mdl-button--item-category-menu--request-list " href="#content--auditor-profile--category-education--education-requested" class="text-uppercase" aria-controls="content--auditor-profile--educational" role="tab" data-toggle="tab" > <span class="mdl-badge" data-badge="0"> Permintaan tambah pendidikan </span> </a>     </li>
                <?php } ?>
            </ul>

            <div class="tab-content tab-content--auditor-profile--category--education" style="margin:5px 0px;">
                <div role="tabpanel" class="tab-pane active" id="content--auditor-profile--category-education--formal-education">
                    <?php $this->load->view('auditor/panel-audit--profile--overview-pendidikan-formal'); ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="content--auditor-profile--category-education--informal-education">
                    <?php $this->load->view('auditor/panel-audit--profile--overview-pendidikan-informal'); ?>
                </div>
                <?php if( $_SESSION['level'] == 1 || $_SESSION['level'] == 100 ){ ?>
                    <div role="tabpanel" class="tab-pane" id="content--auditor-profile--category-education--education-requested">
                        <?php $this->load->view('auditor/panel-audit--profile--overview-pendidikan-requested'); ?>
                    </div>
                <?php } ?>

            </div>

        </div>
        <div role="tabpanel" class="tab-pane" id="content--auditor-profile--category-log">
            <?php $this->load->view('auditor/panel-audit--profile--overview-log-audit'); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="content--auditor-profile--category-competency">
            <?php $this->load->view('auditor/panel-audit--profile--overview-competency', array('profile' => $profile)); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="content--auditor-profile--category-add-education">
            <?php $this->load->view('auditor/panel_auditor_add_education'); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="content--auditor-profile--category-edit-education">
            <?php $this->load->view('auditor/panel_auditor_edit_education'); ?>
        </div>
    </div>
</div>

    

<script type="text/javascript">
	function editAuditorEducation(ui,type)
    {
        
        $('#content--auditor-profile--educational--edit .edit-education--tab [data-type_riwayat="'+type+'"]').trigger('click')
        var tr = $(ui).parents('tr')[0];
        switch(type)
        {
            case 0:
                var datatable = window.auditorEducation;
                break;
            case 1:
                var datatable = window.auditorInformalEducation1;
                break;
            case 2:
                var datatable = window.auditorInformalEducation2;
                break;
        }
        var data = datatable.row(tr).data();
        console.log(data);
        $('<a href="#content--auditor-profile--educational--edit" data-toggle="tab"></a>').tab('show');
        $.each(data, function(a,b){
            $('#content--auditor-profile--educational--edit').find('input[name="'+a+'"]').val(b);
        })


	}

    function removeAuditorEducation(ui, type)
    {
        var tr = $(ui).parents('tr')[0];
        switch(type)
        {
            case 0:
                var datatable = window.auditorEducation;
                break;
            case 1:
                var datatable = window.auditorInformalEducation1;
                break;
            case 2:
                var datatable = window.auditorInformalEducation2;
                break;
        }
        var data = datatable.row(tr).data();
        swal({
            title: 'Hapus pendidikan auditor',
            text: 'Aksi ini akan menghapus data pendidikan auditor. apakah anda ingin melanjutkan?',
            type: 'warning',
            showCancelButton: true,
            closeOnCancel: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },function(){
            $.post( site_url('auditor/process/post/delete/pendidikan/formal'), {id_riwayat_pendidikan: data.id_riwayat_pendidikan_auditor} )
            .done(function(res){
                swal('Pendidikan selesai dihapus','Pendidikan auditor telah selesai dihapus','success');
                datatable.ajax.reload();
            })
            .error(function(res){
                swal('Kesalahan saat menghapus auditor', 'Terdapat kesalahan saat menghapus auditor. Silahkan ulang kembali langkah ini!.', 'error');
            })
        })   
    }

    function remove_competency(ui)
    {
        var tr = $(ui).parents('tr')[0];
        var data = window.auditorCompetency.row(tr).data();
        swal({
            title: 'Hapus kompetensi auditor',
            text: 'Aksi ini akan menghapus kompetensi auditor. apakah anda ingin melanjutkan?',
            type: 'warning',
            showCancelButton: true,
            closeOnCancel: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },function(){
            $.post( site_url('auditor/process/delete/kompetensi'), {id_auditor: data.id_auditor, competency: data.competency} )
            .done(function(res){
                swal('Kompetensi selesai dihapus','Kompetensi auditor telah selesai dihapus','success');
                window.auditorCompetency.ajax.reload();
            })
            .error(function(res){
                swal('Kesalahan saat menghapus kompetensi', 'Terdapat kesalahan saat menghapus kompetensi auditor. Silahkan ulang kembali langkah ini!.', 'error');
            })
        })
    }

    function confirm_pendidikan(ui, id_riwayat_pendidikan_auditor, status)
    {
        if(status < 1)
        {

            swal({
                title: 'Tolak permintaan tambah pendidikan auditor',
                text: 'Aksi ini akan menggagalkan permintaan pendidikan auditor. apakah anda ingin melanjutkan?',
                type: 'warning',
                showCancelButton: true,
                closeOnCancel: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },function(){
                $.post( site_url('auditor/update_approval_auditor_education'), {id_riwayat_pendidikan_auditor: id_riwayat_pendidikan_auditor, status: status} )
                .done(function(res){
                    swal('Permintaan pendidikan auditor digagalkan','Data telah selesai diperbarui','success');
                    window.educationRequested.ajax.reload(function(){
                        $('.mdl-button--item-category-menu--request-list .mdl-badge').attr('data-badge',window.educationRequested.data().length)
                    });
                    window.auditorEducation.ajax.reload();
                    window.auditorInformalEducation1.ajax.reload();
                    window.auditorInformalEducation2.ajax.reload();

                    Notify.send({notification_for_level: <?php echo $profile['auditor_level']; ?>, notification_for_user: <?php echo $profile['id_auditor']; ?>,  notification_text: ' Permintaan anda terkait data pendidikan tidak disetujui oleh LSBBKKP.'  })

                })
                .error(function(res){
                    swal('Kesalahan saat memperbarui data', 'Terdapat kesalahan saat memperbarui pendidikan auditor. Silahkan ulang kembali langkah ini!.', 'error');
                })
            })

        }else
        {
            $.post( site_url('auditor/update_approval_auditor_education'), {id_riwayat_pendidikan_auditor: id_riwayat_pendidikan_auditor, status: status} )
            .done(function(res){
                swal('Permintaan pendidikan auditor diterima','Data telah selesai diperbarui','success');
                window.educationRequested.ajax.reload(function(){
                    $('.mdl-button--item-category-menu--request-list .mdl-badge').attr('data-badge',window.educationRequested.data().length)
                });
                window.auditorEducation.ajax.reload();
                window.auditorInformalEducation1.ajax.reload();
                window.auditorInformalEducation2.ajax.reload();
                Notify.send({notification_for_level: <?php echo $profile['auditor_level']; ?>, notification_for_user: <?php echo $profile['id_auditor']; ?>,  notification_text: ' Permintaan anda terkait data pendidikan disetujui oleh LSBBKKP. Date pendidikan telah diperbarui'  })
            })
            .error(function(res){
                swal('Kesalahan saat memperbarui data', 'Terdapat kesalahan saat memperbarui pendidikan auditor. Silahkan ulang kembali langkah ini!.', 'error');
            })
        }
    }

    var deferFormalEdu = $.Deferred(),
        deferUnFormalEdu = $.Deferred(),
        deferTeach = $.Deferred();

    window.educationRequested = $('#table-auditor-profile-overview--education-requested').DataTable({
        info: false,
        lengthChange: false,
        searching: false,
        ajax: {
            url: site_url('auditor/process/get/education'),
            type: 'POST',
            data: function(d){
                return {id_auditor: '<?php echo $profile["id_auditor"] ?>'}
            },
            dataSrc: function(json)
            {
                json = (json.data)? json.data : json;
                var i = 1;
                json = json.filter(function(res){
                    return res.is_approved == '0';
                })
                console.log(json);
                $.each(json, function(a,b){
                    var type = '';
                    switch(parseInt( b.type_riwayat) )
                    {
                        case 1:
                            type = 'Pendidikan non-formal';
                            break;
                        case 2:
                            type = 'Educator / pembicara';
                            break;
                        case 0:
                            type = 'Pendidikan formal'
                            break;

                    }
                    json[a]['no'] = i;
                    json[a]['action'] = '';
                    json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--icon btn-danger" onclick="confirm_pendidikan(this,'+b.id_riwayat_pendidikan_auditor+',-1)" style=""><i class="material-icons" style="font-size:20px;color:white;">clear</i></button> <button class="mdl-button mdl-js-button mdl-button--icon btn-primary" onclick="confirm_pendidikan(this,'+b.id_riwayat_pendidikan_auditor+',1)" ><i class="material-icons" style="font-size:20px;color:white;">done</i></button>';
                    json[a]['type_permintaan'] = type;
                    i++;
                })
                if(!json){return false; }

                // hentikan loading
                return json;
            }
        },
        columns:[
            {data: 'pendidikan'},
            {data: 'jurusan'},
            {data: 'tahun_lulus'},
            {data: 'jenjang'},
            {data: 'type_permintaan'},
            {data: 'action'},
        ],
        initComplete: function(){
            // requested.resolve();
            $('.mdl-button--item-category-menu--request-list .mdl-badge').attr('data-badge',window.educationRequested.data().length)
        }
    });

	window.auditorEducation = $('#table-auditor-profile-overview--education').DataTable({
        info: false,
        lengthChange: false,
        searching: false,
        ajax: {
            url: site_url('auditor/process/get/education'),
            type: 'POST',
            data: function(d){
            	return {id_auditor: '<?php echo $profile["id_auditor"] ?>'}
            },
            dataSrc: function(json)
            {
                json = (json.data)? json.data : json;
                var i = 1;
                json = json.filter(function(res){
                    return res.type_riwayat == '0' && res.is_approved == 1;
                })
                $.each(json, function(a,b){
                	json[a]['no'] = i;
                	json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--icon" onclick="editAuditorEducation(this,'+b.type_riwayat+')" ><i class="material-icons" style="font-size:20px;">create</i></button> <button class="mdl-button mdl-js-button mdl-button--icon" onclick="removeAuditorEducation(this,'+b.type_riwayat+')" style="background-color:#EF4836;"><i class="material-icons" style="font-size:20px;color:white;">clear</i></button>';
                	i++;
                })
                if(!json){return false; }

                // hentikan loading
                return json;
            }
        },
        "order": [[ 2, "asc" ]],
        columns:[
            {data: 'pendidikan'},
            {data: 'jurusan'},
            {data: 'tahun_lulus'},
            {data: 'jenjang'},
            {data: 'action'},
        ],
        initComplete: function(){
            deferFormalEdu.resolve();
        }
    });

    window.auditorInformalEducation1 = $('#table-auditor-profile-overview--non-formal-education').DataTable({
        info: false,
        lengthChange: false,
        searching: false,
        ajax: {
            url: site_url('auditor/process/get/education'),
            type: 'POST',
            data: function(d){
                return {id_auditor: '<?php echo $profile["id_auditor"] ?>'}
            },
            dataSrc: function(json)
            {
                json = (json.data)? json.data : json;
                var i = 1;
                json = json.filter(function(res){
                    return res.type_riwayat == '1' && res.is_approved == 1;
                })
                $.each(json, function(a,b){
                    json[a]['no'] = i;
                    json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--icon" onclick="editAuditorEducation(this,'+b.type_riwayat+')" ><i class="material-icons" style="font-size:20px;">create</i></button> <button class="mdl-button mdl-js-button mdl-button--icon" onclick="removeAuditorEducation(this,'+b.type_riwayat+')" style="background-color:#EF4836;"><i class="material-icons" style="font-size:20px;color:white;">clear</i></button>';
                    i++;
                })
                if(!json){return false; }

                // hentikan loading
                return json;
            }
        },
        "order": [[ 2, "asc" ]],
        columns:[
            {data: 'tahun_lulus'},
            {data: 'pendidikan'},
            {data: 'jurusan'},
            {data: 'action'},
        ],
        initComplete: function(){
            deferUnFormalEdu.resolve();
        }
    })
    window.auditorInformalEducation2 = $('#table-auditor-profile-overview--teaching').DataTable({ 
        info: false,
        lengthChange: false,
        searching: false,
        ajax: {
            url: site_url('auditor/process/get/education'),
            type: 'POST',
            data: function(d){
                return {id_auditor: '<?php echo $profile["id_auditor"] ?>'}
            },
            dataSrc: function(json)
            {
                json = (json.data)? json.data : json;
                var i = 1;
                json = json.filter(function(res){
                    return res.type_riwayat == '2' && res.is_approved == 1;
                })
                $.each(json, function(a,b){
                    json[a]['no'] = i;
                    json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--icon" onclick="editAuditorEducation(this,'+b.type_riwayat+')" ><i class="material-icons" style="font-size:20px;">create</i></button> <button class="mdl-button mdl-js-button mdl-button--icon" onclick="removeAuditorEducation(this,'+b.type_riwayat+')" style="background-color:#EF4836;"><i class="material-icons" style="font-size:20px;color:white;">clear</i></button>';
                    i++;
                })
                if(!json){return false; }

                // hentikan loading
                return json;
            }
        },
        "order": [[ 2, "asc" ]],
        columns:[
            {data: 'tahun_masuk'},
            {data: 'tahun_lulus'},
            {data: 'pendidikan'},
            {data: 'jurusan'},
            {data: 'action'},
        ],
        initComplete: function(){

            deferTeach.resolve();
        }
    })

    $.when( deferTeach, deferFormalEdu, deferUnFormalEdu )
    .done(function(){
        Snackbar.show('Data selesai dimuat')
    })

    $(document).ready(function(){
        <?php 
            if(isset($_GET['openTab'])){ 
                $tab = explode(',', $_GET['openTab']);
                foreach ($tab as $key => $value) {
        ?>
            console.log($('[href="#<?php echo $value ?>"]'))
            $('[href="#<?php echo $value ?>"]').tab('show')

        <?php } } ?>
    })


</script>