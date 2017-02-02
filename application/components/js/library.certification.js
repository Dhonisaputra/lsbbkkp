var Certification = (function(){

	var o = function(){}

	o.prototype = 
	{
		get_certification: function()
		{
			var deff = $.Deferred();
			$.post(site_url('certification/process/get/list'))
			.done(function(response){
				response = JSON.parse(response);
				deff.resolve(response);
			})

			return deff.promise();
		},

		/*
		* Append Data
		* 
		*
		* Jika ingin mengganti template, untuk data yang ingin dituliskan, jadikan dalam pattern berikut. 
		* contohnya ada response object company_name, dan kita ingin menuliskannya di attributes value
		* jadi kita tulis ... value="(:company_name)"
		*/
		appendData: function(options)
		{
			var dataText = '', 
				deff = $.Deferred();

			options = $.extend({target:undefined, records: Certification.get_certification(), template: '<option value="::cat_certificate::">::name::</option>' }, options)
			if(!options.target)
			{
				console.info('Certification appendData need target to append. if target undefined, this data will be text and served with deferred.');
			}

			$.when(options.records).done(function(response){

				$.each(response, function(a,b){
					var pattern, renderTemplete = options.template;
					$.each(b, function(c,d){
						pattern = '::'+c+'::';
						var reg = new RegExp(pattern, 'g');
						renderTemplete = renderTemplete.replace(reg, b[c]);
					})
					if(options.target)
					{
						$(options.target).append(renderTemplete);
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

	return new o();
})()