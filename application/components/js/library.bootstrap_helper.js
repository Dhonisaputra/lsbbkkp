var Bootstrap_helper = (function(){
	var o = function(){}
	o.prototype = 
	{

		modal: 
		{
			_records: {},
			_active: [],
			active: function()
			{
				return c[c.length - 1];
			},
			set: function(options)
			{
				options = $.extend({
					showIt: false,
					target: undefined,
					options: {
						title: 'Untitled',
						id: '#modalTemp',
					},
					onShown: function()
					{

					},
					onShow: function()
					{

					},
					onHide: function()
					{

					},
					onHidden: function()
					{

					}
				}, options)
			
				if($(options.target).length < 1)
				{
					options.target = $('<div class="modal fade" id="modalTemp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'+
						'<div class="modal-dialog" role="document">'+
						'<div class="modal-content">'+
						'<div class="modal-header">'+
						'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						'<h4 class="modal-title" id="myModalLabel">Modal title</h4>'+
						'</div>'+
						'<div class="modal-body">'+
						'</div>'+
						'</div>'+
						'</div>'+
						'</div>')
				}

				options.options.id_modified = options.options.id.substring(1)
				options.target = $(options.target).attr('id',options.options.id_modified);
				$(options.target).find('.modal-title').text(options.options.title);


				this._records[options.options.id] = {ui: options.target, options: options}

				if(options.showIt)
				{
					this.call(options.options.id)
				}
			},
			call: function(id)
			{
				var records = this._records[id],
					modal = records.ui[0];

				$(modal).on('hidden.bs.modal', function (e) {
					records.options.onHidden(e)
				})

				$(modal).on('shown.bs.modal', function (e) {
					records.options.onShown(e)
				})

				$(modal).on('hide.bs.modal', function (e) {
					records.options.onHide(e)
					// var index = Bootstrap_helper.modal._active.indexOf(id);
					// Bootstrap_helper.modal._active.splice(index, 1)

				})

				$(modal).on('show.bs.modal', function (e) {
					records.options.onShow(e)
				})

				$(modal).modal(records.options.options);

				// this._active.push(id);
			}

		}
	}

	return new o();

})()