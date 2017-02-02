var Modal = (function(){
	var o = function(){}
	o.prototype = 
	{
		_records: {},
		_active: '',
		active: function()
		{
			return $(this._active.target);
		},
		hidden: function(e)
		{
			e = (!e)? this.active() : $(e);
			e.modal('hide');
		},
		set: function(options)
		{
			options = $.extend({
				showIt: false,
				target: undefined,
				title: 'Untitled',
				id: '#modalTemp',
				css: {},
				
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
				options.target = $('<div class="modal fade" id="modalTemp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" isTemporaryModal="true">'+
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
			$(options.target).find('.modal-dialog').css(options.css);
			options.id_modified = options.id.substring(1)
			options.target = $(options.target).attr('id',options.id_modified);
			$(options.target).find('.modal-title').text(options.title);


			this._records[options.id] = {ui: options.target, options: options}

			if(options.showIt)
			{
				this.call(options.id)
			}
		},
		call: function(id)
		{
			var records = this._records[id],
				modal = records.ui[0],
				eui = {body: $(modal).find('.modal-body')};

			$(modal).on('hidden.bs.modal', function (e) {
				Modal._active = '';
				
				records.options.onHidden(e, eui)
				if($(modal).attr('isTemporaryModal') == 'true')
				{
					$(modal).remove();
				}
			})

			$(modal).on('shown.bs.modal', function (e) {
				Modal._active = e;
				records.options.onShown(e, eui)
			})

			$(modal).on('hide.bs.modal', function (e) {
				records.options.onHide(e, eui)
			})

			$(modal).on('show.bs.modal', function (e) {
				records.options.onShow(e, eui)
			})

			$(modal).modal(records.options.options);
		}

	}

	return new o();
})()