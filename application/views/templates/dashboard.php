<!-- 
    yang perlu ditampilkan
    
-->

<?php echo $this->load->component('js','js/library.company.js'); ?>
<?php echo $this->load->component('js','js/library.bootstrap_helper.js'); ?>

<?php echo $this->load->component('js', 'js/zebra_datepicker/javascript/zebra_datepicker.js') ?>
<?php echo $this->load->component('css', 'js/zebra_datepicker/css/default.css') ?>

<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<?php echo $this->load->component('css', 'css/main_dashboard.css') ?>


<?php echo $this->load->component('js', 'plugins/ckeditor/ckeditor.js') ?>
<?php echo $this->load->component('js', 'plugins/ckeditor/config.js') ?>
<?php echo $this->load->component('js', 'plugins/ckeditor/adapters/jquery.js') ?>


<style type="text/css">
    .axis path, .axis line
    {
        fill: none;
        stroke: #777;
        shape-rendering: crispEdges;
    }

    .axis text
    {
        font-family: 'Arial';
        font-size: 13px;
    }
    .tick
    {
        stroke-dasharray: 1, 2;
    }
    .bar
    {
        fill: FireBrick;
    }
    .easy-autocomplete, .Zebra_DatePicker_Icon_Wrapper
    {
        width: 100% !important;
    }


</style>
<section class="nav navbar">
    <button class="mdl-button mdl-js-button mdl-button--icon bs-tooltip" title="Refresh Table" data-placement="right" onclick="refreshMainTable()" data-upgraded=",MaterialButton" > 
      <i class="material-icons">replay</i>
  </button>
  <div class="pull-right">
  <a data-engine="pushstate" data-target="#document-actual-tab" href="<?php echo site_url('certificate/search') ?>" class="mdl-button mdl-js-button"> <i class="material-icons">search</i> Cari Sertifikat </a>
</div>
</section>
<input type="hidden" name="sum_assessment">


<div class="" style="padding-top:20px;">
    <div class=" mdl-grid">

        <div class="demo-card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--3-col mdl-cell-3-col-tablet mdl-cell--2-col-phone card-top" style="background:#3498DB;" role="tab" data-toggle="tab" href="#dashboard-tab--certificate-tab">
            <div class="mdl-card__title mdl-card--expand" style="">
                <div class="content-widget">
                    <div class="text-content-widget color_white mdl-confirmed-assessment-badge">0</div>
                    <div class="text-subcontent-widget color_white"><i class="material-icons icons-middle">event_available</i> Jadwal terkonfirmasi </div>
                </div>

            </div>
        </div>

        <div class="demo-card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--3-col mdl-cell-3-col-tablet mdl-cell--2-col-phone card-top"  style="background:#3498DB;" role="tab" data-toggle="tab" href="#tab-schedule--missed-schedules">
            <div class="mdl-card__title mdl-card--expand" style="">
                <div class="content-widget">
                    <div class="text-content-widget color_white text mdl-new-assessment-badge">0</div>
                    <div class="text-subcontent-widget color_white"><i class="material-icons icons-middle">local_offer</i> Sertifikasi baru </div>
                </div>

            </div>
        </div>

        <div class="demo-card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--3-col mdl-cell-3-col-tablet mdl-cell--2-col-phone card-top" style="background:#3498DB;" role="tab" data-toggle="tab" href="#dashboard-tab--assessment-tab">
            <div class="mdl-card__title mdl-card--expand" style="">
                <div class="content-widget">
                    <div class="text-content-widget color_white mdl-active-certificate-badge">0</div>
                    <div class="text-subcontent-widget color_white"><i class="material-icons icons-middle">verified_user</i> Sertifikat terdaftar </div>
                </div>

            </div>
        </div>

    </div>

    <div class="mdl-tooltip" for="reAssessment"> View Reassessment Schedules </div>
    <div class="mdl-tooltip" for="newAssessment"> View new assessment Schedules </div>
    <div class="mdl-tooltip" for="expiredAssessment"> View Expired Certification </div>

    <!-- //////////////////////////// end of nav card //////////////////////////////////// -->
    <div class="tab-content">

        <div role="tabpanel" class="tab-pane active" id="dashboard-tab--assessment-tab" >
            <!-- start tab -->
            <?php $this->load->view('templates/dashboard--tab-assessment') ?>
            <!-- end tab -->
        </div>
        
    </div>
</div>    

<!-- Modal -->
<div class="modal fade" id="assessmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<?php echo $this->load->component('js', 'js/jspage.main_dashboard.js') ?>
<?php echo $this->load->component('js', 'js/jstools/jstools.filter_assessment_dashboard.js') ?>
