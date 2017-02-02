var Company = (function(){
	var o = function(){}
	
	o.prototype = 
	{
		list: function()
		{
			return this.get();
		},
		get: function(data)
		{
			var deff = $.Deferred();
			data = $.extend({action:'company_list'}, data);
			$.post('controllers/company/getCompany.php', data)
			.done(function (response){
				response = JSON.parse(response);
				deff.resolve(response);
			})
			return deff.promise();
		}
	}

	return new o();
})()