


var template_productLineCategory_yq = '<div class="row collapse--category collapsable-checkbox">' +
    '<div class="col-md-12 ">' +
        '<a class="" role="button" data-toggle="collapse" href="#product-line--category-yq--::product_line_number::" aria-expanded="false"> <span class="arrow">&#9658;</span> <span class="sentece-case">::product_line_name:: </span> </a>' +
        '<div class="collapse collapsable" id="product-line--category-yq--::product_line_number::">' +
            '<div class="col-md-12 collapsable-item collapsable-content"></div>' +
        "</div>" +
    "</div>" +
"</div>";

var template_productLineSubcategory_yq = '<div class="row collapse--category collapsable-checkbox">' +
    '<div class="col-md-12 ">' +
        '<a class="" role="button" data-toggle="collapse" href="#product-line--subcategory-yq--::product_line_id::" aria-expanded="false"> <span class="arrow">&#9658;</span> <span class="sentece-case">::product_line_name:: </span> </a>' +
        '<div class="collapse collapsable" id="product-line--subcategory-yq--::product_line_id::">' +
            '<div class="col-md-12 collapsable-item collapsable-content">  </div>' +
        "</div>" +
    "</div>" +
"</div>";


var template_productLineCategory_jeca = '<div class="row collapse--category collapsable-checkbox">' +
    '<div class="col-md-12 ">' +
        '<a class="" role="button" data-toggle="collapse" href="#product-line--category-jeca--::product_line_number::" aria-expanded="false"> <span class="arrow material-icons text-muted">add</span> <span class="sentece-case text-muted">::product_line_name:: </span> </a>' +
        '<div class="collapse collapsable" id="product-line--category-jeca--::product_line_number::">' +
            '<div class="col-md-12 collapsable-item collapsable-content"></div>' +
        "</div>" +
    "</div>" +
"</div>";

var template_productLineSubcategory_jeca = '<div class="row collapse--category collapsable-checkbox">' +
    '<div class="col-md-12 ">' +
        '<a class="" role="button" data-toggle="collapse" href="#product-line--subcategory-jeca--::product_line_id::" aria-expanded="false"> <span class="arrow material-icons text-muted">add</span> <span class="sentece-case text-muted">::product_line_name:: </span> </a>' +
        '<div class="collapse collapsable" id="product-line--subcategory-jeca--::product_line_id::">' +
            '<div class="col-md-12 collapsable-item collapsable-content">  </div>' +
        "</div>" +
    "</div>" +
"</div>";

var deferYQScope    = $.Deferred(),
    deferJECAScope  = $.Deferred(),
    deferJECANace   = $.Deferred(),
    deferYQNace     = $.Deferred();

var template_productLine_item_checkbox_yq = '<div class="parent-product-line-subcategory-item checkbox-childrens"> <div class="checkbox"> <label> <input type="checkbox" class="product-line-item" value="::product_line_id::" data-certification="YQ-005" onchange="$.fn.request_assessment.product_line(this)" >   <span class="sentece-case">::product_line_name::</span> </label </div> <div data-product_line_children="::product_line_id::-product_line-childrens"></div> </div>';
var template_productLine_item_checkbox_jeca = '<div class="parent-product-line-subcategory-item checkbox-childrens"> <div class="checkbox"> <label> <input type="checkbox" class="product-line-item" value="::product_line_id::" data-certification="JECA-004" onchange="$.fn.request_assessment.product_line(this)" >   <span class="sentece-case">::product_line_name::</span> </label </div> <div data-product_line_children="::product_line_id::-product_line-childrens"></div> </div>';
    
// certification ///////////////////////
    
    // JECA ///////////////
    $('#jeca-certification').certification({
        type:'JECA-004',
        template: '<div class="checkbox"> <label> <input type="checkbox" data-certification="JECA-004" data-role="checkbox-jeca-certification" class="certification--choose-certification-available" value="::audit_reference::" name="certification[]" form="form-add-certification" data-assessment="::name::" onchange="$.fn.request_assessment.certification(this);jstools_accreditation_request(this,\'JECA-004\', \'certification\');">  <span>::name::</span> </label </div>'
    })

    $.fn.product_line.initialize()
    .done(function(all, item, subcategory, category){
        Tools.write_data({
            template: template_productLineCategory_jeca,
            records: category,
            target: '#jeca-product-line',
            afterAppend: function(a,b,c)
            {
                var sCat = subcategory.filter(function(res){
                    return res.product_line_parent == c.product_line_number;
                })
                Tools.write_data({
                    template: template_productLineSubcategory_jeca,
                    records: sCat,
                    target: $(b).find('.collapsable-content'),
                    afterAppend: function(event, d, e){
                        
                        var sItem = item.filter( function(res){ return res.product_line_parent == e.product_line_number } )
                        Tools.write_data({
                            template: template_productLine_item_checkbox_jeca,
                            records: sItem,
                            target: $(d).find('.collapsable-content'),
                            
                        })
                    }
                })
            }
        })
    })
    // $('#jeca-product-line').product_line({
    //     type: 'JECA-004',
    //     template: '<div class="col-md-12 parent-product-line-category" data-filter="::product_category_id::"> <div class="checkbox"> <label> <input type="checkbox" class="iso--choose-product_line-available sr-only" value="::product_category_id::" name="" form="helper-form--request-certification" data-assessment="::product_category_name::" data-certification="JECA-004" data-gath="iso_subcategory" onchange="$.fn.product_line_category.toggle(event, this)"> <span class="sign glyphicon glyphicon-plus"></span>  <span>::product_category_name::</span> </label </div> <div data-product_line_children="::product_category_id::-category-childrens"></div> </div>'
    // })

    $('#jeca-commodity').commodity({
        template: '<div class="checkbox"> <label> <input type="checkbox" class="commodity--choose-item" data-role="checkbox-jeca-commodity" value="::id_commodity::" name="jeca_commodity[]" form="helper-form--request-certification" data-certification="JECA-004" onchange="$.fn.request_assessment.scope(this); jstools_accreditation_request(this,\'JECA-004\', \'scope\');" disabled>  <span>::commodity_name::</span> </label> </div>'
    })
    .done(function(){
        deferJECAScope.resolve();
    });

    /*$('#jeca-nace').nace_category({
        type: 'JECA-004',
    })
    .done(function(res){
        deferJECANace.resolve();
    });*/
    /*$.fn.nace.MLM('#yq-nace')
    .done(function(res){
        deferJECANace.resolve();
    });*/

    // YQ /////////////////

    $('#yq-certification').certification({
        type:'YQ-005',
        template: '<div class="checkbox"> <label> <input type="checkbox" data-certification="YQ-005" data-role="checkbox-yq-certification" class="certification--choose-certification-available" value="::audit_reference::" name="certification[]" form="form-add-certification" data-assessment="::name::" onchange="$.fn.request_assessment.certification(this); jstools_accreditation_request(this,\'YQ-005\', \'certification\')" disabled>  <span>::name::</span> </label </div>'
    })
    
    // $('#yq-product-line').product_line({
    //     type: 'YQ-005',
    //     template: '<div class="col-md-12 parent-product-line-category" data-filter="::product_category_id::"> <div class="checkbox"> <label> <input type="checkbox" class="iso--choose-product_line-available sr-only" value="::product_category_id::" name="" form="helper-form--request-certification" data-assessment="::product_category_name::" data-certification="YQ-005" data-gath="iso_subcategory" onchange="$.fn.product_line_category.toggle(event, this)"> <span class="sign glyphicon glyphicon-plus"></span>  <span>::product_category_name::</span> </label </div> <div data-product_line_children="::product_category_id::-category-childrens"></div> </div>'
    // })

   /* $.fn.product_line.dataDefer()
    .done(function(all, item, subcategory, category){
        Tools.write_data({
            template: template_productLineCategory_yq,
            records: category,
            target: '#yq-product-line',
            afterAppend: function(a,b,c)
            {
                var sCat = subcategory.filter(function(res){
                    return res.product_line_parent == c.product_line_number;
                })
                Tools.write_data({
                    template: template_productLineSubcategory_yq,
                    records: sCat,
                    target: $(b).find('.collapsable-content'),
                    afterAppend: function(event, d, e){
                        
                        var sItem = item.filter( function(res){ return res.product_line_parent == e.product_line_number } )
                        Tools.write_data({
                            template: template_productLine_item_checkbox_yq,
                            records: sItem,
                            target: $(d).find('.collapsable-content'),
                            
                        })
                    }
                })
            }
        })
    })*/

    $('#yq-commodity').commodity({
        template: '<div class="checkbox"> <label> <input type="checkbox" class="commodity--choose-item" data-role="checkbox-yq-commodity" value="::id_commodity::" name="yq_commodity[]" form="helper-form--request-certification" data-certification="YQ-005" onchange="$.fn.request_assessment.scope(this); jstools_accreditation_request(this,\'YQ-005\', \'scope\');" disabled>  <span>::commodity_name::</span> </label> </div>'
    })
    .done(function(){
        deferYQScope.resolve();
    });

    $('#yq-nace').nace_category({
        type: 'YQ-005',
    })
    .done(function(){
        deferYQNace.resolve();
    })

    //////////////////////
    
/////////////////////////////////////////
    

// AUDIT KHUSUS //////////////////////////////

    // JECA ///////////////

    $('#jeca-audit-khusus-commodity').commodity({
        template: '<div class="checkbox"> <label> <input type="checkbox" class="commodity--choose-item" data-role="checkbox-jeca-commodity" value="::id_commodity::" name="jeca_commodity[]" form="helper-form--request-certification" data-certification="JECA-004" onchange="$.fn.request_assessment.scope(this)" >  <span>::commodity_name::</span> </label> </div>'
    });

    $('#jeca-audit-khusus-product-line').product_line({
        type: 'JECA-004',
        template: '<div class="col-md-12 parent-product-line-category" data-filter="::product_category_id::"> <div class="checkbox"> <label> <input type="checkbox" class="iso--choose-product_line-available sr-only" value="::product_category_id::" name="" form="helper-form--request-certification" data-assessment="::product_category_name::" data-certification="JECA-004" data-gath="iso_subcategory" onchange="$.fn.product_line_category.toggle(event, this)"> <span class="sign glyphicon glyphicon-plus"></span>  <span class="sentece-case">::product_category_name::</span> </label </div> <div data-product_line_children="::product_category_id::-category-childrens"></div> </div>'
    }).done(function(){
    })

    // YQ ///////////////
    
    

    $('#yq-audit-khusus-commodity').commodity({
        template: '<div class="checkbox"> <label> <input type="checkbox" class="commodity--choose-item" data-role="checkbox-yq-commodity" value="::id_commodity::" name="yq_commodity[]" form="helper-form--request-certification" data-certification="YQ-005" onchange="$.fn.request_assessment.scope(this)">  <span>::commodity_name::</span> </label> </div>'
    });
    
    $('#yq-audit-khusus-nace').nace_category({
        type: 'YQ-005',
    })
    

    $('a[href="#yq-nace-certification"][data-toggle="tab"]').on('shown.bs.tab', function (e) {

        Tools.element.filter({
            trigger_using: $('#yq-input-filter-nace'),
            target: $('#yq-nace [data-filter]')
        })
    });
    $('a[href="#jeca-nace-certification"][data-toggle="tab"]').on('shown.bs.tab', function (e) {

        Tools.element.filter({
            trigger_using: $('#jeca-input-filter-nace'),
            target: $('#jeca-nace .parent-nace-category[data-filter]')
        })
        
    })

    $('a[href="#tab-request--JPA"][data-toggle="tab"]').on('show.bs.tab', function (e) {

        if( $('#tab-product--jpa .jpa-certification-item').length < 1 )
        {

        }
        
    })

    // additional
    $(document).delegate('.radio--choose-commodity', 'change', function(event){
        var isCheck = $(event.target).is(':checked'),
            data = $(event.target).data();

        // remove all checkbox in prev data
        $(this).parents('[_]').find('.checkbox--choose-subcommodity').prop('checked',false);
        // collapse hide all
        $(this).parents('[_]').find('.collapse--subcommodity').collapse('hide')
        // collapse show all
        $(this).parents('.list-commodity').find('.collapse--subcommodity').collapse('show')
    });

    // filling brand
    function data_brand(ui)
    {
            // get attr _ sebagai identifier object JPA
        var _ = $(ui).parents('[_]').attr('_'),
            // split berdasarkan [,] dan ambil hanya yang ada isinya !""
            value = $(ui).val().split(',').filter(function(res){return res !== ""}),
            // certification type
            certification = 'JPA-009';
        $.fn.request_assessment.addProduct.brand(certification,_,value);
    }

    // JPA SECTIOn ///////////////////////////////////////////////////////////////////////////////////////////////////
    $(document).delegate('[role-certificate="JPA-009"][_] .radio--choose-commodity', 'change', function(event){
         var _      = $(event.target).parents('[_]').attr('_'),
            isCheck = $(event.target).is(':checked'),
            data    = $(event.target).data(),
            value   = $(event.target).val(),
            certification = 'JPA-009';

            $.fn.request_assessment.addProduct.commodity(certification,_,value);
    })

    $(document).delegate('[role-certificate="JPA-009"][_] .checkbox--choose-subcommodity', 'change', function(event){
        var _       = $(event.target).parents('[_]').attr('_'),
            isCheck = $(event.target).is(':checked'),
            data    = $(event.target).data(),
            value   = $(event.target).parents('[_]').find('.checkbox--choose-subcommodity[data-commodity="'+data.commodity+'"]').serializeArray().map(function(res){return res.value}),
            certification = 'JPA-009';

            $.fn.request_assessment.addProduct.subcommodity(certification,_,value);
    })

    $(document).delegate('[role-certificate="JPA-009"][_] .certification--choose-certification-available', 'change', function(event){
        var _       = $(event.target).parents('[_]').attr('_'),
            isCheck = $(event.target).is(':checked'),
            data    = $(event.target).data(),
            value   = $(event.target).parents('[_]').find('.certification--choose-certification-available').serializeArray().map(function(res){return res.value}),
            certification = 'JPA-009';

            $.fn.request_assessment.addProduct.certification(certification,_,value);
    })

    $(document).delegate('[name="yq-type"][data-certification="YQ-005"]','change', function(event){
        var value = $(this).val();

        if(value == 1)
        {
            $('[data-role="checkbox-yq-commodity"]').prop('disabled',false)
            $('.certification--choose-certification-available[data-certification="YQ-005"][data-role="checkbox-yq-certification"]').prop('disabled',false)
        }else
        {
            $('[data-role="checkbox-yq-commodity"]:checked, .certification--choose-certification-available[data-certification="YQ-005"][data-role="checkbox-yq-certification"]:checked ').trigger('click')
            $('[data-role="checkbox-yq-commodity"], .certification--choose-certification-available[data-certification="YQ-005"][data-role="checkbox-yq-certification"]').prop('disabled',true)
        }
    })

    $(document).delegate('[name="jeca-type"][data-certification="JECA-004"]','change', function(event){
        var value = $(this).val();

        if(value == 1)
        {
            $('[data-role="checkbox-jeca-commodity"]').prop('disabled',false)
            $('.certification--choose-certification-available[data-certification="JECA-004"][data-role="checkbox-jeca-certification"]').prop('disabled',false)
        }else
        {
            $('[data-role="checkbox-jeca-commodity"]:checked, .certification--choose-certification-available[data-certification="JECA-004"][data-role="checkbox-jeca-certification"]:checked ').trigger('click')
            $('[data-role="checkbox-jeca-commodity"], .certification--choose-certification-available[data-certification="JECA-004"][data-role="checkbox-jeca-certification"]').prop('disabled',true)
        }
    })
    
    // TOGGLE JECA PRODUCT LINE
    $(document).delegate('#jeca-product-line .collapsable', 'show.bs.collapse', function (event) {
        // do something…
        var id = $(event.target).attr('id');
        $('a[href="#'+id+'"]').find('.arrow').text('remove')
    })
    $(document).delegate('#jeca-product-line .collapsable', 'hide.bs.collapse', function (event) {
        // do something…
        var id = $(event.target).attr('id');
        $('a[href="#'+id+'"]').find('.arrow').text('add')
    })

     // TOGGLE JPA PRODUCT LINE
    $(document).delegate('#jpa-product-line--new .collapsable', 'show.bs.collapse', function (event) {
        // do something…
        var id = $(event.target).attr('id');
        $('[data-target="#'+id+'"]').find('.material-icons').text('remove')
    })
    $(document).delegate('#jpa-product-line--new .collapsable', 'hide.bs.collapse', function (event) {
        // do something…
        var id = $(event.target).attr('id');
        $('[data-target="#'+id+'"]').find('.material-icons').text('add')
    })
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /*
    |-------------------------
    | Defer for status gathering data
    |-------------------------
    */
    $.when(deferYQScope, deferJECAScope, deferYQNace)
    .done(function(){
        swal('Data telah selesai diambil','', 'success');
        Snackbar.show('Data telah selesai diambil!')
        $('.sentece-case').sentenceCase();
    })

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function submit(event, options)
    {

        options = $.extend({
            data: $.fn.request_assessment.data,
            form: $(form)
        }, options)
        
        swal({   
            title: "Mendaftarkan sertifikasi",   
            text: "Menambahkan sertifikasi sedang dalam proses. Silahkan tunggu!",   
            type: "info",   
            showConfirmButton: false
        });

        Snackbar.manual({message: 'Mendaftarkan sertifikasi!', spinner:true });
        var data = $.fn.request_assessment.data,
            form = $('form');
        // check apakah ada self assessment yang true
        // yq self assessment?
        var isYQ_self_announce = $.fn.request_assessment.data['YQ-005'].is_self_announcement,
            isJECA_self_announce = $.fn.request_assessment.data['JECA-004'].is_self_announcement,
            isBrandEmpty = [];

        var dataBrand = $.fn.request_assessment.data['JPA-009'].filter(function(res){ return res.brand == ""})
        
        if(dataBrand.length > 0)
        {
            alert('Daftar merek masih kosong!');
            $('[_="'+dataBrand[0].id+'"] [name="brand"]').focus();
            return false;
        }else
        {
            $.post(form.attr('action'), $.fn.request_assessment.data)
            .done(function(res){
                Snackbar.hide();
                Snackbar.show('Permintaan sertifikasi telah berhasil ditambahkan!');
                swal('Permintaan sertifikasi selesai ditambahkan', '', 'success');
                window.location.href = site_url('company');                
            })
            .error(function(res){
                // console.log(res);
                swal('Kesalahan saat mengirim email', 'Gagal saat mengirimkan email konfirmasi ke perusahaan. Kemungkinan karena koneksi anda yang bermasalah atau karena server sedang tidak stabil.', 'error');

            })
        }

    }
   