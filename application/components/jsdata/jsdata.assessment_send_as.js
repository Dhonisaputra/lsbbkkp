$.sendAs = function()
{

}

$.sendAs.group = function()
{

}

$.sendAs.single = function()
{

}

$.sendAs.records = [];

$.sendAs.sign = function(data, checkoruncheck)
{
	if(checkoruncheck)
	{
		$.sendAs.mark(data);
	}else
	{
		$.sendAs.unmark(data);
	}
};

$.sendAs.mark = function(data)
{
	var isExsist = $.sendAs.records.filter(function(res){ res.identifier == data.identifier })
	if(isExsist.length < 1) 
	{
		$.sendAs.records.push(data)
	}
}

$.sendAs.unmark = function(data)
{
	var isExsist = $.sendAs.records.map(function(res){ res.identifier}).indexOf(data.identifier)

	$.sendAs.records.splice(isExsist, 1);
}

$.fn.editorSendAsSingle = function()
{
	// var deff = $.Deferred();

	// $(this).load(site_url('assessment/notify_as/group'), $.sendAs.records, function(){
	// 	deff.resolve({})
	// })	

	// return $.when(deff.promise());
};

$.fn.editorSendAsGroup = function()
{
	var deff = $.Deferred();

	$(this).load(site_url('assessment/notify_as/group'), $.sendAs.records, function(){
		deff.resolve({})
	})	

	return $.when(deff.promise());
};

/////////////////////////////////////////////////////////////////////////////////////////////////////////

