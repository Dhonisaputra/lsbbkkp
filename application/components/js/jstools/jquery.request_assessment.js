

(function ( $ ) {
    var _data = {
        // lampiran:{'JPA-009': { text:'' }}, 
        'YQ-005': {is_self_announcement: true, nace: [],  product_line:[], scope: [], certification: [] }, 
        'JPA-009': {is_self_announcement: true, nace: [],  product_line: null, scope: [], brand:{}, certification: [] }, 
        // 'JPA-009': [], 
        'JECA-004': {is_self_announcement: true, nace:[], product_line:[], scope: [], certification: []},
        'extras': {} 
    };

    $.fn.request_assessment = function()
    {

    };
    $.fn.request_assessment.search = function()
    {

    }
    
    $.fn.request_assessment.self_announcement = function(type, value)
    {

        _data[type].is_self_announcement = JSON.parse(value);

    };

    $.fn.request_assessment.company = function(company)
    {
        _data['id_company'] = company;
    };
    $.fn.request_assessment.dataExtras = function(name, value)
    {
        if(typeof name == 'object' && !Array.isArray(name))
        {
            $.each(name, function(a,b){
                _data['extras'][a] = b;        
            })
        }else
        {
            _data['extras'][name] = value;
        }
    };

    $.fn.request_assessment.certification = function(ui)
    {
        var data = $(ui).data(),
            isCheck = $(ui).is(':checked'),
            value = $(ui).val();
        if(isCheck)
        {
            _data[data.certification].certification.push(value);
        }else
        {
            var index = _data[data.certification].certification.indexOf(value);
            _data[data.certification].certification.splice(index, 1);

        }
    }
    $.fn.request_assessment.nace = function(ui)
    {
        var data = $(ui).data(),
            isCheck = $(ui).is(':checked'),
            value = $(ui).val();

        if(isCheck)
        {
            _data[data.certification].nace.push(value);
        }else
        {

            var index = _data[data.certification].nace.indexOf(value);
            _data[data.certification].nace.splice(index, 1);

        }
    }

    $.fn.request_assessment.product_line = function(ui)
    {
        var data = $(ui).data(),
            isCheck = $(ui).is(':checked'),
            value = $(ui).val();

        if(isCheck)
        {
            _data[data.certification].product_line.push(value);
        }else
        {

            var index = _data[data.certification].product_line.indexOf(value);
            _data[data.certification].product_line.splice(index, 1);

        }
    }


    $.fn.request_assessment.scope = function(ui)
    {
        var data = $(ui).data(),
            isCheck = $(ui).is(':checked'),
            value = $(ui).val();
        if(isCheck)
        {
            _data[data.certification].scope.push(value);
        }else
        {

            var index = _data[data.certification].scope.indexOf(value);
            _data[data.certification].scope.splice(index, 1);

        }
    };

    $.fn.request_assessment.data = _data;

    /*
    certification_type = [YQ-005,..,..]
    type [text | file]
    content [text]
    */
    $.fn.request_assessment.lampiran = function(certification_type, type, content)
    {
        if(type !== 'text' && type !== 'file' )
        {
            return false;
        }
        _data['lampiran'][certification_type][type] = content;
        if(_data['lampiran'][certification_type][type] == content)
        {
            return true;
        }else
        {
            return false;
        }
    }


    // add Product
    $.fn.request_assessment.addProduct = function()
    {

    };

    $.fn.request_assessment.addProduct.object = function(certification_type)
    {
        var product_object = {id: new Date().getTime(), scope: [], nace: [], brand: '', certification: [], product_line: ""}
        _data[certification_type].push(product_object);
        return product_object.id;
    };

    $.fn.request_assessment.addProduct.brand = function() {};

    $.fn.request_assessment.addProduct.brand.add = function(certification_type) {
        var time = new Date().getTime(),
            key = 'brand'+time;
         _data[certification_type].brand[key] = {item: [] , lampiran: ''}
         return {key:key, type: 'JPA-009', id:time}
    };

    $.fn.request_assessment.addProduct.brand.remove = function(certification_type, key) {
         delete _data[certification_type].brand[key]
    };

    $.fn.request_assessment.addProduct.brand.item = function(certification_type, key, value) {
        var value = value.split(',');
        _data[certification_type].brand[key]['item'] = value;
    };

    $.fn.request_assessment.addProduct.brand.lampiran = function(certification_type, key, value) {
        _data[certification_type].brand[key]['lampiran'] = value;
    };


    $.fn.request_assessment.addProduct.scope = function(certification_type, id, ui)
    {
        var data = $(ui).data(),
            isCheck = $(ui).is(':checked'),
            value = $(ui).val(),
            index = _data[certification_type].map(function(res){ return res.id }).indexOf(parseInt(id));

        if(isCheck)
        {
            _data[certification_type][index].scope.push(value);
        }else
        {

            var i =  _data[certification_type][index].scope.indexOf(value);
            _data[certification_type][index].scope.splice(i, 1);

        }
    };

    $.fn.request_assessment.addProduct.nace = function(certification_type, id, ui)
    {
        var data = $(ui).data(),
            isCheck = $(ui).is(':checked'),
            value = $(ui).val(),
            index = _data[certification_type].map(function(res){ return res.id }).indexOf(parseInt(id));

        if(isCheck)
        {
            _data[certification_type][index].nace.push(value);
        }else
        {

            var i =  _data[certification_type][index].nace.indexOf(value);
            _data[certification_type][index].nace.splice(i, 1);

        }
        
    };

    $.fn.request_assessment.addProduct.product_line = function(certification_type, id, value)
    {
        _data[certification_type].product_line = value;
    };

    $.fn.request_assessment.addProduct.certification = function(certification_type, id, ui)
    {
        var data = $(ui).data(),
            isCheck = $(ui).is(':checked'),
            value = $(ui).val();
            // index = _data[certification_type].map(function(res){ return res.id }).indexOf(parseInt(id));

        if(isCheck)
        {
            _data[certification_type].certification.push(value);
        }else
        {
            var i =  _data[certification_type].certification.indexOf(value);
            _data[certification_type].certification.splice(i, 1);
        }
    };
    $.fn.request_assessment.addProduct.certification.reset = function(certification_type, id, ui)
    {
        // var index = _data[certification_type].map(function(res){ return res.id }).indexOf(parseInt(id));

         _data[certification_type].certification = []
    }

    $.fn.request_assessment.addProduct.remove = function(certification_type, id, eWillBeRemove)
    {

        // var index = _data[certification_type].map(function(res){ return res.id }).indexOf(parseInt(id));

        $.fn.request_assessment.data[certification_type].splice(index,1)

        if($.fn.request_assessment.data[certification_type].map(function(res){ return res.id }).indexOf(parseInt(id)) < 0)
        {
            $(eWillBeRemove).remove()
        }else
        {
            alert('remove gagal!');
        }

    }

    /*
    * Notes
    - baru diaplikasikan di bagian insert new brand in certification
    - request new assessment belum.
    */
    $.fn.request_assessment.submit = function(options)
    {
        // parameters needed
        var deff = $.Deferred();
        options = $.extend({
            data: $.fn.request_assessment.data,
            action: $('form').attr('action'),
            success: function(response){
                
                // window.location.href = site_url('company');
                console.log(response)
            },
            error: function(response)
            {
                swal('Kesalahan saat menyimpan permintaan', 'Kesalahan saat mengirimkan permintaan sertifikasi. Kemungkinan karena koneksi anda atau server yang tidak stabil. silahkan laporkan pada admin LSBBKKP!', 'error');
            }
        }, options)

        // snackbar mdl 
        Snackbar.manual({message: 'Mengirimkan permintaan sertifikasi!', spinner:true });
        
        // check apakah ada self assessment yang true
        // yq self assessment?
        /*var isYQ_self_announce = options.data['YQ-005'].is_self_announcement, // check is self announce
            isJECA_self_announce = options.data['JECA-004'].is_self_announcement, // i\check is jeca self announce
            isBrandEmpty = []; // array untuk tampung isbrandEmpty. sebenarnya ndak dipake sih.. -_-"
*/
        // check data brand dengan value kosong.
        // var dataBrand = options.data['JPA-009'].filter(function(res){ return res.brand == ""})
        var dataBrand = 0
        
        // eksekusi jika kosong
        if( dataBrand > 0)
        {
            // hide snackbar dan open tab jpa
            Snackbar.hide('#snackbarTemp');open_jpa_request();
            // alert('there are some brand missing!');
            swal({title: 'Isikan nama merek', message:'Silahkan isikan merek terlebih dahulu!' , type: 'warning'}, function(res){
                // focus cursor di nama brand yg
                $('[_="'+dataBrand[0].id+'"] [name="brand"]').focus();
            });

            return false;
        }else
        {
            $.post(options.action, options.data)
            .done(function(res){
                Snackbar.hide();
                Snackbar.show('Permintaan assessment telah dikirim!');
                swal({   
                    title: "Permintaan assessment telah dikirim",   
                    text: "",   
                    type: "success",   
                }, function(){   
                    deff.resolve(res);
                });
                options.success(res);
            })
            .error(function(res){
                options.error(res);
            })
        }

        return $.when(deff.promise())
    }
 
}( jQuery ));