(function ( $ ) {
 
    $.fn.datatableHelper = function(options)
    {
    	var deff =$.Deferred(),
    		deffCreate = $.Deferred();

    	options = $.extend({
			"fnDrawCallback": function (oSettings) {
				deffCreate.resolve(oSettings)
			}
    	}, options)

    	var table = this.DataTable(options)
    	
    	deffCreate.promise().done(function(){
    		deff.resolve(table);
    	})
    	return deff.promise();

    }
 
}( jQuery ));