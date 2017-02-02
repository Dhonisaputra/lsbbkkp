/*
    # PLEASE READ THIS #

    - this plugins need Engine.tools.js

*/

var nav = (function() {
    function function_recognize(options)
    {
        url = options.url;
        url = URL.get(url);
        if( (url.hash.fn && JSON.parse(url.hash.fn) == true) || (url.query.fn && JSON.parse(url.query.fn) == true) )
        {
            var fnName = (url.hash.fn_name)? url.hash.fn_name : url.query.fn_name;
            if(!fnName) return false;
            Tools.executeFunctionByName(fnName, window, options)
        }/*else
        {
            window.location.href = options.url;
        }*/
    }

    

    function sanitaze(options)
    {
        var deff = $.Deferred();

        var sanitazeObject = ['fn','fn_name'];
        var url = URL.get(options.url);
        var hash = url.hash
        $.each(sanitazeObject, function(a,b){
            delete hash[b];
        })
        deff.resolve(url.access_url+'#'+URL.update.build.hash(hash));

        return deff.promise();
    }

    function reurl(options)
    {

    }
    var Nav = function() {}

    Nav.prototype = {
        _lastOptions: {},
        _config: {extend:true},
        function_recognize: function(options){
            function_recognize(options);
        },
        bind: {
            popstate: function(options)
            {
                var deff = $.Deferred();

                options = $.extend({callback: function(event, state){} }, options);

                $(window).bind("popstate", function(event) {
                    var u = URL.get();
                    // nav.to({url:u.href})
                    options.callback(event, event.originalEvent.state) 
                    deff.resolve(event, event.originalEvent.state);   
                });

                return deff.promise();
            },
            change: function() {
                this.popstate()
                // nav.function_recognize({url: window.location.hash})

                /*
                    data in element <element href=":url" data-role="pushstate" role-attribute="href|link|..."> </element> 
                    jika role-attribute diisi href, maka system akan mencari attribute tsb. 
                    #default: href
                */
                $(document).delegate('[data-role="pushstate"], [data-role="replacestate"]', 'click', function(event){
                    // otomatis di prevent
                    event.preventDefault();

                    var role_attr = $(this).attr('ref-attribute')? $(this).attr('ref-attribute') : $(this).attr('href'),
                        data_role = $(this).attr('data-role') ;

                    var url = role_attr, 
                        title = ($(this).attr('title'))?$(this).attr('title'): 'no title',
                        target = ($(this).attr('data-target'))? $(this).attr('data-target'): '' ;
                    
                    nav.to({url: url, title: title, role: data_role, data: {url: url, title: title, target: target,  URI: URL.get(url) } } )
                    
                })
            }
        },
        lastOptions: function(){
            return this._lastOptions;
        },
        config: function(config){
            this._config = $.extend(this._config, config)
            return this._config;
        },
        back: function()
        {
            window.history.back();
            // nav.bind.change();
        },
        toUrl: function(options){
            options = $.extend({
                data: {},
                title: 'no title',
                url: undefined,
                role: 'pushstate',
            }, options)
            options.data.__uid = Date.now();
            options.url_modify = URL.params({'_': (new Date()).getTime()}, options.url, this._config)
            this._lastOptions = options;

            switch(options.role)
            {
                case 'pushstate':
                    window.history.pushState(options, options.title, options.url_modify);
                    break;

                case 'replacestate':
                    window.history.replaceState(options, options.title, options.url_modify)
                    break;
            }

            return nav.toLoad(options);
            
        },
        toLoad: function(options){
            var deff = $.Deferred();
            if(options.load.target)
            {
                $(options.load.target).load(options.url, options.load.data, function(a,b,c){
                    deff.resolve(a, b, c);
                })
               
            }else{

                deff.resolve({});
                console.warn('no target for load url')
            }
            return $.when(deff);

        },

        to: function(options)
        {
            // console.log(options);

            options = $.extend({
                data: {_sys:{source: undefined}},
                title: 'no title',
                url: undefined,
                role: 'pushstate',
                _sys: {source: undefined},
            }, options)
            
            var data = options.data;
            options.data = {_client:{}, _sys: options._sys, _server:{url: options.url, title: options.title, data: data}}
        
            var fnRec = options;

            // $.when(sanitaze(options)).done(function(res){
                // var url = ;
                
                // pushstate
                switch(options.role)
                {
                    case 'pushstate':
                        window.history.pushState(options.data, options.title, options.url);
                        break;

                    case 'replacestate':
                        window.history.replaceState(options.data, options.title, options.url)

                        break;
                }
                
                function_recognize(fnRec)
            // })
            // function recognize
        }
    };

    var newNav = new Nav();
    return newNav;
})()
nav.bind.change();

/*
|--------------------
| Engine Pushstate
|--------------------
*/
$(document).ready(function(){
    
    $(document).on('click','[data-engine="pushstate"]', function(e){
        e.preventDefault();
        $.ajaxSetup ({
            // Disable caching of AJAX responses
            cache: false
        });
        var  $this = $(this)
            ,using = $this.attr('engine-attr')
            ,url = (!using)? $this.attr('href') : $this.attr(using)
            ,title = $this.attr('title')? $this.attr('title') : ''
            ,target = $this.attr('data-target')
            ,config = $this.attr('engine-config')? JSON.parse($this.attr('engine-config')) : {extend:true}

        if(!url)
        {
            console.error('no url given. terminated function.')
            return false;
        }

        Snackbar.manual({message: 'Memuat halaman, silahkan tunggu!', spinner:true})
        
        nav.config(config)
        nav.toUrl({
            url: url, 
            title: title,
            load:
            {
                target: target
            }
        })
        .done(function(res){
            Snackbar.show('Halaman selesai dimuat.')
        })

        $this.siblings('.mdl-navigation__link').removeClass('active')
        $this.addClass('active');
    })

    $(window).bind("popstate", function(event) {
        var u = URL.get()
            ,$state = event.originalEvent.state;
        if($state)
        {
            nav.toLoad($state)
            .done(function(res){
                Snackbar.show('Halaman selesai dimuat.')
            })
        }else
        {
            window.location.href = u.href;
        }
        // nav.toUrl($state)
    });
})