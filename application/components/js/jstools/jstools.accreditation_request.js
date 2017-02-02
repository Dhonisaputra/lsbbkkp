
/*
|--------------------------
|
|--------------------------
| unit: SCOPE|PRODUCT_LINE|NACE
*/
function jstools_accreditation_request(ui, type, unit, replace, value, action)
{
    var $this = $(ui),
        $parent = $this.closest('.section--certification'),
        $key = $parent.attr('key')
    
    value = (value)? value : $this.val();
    var isCheck = $this.is(':checked');
    if(isCheck || (action && action === 'insert') )
    {
        $.jstools_accreditation_request.insert($key, unit, value, replace)
    }else {
        $.jstools_accreditation_request.remove($key, unit, value, replace)
    }

}



(function ( $ ) {
   

    $.jstools_accreditation_request = function()
    {

    }

    $.jstools_accreditation_request.insert = function(key, unit, value, replace)
    {
        var rec = $.jsdata_accreditation_request.find(key);
        if(replace)
        {
            $.jsdata_accreditation_request.records()[rec.index][unit] = value;
        }else {        
            $.jsdata_accreditation_request.records()[rec.index][unit].push(value);
        }
    }

     $.jstools_accreditation_request.remove = function(key, unit, value, replace)
    {
        var rec = $.jsdata_accreditation_request.find(key);
        if(replace)
        {
            $.jsdata_accreditation_request.records()[rec.index][unit] = value;

        }else {
            var find = $.jsdata_accreditation_request.records()[rec.index][unit].indexOf(value);
            $.jsdata_accreditation_request.records()[rec.index][unit].splice(find, 1);
        }
    }


    $.jstools_accreditation_request.scope = function(key, unit, isCheck, value, replace)
    {
        if(isCheck)
        {
            $.jstools_accreditation_request.insert(key, unit, value, replace)
        }else {
            $.jstools_accreditation_request.remove(key, unit, value, replace)
        }
    }
    

    $.jstools_accreditation_request.accreditation = function(key, isCheck, value, replace)
    {
        if(isCheck)
        {
            $.jstools_accreditation_request.accreditation.insert(key, value, replace)
        }else {
            $.jstools_accreditation_request.accreditation.remove(key, value, replace)
        }
    }

    
    
}( jQuery ));

$(function(){
    $(document).on('change', '.nace--choose-nace-available:not(.sr-only)', function(){

        var $this = $(this),
            $parent = $this.closest('.section--certification'),
            $key = $parent.attr('key'),
            $data =$this.data()

        var isCheck = $this.is(':checked');
        if(isCheck)
        {
            $.jstools_accreditation_request.insert($key, 'nace', $this.val())
        }else {
            $.jstools_accreditation_request.remove($key, 'nace', $this.val())
        }
    })

    $(document).on('change', '.product-line-item', function(){

        var $this = $(this),
            $parent = $this.closest('.section--certification'),
            $key = $parent.attr('key'),
            $data =$this.data()

        var isCheck = $this.is(':checked');
        if(isCheck)
        {
            $.jstools_accreditation_request.insert($key, 'product_line', $this.val())
        }else {
            $.jstools_accreditation_request.remove($key, 'product_line', $this.val())
        }
    })
})