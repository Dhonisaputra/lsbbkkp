/*
JSDATA

filename	: jsdata.auditor.js
Use to 		: transaksi data untuk auditor
scope		: jabatan, auditor
*/

/*
* function JabatanAuditor
* get data auditor
* requirement
	1. records [{}]  / array object,
	2. template DOM/HTML
	3. target DOM existed

* callback
	1. response : object / records above
	2. DOM rendered.

.done(function(response, ui){
	
})

*/
// Jabatan Auditor //////////////////////////////////////
$.JabatanAuditor = function(options)
{
	var deff = $.Deferred();

	options = $.extend({
		records		: $.JabatanAuditor.records(),
		template	: undefined,
		target 		: undefined,
		success		: function(res){},
	}, options)

	options.records.done(function(res){
		Tools.write_data({
			records: res,
			template: options.template,
			target: options.target
		})
		.done(function (response){
			options.success(res);
			deff.resolve(res, response);
		})
	})

	return $.when(deff.promise());
}

// get data jabatan auditor
$.JabatanAuditor.records = function()
{
	var data = $.Deferred();

	$.post( site_url('auditor/process/get/jabatan') )
	.done(function(res){
		res = JSON.parse(res);
		data.resolve(res)
	})
	.error(function(res){
		data.resolve(res)
	})

	return $.when(data.promise());
}

// Auditor /////////////////////////////////////////////////
$.Auditor = function(options)
{
	var deff = $.Deferred();

	options = $.extend({
		records		: $.Auditor.records(),
		template	: undefined,
		target 		: undefined,
		success		: function(res){},
	}, options)

	options.records.done(function(res){
		Tools.write_data({
			records: res,
			template: options.template,
			target: options.target
		})
		.done(function (response){
			options.success(res);
			deff.resolve(res, response);
		})
	})

	return $.when(deff.promise());
}
$.Auditor.Assigned_records = [];
$.Auditor.records = function()
{
	var data = $.Deferred();

	$.post( site_url('auditor/process/get/auditor') )
	.done(function(res){
		res = JSON.parse(res);
		data.resolve(res)
	})
	.error(function(res){
		data.resolve(res)
	})

	return $.when(data.promise());
}
$.Auditor.assigned = function($company, $auditor_in_charge)
{
	$.each($company, function(a,b){
		var buf = new Uint16Array(2);
    	var unique = window.crypto.getRandomValues(buf).join('');
    	var uniqid = (new Date().getTime()).toString(16)+unique;

    	// check URL
    	var url = URL.get();
		var data = {
			type: (url.query.type_assessment == 'assessment')? 1 : 0, // 1 untuk assessment | audit khusus, 0 untuk resurveilence
			id: url.query.id,
			company: b,
			auditor: $auditor_in_charge,
			leader: null,
			key: uniqid
		}
		$.Auditor.Assigned_records.push(data);
	})
}