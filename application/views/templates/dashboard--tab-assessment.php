<!-- standard Angular -->
    
<?php echo $this->load->component('js', 'jsdata/jsdata.assessment_send_as.js') ?>
<?php echo $this->load->component('js', 'jsdata/jsdata.auditor_assignment.js');  ?>

<?php #echo $this->load->component('js', 'plugins/angular/angular.min.js');  ?>
<?php #echo $this->load->component('js', 'js/jstools/angular.assessment_setup.js');  ?>

<style type="text/css">
    .section--filter-by-date
    {
        font-size: 19px;
    }
    .section--filter-by-date>*
    {
        display: inline-block !important;
    }
    .mdl-tabs-table-schedule .mdl-tabs__panel .table-schedules
    {
        margin-top: 15px;
    }
    .table tr
    {
        cursor: pointer;
    }
</style>

<div class="panel panel-default" ng-app="assessment_setup">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-5">
                <div class="section--filter-by-date">
                    <span><?php echo date('M Y') ?> - </span>                
                    <div><input class="form-control sr-only" placeholder="Batas Atas" type="date" id="fetch-between--start" value="<?php echo date('Y-m-01') ?>"></div>
                    <div><input class="" placeholder="Batas Bawah" type="text" id="fetch-between--end" style="border: none; background: transparent; box-shadow: none; font-size: 20px; width:100px;" value="<?php echo date('M Y', strtotime("+3 months", strtotime( date('Y-m-d') ))) ?>"> </div> 
                </div>
                <div class="section--filter-by-date--helper-text text-muted">Nilai default adalah 3 bulan dari bulan <?php echo date('F') ?>. <br>Klik <a href="#" onclick="FilterDashboard.resetDate();return false;">reset</a> untuk kembali ke nilai awal</div>
            </div>
        </div>

       <!--  <div class="col-md-3">
            <div class="form-group">
                <span id="helpBlock" class="help-block text-info"> Default is 3 months </span>
            </div>    
        </div>
        <div class="form-group"> <button class="mdl-button mdl-js-button" onclick=""> <i class="material-icons">clear</i> clear </button> </div>   
 -->

        <div class="mdl-tabs-table-schedule mdl-tabs mdl-js-tabs">

            <div class="mdl-tabs__tab-bar">
                <a href="#allschedule-panel" class="mdl-tabs__tab is-active "> <span class="mdl-badge mdl-all-schedules-badge" data-badge="0">semua jadwal</span> </a>
                <a href="#unconfirmSchedules-panel" class="mdl-tabs__tab "><span class="mdl-badge mdl-unconfirmed-schedules-badge" data-badge="0">jadwal belum dikonfirmasi</span> </a>
                <!-- <a href="#assessmentProgress-panel" class="mdl-tabs__tab "><span class="mdl-badge mdl-new-schedules-badge" data-badge="-">New Assessment</span> </a> -->
                <a href="#lannisters-panel" class="mdl-tabs__tab "> <span class="mdl-badge mdl-confirmed-schedules-badge" data-badge="0">Jadwal telah dikonfirmasi</span> </a>
                <!-- <a href="#passedSchedule-panel" class="mdl-tabs__tab "> <i class="material-icons icons-middle text-danger">warning</i> <span class="mdl-badge mdl-missed-schedules-badge" data-badge="-">Missed Schedule</span> </a> -->
            </div>


            <div class="mdl-tabs__panel is-active" id="allschedule-panel">
                 
                
                <div class="table-responsive col-md-12 table-schedules" ng-controller="sse_checker_all_schedules as sse_as">
                    <table class="table table-stripped  table-hover" id="allSchedules" style="width:100%;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Batas Waktu</th>
                                <th>Perusahaan</th>
                                <th>Negara</th>
                                <th>Wilayah</th>
                                <th>Type</th>
                                <th>action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="form-group  pull-right">
                    <!-- Colored raised button -->
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="assessment-group--send-as-single" create disabled onclick="notify_as_single()">
                        Kirim sebagai surveilen inidividu
                    </button>
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="assessment-group--send-as-group" create disabled onclick="notify_as_group()">
                        Kirim sebagai surveilen kelompok
                    </button>
                </div>

            </div>

            <div class="mdl-tabs__panel" id="unconfirmSchedules-panel">
                
                <div class="table-responsive col-md-12 table-schedules">
                    <table class="table table-stripped  table-hover" id="unconfirmedSchedules" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Batas waktu</th>
                                <th>Perusahaan</th>
                                <th>Negara</th>
                                <th>Wilayah</th>
                                <th>Tanda</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="form-group  pull-right">
                    <!-- Colored raised button -->
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="resend_email()">
                        Kirim ulang
                    </button>
                </div>

            </div>
            
            <!-- <div class="mdl-tabs__panel" id="assessmentProgress-panel">

                <div class="table-responsive col-md-12">
                    <table class="table table-stripped  table-hover" id="tableAssessment1" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Company</th>
                                <th>Notification Date</th>
                                <th>Assessment Date</th>
                                <th>Type</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div> -->

            <div class="mdl-tabs__panel" id="lannisters-panel" style="padding-top:20px;">
                <div class="alert alert-info flat row">
                    <span class="material-icons material-icons--middle">info</span> Silahkan pilih jadwal dengan cara klik pada salah satu baris. 
                </div>
                
                <button class="mdl-button mdl-button-js btn btn-primary" href="#confirmed--single" role="tab" data-toggle="tab" onclick="dataTypeReassessment(this)">Individual <span class="badge confirmed-single-badge" data-badge="0"></span></button>
                <button class="mdl-button mdl-button-js btn btn-default" href="#confirmed--group" role="tab" data-toggle="tab" onclick="dataTypeReassessment(this)">Kelompok <span class="badge confirmed-group-badge" data-badge="0"></span></button>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="confirmed--single">
                        <div class="table-responsive col-md-12 table-schedules">
                            <table class="table table-stripped table-hover tableConfirmed" id="tableConfirmed--single" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Tanggal dilaksanakan</th>
                                        <th>Perusahaan</th>
                                        <th>Negara</th>
                                        <th>Kabupaten</th>
                                        <th>keterangan</th>
                                        <th>Assign</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="confirmed--group">
                        <div class="table-responsive col-md-12 table-schedules">
                            <table class="table table-stripped table-hover tableConfirmed" id="tableConfirmed--group" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Tanggal dilaksanakan</th>
                                        <th>Perusahaan</th>
                                        <th>Negara</th>
                                        <th>Kabupaten</th>
                                        <th>Assign</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div> <!-- end table responsive -->

                    </div>
                </div>
                
                <div class="form-group  pull-right">
                    <!-- Colored raised button -->
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="assessment_assigned()">
                        Tambahkan Auditor
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>


