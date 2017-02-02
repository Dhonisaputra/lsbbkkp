<html>
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>

<?php $this->load->view('templates/headsource', array('title'=> @$title)); ?>
<body class="">

    <div class="sr-only">
        <a href="#document-actual-tab" role="tab" data-toggle="tab"></a>
        <a href="#document-inline-tab" role="tab" data-toggle="tab"></a>
    </div>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">

        <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title">Home</span>
                <div class="mdl-layout-spacer"></div>

                <button class="mdl-button mdl-js-button mdl-js-ripple-effect notification-popover" tabindex="0" role="button" data-placement="bottom" data-toggle="popover" data-trigger="manual" id="btn-notification"> 
                    <i class="material-icons mdl-badge mdl-badge--overlap mdl-badge--notification" data-badge="0">public</i>
                </button>
                
            </div>
        </header>

        <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
            <header class="demo-drawer-header text-center">
                <center> <img src="<?php echo (!isset($_SESSION['avatar']) )? base_url('application/components/images/user.jpg') : base_url($_SESSION['avatar']) ?>" class="demo-avatar img-round"> </center>
                <span style="margin-top: 20px;"><?php echo $_SESSION['username'] ?></span>
            </header>

            <nav class="demo-navigation mdl-navigation mdl-main-navigation mdl-color--blue-grey-800">
                <?php if ($_SESSION['level'] == 100){ ?>
                    <a class="mdl-navigation__link" href="<?php echo site_url('users') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">verified_user</i> users </a>
                    <a class="mdl-navigation__link" href="<?php echo site_url('akuntansi') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">attach_money</i> akuntansi </a>
                    <a class="mdl-navigation__link" href="<?php echo site_url('certification/panel_manipulasi_kelengkapan_dokumen') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">insert_drive_file</i> Panel dokumen </a>
                    <a class="mdl-navigation__link" href="<?php echo site_url('users') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">person</i> Users </a>
                    
                <?php } ?>
                <?php if($_SESSION['level'] == 1){ ?> <!-- A D M I N  -->

                <a class="mdl-navigation__link <?php echo ($this->uri->segment(1) == '')? 'active' : ''; ?>" href="<?php echo site_url() ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings_input_component</i>Assessment Setup</a>
                <a class="mdl-navigation__link <?php echo ($this->uri->segment(1) == 'assessment')? 'active' : ''; ?>" href="<?php echo site_url('assessment/schedules') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">schedule</i>Assessment Schedule</a>
                <a data-engine="pushstate" data-target="#document-actual-tab" title="perusahaan" class="mdl-navigation__link <?php echo ($this->uri->segment(1) == 'company')? 'active' : ''; ?>" href="<?php echo site_url('company') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">domain</i>Company Registration</a>
                <a class="mdl-navigation__link <?php echo ($this->uri->segment(1) == 'certification')? 'active' : ''; ?>" href="<?php echo site_url("certification/panel") ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">book</i>Accredited ISO/SNI Certification</a>
                <a class="mdl-navigation__link <?php echo ($this->uri->segment(1) == 'auditor')? 'active' : ''; ?>" href="<?php echo site_url("auditor") ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">group</i>Auditor Profile</a>

                <?php }elseif ($_SESSION['level'] == 2) { ?> <!-- A U D I T O R -->

                <a data-engine="pushstate" data-target="#document-actual-tab" title="Home" class="mdl-navigation__link <?php echo ($this->uri->segment(2) == 'panel' && $this->uri->segment(3) == '')? 'active' : ''; ?>" href="<?php echo site_url('auditor/panel') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">dashboard</i> Dashboard </a>
                <a data-engine="pushstate" data-target="#document-actual-tab" title="Calendar" class="mdl-navigation__link <?php echo ($this->uri->segment(2) == 'panel' && $this->uri->segment(3) == 'calendar')? 'active' : ''; ?>" href="<?php echo site_url('auditor/panel/calendar/'.$_SESSION['id_users']) ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">event</i> Kalender </a>
                <a data-engine="pushstate" data-target="#document-actual-tab" title="Jadwal" class="mdl-navigation__link <?php echo ($this->uri->segment(2) == 'panel' && $this->uri->segment(3) == 'schedule')? 'active' : ''; ?>" href="<?php echo site_url('auditor/panel/schedule/'.$_SESSION['id_users']) ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">view_list</i> Jadwal </a>
                <a data-engine="pushstate" data-target="#document-actual-tab" title="Setting" class="mdl-navigation__link <?php echo ($this->uri->segment(2) == 'profile' && $this->uri->segment(3) == 'settings')? 'active' : ''; ?>" href="<?php echo site_url('auditor/profile/settings/'.$_SESSION['id_users']) ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">build</i> settings </a>

                <?php }elseif ($_SESSION['level'] == 3) { ?> <!-- P J T -->

                <a data-engine="pushstate" data-target="#document-actual-tab" title="" class="mdl-navigation__link <?php echo ($this->uri->segment(1) == 'pjt' && $this->uri->segment(3) == '')? 'active' : ''; ?>" href="<?php echo site_url('pjt/panel') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">dashboard</i> PJT Dashboard </a>
                <a data-engine="pushstate" data-target="#document-actual-tab" title="" class="mdl-navigation__link <?php echo ($this->uri->segment(1) == 'pjt' && $this->uri->segment(3) == 'company')? 'active' : ''; ?>" href="<?php echo site_url('pjt/panel/company') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i> Perusahaan </a>

                <?php }elseif ($_SESSION['level'] == 4) { ?> <!-- C O M P A N Y -->

                <a class="mdl-navigation__link <?php echo ($this->uri->segment(1) == 'company' && $this->uri->segment(2) == 'dashboard')? 'active' : ''; ?>" href="<?php echo site_url('company/dashboard') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">dashboard</i> Dashboard </a>
                <a title="Ajukan sertifikasi" class="mdl-navigation__link " href="<?php echo site_url('company/ajukan_permintaan_sertifikasi/'.$_SESSION['id_company']) ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">class</i> Ajukan sertifikasi </a>
                <a class="mdl-navigation__link <?php echo ($this->uri->segment(1) == 'company' && $this->uri->segment(3) == 'settings')? 'active' : ''; ?>" href="<?php echo site_url('company/panel/settings') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">build</i> Settings </a>

                <?php } ?>
                <a class="mdl-navigation__link " href="<?php echo site_url("logout") ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">lock_outline</i>Logout</a>
                <div class="mdl-layout-spacer"></div>
                <a class="mdl-navigation__link" href="<?php echo site_url('faq') ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
            </nav>

        </div>

        <main class="mdl-layout__content mdl-color--grey-100 ">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="document-actual-tab" style="margin:10px;">