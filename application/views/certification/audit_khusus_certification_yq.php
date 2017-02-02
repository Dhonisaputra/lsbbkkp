<section class="navbar ">
    <a href="#tab-summary-request"  role="tab" data-toggle="tab" class="mdl-button mdl-js-button" onclick="window.close()">
        <i class="material-icons">close</i> Cancel 
    </a>
    <a href="#tab-summary-request"  role="tab" data-toggle="tab" class="btn btn-primary mdl-button mdl-js-button pull-right">
        Next <i class="glyphicon glyphicon-chevron-right"></i>
    </a>
</section>
<div class="form-group">
    <p><strong>Certificate :</strong> <?php echo $data['id_certificate'] ?></p>
    <p><strong>Issued :</strong> <?php echo $data['issued_date'] ?></p>
    <p><strong>Expired :</strong> <?php echo $expired['deadline_date'] ?></p>
</div>

<div class="mdl-grid">
    <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#yq-scope-certification" class="" aria-controls="home" role="tab" data-toggle="tab">Scope</a></li>
                <li role="presentation"><a href="#yq-nace-certification" class="" aria-controls="NACE" role="tab" data-toggle="tab">Nace</a></li>
                <!-- <li role="presentation"><a href="#yq-iso-certification" class="" aria-controls="ISO" role="tab" data-toggle="tab">Product Line</a></li> -->
            </ul>
            

             <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="yq-scope-certification">
                    
                    <div class="col-md-12">
                        <div class="commodity" id="yq-audit-khusus-commodity"></div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="yq-nace-certification">
                    <div class="col-md-12">
                        <div class="yq-filter-nace">
                            <div class="form-group">
                                <label>Filter</label>
                                <input class="form-control" placeholder="filter nace" id="yq-input-filter-nace">
                            </div>
                        </div>
                        <div class="nace" id="yq-audit-khusus-nace"></div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    
</div>


<!-- <div class="row">
    <div class="col-md-12 hidden-sm hidden-xs">
    <hr>
        <button href="#tab-request--JECA"  role="tab" data-toggle="tab" class="btn btn-primary" onclick="$('.presentation').removeClass('active');$('.presentation-JECA').addClass('active')">
          Next <i class="glyphicon glyphicon-chevron-right"></i>
        </button>
    </div>
</div> -->


<script type="text/javascript">
    
</script>