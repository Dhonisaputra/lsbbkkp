
<?php echo $this->load->component('css', 'plugins/datetimepicker/jquery.datetimepicker.css') ?>
<?php echo $this->load->component('js', 'plugins/datetimepicker/jquery.datetimepicker.min.js') ?>
<style type="text/css">
    .row-selected
    {
        background: #afafaf !important;
    }
    .company--main-menu
    {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .company--menu-item
    {
        height: 100px;
        font-size: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .company--menu-item i
    {
        font-size: 35px;
    }

</style>

<!-- //////////////////////////////////////////////////////////////////////////////////////////// BODY  -->



<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="profile-company--table"> 
        <section class="navbar">

            <a href="<?php echo site_url('company') ?>" class="mdl-button mdl-js-button"> <i class="material-icons">chevron_left</i> Daftar perusahaan </a>

            <a href="#" class="mdl-button--icon mdl-button mdl-js-button preventDefault" onclick="refreshTableCompany()"> <i class="material-icons">replay</i> </a>
            
            <!-- <a  class="btn btn-primary flat pull-right mdl-button mdl-js-button" target="_blank"> <i class="material-icons icons-middle">add</i> Sertifikasi baru </a> -->
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-primary flat  mdl-button mdl-js-button dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons icons-middle">add</i> Sertifikasi baru </a> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a target="_blank" href="<?php echo site_url('certification/add/'.$company['id_company']) ?>">Sertifikasi baru </a></li>
                    <li role="separator" class="divider"></li>
                    <li><a target="_blank" href="<?php echo site_url('certification/exist/add/'.$company['id_company']).'?existing_certificate' ?>">Sertifikasi yang telah diterbitkan </a></li>
                </ul>
            </div>

        </section>

        <!-- <fieldset>
            <legend>Daftar menu</legend>
            <div class="company--main-menu">
                <button class="btn btn-info btn-lg flat company--menu-item">
                    <i class="material-icons middle"> info_outline </i>
                    <span>Detail perusahaan</span>
                </button>
                <button class="btn btn-primary btn-lg flat company--menu-item">
                    <i class="material-icons middle"> add </i>
                    <span>Tambah sertifikasi</span>
                </button>
                <button class="btn btn-primary btn-lg flat company--menu-item">
                    <i class="material-icons middle"> assignment_turned_in </i>
                    <span> Daftar sertifikat </span>
                </button>
                <button class="btn btn-primary btn-lg flat company--menu-item">
                    <i class="material-icons middle"> date_range </i>
                    <span>Jadwal</span>
                </button>
                <button class="btn btn-primary btn-lg flat company--menu-item">
                    <i class="material-icons middle"> settings </i>
                    <span>Settings</span>
                </button>
            </div>
        </fieldset> -->

        <div class="" ng-app="company_profile">

            <div class="col-md-12 mdl-shadow--2dp" style="padding-top:20px;">
                <div class="list-group">
                    <div class="list-group-item"> <strong>Nama Perusahaan :</strong> <?php echo $company['company_name'] ?></div>
                    <div class="list-group-item"> <strong>Telephone :</strong> <?php echo $company['telephone'] ?></div>
                    <div class="list-group-item"> <strong>Email :</strong> <?php echo $company['email'] ?></div>
                    <div class="list-group-item"> <strong>Fax :</strong> <?php echo $company['company_fax'] ?></div>
                    <div class="list-group-item"> <strong>Alamat :</strong> <?php echo $company['company_address'] ?></div>
                    <div class="list-group-item"> <strong>Kabupaten :</strong> <?php echo $company['company_region'] ?></div>
                    <div class="list-group-item"> <strong>Provinsi :</strong> <?php echo $company['company_province'] ?></div>
                    <div class="list-group-item"> <strong>Kodepos :</strong> <?php echo $company['company_post'] ?></div>
                    <div class="list-group-item"> <strong>Jumlah Karyawan :</strong> <?php echo $company['company_employee'] ?></div>
                </div>

                <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                    <div class="mdl-tabs__tab-bar">
                        <a href="#certification-panel" class="mdl-tabs__tab is-active">Sertifikat</a>
                        <a href="#schedules-panel" class="mdl-tabs__tab">Jadwal</a>
                        <a href="#settings-panel" class="mdl-tabs__tab">Settings</a>
                    </div>


                    <div class="mdl-tabs__panel is-active table-responsive" id="certification-panel">
                        <table id="certification-list" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nomor Sertifikat</th>
                                    <th>Jenis sertifikasi</th>
                                    <th>Tanggal terbit</th>
                                    <th>status</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody ></tbody>
                        </table>
                    </div>
                    
                    <div class="mdl-tabs__panel table-responsive" id="schedules-panel">
                        <table id="schedules-list" class="table table-bordered table-hover table-stripped" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Jadwal</th>
                                    <th>Tanggal </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="mdl-tabs__panel table-responsive" id="settings-panel">
                        <div class="list-group">
                            <div class="list-group-item">
                                <button class="pull-right mdl-button btn-sm mdl-js-button btn btn-default" data-company="<?php echo $company['id_company'] ?>" onclick="resetPasswordCompany(this)"> Reset password </button>
                                <div><label>Reset Password</label></div>
                                <div>
                                    <span style="-webkit-text-security: disc; -moz-text-security: disc;">password</span>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <a class="pull-right mdl-button btn-sm mdl-js-button btn btn-default" data-company="<?php echo $company['id_company'] ?>" href="<?php echo site_url('company/settings/'.$company['id_company'].''); ?>?edit=email"> 
                                    <i class="glyphicon glyphicon-pencil"></i> EDIT
                                </a>
                                <div><label>Email</label></div>
                                <div>
                                    <span><?php echo $company['email'] ?></span>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <a class="pull-right mdl-button btn-sm mdl-js-button btn btn-default" href="<?php echo site_url('company/settings/'.$company['id_company'].''); ?>?edit=address">
                                    <i class="glyphicon glyphicon-pencil"></i> EDIT
                                </a>
                                <div><label>Alamat perusahaan</label></div>
                                <div>
                                    <?php echo $company['company_address'] ?>, Regional <?php echo $company['company_region'] ?>, Province <?php echo $company['company_province'] ?>, Post/zip <?php echo $company['company_post'] ?>
                                </div>
                            </div>
                            <div class="list-group-item" ng-controller="company_contact as compCont">
                                <a class="pull-right mdl-button btn-sm mdl-js-button btn btn-default" href="<?php echo site_url('company/settings/'.$company['id_company'].''); ?>?edit=contact">
                                    <i class="glyphicon glyphicon-pencil"></i> EDIT
                                </a>
                                <input type="hidden" ng-model="compCont.id_company" value="<?php echo $company['id_company'] ?>">
                                <div><label>Kontak perusahaan</label></div>
                                <hr>
                                <div ng-repeat="contact in company_contact">
                                    <div style="height: 35px; border-bottom: 1px solid #D8D8D8;margin-top: 5px;"><strong>{{contact.contact_name}}</strong>  <div class="pull-right ">{{contact.contact_number}} <a class="btn btn-sm btn-info text-uppercase" href="tel:{{contact.contact_number}}"><i class="glyphicon glyphicon-earphone"></i></a> </div> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>

            </div> <!-- end col-md- 7 -->

            <div class="modal fade" id="modalCreateCertification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-md" role="document" style="width: 60%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Create Certification</h4>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- end mdl grid -->
    </div> <!-- end table panel -->
    <div role="tabpanel" class="tab-pane" id="profile-company--detail-schedule">

        <section class="navbar">
            <button class="mdl-button mdl-js-button btn btn-primary" form="profile-company--form-edit-schedule"> Simpan </button>
            <a  href="#profile-company--table" aria-controls="profile-company--table" role="tab" data-toggle="tab" class="mdl-button mdl-js-button pull-right mdl-button--icon"> <i class="material-icons">clear</i> </a>
        </section>

        <p><strong>Jenis jadwal : </strong><span class="profile-company--schedule-description profile-company--schedule-description-type_report">Not Available</span></p>
        <p><strong>Jenis sertifikasi : </strong><span class="profile-company--schedule-description profile-company--schedule-description-type">Not Available</span></p>
        <p><strong> Nomor Sertifikat : </strong><span class="profile-company--schedule-description profile-company--schedule-description-id_certificate">Not Available</span></p>
        <p><a href="#" class="preventDefault detail-request" > Detail Request </a> </p>
        <form class="" id="profile-company--form-edit-schedule" name="profile-company--form-edit-schedule" onsubmit="updateFormEditSchedule(event, this)">

            <input type="hidden" class="profile-company--form-schedule-component" data-schedule-for="id_company" name="id_company">
            <input type="hidden" class="profile-company--form-schedule-component" data-schedule-for="id_assessment" name="id_assessment">
            <input type="hidden" class="profile-company--form-schedule-component" data-schedule-for="type_report" name="type_assessment">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Date</label>
                        <div>
                            <div style="display:inline-block;">
                                <input class="form-control" name="schedule-date" id="profile-company--schedule--edit-date" type="date" required>
                            </div> 
                            <div style="display:inline-block; vertical-align: middle; cursor:pointer;">
                                <i class="material-icons" onclick="$('#profile-company--schedule--edit-date').datetimepicker('show');">date_range</i>
                            </div>
                        </div>

                        <span class="help-block">Klik <a onclick="$('#profile-company--schedule--edit-date').datetimepicker('show');" style="cursor:pointer;">disini</a> / icon kalender untuk ganti tanggal.</span>

                    </div>
                </div>
            </div>
        </form>

    </div> <!-- end tabpanel -->
</div>


<script type="text/javascript">
    var __row_id_brand,
    deferCertification = $.Deferred(), 
    deferSchedules = $.Deferred();
    function refreshTableCompany()
    {
        window.certificateTable.ajax.reload();
        window.schedulesTable.ajax.reload();
    }

    function addCertification(args)
    {

        $('#modalCreateCertification').modal({
            backdrop: false
        });
        $('#modalCreateCertification .modal-body').html('').load( site_url('certification/add'), {id_company: '<?php echo $company["id_company"] ?>'}, function(){
            nav.to({url:'#!/certification/choose', role:'replacestate', data: {state: 'certification'}})
        } );
        
    }    

    function changeStatus(event)
    {
        var company = $(event.target).attr('data-company'),
        status = $(event.target).val(),
        data_a0_cat_id = parseInt( $(event.target).attr('data-id_a0_cat') ),
        action = site_url('assessment/process/confirmation/status');

        data = {id_company: company, status: status, id_a0_cat: data_a0_cat_id};

        $.when( Company.get_assessment() ).done(function(response){

            response = response.filter(function(data){ return data.id_a0_cat === data_a0_cat_id })[0];
            response['new_status'] = status;
                // $('#modalCreateCertification .modal-body').load(site_url('certification/create'), response );

                $.post(site_url('certification/process/create/certificate'), response)
                .done(function (response){
                    response = JSON.parse(response);

                    if(response.success)
                    {

                    }

                    // console.log(response);

                })

            });

        switch(status)
        {
            case 'progress':
            break;

            case 'fail':
            break;

            case 'success':
                    // window.location.replace( site_url('certification/create') );

                    

                    break;
                }

        // window.location.reload();
    }

    function dataScheduleDate(date)
    {
        // date = moment(date).format('YYYY/MM/DD');
        $('#profile-company--schedule--edit-date').val(date)

    }

    function editSchedule(data)
    {
        $.each(data, function(a,b){
            $('.profile-company--form-schedule-component[data-schedule-for="'+a+'"]').val(b);
            $('.profile-company--schedule-description-'+a).text(b);
        })
        console.log(data)
        var $type = 'a0'; 
        var $id = data.id_a0;

        $type = (data.type_report == 'reassessment')? 'reassessment' : $type;
        $type = (data.type_report == 'audit khusus')? 'assessment' : $type;

        dataScheduleDate(data.assessment_date)
        $('.detail-request').attr('onclick',"Tools.popupCenter('"+site_url("assessment/data_detail_certification/"+$type+"/"+data.id_a0+"")+"','detailRequest',500,500)")
    }

    /*
    |
    |
    |
    */
    function updateFormEditSchedule(event, ui)
    {
        event.preventDefault();
        Snackbar.manual({spinner: true, message:'Memperbarui jadwal. Silahkan tunggu!' });

        var data = $(ui).serializeArray();
        $.post( site_url('assessment/update_schedule'), data )
        .done(function(res){
            console.log(res)
            Snackbar.show('Jadwal telah diubah');
            window.schedulesTable.ajax.reload();
            // Doctab.hide();
            $('<a  href="#profile-company--table"></a>').tab('show')
        })
    }

    function resetPasswordCompany(ui)
    {
        var $this = $(ui)
        $data = $this.data()
        
        swal({
            title: 'Memperbarui password',
            text: 'Aksi ini akan menghapus password yang lama dan digantikan dengan password yang baru. Password yang baru akan dikirimkan ke perusahaan terkait. apakah anda ingin melajutkan? ',
            type: 'warning',
            showCancelButton: true,
            closeOnCancel: true,
            closeOnConfirm: false,

        }, function(){

            swal({title:'Memperbarui password', text:'Silahkan tunggu sebentar!', type:'info', allowEscapeKey: false, showConfirmButton: false} );

            $.post(site_url('company/reset_password_perusahaan'), {id_company: $data.company})
            .done(function(res){
                swal('Password telah diperbarui', 'Password telah dikirimkan ke perusahaan terkait', 'success');
            })
            .error(function(res){
                swal('error', res.statusText, 'error');

            })

        }) /*end of warning*/
    }

    function companySettings(ui)
    {
        var $url = $(ui).attr('href');
        Doctab
        .show({
            load:
            {
                url: $url,
                data: {}
            },
        })
    }

    $(function(){

        $('#profile-company--schedule--edit-date').datetimepicker({
            timepicker:false,
            format:'Y-m-d',
            lang: 'id',
            minDate:0,

        });

        var brand = Company.get_brand({id_company: parseInt("<?php echo $company['id_company'] ?>")});
        var certificate_active = Company.get_certification_active({data:{id_company: "<?php echo $company['id_company'] ?>" }});

        $.when( brand, certificate_active ).done(function(resBrand, resCertActive){

            /*table certificate active*/
            window.certificateTable = $('#certification-list').DataTable({
                "searching": true,
                info: false,
                paging: true,
                lengthChange: false,
                ajax: 
                {
                    url: site_url('certification/get_certification_active_in_company/<?php echo $company["id_company"] ?>'),
                    dataSrc: function(json)
                    {
                        json = (json.data)? json.data : json;var i = 1;
                        if( json.length < 1 ) 
                        {
                            return false
                        }else
                        {
                            console.log(json)
                            $.each(json, function(a,b){
                                json[a]['no'] = i;
                                json[a]['action'] = '<a href="#profile-company--detail-certificate" data-role="pushstate" data-href="" ref-attribute="#!certificate/detail/'+b.id_a0_cat+'&id='+b.id_a0_cat+'&fn=true&fn_name=fetch_data_certificate" role="tab" data-toggle="tab" class="text-uppercase btn btn-edit btn-primary btn-sm"> Detail </a> <a target="_blank" class="mdl-button mdl-js-button mdl-button--icon" href="'+site_url('certification/view/5e45d0b30a386155c6807f5096c2029f/'+b.id_a0_cat)+'"> <i class="material-icons">link</i></a>';
                                i++;
                            })
                            return json;
                        }
                    }
                },
                columns: [
                {data: 'no'},
                {data: 'no_certificate'},
                {data: 'name'},
                {data: 'issued_date'},
                {data: 'certificate_status'},
                {data: 'action'},
                ],
                initComplete: function( settings, json ) {
                    deferCertification.resolve(json);
                }
            })

            // table assessment 
            window.schedulesTable = $('#schedules-list').DataTable({
                "searching": true,
                info: false,
                paging: true,
                lengthChange: false,
                ajax: 
                {
                    url: site_url('assessment/get__schedule'),
                    type: 'POST',
                    data: function(d){
                        var id_company = parseInt('<?php echo $company["id_company"] ?>')
                        var data = $.extend({},d, {id_company: id_company} )
                        return data;
                    },
                    dataSrc: function(json)
                    {
                        json = (json.data)? json.data : json;i=1;
                        if( json.length < 1 ) 
                        {
                            return false
                        }else
                        {
                            console.log(json)
                            $.each(json, function(a,b){
                                var typeDetail = 'assessment';
                                typeDetail = (b.type_report == 'assessment')? 'a0' : typeDetail;
                                var id = b.id_a0_cat;
                                id = (b.type_report == 'assessment')? b.id_a0 : id;
                                var typeDetail = (b.type_report == 'assessment')? "Permintaan awal" : "Surveilen "+b.description;

                                var url = site_url('assessment/data_detail_certification/'+typeDetail+'/'+id);
                                json[a]['no'] = i;
                                json[a]['sign'] = b.type_report+' '+b.type;
                                json[a]['detailtype'] = '<span class="">'+typeDetail+'</span> <a href="#" class="preventDefault pull-right mdl-button mdl-js-button mdl-button--icon" onclick="Tools.popupCenter(\''+url+'\',\'detailRequest\',500,500)"> <span class="material-icons" title="icon">info</span> </a>'
                                i++;
                            })
                            return json;
                        }
                    }
                },
                columns: [
                {data: 'no'},
                {data: 'detailtype'},
                {data: 'assessment_date'}
                ],
                initComplete: function( settings, json ) {
                    deferSchedules.resolve(json);
                }

            })


        });

Snackbar.manual({message: 'Memuat data. Silahkan tunggu!', spinner:true})

$.when(deferSchedules, deferCertification)
.done(function(a,b){
    Snackbar.show('data has been fully loaded!')
})
})
</script>

<?php if( $this->agent->is_mobile() ) { ?>

<script type="text/javascript">
 $(document).delegate('#schedules-list tr', 'click', function(e){
    e.preventDefault();
    $('<a  href="#profile-company--detail-schedule" aria-controls="home" role="tab" data-toggle="tab"></a>').tab('show')
    var data = window.schedulesTable.row(e.target).data();
    editSchedule(data)
            // console.log(e);
        })
    </script>

    <?php }else{ ?>
    <script type="text/javascript">
        $(document).delegate('#schedules-list tr', 'dblclick', function(e){
            e.preventDefault();
            $('<a  href="#profile-company--detail-schedule" aria-controls="home" role="tab" data-toggle="tab"></a>').tab('show')
            var data = window.schedulesTable.row(e.target).data();
            editSchedule(data)
        })
    </script>
    <?php } ?>