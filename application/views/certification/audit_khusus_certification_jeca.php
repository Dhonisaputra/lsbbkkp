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

<!-- 
<div class="form-group">
    <div class="radio">
        <label><input type="radio" name="jeca-type" class="self-announcement" data-certification="JECA-004" value="0" onchange="$.fn.request_assessment.self_announcement('JECA-004',true)" checked> Self Announcement</label>
    </div>
</div>

<div class="form-group">
    <div class="radio">
        <label><input type="radio" name="jeca-type" class="self-announcement" data-certification="JECA-004" value="1" onchange="$.fn.request_assessment.self_announcement('JECA-004',false)"> LSBBKKP </label>
    </div>
</div>
 -->
<div class="mdl-grid">
    <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">

        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#jeca-scope-certification" aria-controls="home" role="tab" data-toggle="tab">Scope</a></li>
                <!-- <li role="presentation"><a href="#jeca-nace-certification" aria-controls="NACE" role="tab" data-toggle="tab">Nace</a></li> -->
                <li role="presentation"><a href="#jeca-iso-certification" aria-controls="ISO" role="tab" data-toggle="tab">Product Line</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="jeca-scope-certification">
                    <div class="col-md-12">
                        <div class="commodity" id="jeca-audit-khusus-commodity"></div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="jeca-nace-certification">
                    <div class="col-md-12">
                        <div class="yq-filter-nace">
                            <div class="form-group">
                                <label>Filter</label>
                                <input class="form-control" placeholder="filter nace" id="jeca-input-filter-nace">
                            </div>
                        </div>
                        <div class="nace" id="jeca-audit-khusus-nace"></div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="jeca-iso-certification">
                    <div class="col-md-12">
                        <div class="certification" id="jeca-product-line"></div>
                    </div>
                    
                </div>
            </div>

        </div>

    </div>

</div>
<script type="text/javascript">
    
</script>