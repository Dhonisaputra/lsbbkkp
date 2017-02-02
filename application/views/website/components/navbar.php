<!-- Uses a header that contracts as the page scrolls down. -->
<style>
    .demo-layout-waterfall .mdl-layout__header-row .mdl-navigation__link:last-of-type  {
        padding-right: 0;
    }
</style>

<div class="demo-layout-waterfall mdl-layout mdl-js-layout mdl-layout--fixed-header ">
    <header class="mdl-layout__header web-component--navbar web-component--header">
        <!-- Top row, always visible -->
        <div class="mdl-layout__header-row web-component--header hidden-xs hidden-sm">
            <!-- Title -->
                
                <div class="col-md-3 col-xs-12 col-sm-12">
                    <img src="<?php echo site_url('application/components/images/logo_yoqa.png') ?>" class="img-responsive">
                </div>
                <div class="mdl-layout-spacer"></div>
                <div class="form-group">
                   <!-- Colored raised button -->
                    <a href="<?php echo site_url('company/signup') ?>" target="_blank" class="text-center mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                      Daftar sekarang
                    </a>
                    <a href="<?php echo site_url('login') ?>" target="_blank" class="text-center mdl-button mdl-js-button masuk mdl-button--raised">
                      Log in
                    </a>
                </div>

        </div>
        <div class="container hidden-md hidden-lg">
            <div class="mdl-grid flex-space-around flex-distributed" style="">
                <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <img src="<?php echo site_url('application/components/images/logo_yoqa.png') ?>" class="img-responsive text-center">
                </div>
                <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="pull-right">
                        
                    <a href="<?php echo site_url('company/signup') ?>" target="_blank" class="text-center mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                      Daftar sekarang
                    </a>
                    <a href="<?php echo site_url('login') ?>" target="_blank" class="text-center mdl-button mdl-js-button masuk mdl-button--raised">
                      Log in
                    </a>
                    </div>
                </div>
            </div>
        </div>

    </header>
   
    
</div>