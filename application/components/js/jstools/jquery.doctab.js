
var Doctab = (function(){
	var _dataProperty = {},
	_exchangeData = {},
	_optionsShowDeff = $.Deferred();

	var o = function(){
	}
	o.prototype = 
	{
		exchangeData:
		{
			set: function(key, value)
			{

				var valType = typeof value,
				len = (valType == "object" && Array.isArray(value) )? value.length : Object.keys(value).length
				
				var property = {
					data_type: valType,
					length: (valType == 'string')? 0 : len,
					from: URL.get(),
				}
				_exchangeData[key] = {_property: property, data: value};
			},
			get: function(key,complete)
			{
				if(!_exchangeData[key])
				{
					return false
				}

				if(!complete)
				{
					return _exchangeData[key].data;
				}else
				{
					return _exchangeData[key];
				}
			},
			remove: function(key)
			{
				delete _exchangeData[key];
			},
			reset: function()
			{
				_exchangeData = {}
			}
		},
		
		show: function(options)
		{
			// save url 
			_dataProperty['urlBefore'] = URL.get().href
			var deffShown = $.Deferred();
			var deffShow = $.Deferred();
			var deffHide = $.Deferred();
			var deffHidden = $.Deferred();

			options = $.extend({
				closeButton: true,
				load: {
					url: undefined,
					data: {},
					title: undefined,
					urlRouting: undefined,
				},
				publishManipulateStory: true,
				manipulateHistory: true,
				fnHistory: function(url, title, client_data, routing)
				{
					title = (title)?title: '';
					var data = {url: url, title: title, _sys:{ source: "Doctab", Doctab: {status: 'show'} }, data: client_data, routing: routing}
					return data;
				},
				successLoadUrl: function(a,b,c)
				{

				},
				onShown: function(e)
				{

				},
				onShow: function(e)
				{
				},
				onHide: function(e){

				},
				onHidden: function(e){
				}

			}, options)

			options.load = $.extend({
				onShow: function(){
					if(Snackbar)
					{
						Snackbar.manual({message: 'Memuat halaman', spinner: true});
					}
				},
				onShown: function(a,b,c){
					if(Snackbar)
					{
						Snackbar.show('Halaman selesai dimuat');
					}
				}
			}, options.load)
			// add query doctab=1
			options.load.url = (options.load.url)? URL.params({doctab:1},options.load.url) : options.load.url;

			
			$('[href="#document-inline-tab"][data-toggle="tab"]').on('show.bs.tab', function (e) {
				e['tabContent'] = $('#document-inline-content')
				deffShow.resolve(e);

			})

			$('[href="#document-inline-tab"][data-toggle="tab"]').on('shown.bs.tab', function (e) {
				
				e['tabContent'] = $('#document-inline-content')

				var target = $(this).attr('href');  

				$(target).css('left','-'+$(window).width()+'px');   
			    
			    var left = $(target).offset().left;
			    $(target).css({left:left}).animate({"left":"0px"}, "1000");
				
				deffShown.resolve(e);
				
				// jika url !undefined
				
			  	// console.log(e)
			  })
			$('[href="#document-inline-tab"][data-toggle="tab"]').on('hide.bs.tab', function (e) {
				e['tabContent'] = $('#document-inline-content')
				deffHide.resolve(e);			  	
			})
			$('[href="#document-inline-tab"][data-toggle="tab"]').on('hidden.bs.tab', function (e) {
				e['tabContent'] = $('#document-inline-content');
				deffHidden.resolve(e);			  	
				
			})

			deffShow.done(function(res){
				options.onShow(res)

				/*
				| Check is show closeButton
				*/
				if(!options.closeButton)
				{
					$('#doctab--btn-doctab').addClass('sr-only')
				}else
				{
					$('#doctab--btn-doctab').removeClass('sr-only')
				}
				/*manipulate history*/

				if(options.manipulateHistory)
				{
					// var urlHistory = (options.load.url)? options.load.url : URL.get().href+'#doctab';
				  	// jika manipulateHistory == true maka address akan diganti. jika tidak maka kosong
				  	var urlHistory 	= (options.manipulateHistory)? options.load.url: URL.get().href+'#doctab';
				  	// jika ada aliasing URL, maka gunakan URL Aliasing / routing. 
				  	// urlHistory 		= (options.load.urlRouting)? options.load.urlRouting : urlHistory;

				  	var dataFnHistory = options.fnHistory(urlHistory, options.load.title, options.load.data, options.load.urlRouting)

				  	nav.to(dataFnHistory);

				  }
				})

			deffShown.done(function(res){

				options.onShown(res)
				if( options.load.url )
				{
					if(options.load.onShow){
						options.load.onShow();
					} 
					$(res.tabContent).load(options.load.url, options.load.data, function (a,b,c){
						componentHandler.upgradeAllRegistered()
						options.successLoadUrl(res,a,b,c);
						
						if(options.load.onShown){
							options.load.onShown(a,b,c);
						} 

						// initialize bootstrap
						$('[data-toggle="tooltip"], [data-bs="tooltip"], .bs-tooltip').tooltip();

					})
				}
				componentHandler.upgradeAllRegistered()
				
			})

			deffHide.done(function(res){
				options.onHide(res);
			})

			deffHidden.done(function(res){
				options.onHidden(res);
				$(res.tabContent).html('')
			})


			$('[href="#document-inline-tab"][data-toggle="tab"]').tab('show');

		},
		hide: function(options)
		{
			var deff = $.Deferred();
			options = $.extend({ resetOnHide: true, resetUrlOnHide: true }, options)
			


			$('[href="#document-actual-tab"][data-toggle="tab"]').tab('show');

			$('[href="#document-actual-tab"][data-toggle="tab"]').on('shown.bs.tab', function (e) {
				deff.resolve(e);
			})

			if(options.resetOnHide)
			{
				Doctab.clear();
				// $('#document-inline-content').html('')
			}

			if(options.resetUrlOnHide)
			{
				// return url before Doctab Opened
				nav.back()
			}

			return $.when( deff.promise() )
		},
		isActive: function(where)
		{
			return $('#document-inline-tab').hasClass('active');
		},
		clear: function()
		{
			$('#document-inline-content').html('')
		},
		toggle: function()
		{
			if(Doctab.isActive())
			{
				$('[href="#document-actual-tab"][data-toggle="tab"]').tab('show');
				// Doctab.hide({resetOnHide:false})
			}else
			{
				// Doctab.show();
				$('[href="#document-inline-tab"][data-toggle="tab"]').tab('show')
			}
		}
	}

	return new o();
})()
$(window).bind("popstate", function(event) {   
	// console.log(event)
	var state = event.originalEvent.state;
	if(state && state._sys && state._sys.source && state._sys.source == 'Doctab')
	{
		Doctab.show({load: {url: state._server.url, data: state._server.data}, manipulateHistory: false })
	}else
	{
		if($('#document-actual-tab').html() !== '')
		{
			Doctab.hide({resetUrlOnHide:false})
		}else
		{
			nav.back();		
			var uri = URL.get();	
			window.location.href = uri.href;
		}
		// if(uri.query.doctab === "1")
		// {
		// }else
		// {
		// 	nav.back();
		// 	
		// 	console.log(uri)
		// }
	}
	// o.prototype.fnInitializeProp.DoctabStatus(state)
});

// detect is url using doctab.
$(document).ready(function(){
	var uri = URL.get();
	if( URL.params('doctab') === '1' )
	{
		Doctab.show({load: {url: uri.access_url}, manipulateHistory: false})
		$('#document-actual-tab').html('');
	}
})
