var jspage_create_certification = (function(){
	var __records_data_request_assessment = {'JPA-009': [], 'JECA-004': [] };
	var data_draft_item = {}
	
	var o = function(){}
	o.prototype = 
	{
		get_records: function(type)
		{
			if(type)
			{
				return __records_data_request_assessment[type];
			}else
			{
				return __records_data_request_assessment;
			}
		},
		reset: function()
		{
			__records_data_request_assessment = {'JPA-009': [], 'JECA-004': [] }
		},
		commodity:
		{
			// addItems: function(commodity, certification)
			// {
			// 	commodity = parseInt(commodity);

			// 	var index = __records_data_request_assessment['JECA-004'].map(function(res){ return res.commodity}).indexOf(commodity);
			// 	if(Array.isArray(certification))
			// 	{
			// 		certification = parseInt(certification);
			// 		$.unique( __records_data_request_assessment['JECA-004'][index]['items'].concat(certification) )
			// 	}else
			// 	{
			// 		certification = parseInt(certification);
			// 		__records_data_request_assessment['JECA-004'][index]['items'].push(certification);				
			// 	}

			// },
			// removeItems: function(commodity, certification)
			// {
			// 	var index = __records_data_request_assessment['JECA-004'].map(function(res){ return res.commodity}).indexOf(commodity);
			// 	__records_data_request_assessment['JECA-004'].splice(index, 1);

			// },
			add: function(id_commodity, item)
			{
				id_commodity = parseInt(id_commodity);
				item = parseInt(item);
				
				__records_data_request_assessment['JECA-004'].push({commodity:id_commodity, item:item})
			},
			replace: function(old, newCommodity)
			{
				var index = __records_data_request_assessment['JECA-004'].map(function(res){ return res.commodity}).indexOf(old);
				__records_data_request_assessment['JECA-004'][index] = {commodity: newCommodity, items:[]};
				var product = jspage_create_certification.product.get('commodity',old)//__records_data_request_assessment['JPA-009'].filter(function(res){ return res.commodity == old });
				if(product.isExist)
				{
					$.each(product.data, function(a,b) {
						b.commodity = newCommodity;

						jspage_create_certification.product.replace('commodity', old, b)
					})
				}

			},
			remove: function(id_commodity)
			{
				var index = __records_data_request_assessment['JECA-004'].map(function(res){ return res.commodity == old }).indexOf(id_commodity);
				__records_data_request_assessment['JECA-004'].splice(index, 1);
			}
		},
		product:
		{
			add: function(options)
			{
				var data = $.extend({product_name: '', product_id: null, commodity: null }, options);
				if( !data.commodity || !data.product_name ){ console.error('no commodity or product given in parameters');return false; }
				var dataProduct = this.get('product_name', data.product_name);
				
				// if(dataProduct.isExist){ console.error('product has been exist! try another name!'); return false; }

				__records_data_request_assessment['JPA-009'].push( data )
			},
			get: function(type, value)
			{
				var index = __records_data_request_assessment['JPA-009'].map(function(res){ return res[type] }).indexOf(value);
				var exist = __records_data_request_assessment['JPA-009'].filter(function(res){ return res[type] == value });

				return {isExist: (exist.length > 0)? true : false, length: exist.length, index: index, data: exist };
			},
			remove: function(product_name)
			{
				var data = this.get(product_name);
				__records_data_request_assessment['JPA-009'].splice(data.index, 1);
			},
			replace: function(oldType, oldValue, newData)
			{
				var data = $.extend({product_name: '', product_id: null, commodity: null }, newData);
				if( !data.commodity || !data.product_name ){ console.error('no commodity or product given in parameters');return false; }

				var dataProduct = this.get(oldType, oldValue);

				__records_data_request_assessment['JPA-009'][dataProduct.index] = newData;
			}
		}

	}
	return new o();

})()


// -------------------------------------------------------- end 

var data_assessment = (function(){
		
		var __records_data_request_assessment = {'YQ-005': [], 'JPA-009': [], 'JECA-004': [] };
		var data_draft_item = {}
		
		var o = function(){}
		o.prototype = 
		{
			reset_draft: function()
			{
				data_draft_item = {};
			},

			set_draft: function(draft, value)
			{
				data_draft_item[draft] = value;
			},
			
			get_draft: function(item)
			{
				if(item)
				{
					return data_draft_item[item];
				}
				return data_draft_item;
			},

			tambah_item: function(certification, value, audit_reference)
			{
				var audit = [];

				// check index
				var index = __records_data_request_assessment[certification].map( function(res){ return res.dibrakom } ).indexOf(value);
								
				// if no certification matched with YQ, JPA, JECA
				if ( typeof __records_data_request_assessment[certification] !== 'object' ) { console.error('no certificate type of'+certificate+' exist!'); return false; }

				// console.log(index)
				// if there are same dibrakom in some type.
				if ( index > -1 )
				{
					var index_ref = __records_data_request_assessment[certification][index]['certification'].indexOf(audit_reference);
					
					// if no certification matched in certification array 
					if(index_ref < 0)
					{
						__records_data_request_assessment[certification][index]['certification'] = $.unique( __records_data_request_assessment[certification][index]['certification'].concat(audit_reference) );
						return false
					}

					console.info('data certification '+audit_reference+' has been inserted while ago. not saved!')

				}else
				{
					var data = {dibrakom: value, certification: []}
					
					data.certification = $.unique(data.certification.concat(audit_reference));

					__records_data_request_assessment[certification].push(data);
				}
			},

			remove_dibrakom: function(type, dibrakom)
			{
				var index = __records_data_request_assessment[type].map( function(res){ return res.dibrakom } ).indexOf(dibrakom);
				if(index >= 0)
				{				
					__records_data_request_assessment[type].splice(index, 1);
				}

				return (index >= 0)? true : false
			},

			remove_certification: function(type, dibrakom, audit_reference)
			{
				var index = __records_data_request_assessment[type].map( function(res){ return res.dibrakom } ).indexOf(dibrakom);
				index_ref = __records_data_request_assessment[type][index]['certification'].indexOf(audit_reference);
				if( (__records_data_request_assessment[type][index]['certification'].indexOf(audit_reference) >= 0) )
				{
					__records_data_request_assessment[type][index]['certification'].splice(index_ref,1);
				}

				if(__records_data_request_assessment[type][index]['certification'].length < 1)
				{
					this.remove_dibrakom(type, dibrakom);
					return true;
				}else
				{

					return (__records_data_request_assessment[type][index]['certification'].indexOf(audit_reference) < 0)? true : false;
				}
			},

			get_records: function()
			{
				return __records_data_request_assessment;
			},

			reset: function()
			{
				__records_data_request_assessment = {'YQ-005': [], 'JPA-009': [], 'JECA-004': [] };
			}

		}
		return new o();
	})()