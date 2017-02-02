
Array.prototype.diff = function(arr2) {
    var ret = [];
    for(var i in this) {   
        if(arr2.indexOf( this[i] ) > -1){
            ret.push( this[i] );
        }
    }
    return ret;
};

// Sentence case function. 
(function ( $ ) {
    
    $.fn.sentenceCase = function()
    {
        var $this = $(this);
        if($this.length > 0)
        {
            
            $.each($this, function(a,b){
                var $ui = $(b),
                    $text = $ui.html()

                if($text !== '')
                {

                    $splitDot = $text.split('.')
                    
                    $.each($splitDot, function(c,d){
                        var $textLC = d.toLowerCase(),
                        $textExpl = $textLC.split(''),
                        $1stExpl = $textExpl[0].toUpperCase();

                    $textExpl[0] = $1stExpl
                    $textExpl = $textExpl.join('')
                    $splitDot[c] = $textExpl;
                    })
                    
                    $splitDot = $splitDot.join('.');
                    
                    $(b).html( $splitDot );
                }
            })
        }
        return $this;
    }

}( jQuery ));

var Tools = (function(){
	
	var o = function(){}
	
	o.prototype = 
	{
		executeFunctionByName: function(functionName, context /*, args */ ) {

            var args = [].slice.call(arguments).splice(2),
            	namespaces = functionName.split("."),
            	func = namespaces.pop();
            
            for (var i = 0; i < namespaces.length; i++) {
                context = context[namespaces[i]];
            }
            
            return context[func].apply(this, args);
        },

        write_data: function(options)
        {
            var dataText, promises = [];
            options = $.extend({
                target:undefined, 
                records: [], 
                template: '', 
                overwrite: true,
                typeWrite: 'append', //[append, prepend]
                success: function(event, ui, data){ } ,
                beforeWrite: function(event, target, data)
                {

                },
                beforeAppend: function(event, target, data)
                {

                },
                afterAppend: function(event, target, data)
                {

                }
            }, options)
            /*when option records given*/
            $.when(options.records).done(function(response){

                // create new event;
                var event = new Event('write');
                
                // function before write
                options.beforeWrite(event, options.target, options.records);
                if(options.overwrite)
                {
                    $(options.target).html('')
                }
                $.each(response, function(a,b){
                    var dataCustom = {},
                        deff = $.Deferred();

                    if(typeof options.dataCustom == 'function')
                    {
                        dataCustom = options.dataCustom(b);

                    }

                    b = $.extend({}, b, dataCustom);

                    /*stream number is number that automatically create such as 1,2,3,4,5,6,..,n*/
                    var pattern, 
                        renderTemplete = options.template;
                    
                        renderTemplete = renderTemplete.replace(/\(:__stream_number\)/, a+1);

                    $.each(b, function(c,d){
                        
                        pattern = '::'+c+'::';
                        var reg = new RegExp(pattern, 'g');
                        var value = (b[c])? b[c] : '';
                        renderTemplete = renderTemplete.replace(reg, value);
                    
                    })

                    // renderTemplete = $(renderTemplete);

                    $(renderTemplete).each(function(){

                        deff.resolve({ui:this, options: options});
                        
                        promises.push(deff);

                        options.beforeAppend(event, this, b)
                        
                        options.success(event, this, b)

                    })
                    
                    if(options.target)
                    {
                        // $(renderTemplete).appendTo(options.target).each(function(){

                        //         $(this).data(b)
                        //         componentHandler.upgradeAllRegistered()
                        //         options.afterAppend(event, this, b)
                        //     })

                        if(options.typeWrite == 'append')
                        {

                            $(renderTemplete).appendTo(options.target).each(function(){

                                $(this).data(b)
                                componentHandler.upgradeAllRegistered()
                                options.afterAppend(event, this, b)
                            })
                        }else if(options.typeWrite == 'prepend')
                        {
                            $(renderTemplete).prependTo(options.target).each(function(){

                                $(this).data(b)
                                componentHandler.upgradeAllRegistered()
                                options.afterAppend(event, this, b)
                            })
                        }

                    }

                    /*else
                    {
                        dataText += renderTemplete;
                    }*/

                })
            })
            
            return $.when.apply(undefined, promises).promise();
            // return $.when(deff.promise());
        },

        element:
        {
            filter: function(options)
            {
                options = $.extend({trigger: 'input', trigger_using: undefined, target: undefined, caseSensitive: true}, options)

                if(!options.trigger_using || !options.target) { console.error('no element trigger or target defined!');return false };


                $(options.trigger_using).on(options.trigger, function(event){
                    var value = $(this).val();

                    if(!options.caseSensitive)
                    {
                        value = value.toLowerCase();
                    }

                    if(value == '') 
                    {
                        $(options.target).show();
                        // return false;
                    }

                    $(options.target).each(function(e){
                        var val = $(this).attr('data-filter');

                        if(!options.caseSensitive)
                        {
                            val = val.toLowerCase();
                        }
                        var contain = val.indexOf(value);

                        if(contain > -1)
                        {
                            $(this).show()
                        }else
                        {
                            $(this).hide()
                        }
                    })

                    // $(options.target+'[data-filter!="'+value+'"]').hide();
                    // $(options.target+'[data-filter="'+value+'"]').show();

                })
            }
        },
	
        // popup window in center
        popupCenter: function(url, title, w, h,other) {
            // Fixes dual-screen position                         Most browsers      Firefox
            var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
            var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

            var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
            var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

            var left = ((width / 2) - (w / 2)) + dualScreenLeft;
            var top = ((height / 2) - (h / 2)) + dualScreenTop;
            var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left+',scrollbars,'+other);

            // Puts focus on the newWindow
            if (window.focus) {
                newWindow.focus();
            }
            return newWindow;
        }
    }

	return new o();
})()
