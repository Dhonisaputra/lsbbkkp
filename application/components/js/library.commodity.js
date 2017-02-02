var Commodity = (function(){
	
	var o = function(){}

	o.prototype = 
	{
		get: 
		{
			commodity_list: function()
			{
				var deff = $.Deferred();

				$.post(site_url('commodity/process/get/list'))
				.done(function(res){
					res = JSON.parse(res);
					deff.resolve(res);
				})
				return deff.promise();
			}
		},

		render: 
		{
			commodity_list: function(options)
			{
				options = $.extend({records: Commodity.get.commodity_list(options), target: undefined },options);
				this.__main(options);
			},

			__main: function(options)
			{
				var deff = $.Deferred(), dataText;
				options = $.extend({target:undefined, records: [], template: '' }, options)
				/*when option records given*/
				$.when(options.records).done(function(response){
				// console.log(response)

					$.each(response, function(a,b){
						
						/*stream number is number that automatically create such as 1,2,3,4,5,6,..,n*/
						var pattern, 
							renderTemplete = options.template;
						
							renderTemplete = renderTemplete.replace(/\(:__stream_number\)/, a+1);

						$.each(b, function(c,d){

							pattern = '::'+c+'::';
							var reg = new RegExp(pattern, 'g');
							renderTemplete = renderTemplete.replace(reg, b[c]);
						})
						
						if(options.target)
						{
							$(options.target).append(renderTemplete);
							componentHandler.upgradeAllRegistered()
						}else
						{
							dataText += renderTemplete;
						}

					})
					deff.resolve(dataText);
				})

				return deff.promise();
			}
		}
		
	}

	return new o();
})()