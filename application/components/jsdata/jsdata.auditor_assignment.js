(function ( $ ) {

    function hide_company()
    {

    }

 	function update_auditor_assignment()
 	{
 		$.fn.auditor_assignment.records = []
		$('.checkbox-auditor-assigment:checked').each(function(){
			$.fn.auditor_assignment.records.push( $(this).data() )
		})
		return $.fn.auditor_assignment.records;
 	}

 	function update_auditor_placement()
 	{
 		$.fn.auditor_placement.records = []
		$('.checkbox-auditor-placement:checked').each(function(){
			$.fn.auditor_placement.records.push( $(this).val() )
		})
		return $.fn.auditor_placement.records;
 	}

    $.fn.auditor_assignment = function(options)
    {
    	var parents = $(this).parents('.list-group-item-auditor'),
			checkbox = $(parents).find('input[type="checkbox"]');
        // console.log($(checkbox).is(':checked'), $(this))
    	if( $(checkbox).is(':checked') )
		{
			$.fn.auditor_assignment.unmark(this);
		}else
		{
			$.fn.auditor_assignment.mark(this);
		}
		update_auditor_assignment()
    };

    $.fn.auditor_assignment.records = []

    $.fn.auditor_assignment.unmark = function(ui)
    {
    	var parents = $(ui).parents('.list-group-item-auditor'),
			checkbox = $(parents).find('input[type="checkbox"]');

        $(ui).removeClass('auditor-assignment--selected')
    	$(checkbox).prop('checked',false);
		$(ui).find('.material-icons').text('person_add');
    }

    $.fn.auditor_assignment.mark = function(ui)
    {
    	var parents = $(ui).parents('.list-group-item-auditor'),
			checkbox = $(parents).find('input[type="checkbox"]');

        $(ui).addClass('auditor-assignment--selected')
    	$(checkbox).prop('checked',true);
		$(ui).find('.material-icons').text('clear');
		
    };

    // auditor placement function ////////////////////////
    $.fn.auditor_placement = function(options)
    {
    	var parents = $(this).parents('.list-group-item-auditor'),
			checkbox = $(parents).find('input[type="checkbox"]');

    	if( $(checkbox).is(':checked') )
		{
            $(this).removeClass('added')
			$.fn.auditor_placement.remove(this);
		}else
		{
            $(this).addClass('added')
			$.fn.auditor_placement.add(this);
		}
		update_auditor_placement()

    };

    $.fn.auditor_placement.records = []

    // hasil penempatan auditor ke perusahaan
    $.fn.auditor_placement.draft = []

    $.fn.auditor_placement.resetDraft = function()
    {
         $.fn.auditor_placement.draft = [];
    }

    $.fn.auditor_placement.removeDraft = function(company)
    {
        var data = $.fn.auditor_placement.draft,
            index = $.fn.auditor_placement.checkDraft(company);

        data.splice(index,1);
        $.fn.auditor_placement.draft = data;
    }

    $.fn.auditor_placement.updateDraft = function(company, data)
    {
        var index = $.fn.auditor_placement.checkDraft(company);
        $.fn.auditor_placement.draft[index] = data;
    }

    $.fn.auditor_placement.checkDraft = function(company)
    {
        var index = $.fn.auditor_placement.draft.map(function(res){ return res.company }).indexOf(company);
        return index
    }

    $.fn.auditor_placement.remove = function(ui)
    {
        var parents = $(ui).parents('.list-group-item-auditor'),
            checkbox = $(parents).find('input[type="checkbox"]');

        $(ui).removeClass('auditor-placement--selected')
        $(checkbox).prop('checked',false);
        $(ui).find('.material-icons').text('person_add');
    }

    $.fn.auditor_placement.add = function(ui)
    {
        var parents = $(ui).parents('.list-group-item-auditor'),
            checkbox = $(parents).find('input[type="checkbox"]');

        $(ui).addClass('auditor-placement--selected')
        $(checkbox).prop('checked',true);
        $(ui).find('.material-icons').text('clear');
        
    };
    
    // object data brand
    $.fn.auditor_placement.company_added = [];
    
    // company obj add
    $.fn.auditor_placement.company_add = function(obj)
    {
        $.fn.auditor_placement.company_added.push(obj);
    }

    $.fn.auditor_placement.company_remove = function(id_company)
    {
        var index = $.fn.auditor_placement.company_added.map(function(res){ return res.id_company }).indexOf(id_company);
        $.fn.auditor_placement.company_added.splice(index,1);

    }
    
    $.fn.auditor_placement.company_selected = function()
    {
        // var checkbox = $('.schedules_confirmed:checked'),
        //     data = [];

        // $(checkbox).each(function(){
        //     var tr =  $(this).parents('tr');
        //     var trdata = tableConfirmed.row(tr).data()
        //     data.push(trdata);
        // })
        // return data;
        return $.fn.auditor_placement.company_added;
    }

    $.fn.auditor_placement.company_placement = function()
    {
        var data = $('[name="placement_company_list[]"]:checked').serializeArray();

        return data.map(function(res){ return res.value });
    }

    /*
    |------------------------
    | Run saat prepare review summary
    |------------------------
    */
    $.fn.auditor_placement.drafting = function()
    {
        if($.fn.auditor_placement.company_selected().length < 1)
        {
            swal('Silahkan pilih jadwal','Anda tidak memilih jadwal apapun. Silahkan pilih jadwal terlebih dahulu sebelum melanjutkan!', 'error');
            Doctab.hide();
            return false;
        }

        if( $.fn.auditor_placement.company_placement().length < 1 &&  $.fn.auditor_placement.draft.length < 1)
        {
            swal('Silahkan pilih perusahaan','Silahkan pilih perusahaan yang akan menjadi tempat auditor bertugas! (min. 1 perusahaan) ', 'error');

            return false;
        }

        if( $.fn.auditor_placement.records.length < 1 )
        {
            swal('Silahkan pilih auditor', 'Pilih auditor yang bertugas untuk perusahaan yang terpilih!', 'warning');
            return false;
        }

        // Jika kebutuhan auditor kurang dari yang ditambahkan;
        /*var kekurangan = window.audit_time_detail.kebutuhan.auditor - $.fn.auditor_placement.records.length 
        if(kekurangan > 0)
        {
            swal('Auditor masih kurang', 'Silahkan pilih '+kekurangan+' auditor lagi !', 'warning');
            return false;
        }*/

        if( $.fn.auditor_placement.company_selected().length > 0 &&
            $.fn.auditor_placement.company_placement().length > 0 &&
            $.fn.auditor_placement.records.length > 0 )
        {

            // $.fn.auditor_placement.draft = [];
            $.each( $.fn.auditor_placement.company_placement(), function(a,b){
                b = parseInt(b);
                var company_prop = $.fn.auditor_placement.company_selected().filter(function(res){ return res.id_company == b })[0],
                    datasave     = {company: b, auditor: $.fn.auditor_placement.records, property: company_prop, leader: null},
                    isExist      = $.fn.auditor_placement.draft.filter(function(res){ return res.company == b })

                // jika auditor placement belum ditambahkan
                if(isExist.length < 1 )
                {
                    $.fn.auditor_placement.draft.push(datasave);           
                }else
                {
                    // jika auditor placement sudah ditambahkan dan records nya sama dengan yang lama.

                    if(isExist.length > 0 && isExist[0].auditor.length !== $.fn.auditor_placement.records.length)
                    {
                        var e1 = $.fn.auditor_placement.draft.map(function(res){ return res.company }).indexOf(b);
                        $.fn.auditor_placement.draft[e1] = datasave;
                    }

                } 
            })
        }
    	
    }
    $.fn.auditor_placement.refreshAuditorAssigned = function()
    {
        $('.list-group-auditor-placement').html('');
        var template = '<div class="list-group-item list-group-auditor-placement" data-filter="::nama_jabatan::"> <div class="checkbox" style="display:inline;"> <label><input type="checkbox" name="auditor_placement[]" data-auditor="::fullname::" class="sr-only checkbox-auditor-placement" value="::id_auditor::"> <i class="material-icons" style="vertical-align:middle;">account_circle</i> ::fullname:: <span class="badge" style="float:none!important;">::nama_jabatan::</span> </label>  </div> <div class="btn-add-auditor" style="display:inline;float:right"> <button class="mdl-button mdl-js-button mdl-button--icon" onclick="$(this).auditor_placement()"> <i class="material-icons">add</i> </button> </div> </div>';
        return Tools.write_data({
            template: template,
            records: $.fn.auditor_assignment.records,
            success: function(event, ui, data)
            {
                if($('.auditor-placement--auditor-id--'+data.id_auditor).length < 1 )
                {
                    ui = $(ui).addClass('auditor-placement--auditor-id--'+data.id_auditor)
                    $('#auditor-placement--auditor-list-'+data.id_jabatan).append(ui).each(function(){
                        $(ui).find('input[type="checkbox"]').data(data);
                    });
                }

            }

        })

    }
    $.fn.auditor_placement.save = function()
    {

        if($.fn.auditor_placement.company_selected().length < 1)
        {
            swal('Silahkan pilih jadwal','Anda tidak memilih jadwal apapaun. Silahkan pilih jadwal terlebih dahulu!', 'error');
            Doctab.hide();
            return false;
        }
        var unLeadered = $.fn.auditor_placement.draft.filter(function(res){
            return res.leader == null
        })
        if( Object.keys(unLeadered).length > 0 )
        {
            swal('Silahkan pilih leader','ada beberapa group auditor yang belum memiliki leader. Silahkan pilih leader terlebih dahulu.!', 'error');
            return false;
        }

        swal({
            title: 'Mendaftarkan auditor',
            text: 'Sedang mendaftarkan auditor. Silahkan tunggu!',
            type: 'info',
            showConfirmButton: false
        })
        Snackbar.manual({message: 'Mendaftarkan auditor!', spinner:true})

        // var data = []
        // $.each( $.fn.auditor_placement.draft, function(a,b){
        //  var datasave = {company: b, auditor: $.fn.auditor_placement.records}
        //  data.push(datasave);
        // } )
        $.post(site_url('auditor/process/post/auditor_assignment'), {assignment: $.fn.auditor_placement.draft } )
        .done(function(res){
            console.log(res);

            Snackbar.show('Auditor telah didaftarkan!');

            // Update tanble confirmed
            // window.tableConfirmed.ajax.reload();
            window.tableConfirmedSingle.ajax.reload();
            window.tableConfirmedGroup.ajax.reload();
            window.completeSchedules.ajax.reload();
            window.unconfirmedSchedules.ajax.reload();
            window.passedSchedule.ajax.reload();
            
            // remove selected company
            var company = $.fn.auditor_placement.draft.map(function(res){ return res.company });
            $.each( company , function(a,b) {
                $('.auditor_placement--selected-company-list#selected-company--'+b).remove();
                $.fn.auditor_placement.removeDraft(b);

            })

            // show alert
            swal({   
                title: "Auditor telah ditambahkan",   
                text: "Auditor telah ditambahkan pada perusahaan yang terpilih!",   
                type: "info",   showCancelButton: false,   closeOnConfirm: true,   showLoaderOnConfirm: false,   

            // on alert clicked
            }, function(){  
                // reset draft data
                $.fn.auditor_placement.resetDraft();

                // remove checked selected company
                if( $('[name="placement_company_list[]"]').length > 0 )
                {
                    // reset data auditor ///////////////////////////////
                    $.fn.auditor_placement.refreshAuditorAssigned()
                    .done(function(){

                        // open tab auditor placement
                        next_to_auditor_placement()

                    })
                    ////////////////////////////////////////////////////////////
                }else
                {
                    // hide doctab
                    Doctab.hide();

                }
			});
		})
		.fail(function(res){
            console.log(res)
			swal('Kesalahan saat menyimpan','','error');
            Snackbar.show('Auditor telah didaftarkan!');
		})
    }
 
}( jQuery ));