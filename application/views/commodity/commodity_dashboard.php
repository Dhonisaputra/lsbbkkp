<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="tab--add-commodity">

        <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <!-- Colored raised button -->
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" href="#tab--home-commodity" role="tab" data-toggle="tab">
                <i class="material-icons">keyboard_backspace</i> Home
            </button>
        </div>
        
        <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <?php $this->load->view('commodity/form_add_commodity'); ?>
        </div>


    </div>
    
    <div role="tabpanel" class="tab-pane active" id="tab--home-commodity">
        
        <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <!-- Colored raised button -->
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" href="#tab--add-commodity" role="tab" data-toggle="tab">
                <i class="material-icons">add</i> Add Commodity
            </button>
        </div>

        <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">

            <?php $this->load->view('commodity/commodity_table'); ?>

        </div>

    </div>
</div>


