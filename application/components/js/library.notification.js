var Notify = (function(){
	function notify_begin(title, options)
	{
		options = $.extend({body: 'Body Notification', icon: site_url('application/components/images/logo_yoqa.png') }, options)
		// Let's check if the browser supports notifications
		if (!("Notification" in window)) {
			alert("This browser does not support desktop notification");
		}

		// Let's check whether notification permissions have already been granted
		else if (Notification.permission === "granted") {
			// If it's okay let's create a notification
			var N =  new Notification(title, options);
			N.onshow = function(){
				playSound(site_url('application/components/music/notify'))
			}
	    	return N;
		}

		// Otherwise, we need to ask the user for permission
		else if (Notification.permission !== 'denied') {
			Notification.requestPermission(function (permission) {
			  	// If the user accepts, let's create a notification
			  	if (permission === "granted") {
			    	var N =  new Notification(title, options);
			    	return N;
			  	}
			});
		}

		// At last, if the user has denied notifications, and you 
		// want to be respectful there is no need to bother them any more.
	}

	var o = function()
	{
		this.soundpath = '';
	}
	o.prototype = 
	{
		get_soundpath: function()
		{
			return this.soundpath;
		},
		set_soundpath: function(path)
		{
			this.soundpath = path
		},
		send: function(data)
		{
			if(!data.notification_for_level) { console.error('data Notification untuk level tidak ditemukan'); return false }
			var deff= $.Deferred();
			$.post(site_url('notification/send'), data)
			.done(function(res){
				data = $.extend({notification_for_user:'*'}, data);
				var event = data.notification_for_level+'.'+data.notification_for_user;
				window.notif.send(event, data)
				.done(function(){
				})

				deff.resolve(res)
			})
			return $.when(deff.promise())
		},
		set: function(data)
		{
			return notify_begin(data.title, data);			
		}
	}
	return new o();
})()