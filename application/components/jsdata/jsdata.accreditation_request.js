(function ( $ ) {
 	var _data = {
        // lampiran:{'JPA-009': { text:'' }}, 
        'YQ-005': {is_self_announcement: true, nace:[], product_line:null, scope: [], certification: [], type: 'YQ-005' }, 
        'JECA-004': {is_self_announcement: true, nace:null, product_line:[], scope: [], certification: [], type: 'JECA-004'}, 
        'JPA-009': {is_self_announcement: true, nace:null, product_line: "", notes: "", scope: null, brand:[], certification: [], type: 'JPA-009' }, 
        'brand': {brand_name: '', lampiran: ''}
    };
    var _saver = []

    $.jsdata_accreditation_request = function()
    {

    }
    $.jsdata_accreditation_request.key = function()
    {
    	var buf = new Uint16Array(2);
    	var unique = window.crypto.getRandomValues(buf).join('');
    	var uniqid = (new Date().getTime()).toString(16)+unique;
    	return uniqid;
    }
    $.jsdata_accreditation_request.options = 
    {
    	
    }
    $.jsdata_accreditation_request.request = function(type, selfAssessment)
    {
        if(!_data[type])
        {
            console.error(type+' tidak ada di dalam daftar sertifikasi kami!');
            return false;
        }
        var key = $.jsdata_accreditation_request.key();
        var cloneObj = JSON.parse(JSON.stringify(_data[type]));
        cloneObj['key'] = key;
        cloneObj['is_self_announcement'] = (!selfAssessment)? false : true;
        _saver.push(cloneObj);
        return cloneObj;
    }
    $.jsdata_accreditation_request.records = function()
    {
        return _saver;
    }
    $.jsdata_accreditation_request.find = function(key)
    {
        var index = _saver.map(function(res){
            return res.key
        }).indexOf(key);
        var data = _saver.filter(function(res){
            return res.key == key
        })

        return {index: index, data: data, key:key}
    }
    $.jsdata_accreditation_request.remove = function(key)
    {
        var index = _saver.map(function(res){
            return res.key
        }).indexOf(key);

        if(index < 0)
        {
            console.error('request dengan key '+key+' tidak ditemukan. Silahkan check key yang anda punya!');
            return false;
        }

        _saver.splice(index, 1);
    }
    $.jsdata_accreditation_request.reset = function()
    {
        _saver = [];
    }
 
}( jQuery ));