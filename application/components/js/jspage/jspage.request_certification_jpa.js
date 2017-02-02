    function open_summary()
    {
        $('a[href="#tab-summary-request"]').tab('show');
    }

    /*
    |-----------------------------------------------------------------------
    */
    function jpa_onchange_type(LSBBKKP)
    {
        if(LSBBKKP == 'LSBBKKP' )
        {
            // $.fn.request_assessment.self_announcement('JPA-009',false);
            $('#jpa-audit-baru--certification .section--certification-jpa').show()
            if($('#jpa-audit-baru--certification .section--certification-jpa:not(.clone)').length < 1)
            {
                clone_jpa()
            }

            $.each($.jsdata_accreditation_request.records(), function (a,b){
                if(b.type === 'JPA-009')
                {
                    b.is_self_announcement = false;
                }
            })
        }else {
            $('#jpa-audit-baru--certification .section--certification-jpa').hide()
            // $.fn.request_assessment.self_announcement('JPA-009',true);
            
            $.each($.jsdata_accreditation_request.records(), function (a,b){
                if(b.type === 'JPA-009')
                {
                    b.is_self_announcement = true;
                }
            })

        }
    }
    function product_line_structurize()
    {
        var defer = $.Deferred();
        $.fn.product_line.initialize()
        .done(function(res){
            var o = {},
            oArr = []
            $.each(res, function(a,b){
                if(!o[b.product_line_parent])
                {
                    o[b.product_line_parent] = [];
                }

                // oArr.push(o);
            })

             $.each(res, function(c,d){
                if(o[d.product_line_parent])
                {
                    o[d.product_line_parent].push(c)
                }
            })

            $.each(o, function(c){
            })

            defer.resolve(o, res)
        })   

        return $.when(defer.promise());
    }

    function product_line_MLM(target)
    {
        var buf = new Uint16Array(2);
        var unique = window.crypto.getRandomValues(buf).join('');
        var uniqid = (new Date().getTime()).toString(16)+unique;

        product_line_structurize()
        .done(function (structure,data){
            var structures = Object.keys(structure).sort();
            $.each(structures, function(a,b){
                
                $.each(structure[b], function(c,d){
                    var d0 = data[d]
                    var $target = (b == 0)? $(target) : $(target).find('.product-line-parent[data-product-line-parent="'+d0.product_line_parent+'"]');
                    
                    var $TEMPLATE = '<div class="product-line--container"><div class="handler-toggle " role="button" data-toggle="collapse" data-target="#'+d0.product_line_type+d0.product_line_id+'_'+uniqid+'" aria-expanded="false" aria-controls="collapseExample"> <span class="material-icons material-icons--middle">add</span> <div class="radio" style="display: inline-block"></div> <span class="product-line-name product-line-name--number">'+d0.product_line_number+'</span> <span class="product-line-name product-line-name--title sentence-case">'+d0.product_line_name+' </span> </div>'+
                            '<div class="collapse collapsable" id="'+d0.product_line_type+d0.product_line_id+'_'+uniqid+'">'+
                                '<div class="data-appended-product-line product-line-parent" data-product-line-parent="'+d0.product_line_number+'" id="'+d0.product_line_type+d0.product_line_number+'_'+uniqid+'">'+
                                '</div>'+
                            '</div></div>';

                    $TEMPLATE = $($TEMPLATE);        
                    $TEMPLATE.appendTo($target)
                    .each(function(){

                        // make sentence case
                        $(this).find('.sentence-case').sentenceCase();

                        if(d0.product_line_type === 'item')
                        {
                            $(this).find('div.radio').html('<label> <input type="radio" class="jpa_product_line_picker" name="'+uniqid+'_jpa_product_line_picker" value="'+d0.product_line_id+'"> '+d0.product_line_number+' '+d0.product_line_name+' </label>')

                            $(this).find('span.product-line-name').text('')

                            $(this).find('.jpa_product_line_picker').data(d0)

                           

                            if(d0.note == '1')
                            {
                                $(this)
                                .find('#'+d0.product_line_type+d0.product_line_number+'_'+uniqid)
                                .html(  '<div class="notes-container row"><div class="col-md-5">'+
                                            '<div class="form-group  has-warning has-feedback"><label>Spesifikasi Produk</label><input class="form-control input-sm insert-notes-product-line" placeholder="Isikan spesifikasi produk (cth: SIR 10)">'+
                                            ' <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>'+
                                            '<span id="helpBlock" class="help-block"> Pisahkan dengan koma ",".</span> </div>'+
                                        '</div>')
                            }else {
                                 $(this).find('.handler-toggle')
                                .removeAttr('href')
                                .removeAttr('aria-expanded')
                                .removeAttr('data-toggle')
                                .removeClass('collapsed');
                                $(this)
                                .find('.handler-toggle .material-icons')
                                .remove();
                            }
                        }
                    })
                })
            })
            
        })

    }