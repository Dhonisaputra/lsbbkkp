var _scope, _productLineDeffItem = $.Deferred();
(function ( $ ) {

	$.fn.product_line = function(options)
	{
		var deff = $.Deferred();
		options = $.extend({
        	template: '<div class="col-md-12 parent-product-line-category" data-filter="::product_category_id::"> <div class="checkbox"> <label> <input type="checkbox" class="iso--choose-product_line-available sr-only" value="::product_category_id::" name="" form="helper-form--request-certification" data-assessment="::product_category_name::" data-gath="iso_subcategory" onchange="$.fn.product_line_category.toggle(event, this)"> <span class="sign glyphicon glyphicon-plus"></span>  <span class="sentece-case">::product_category_name::</span> </label </div> <div data-product_line_children="::product_category_id::-category-childrens"></div> </div>',
			records: $.fn.product_line_category(),
		},options)
		var ui = this;

		options.records
		.done(function(res){

			Tools.write_data({
				target: ui,
				template: options.template,
				records: res 
			})
			.done(function(res){
				deff.resolve(res);
			})
		
		})

		return $.when(deff.promise())
	}

	$.fn.product_line.defer = $.Deferred();
	// function get all data product line;
	$.fn.product_line.initialize = function()
	{
		$.post( site_url('certification/process/get/certificate/product_line') )
		.done(function(res){
			res = JSON.parse(res);

			var item = res.filter(function(r){ return r.product_line_type == 'item' }),
				subcategory = res.filter(function(r){ return r.product_line_type == 'subcategory' }),
				category = res.filter(function(r){ return r.product_line_type == 'category' });

			$.fn.product_line.defer.resolve(res, item, subcategory, category)

			
		})
		return $.when($.fn.product_line.defer.promise() )
	};

	$.fn.product_line.dataDefer = function(){
		return $.when($.fn.product_line.defer.promise() )
	}

	$.fn.product_line.toggle = function(ui, parent, children)
	{
		if( $(parent).hasClass('open') )
		{
			$(children).hide();
			$(parent).removeClass('open');
        	$(ui).siblings('.sign').removeClass('glyphicon-minus').addClass('glyphicon-plus');
		}else
		{
			$(children).show();
			$(parent).addClass('open');
        	$(ui).siblings('.sign').removeClass('glyphicon-plus').addClass('glyphicon-minus');
		}
	}

	// get product line category
	$.fn.product_line_category = function()
	{
		var deff = $.Deferred();
		$.post(site_url('product_line/json_get_product_line_category'))
		.done(function(res){
			res = JSON.parse(res);
			deff.resolve(res);
		})
		return $.when(deff.promise())
	}

	$.fn.product_line_category.toggle = function(event, ui)
	{
		var parent = $(ui).parents('.parent-product-line-category'),
			data = $(parent).data(),
			uidata = $(ui).data(),
			children = $(parent).find('[data-product_line_children="'+data.product_category_id+'-category-childrens"]')

		if( $(parent).find('.parent-product-line-subcategory').length < 1 )
		{
			$(children).product_line({
				records: $.fn.product_line_subcategory(data.product_category_id),
	       		template: '<div class="col-md-12 parent-product-line-subcategory checkbox-childrens"> <div class="checkbox"> <label> <input type="checkbox" class="iso--choose-product_line-available sr-only" value="::product_subcategory_id::" form="helper-form--request-certification" data-assessment="::product_subcategory_name::" data-gath="iso_subcategory_item" onchange="$.fn.product_line_subcategory.toggle(event, this)" data-certification="'+uidata.certification+'"> <span class="sign glyphicon glyphicon-plus"></span>  <span>::product_subcategory_name::</span> </label </div> <div data-product_line_children="::product_subcategory_id::-subcategory-childrens"></div> </div>',
			})

		}

		$.fn.product_line.toggle(ui, parent, children);		

	}

	// get product line subcategory
	$.fn.product_line_subcategory = function(product_category_id)
	{
		var deff = $.Deferred();
		$.post(site_url('product_line/json_get_product_line_subcategory'))
		.done(function(res){
			res = JSON.parse(res);
			if(product_category_id)
			{
				res = res.filter(function(res){
					return res.product_category_id == product_category_id
				})
			}
			deff.resolve(res);
		})
		return $.when(deff.promise())
	}
	$.fn.product_line_subcategory.toggle = function(event, ui)
	{
		var parent = $(ui).parents('.parent-product-line-subcategory'),
			data = $(parent).data(),
			uidata = $(ui).data(),
			children = $(parent).find('[data-product_line_children="'+data.product_subcategory_id+'-subcategory-childrens"]')

		if( $(parent).find('.parent-product-line-subcategory-item').length < 1 )
		{
			$(children).product_line({
				records: $.fn.product_line_item(data.product_subcategory_id),
	       		template: '<div class="col-md-12 parent-product-line-subcategory-item checkbox-childrens"> <div class="checkbox"> <label> <input type="checkbox" class="product-line-item" value="::product_line_id::" data-certification="'+uidata.certification+'" onchange="$.fn.product_line_SNI.toggle(event, this)">   <span>::product_line_name::</span> </label </div> <div data-product_line_children="::product_line_id::-product_line-childrens"></div> </div>',
			})
			.done(function(res){
				_productLineDeffItem.resolve(res);
				
			})

		}

		$.fn.product_line.toggle(ui, parent, children);
	}

	// get product line item
	$.fn.product_line_item = function(product_subcategory_id)
	{
		var deff = $.Deferred();
		$.post(site_url('product_line/json_get_product_line'))
		.done(function(res){
			res = JSON.parse(res);
			if(product_subcategory_id)
			{
				res = res.filter(function(res){
					return res.product_subcategory_id == product_subcategory_id
				})
			}

			deff.resolve(res);
		})
		return $.when(deff.promise())
	}

	// get product line SNI
	$.fn.product_line_SNI = function(product_line_id)
	{
		var deff = $.Deferred();
		$.post(site_url('product_line/json_get_product_line_SNI'))
		.done(function(res){
			res = JSON.parse(res);
			if(product_line_id)
			{
				res = res.filter(function(res){
					return res.product_line_id == product_line_id
				})[0]
			}

			deff.resolve(res);
		})
		return $.when(deff.promise())
	}

	$.fn.product_line_SNI.toggle = function(event, ui)
	{
		var parent 		= $(ui).parents('.parent-product-line-subcategory-item'),
			data 		= $(parent).data(),
			uidata 		= $(ui).data(),
			children 	= $(parent).find('[data-product_line_children="'+data.product_line_id+'-product_line-childrens"]'),
			_parent     = $(ui).parents('[_]'),
            _           = $(_parent).attr('_')

		if( $(parent).find('.parent-product-line-SNI').length < 1 )
		{
			 $.fn.product_line_SNI(data.product_line_id)
			 .done(function(res){
			 	// write SNI certification
			 	if(res.product_line_note !== '')
                {
                    product_line_note = res.product_line_note.split(',');
                    $.each(product_line_note, function(a,b){
                        var template = '<div class="col-md-12 parent-product-line-SNI checkbox-childrens"> <div class="checkbox"> <label> <input type="checkbox" class="SNI--choose-product_line-available" form="helper-form--request-certification" value="'+res.product_line_id+'.'+b+'" data-certification="'+uidata.certification+'" onchange="$.fn.request_assessment.product_line(this)"> <span> <strong> '+b+' </strong>  </span> </label </div>  </div>';
                        $(children).append(template);                    
                    })
                }else
                {
                	$.fn.request_assessment.product_line(ui)
                }

				// Tools.write_data({
				// 	target: children,
		  //      		template: '<div class="col-md-12 parent-product-line-SNI checkbox-childrens"> <div class="checkbox"> <label> <input type="checkbox" class="SNI--choose-product_line-available" form="helper-form--request-certification" onchange="$.fn.request_assessment.product_line(this)" name="yq_product_line[]" value="::audit_reference::" data-certification="'+uidata.certification+'"> <span> <strong> (::name::) </strong> ::certificate_title:: </span> </label </div>  </div>',
				// 	records: res.SNI 
				// })
			 
			 })

		}
		$.fn.product_line.toggle(ui, parent, children);
	}

}( jQuery ));
