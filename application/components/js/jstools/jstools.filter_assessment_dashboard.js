var FilterDashboard = (function(){
	var a0 = function(){}
	a0.prototype = 
	{
		resetDate: function()
		{
			var toMonth = $('#fetch-between--start').val();
			var threeMonths = moment().add(3, 'month').format('MMM Y');			
			$('#fetch-between--end').val(threeMonths);nav.to({url:'#'});
			window.completeSchedules.ajax.reload()
		},
		setDate: function(start, end)
		{
	        	Snackbar.manual({ message : 'Memuat data. Silahkan tunggu!', spinner: true});
                nav.to({url:'#dataTop='+start+'&dataBottom='+end})
                var a = $.Deferred(), b = $.Deferred(), c = $.Deferred(), d = $.Deferred(), e = $.Deferred()
                // 
                window.tableConfirmedSingle.ajax.reload(function(){
                	a.resolve('a');
                });
		        window.tableConfirmedGroup.ajax.reload(function(){
		        	b.resolve('b');
		        });
		        window.completeSchedules.ajax.reload(function(){
		        	c.resolve('c');
		        });
		        window.unconfirmedSchedules.ajax.reload(function(){
		        	d.resolve('d');
		        });
		        /*window.passedSchedule.ajax.reload(function(){
		        	e.resolve('e');
		        });*/

		        $.when(a,b,c,d)
		        .done(function(a,b,c,d){
		        	Snackbar.show('Data selesai dimuat');
		        })
		},
		initialize: function(options)
		{
			options = $.extend({ elmDataBottom: '#fetch-between--end' }, options)
			var url = URL.get(),
				dataBottom = moment(url.hash.dataBottom).format('MMM Y'),
				dataTop = url.hash.dataTop;

			if(url.hash.dataBottom)
			{
				$(options.elmDataBottom).val(dataBottom);
			}

		}
	}
	return new a0();
})();

FilterDashboard.initialize();