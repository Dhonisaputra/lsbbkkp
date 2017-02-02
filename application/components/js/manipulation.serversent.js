var Serversent = (function(){
	var o = function(){}
	o.prototype = 
	{
		get: function(options)
		{
			options = $.extend({ url: '', success: function(event){  }  }, options)
			var source = new EventSource(options.url);
			source.onmessage = function(event) {
			    options.success(event)
			},
			source.onError = function(event){
				console.log(event)
			};

		}
	}
	return new o();

})()