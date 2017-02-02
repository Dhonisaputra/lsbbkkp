var _scopeDataDeff = $.Deferred();
(function ( $ ) {

    $.fn.commodity = function(options)
    {

        var deff = $.Deferred();

    	options = $.extend({
    		records: $.fn.commodity.records(),
    		target: this,
    		template: '<div class="checkbox"> <label> <input type="checkbox" class="commodity--choose-item" value="::id_commodity::" name="commodity[]" >  <span>::commodity_name::</span> </label> </div>',
    		subcommodity: function(event, data)
    		{

    		}
    	}, options);

    	$.when(options.records)
    	.done(function(res){
    		$.fn.commodity.data = res;
    		$.when(
				Tools.write_data({
					records: res,
					target: options.target,
					template: options.template
				})
			)
			.done(function(){
                var event = new Event('commodity');
				options.subcommodity(event, $.fn.commodity.data);
                _scopeDataDeff.resolve($.fn.commodity.data)
                deff.resolve();
			})

    	})

		return $.when(deff.promise());
    	
    };

    // data
    $.fn.commodity.data = {};
    $.fn.commodity.dataRecords = {};
    ///////////////////

    $.fn.commodity.subcommodity = function()
    {

    };
    $.fn.commodity.subcommodityTarget = false;

    $.fn.commodity.records = function()
    {
    	var deff = $.Deferred();

    	$.post(site_url('commodity/get_commodity') )
		.done(function(res){
			res = JSON.parse(res)
            $.fn.commodity.dataRecords = res;
			deff.resolve(res);	
		});

		return deff.promise();

    };
 
}( jQuery ));
