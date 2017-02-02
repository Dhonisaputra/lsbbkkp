var Company = (function(){

	var o = function(){}

	o.prototype = 
	{
		error: [],
		save_brand: function(options)
		{
			var deff = $.Deferred();
			options = $.extend({  
				data: {},
				action: site_url('company/process/create/brand'),
				done: function(response)
				{

				},
			},options)

			$.post(options.action, options.data)
			.done(function(response){
				deff.resolve( JSON.parse(response) );
				options.done(response);
			})
			
			return deff.promise();
		},
		
		get_company: function(options)
		{
			var deff = $.Deferred();

			options = $.extend({filter: 'none', data: {}},options);

			$.post(site_url('company/process/get/all/company'))
			.done(function(response){
				deff.resolve( JSON.parse(response) );
			})

			switch(options.filter)
			{
				case 'none':
					return deff.promise();
					break;
			}
		},

		get_brand: function(options)
		{
			var deff = $.Deferred();

			options = $.extend({filter: 'none', id_company: 0},options);

			$.post(site_url('company/process/get/brand/'+options.id_company+'/json'))
			.done(function(response){
				deff.resolve( JSON.parse(response) );
			})

			switch(options.filter)
			{
				case 'none':
					return deff.promise();
					break;
			}
		},

		get_assessment: function(options)
		{
			var deff = $.Deferred();

			options = $.extend({filter: 'none', id_company: undefined, id_brand: undefined},options);

			$.post(site_url('assessment/process/get/list'))
			.done(function(response){
				response = JSON.parse(response);
				if(options.id_company)
				{
					response = response.filter(function(data){ return data.id_company == options.id_company })
				}

				if(options.id_brand)
				{
					response = response.filter(function(data){ return data.id_brand == options.id_brand })
				}

				deff.resolve( response );

			})

			switch(options.filter)
			{
				case 'none':
					return deff.promise();
					break;
			}
		},

		/*
		* untuk menampilkan semua certification yang bisa didaftarkan oleh sebuah brand
		* need params
			- id_brand
		*/
		get_certification_available_for_brand: function(options)
		{
			options = $.extend({data: {} }, options);
			if(!options.data.id_brand)
			{
				alert('no id company in argument get certification active in company. please check your data');
				return false;
			}
			var deff = $.Deferred();

			$.post(site_url('certification/process/get/brand/available_certification'), {id_brand: parseInt(options.data.id_brand) } )
			.done(function(response){
				response = JSON.parse(response);
				deff.resolve( response );
			})
			return deff.promise();
		},

		/*
		* untuk menampilkan semua certification active suatu company
		* need params
			- id_company
		*/
		get_certification_active: function(options)
		{
			options = $.extend({data: {} }, options);
			if(!options.data.id_company)
			{
				alert('no id company in argument get certification active in company. please check your data');
				return false;
			}
			var deff = $.Deferred();

			$.post(site_url('certification/process/get/company/active_certification'), {id_company: parseInt(options.data.id_company) } )
			.done(function(response){
				response = JSON.parse(response);
				deff.resolve( response );
			})
			return deff.promise();

		},

		render: 
		{
			company: function(options)
			{
				options = $.extend({records: Company.get_company(), target: undefined },options);
				this.__main(options);
			},
			brand: function(options)
			{
				options = $.extend({records: Company.get_brand(options), target: undefined },options);
				this.__main(options);
			},
			brand_assessment: function(options)
			{
				options = $.extend({records: Company.get_assessment(options), target: undefined },options);
				this.__main(options);
			},

			__main: function(options)
			{
				var deff = $.Deferred(), dataText;
				options = $.extend({target:undefined, records: [], template: '' }, options)
				
				/*when option records given*/
				$.when(options.records).done(function(response){

					$.each(response, function(a,b){
						
						/*stream number is number that automatically create such as 1,2,3,4,5,6,..,n*/
						var pattern, 
							renderTemplete = options.template;
						
							renderTemplete = renderTemplete.replace(/\(:__stream_number\)/, a+1);

						$.each(b, function(c,d){
							pattern = '(:'+c+')';
							var reg = new RegExp('/'+pattern+'/g');
							renderTemplete = renderTemplete.replace(pattern, b[c]);
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
		},

		/*input*/
		input: 
		{
			check_availability_brand: function(options)
			{
				var deff = $.Deferred();

				options = $.extend({brand_name: undefined}, options);
				$.post( site_url('company/process/is/available/brandName') , {id_company: options.id_company, brand_name: options.brand_name})
				.done(function(response){
					response = JSON.parse(response);
					deff.resolve(response);
				})
				return deff.promise();

			}
		},

		process: 
		{
			add_certification_brand: function(data)
			{
				var ref = site_url('company/process/brand/add/certification')
				$.post(ref, data)
				.done(function(res){
					console.log(res);
				})
			}
		}

	}

	return new o();

})()