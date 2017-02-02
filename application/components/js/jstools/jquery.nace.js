
var naceDeferred = $.Deferred();

function nacecategory_change(event, ui)
{

    var data = $(ui).data(),
        isLSBBKP = $('.self-announcement[data-certification="'+data.certification+'"]:checked').val();
    if(isLSBBKP == "0" && data.is_verify !== 'false')
    {
        swal('Silahkan pilih LSBBKKP terlebih dahulu','Maaf, anda tidak dapat melanjutkan memilih. Silahkan pilih LSBBKKP terlebih dahulu untuk melakukan sertifikasi oleh LSBBKKP!', 'error');
        $(ui).prop('checked',false)
        return false;
    }
    var data = $(ui).parents('.parent-nace-category').data();
    if( $(ui).is(':checked') )
    {
        var gath = $(ui).data('gath'),
            uidata = $(ui).data(),
            subcat = $.fn.nace.data.filter(function(res){ return res.nace_type == gath })


        $(ui).siblings('.sign').removeClass('glyphicon-plus').addClass('glyphicon-minus');

        if( $(ui).parents('.parent-nace-category').find(' [data-nace_children="'+data.nace_item+'-category-childrens"] > .checkbox-childrens').length < 1)
        {
            $(ui).parents('.parent-nace-category').find('[data-nace_children="'+data.nace_item+'-category-childrens"]').nace_subcategory(data.nace_item, {type: uidata.certification});
        }else
        {
            $(ui).parents('.parent-nace-category').find('[data-nace_children="'+data.nace_item+'-category-childrens"] > .checkbox-childrens').show();
        }
    }else
    {
        $(ui).siblings('.sign').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        $(ui).parents('.parent-nace-category').find('[data-nace_children="'+data.nace_item+'-category-childrens"] > .checkbox-childrens').hide()
    }
}

function nace_subcategory_change(event, ui)
{

    var data = $(ui).parents('.parent-nace-subcategory').data();
    if( $(ui).is(':checked') )
    {

        var gath = $(ui).data('gath'),
            uidata = $(ui).data(),
            subcat = $.fn.nace.data.filter(function(res){ return res.nace_type == gath })
        $(ui).siblings('.sign').removeClass('glyphicon-plus').addClass('glyphicon-minus');


        if( $(ui).parents('.parent-nace-subcategory').find('[data-nace_children="'+data.nace_item+'-subcategory-childrens"]>.checkbox-childrens').length < 1)
        {
            $(ui).parents('.parent-nace-subcategory').find('[data-nace_children="'+data.nace_item+'-subcategory-childrens"]').nace_subcategory_item(data.nace_item, {type: uidata.certification});
        }else
        {
             $(ui).parents('.parent-nace-subcategory').find('[data-nace_children="'+data.nace_item+'-subcategory-childrens"]>.checkbox-childrens').show();
        }
    }else
    {
        $(ui).siblings('.sign').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        $(ui).parents('.parent-nace-subcategory').find('[data-nace_children="'+data.nace_item+'-subcategory-childrens"]>.checkbox-childrens').hide()
    }
}

function nace_subcategory_item_change(event, ui)
{

    var data = $(ui).parents('.parent-nace-subcategory_item').data()
    if( $(ui).is(':checked') )
    {

        var gath    = $(ui).data('gath'),
            uidata = $(ui).data(),
            subcat  = $.fn.nace.data.filter(function(res){ return res.nace_type == gath })

        $(ui).siblings('.sign').removeClass('glyphicon-plus').addClass('glyphicon-minus');

        if( $(ui).parents('.parent-nace-subcategory_item').find('[data-nace_children="'+data.nace_item+'-subcategory-childrens"]>.checkbox').length < 1)
        {
            $(ui).parents('.parent-nace-subcategory_item').find('[data-nace_children="'+data.nace_item+'-subcategory-childrens"]').nace_item(data.nace_item, {type: uidata.certification});
        }else
        {
            $(ui).parents('.parent-nace-subcategory_item').find('[data-nace_children="'+data.nace_item+'-subcategory-childrens"]>.checkbox').show();
        }
    }else
    {
        $(ui).siblings('.sign').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        $(ui).parents('.parent-nace-subcategory_item').find('[data-nace_children="'+data.nace_item+'-subcategory-childrens"]>.checkbox').hide()
    }
}
(function ( $ ) {
    function nace_key()
    {
        var buf = new Uint16Array(2);
        var unique = window.crypto.getRandomValues(buf).join('');
        var uniqid = (new Date().getTime()).toString(16)+unique;
        return 'nace-'+uniqid;
    }
    function write_nace(data, target)
    {

        var defer = $.Deferred();
            // ambil data paling depan
        var $TOPDATA    = data.shift(),
            // replace nace item. e.g 10.2.3 => 10-2-3
            $ID         = nace_key()+'_'+$TOPDATA.nace_item.replace(/\./g, '-'),
            // replace nace parent. e.g 10.2.3 => 10-2-3
            $ID_PARENT  = $TOPDATA.nace_parent.replace(/\./g, '-'),
            // target append
            $TARGET_PARENT = $('.data-nace--tree').find('[nace-item-for="'+$TOPDATA.nace_parent+'"]'),
            $IS_REVOKE  = '',
            // main template
            $TEMPLATE   = '<div class="nace-tree--parent nace-tree--'+$TOPDATA.nace_type+'" data-nace-type="'+$TOPDATA.nace_type+'">'+
                                '<div class="toggler--parent collapsed" data-toggle="collapse" data-target="#'+$ID+'" aria-expanded="false" aria-controls="'+$ID+'"> '+
                                    '<div class="toggler--menu">'+$IS_REVOKE+
                                        '<span class="nace--item" style=""></span>'+
                                        '<span class="nace--name" style=""></span>'+
                                        '<div class="btn-group btn-group--vert-nace-menu" style="display:inline-block;">'+
                                            '<button type="button" class="mdl-button mdl-js-button mdl-button--icon dropdown-toggle button-toggle--menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">'+
                                                '<i class="material-icons" style="font-size:18px;">more_vert</i>'+
                                            '</button>'+
                                            '<ul class="dropdown-menu">'+
                                                
                                            '</ul>'+
                                        '</div>'+
                                    '</div>'+
                            '</div>'+
                            '<div class="collapse" id="'+$ID+'"><div class="nace--child" nace-item-for=""></div></div> '
            // parse tobe jquery object
            $TEMPLATE = $($TEMPLATE)

            // car nace name
            $TEMPLATE.find('.nace--name').text($TOPDATA.nace_name);
            // cari nace item
            $TEMPLATE.find('.nace--item').html('<strong>('+$TOPDATA.nace_item+')</strong>. ');
            // hide menu more_vert
            $TEMPLATE.find('.btn-group--vert-nace-menu').hide();
            // create new attribute
            $TEMPLATE.find('[nace-item-for]').attr('nace-item-for',$TOPDATA.nace_item);

            

            // append main template
            $TEMPLATE.appendTo($TARGET_PARENT)
            .each(function(){
                // add data
                $(this).data($TOPDATA);
                // append menu
                
            })
            // $TARGET_PARENT.append()

        // jika data masih ada, write_nace lagi
        if(data.length > 0)
        {
            write_nace(data)
        }else {
            defer.resolve({});
        }
        return $.when(defer.promise());
        
    }

    $.fn.nace = function(options)
    {
        var deff = $.Deferred();

        options = $.extend({ 
            records: $.fn.nace.records(),
            target: this,
            template: '<div class="checkbox"> <label> <input type="checkbox" class="nace--choose-nace-available" value="::nace_item::" name="nace[]" form="helper-form--request-certification" data-assessment="::nace_name::" onchange="$.fn.request_assessment.nace(this)">  <span class="sentece-case">::nace_name::</span> </label </div>'
        }, options)
        $.fn.nace.options = options;

        $.when(options.records)
        .done(function(res){
           
            Tools.write_data({
                records: res,
                target: options.target,
                template: options.template,
                type: options.type,
                overwrite:false,
                typeWrite: 'append' 
            })
            .done(function(res){
                deff.resolve(res);
            })
        
        })
        return $.when( deff.promise() );
    };

    $.fn.nace.data = undefined;
    $.fn.nace.options = {};
    $.fn.nace.mlm = [];

    $.fn.nace.records = function()
    {
        var deff = $.Deferred();
        if($.fn.nace.data)
        {
            deff.resolve($.fn.nace.data);
        }else
        {
            $.post(site_url('nace/process/get/data'))
            .done(function(res){
                res = JSON.parse(res);
                $.fn.nace.data = res;
                deff.resolve(res);
               
            })
        }

        return deff.promise();
    };

    $.fn.nace_category = function(options)
    {
        var ui = this,
            deff = $.Deferred();

        $.when( $.fn.nace.records() )
        .done(function(res){
            res = res.filter(function(res){ return res.nace_type == 'nace_category' });

            options = $.extend({
                records:res,
                type: options.type,
                template: '<div class="col-md-12 parent-nace-category" data-filter="::nace_name::"> <div class="checkbox"> <label> <input type="checkbox" class="nace--choose-nace-available sr-only" value="::nace_item::" name="" form="helper-form--request-certification" data-assessment="::nace_name::" data-gath="nace_subcategory" data-certification="'+options.type+'" onchange="nacecategory_change(event, this)"> <span class="sign glyphicon glyphicon-plus"></span>  <span><strong>(::nace_item::)</strong> ::nace_name::</span> </label </div> <div data-certification="'+options.type+'" data-nace_children="::nace_item::-category-childrens"></div> </div>'
            }, options)

            $(ui).nace(options)
            .done(function(res){

                deff.resolve(res);
            })
        })
        
        return $.when(deff.promise());
        
    }

    $.fn.nace_subcategory = function(nace_category, options)
    {
        var ui = this,
            data = $(ui).data();

        $.when( $.fn.nace.records() )
        .done(function(res){

            res = res.filter(function(res){ return res.nace_type == 'nace_subcategory' && res.nace_parent == nace_category });
            options = $.extend({
                records:res,
                template: '<div class="col-md-12 parent-nace-subcategory checkbox-childrens" data-filter="::nace_name::"> <div class="checkbox"> <label> <input type="checkbox" class="nace--choose-nace-available sr-only" value="::nace_item::" name="" form="helper-form--request-certification" data-assessment="::nace_name::" data-gath="nace_subcategory_item" data-certification="'+options.type+'" onchange="nace_subcategory_change(event, this)"> <span class="sign glyphicon glyphicon-plus"></span>  <span><strong>(::nace_item::)</strong> ::nace_name::</span> </label </div> <div data-nace_children="::nace_item::-subcategory-childrens" data-certification="'+options.type+'" class="checkbox-childrens"></div> </div>',
                
            }, options)

            $(ui).nace(options);
        })
        return this;
    }

    $.fn.nace_subcategory_item = function(nace_subcategory, options)
    {
        var ui = this,
            data = $(ui).data();

        $.when( $.fn.nace.records() )
        .done(function(res){
            res = res.filter(function(res){ return res.nace_type == 'nace_sub_subcategory' && res.nace_parent == nace_subcategory});
            options = $.extend({
                records:res,
                template: '<div class="col-md-12 parent-nace-subcategory_item checkbox-childrens" data-filter="::nace_name::"> <div class="checkbox"> <label> <input type="checkbox" class="nace--choose-nace-available sr-only" value="::nace_item::" name="" form="helper-form--request-certification" data-assessment="::nace_name::" data-gath="nace_item" data-certification="'+options.type+'" onchange="nace_subcategory_item_change(event, this)"> <span class="sign glyphicon glyphicon-plus"></span> <span><strong>(::nace_item::)</strong> ::nace_name::</span> </label </div> <div data-nace_children="::nace_item::-subcategory-childrens" class="checkbox-childrens" data-certification="'+options.type+'"></div> </div>',

            }, options)
            $(ui).nace(options);
        })
        return this;
    }

    $.fn.nace_item = function(nace_subcategory_item, options)
    {
        var ui = this,
            data = $(ui).data();

        $.when( $.fn.nace.records() )
        .done(function(res){
            res = res.filter(function(res){ return res.nace_type == 'nace_item' && res.nace_parent == nace_subcategory_item });
            options = $.extend({
                records:res,
                template: '<div class="checkbox"> <label> <input type="checkbox" class="nace--choose-nace-available" value="::nace_item::" name="nace[]" form="helper-form--request-certification" data-assessment="::nace_name::" onchange="$.fn.request_assessment.nace(this)" data-certification="'+options.type+'">  <span>::nace_name::</span> <strong>::nace_item::</strong> </label </div>'
            }, options)
            $(ui).nace(options);
        })
        return this;
    }

    $.fn.nace.MLM = function(target){
        var defer = $.Deferred();
        $.when( $.fn.nace.records() )
        .done(function(res){
            write_nace(res, target)
            defer.resolve({})
        })
        return $.when(defer.promise());
    }
 
}( jQuery ));

