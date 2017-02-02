<!-- <section class="navbar navbar-fixed-top hidden-md hidden-lg navbar-primary">
    <button href="#tab-request--YQ"  role="tab" data-toggle="tab" class="mdl-button mdl-js-button" onclick="$('.presentation').removeClass('active');$('.presentation-yq').addClass('active')">
        <i class="glyphicon glyphicon-chevron-left"></i> Prev
    </button>
    <button href="#tab-request--JPA"  role="tab" data-toggle="tab" class="mdl-button mdl-js-button pull-right" onclick="$('.presentation').removeClass('active');$('.presentation-JPA').addClass('active');">
        Next <i class="glyphicon glyphicon-chevron-right"></i>
    </button>
</section> -->

<div class="form-group">
    <div class="radio">
        <label><input type="radio" name="jeca-type" class="self-announcement" data-certification="JECA-004" value="0" onchange="jeca_onchange_type()" checked> Self Announcement</label>
        <span class="help-block text-warning">Jika anda sudah memiliki sertifikasi sendiri, silahkan pilih ini!</span>
    </div>
</div>

<div class="form-group">
    <div class="radio">
        <label><input type="radio" name="jeca-type" class="self-announcement" data-certification="JECA-004" value="1" onchange="jeca_onchange_type('LSBBKKP')"> LSBBKKP </label>
        <span class="help-block text-warning">Jika Anda ingin disertifikasi oleh LSBBKKP , silahkan pilih ini terlebih dahulu!</span>
    </div>
</div>

<div class="mdl-grid section--certification sr-only" id="section--certification-jeca">
    <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--9-col">

        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a class="text-uppercase" href="#jeca-scope-certification" aria-controls="home" role="tab" data-toggle="tab">Ruang Lingkup</a></li>
                <!-- <li role="presentation"><a href="#jeca-nace-certification" aria-controls="NACE" role="tab" data-toggle="tab">Nace</a></li> -->
                <li role="presentation"><a class="text-uppercase" href="#jeca-iso-certification" aria-controls="ISO" role="tab" data-toggle="tab">Lini Produk</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="jeca-scope-certification">
                    <div class="col-md-12">
                        <div class="commodity" id="jeca-commodity"></div>
                    </div>
                </div>

                <!-- <div role="tabpanel" class="tab-pane" id="jeca-nace-certification">
                    <div class="col-md-12">
                        <div class="yq-filter-nace">
                            <div class="form-group">
                                <label>Filter</label>
                                <input class="form-control" placeholder="filter nace" id="jeca-input-filter-nace">
                            </div>
                        </div>
                        <div class="nace" id="jeca-nace"></div>
                    </div>
                </div> -->

                <div role="tabpanel" class="tab-pane" id="jeca-iso-certification">
                    <div class="col-md-12">
                        <div class="certification" id="jeca-product-line"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--3-col">
        <div class="list-group list-group-flat flat"><div class="list-group-item active"> <center>Jenis sertifikat</center> </div></div>
        <div class="col-md-12">
            <div class="certification" id="jeca-certification"></div>
        </div>
    </div>
</div>


