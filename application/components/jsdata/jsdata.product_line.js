var Product_line = (function(){
	function MLMLoopReturn(res)
	{
		Product_line.dataMLMLoop = res;
	}
	var a = function()
	{
		this.initialize();
	}

	a.prototype =
	{
		data: {},
		dataMLM: {},
		dataMLMLoop: {},
		get_data: function(type)
		{
			if( !type )
			{
				return a.prototype.data;
			}else
			{
				return a.prototype.data.filter(function(res){ return res.product_line_type == type })
			}
		},
		initialize: function()
		{
			var defer = $.Deferred();
			defer.always(this.records);
			$.post( site_url('assessment/get__master_product_line') )
			.done(function(res){
				res = JSON.parse(res);

				var item = res.filter(function(r){ return res.product_line_type == 'item' }),
					subcategory = res.filter(function(r){ return res.produc_tline_type == 'subcategory' }),
					category = res.filter(function(r){ return res.product_line_type == 'category' });

				defer.resolve(res, item, subcategory, category);
				
			})
		},

		records: function(res, item, subcategory, category)
		{
			a.prototype.data = res;
		},

		MLM: function(options)
		{
			var defer = $.Deferred();
			defer.always(this.MLMReturn)

			options = $.extend({ records: a.prototype.data, data:[] }, options)
			var pid = 'children';
				// b = options.records.shift();

			var promises = [];

		    $.each(options.records, function(a,b) {
		    	var def = new $.Deferred();
		    	b = options.records[0]
		    	if(b)
		    	{
					b[pid] = []
		    		if(options.records.filter(function(res){ return res.product_line_parent == 0 }).length > 0)
		    		{
						options.data.push(b);
						// options.records.shift();
		    		}

		    		var index = options.data.map(function(res){ return res.product_line_id }).indexOf(b.product_line_parent);
		    		if( index > -1 )
		    		{
		    			options.data[index].children.push(b);
						// options.records.shift();
		    		}else
		    		{
		    			
		    			Product_line.MLM({
							records: options.records,
							data: options.data,
						})
						// options.records.shift();
		    			console.log(options.records, options.data)
		    		}
		    		// var index = options.data.children.length < 1? {product_line_id: '0'} : 
		   //  		if(b.product_line_parent == options.data[index].product_line_id)
					// {
					// 	options.data[pid].push(b);
					// 	console.log(options.data[pid])
						
					// }

		    	}
				

		        promises.push(def);
		    });

			

			// console.log(options)
		},
		MLMReturn: function(data)
		{
			console.log(data)
			a.prototype.dataMLM = data.filter(function(res){ return res });
		},

		MLMLoop: function(rec, needle, product_line_id, history)
		{
			var defer = $.Deferred();
			defer.always(MLMLoopReturn)
			if(rec)
			{
				$.each(rec, function(a,b){
					if(b.product_line_parent == '0')
					{
						history = [];
						product_line_id = b.product_line_id
					}
					

					if(b.product_line_id == needle)
					{
						var o = {parent: product_line_id, product_line_id: b.product_line_id, history: history, item: b}
						defer.resolve(o);
					}else
					{
						history.push(a);
						Product_line.MLMLoop(rec[a]['children'], needle, product_line_id, history )
					}
					
				})
			}
		}
	}

	return new a();
})()