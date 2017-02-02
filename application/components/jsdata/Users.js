/*
	
*/

var Users = (function(){
	

	var o = function(){}
	
	o.prototype = 
	{
		logout: function()
		{
			$.post('controllers/users/model.php', {action:'logout'})
			.done(function(response){
				response = JSON.parse(response);

				if(response.isAuth == false)
				{
					window.location.replace(URL.get().access_url);
				}
				else
				{
					alert('logout error');
				}

			})
		},

		login: function(event)
		{
			event.preventDefault();
			var data = $(event.target).serializeArray(), 
				action = 'controllers/users/model.php?action=login' /*$(event.target).attr('action')*/;

			$.post(action, data)
			.done(function (response){
				response = JSON.parse(response);
				if(response.isAuth == true && response.found == true)
				{
					window.location.reload();
				}
				else
				{
					alert('login error. please check your data!');
				}
			})
		}
	}

	return new o();
})()