/*
--- WHAT IS THIS ---
Ini adalah plugin helper untuk emit dan listen event dari socketio di server node.js
node js disini hanya sebagai terminal untuk data nya dilempar ke event yang lain

- Lihat gambar berikut untuk lebih jelas http://prntscr.com/dzui5q

--- HOW TO USE ---
// declare Notif
var socket = new Notif(:server) // we have been created node.js server as terminal using heroku. the URL is https://infinite-dusk-57108.herokuapp.com/

// listen event
socket.listen(:event-emited, :function(:data-emited) )

// emit data 
socket.emit(:event-target, :data)


*/
var Notif = function(listener){
	this.socket= io(listener);
}
Notif.prototype = 
{
	send: function(event, data)
	{
		var def = $.Deferred();
		this.socket.emit('_catchsend_', {emit: event, data: data}, function(res){
			def.resolve(res, data)
		} )

		return $.when(def.promise());
	},
	listen: function(event, fn)
	{
		this.socket.on( event, fn);
	}
}