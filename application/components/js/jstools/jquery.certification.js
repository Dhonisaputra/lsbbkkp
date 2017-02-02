(function ( $ ) {
    
    $.fn.certification = function(options)
    {
        if(typeof options == 'string' && $.fn.certification.type.indexOf(options) > -1)
        {
            options = {type: options};
        }

        options = $.extend({ 
            records: $.fn.certification.records(),
            target: this,
            template: '<div class="checkbox"> <label> <input type="checkbox" class="certification--choose-certification-available" value="::audit_reference::" name="certification[]" form="helper-form--request-certification" data-assessment="::name::" >  <span>::name::</span> </label </div>'
        }, options)
        var deff = $.Deferred();

        $.when(options.records)
        .done(function(res){
            if(options.type)
            {
                var res = res.filter(function(res){ return res.type == options.type && res.revoke_audit_reference == 0 });
            }


            Tools.write_data({
                records: res,
                target: options.target,
                template: options.template
            })
            .done(function(){
                deff.resolve({});
            })
        
        })
        return $.when( deff.promise() )
    };

    $.fn.certification.type = ['YQ-005', 'JECA-004', 'JPA-009'];
    
    $.fn.certification.records = function()
    {
        var deff = $.Deferred();
        $.post(site_url('certification/process/get/list'))
        .done(function(res){
            res = JSON.parse(res);
            deff.resolve(res);
        })

        return deff.promise();
    }
 
}( jQuery ));