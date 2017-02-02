function playSound(filename){   
	document.getElementById("sound").innerHTML='<audio autoplay="autoplay"><source src="' + filename + '.mp3" type="audio/mpeg" /><source src="' + filename + '.ogg" type="audio/ogg" /><embed hidden="true" autostart="true" loop="false" src="' + filename +'.mp3" /></audio>';
}

function fetching_notification()
{
	$.post(site_url('notification/get_notification'))
	.done(function(res){
		res = JSON.parse(res);
		$('#list-group-notification .list-group-item').remove()
		if(res.length > 0)
		{
			append_notification(res);		
		}else
		{
			$('#list-group-notification').append('<div class="list-group-item flat row list-group-item--show-more flex flex-center flex-distributed"> Tidak ada notifikasi </div>')
		}
		
	})

}
function loadMore(lastItem, time)
{
	$.post(site_url('notification/get_notification'), {action:'load_more', notification_id: lastItem, notification_timestamp: time})
	.done(function(res){
		// console.log(res); return false;
		res = JSON.parse(res);
		if(res.length > 0)
		{
			$('#list-group-notification .list-group-item--show-more').remove()
			append_notification(res);		
		}else
		{
		}
		
	})
}

function append_notification(res)
{
	if(res.length > 0)
	{
		var template = '<div class="list-group-item flat list-group-item-notification row notification-item" id="notification--::notification_id::"> <div class="time-notification badge"></div> <div class="notification-content--text">::notification_text::</div> </div>'
		
		Tools.write_data({
			target : $('#list-group-notification'),
			records: res,
			template: template,
			overwrite: false,
			typeWrite: 'append',
			afterAppend: function(event, ui, data){

				var momentTime = moment(data.notification_timestamp);
				if(momentTime.isValid())
				{
					var now = moment();
					var diff = now.diff(momentTime,'d')
					var time = (diff>1)? momentTime.format('Do, MMM YYYY') : momentTime.fromNow()

					var timeContainer = $(ui).find('.time-notification')
					timeContainer.text(time)

					if(data.notification_shown == 1)
					{
						$(ui).addClass('isShown')
					}

					if(data.notification_link)
					{
						$(ui).attr('onclick', 'window.open("'+data.notification_link+'")')
					}
				}
			}
		})
		.done(function(event, ui, data){
			var records = event.options.records.filter(function(res){ return res.notification_shown == 0 })
			var lastItem = event.options.records[event.options.records.length-1];

			$('.mdl-badge--notification').attr('data-badge', records.length)
			$('#list-group-notification').append('<div class="list-group-item flat row list-group-item--show-more flex flex-center flex-distributed"> <button class="mdl-button mdl-js-button" onclick="loadMore('+lastItem.notification_id+', \''+lastItem.notification_timestamp+'\')"> Load More </button> </div>')

		})
	}
}

function socket_listener(level, id_users)
{	
	notif.listen(level+'.'+id_users, function(data){
		// console.log(data)
		fetching_notification();
		var N = Notify.set({title: 'LSBBKKP Notification' ,body: data.notification_text})
		N.onclick = function()
		{
			fetching_notification()
			N.close()
			if(data.notification_link)
			{
				window.open(data.notification_link, '_blank');
			}
		}
	})	

	notif.listen(level+'.*', function(data){
		// console.log(data)
		fetching_notification();
		var N = Notify.set({title: 'LSBBKKP Notification' ,body: data.notification_text})
		N.onclick = function()
		{
			fetching_notification()
			N.close()
			if(data.notification_link)
			{
				window.open(data.notification_link, '_blank');
			}
		}
	})	

}


$(document).ready(function(){
	// SET LANGUAGE MOMENT INTO INDONESIAN LANGUAGE
	moment.locale('id')
	// FETCHING NOTIFICATION
	

	$('.notification-popover').popover({
		content: function(){
			return $('#notification-popover-content').html()
		},
		html: true,
		title: 'Notification',
	})
	.on('show.bs.popover', function(){
		// FETCHING NOTIFICATION
		fetching_notification();

		var popover = $(this).data("bs.popover").tip();
		var popContent = $('#notification-popover-content');

		// popover.css({'max-width': '500px', width:'500px'})

		$(this).data('content', popContent.html())
		if($('.notification-item:not(.isShown)').length > 0)
		{
			var cookie = Cookies.getJSON('authentication').data;
			$.post(site_url('notification/update'),{update:{notification_shown:1}, where:{notification_for_level: cookie.level, notification_for_user: cookie.id_users} } )
			$('.mdl-badge--notification').attr('data-badge', 0)
			$('.notification-item:not(.isShown)').removeClass('isShown')	
		}
	})

	// NOTIFICATION SECTION 
	$('#btn-notification').on('click', function(){
		if( $(this).hasClass('popover-open') )
		{
            $('[data-toggle="popover"]').popover('hide');
		}else
		{
            $('[data-toggle="popover"]').popover('show');
		}
        $(this).toggleClass('popover-open')
	})

	$('body').on('click', function (e) {
        if ( $(e.target).closest('button#btn-notification').length < 1
        	&& $(e.target).attr('id') != 'btn-notification' 
        	&& $(e.target).closest('.popover').length < 1)
        {
            $('[data-toggle="popover"]').popover('hide');
        	$('#btn-notification').toggleClass('popover-open')
        }
    });
})