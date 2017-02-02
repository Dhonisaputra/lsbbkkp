<!-- <section class="navbar navbar-fixed-top navbar-primary">
    <button href="#tab-request--JECA"  role="tab" data-toggle="tab" class="mdl-button mdl-js-button pull-right" onclick="$('.presentation').removeClass('active');$('.presentation-JECA').addClass('active')">
      Next <i class="glyphicon glyphicon-chevron-right"></i>
    </button>
</section> -->
            
<div class="form-group">
    <div class="radio">
        <label><input type="radio" name="yq-type" class="self-announcement" data-certification="YQ-005" value="0" checked onchange="yq_onchange_type()"> Self Announcement</label>
        <span class="help-block text-warning">Jika anda sudah memiliki sertifikasi sendiri, silahkan pilih ini!</span>
    </div>
</div>

<div class="form-group">
    <div class="radio">
        <label><input type="radio" name="yq-type" class="self-announcement" data-certification="YQ-005" value="1" onclick="" onchange="yq_onchange_type('LSBBKKP')"> LSBBKKP </label>
        <span class="help-block text-warning">Jika Anda ingin disertifikasi oleh LSBBKKP , silahkan pilih ini terlebih dahulu!</span>
    </div>
</div>

<div class="mdl-grid section--certification sr-only" id="section--certification-yq">
    <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--9-col">
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#yq-scope-certification" class="text-uppercase" aria-controls="home" role="tab" data-toggle="tab">Ruang Lingkup</a></li>
                <li role="presentation"><a href="#yq-nace-certification" class="text-uppercase" aria-controls="NACE" role="tab" data-toggle="tab">Nace</a></li>
                <!-- <li role="presentation"><a href="#yq-iso-certification" class="" aria-controls="ISO" role="tab" data-toggle="tab">Product Line</a></li> -->
            </ul>
            

             <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="yq-scope-certification">
                    <div class="col-md-12">
                        <div class="commodity" id="yq-commodity"></div>
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
                        <div class="nace" id="yq-nace">
                            <div class="data-nace--tree">
                                <div class="" nace-item-for="0"></div>
                            </div>
                            <div class="data-nace--tree">
                                <div class="" nace-item-for="0"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div role="tabpanel" class="tab-pane" id="yq-iso-certification">
                    
                    <div class="col-md-12">
                        <div class="certification" id="yq-product-line"></div>
                    </div>

                </div> -->
            </div>
        </div>
    </div>
    <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--3-col">
        <div class="list-group list-group-flat"><div class="list-group-item active"> <center>Jenis sertifikat</center> </div></div>
        <div class="col-md-12">
            <div class="certification" id="yq-certification"></div>
        </div>
    </div>
</div>


