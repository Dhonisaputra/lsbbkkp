<style type="text/css">
    .mdl-navigation__link:hover
    {
        color: #333 !important;

    }
    .navmenu-header
    {
    }
    .mdl-layout__header
    {
        min-height: 50px !important;
        background: #22313F !important;
        color: #333 !important;
    }
    .navmenu-header .mdl-layout__drawer-button
    {
        justify-content: center;
        align-items: center;
        display: flex;
    }

</style>

<!-- No header, and the drawer stays open on larger screens (fixed drawer). -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer navmenu-header">
<!-- <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header navmenu-header"> -->
    
    <!-- <header class="mdl-layout__header ">
        <div class="mdl-layout__header-row">
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
                <label class="mdl-button mdl-js-button mdl-button--icon" for="fixed-header-drawer-exp">
                    <i class="material-icons">search</i>
                </label>
                <div class="mdl-textfield__expandable-holder">
                    <input class="mdl-textfield__input" type="text" name="sample" id="fixed-header-drawer-exp">
                </div>
            </div>
        </div>
  </header> -->
  <!-- Always shows a header, even in smaller screens. -->
  

    <div class="mdl-layout__drawer mdl-layout--background" style="background:#333 !important;color:white;">
        <span class="mdl-layout-title">Menu</span>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="<?php echo site_url(); ?>"><i class="material-icons">dashboard</i> Dashboard</a>
            <a class="mdl-navigation__link" href="<?php echo site_url('notification'); ?>"><i class="material-icons">notifications</i> <span class="mdl-badge __notificication__counter" data-badge="0"> Notifications </span> </a>
            <a class="mdl-navigation__link" href="<?php echo site_url('company'); ?>"><i class="material-icons">business</i> Company</a>
            <a class="mdl-navigation__link" href="<?php echo site_url('certification'); ?>"><i class="material-icons">verified_user</i> Certification</a>
            <a class="mdl-navigation__link" href="<?php echo site_url('commodity'); ?>"><i class="material-icons">touch_app</i> Commodity</a>
            <a class="mdl-navigation__link" href="<?php echo site_url('calendar'); ?>"><i class="material-icons">date_range</i> Calendar</a>
            <a class="mdl-navigation__link" href="<?php echo site_url('users'); ?>"><i class="material-icons">people</i> Users</a>
            <a class="mdl-navigation__link" href="<?php echo site_url('logout'); ?>"><i class="material-icons">lock_open</i> Log out</a>
        </nav>
    </div>
    <main class="mdl-layout__content">
        <div class="page-content">