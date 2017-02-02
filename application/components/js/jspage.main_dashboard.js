    var deferSingle = $.Deferred();
    var deferGroup = $.Deferred();
    var deferCompleteSchedules = $.Deferred();
    var deferUnconfirmedSchedules = $.Deferred();

    // Function panel //////////////////////////////////////////////////////////////////
    function refreshMainTable()
    {
        Snackbar.show({message: 'Mengambil data. Silahkan tunggu!', spinner: true});
        
        var deferSingle = $.Deferred();
        var deferGroup = $.Deferred();
        var deferCompleteSchedules = $.Deferred();
        var deferUnconfirmedSchedules = $.Deferred();

        window.tableConfirmedSingle.ajax.reload(function(){
            var numSingle = window.tableConfirmedSingle.data().count();
            deferSingle.resolve(numSingle);
        });
        window.tableConfirmedGroup.ajax.reload(function(){
            var numGroup = window.tableConfirmedGroup.data().count();
            deferSingle.pipe(function(single){
                var i = numGroup+single;
                deferGroup.resolve(i);
            })
        });
        window.completeSchedules.ajax.reload(function(){
            deferCompleteSchedules.resolve();
        });
        window.unconfirmedSchedules.ajax.reload(function(){
            deferUnconfirmedSchedules.resolve();
        });
        // window.passedSchedule.ajax.reload();

        // reset sendAs Records
        $.sendAs.records = []

        deferGroup.pipe(function(total){
            $('.mdl-confirmed-assessment-badge').text(total)
            $('.mdl-confirmed-schedules-badge').attr('data-badge', total)
        })

        $.when(deferSingle, deferGroup, deferUnconfirmedSchedules, deferCompleteSchedules)
        .done(function(){
            Snackbar.show('Pengambilan data selesai');
        })
       

    }

    function update_counter_num()
    {
        var group = window.tableConfirmedGroup.data().count();
        var single = window.tableConfirmedSingle.data().count();
        var i = group+single;
        console.log(i)
        $('.mdl-confirmed-assessment-badge').text(i)
        $('.mdl-confirmed-schedules-badge').attr('data-badge', i)
    }

    function counter_panel()
    {
        /*counter certification active*/
        $.post( site_url('assessment/process/get/schedules/complete') )
        .done(function(res){
            res = JSON.parse(res);
            var assessmentData = res.filter( function(res){ return res.type_schedule == 'new assessment' && moment(res.execution, 'YYYY-MM').isSame( moment().format('YYYY-MM') ) } )
            var reassessmentData = res.filter( function(res){ return res.type_schedule == 'reassessment' && moment(res.execution, 'YYYY-MM').isSame( moment().format('YYYY-MM') ) } )
            var expiredData = res.filter( function(res){ return moment(res.execution, 'YYYY-MM-DD').isBefore( moment().format('YYYY-MM-DD'), 'day' ) } )
            counter_panel__assessment(assessmentData);
            counter_panel__reassessment(reassessmentData);
            counter_panel__missed_schedule(expiredData);
        })
    }

    function certificateCounter()
    {
        $.post( site_url('certificate/process/get/list') )
        .done(function(res){
            res = JSON.parse(res);
            $('.mdl-active-certificate-badge').text(res.length);
        })
    }
    // run certificateCounter();
    certificateCounter();

    function counter_panel__assessment(data)
    {
        dataLength = data.length;
        $('.text-sum-assessment').text( dataLength );
    }

    function counter_panel__missed_schedule(data)
    {
        // console.log(data);
        dataLength = data.length;
        $('.mdl-missed-schedules-badge').text(dataLength)
    }

    function counter_panel__reassessment(data)
    {
        dataLength = data.length;
        $('.text-sum-reassessment').text(dataLength)
    }


    function update_data(data)
    {
        var inp_data_assessment = parseInt( $('input[name="sum_assessment"]').val() );
        if( data.sum_assessment != inp_data_assessment) { /*input data assessment*/ }

    }

    function openAssessment(event, id_a0, id_company)
    {
        var data = window.completeSchedules.data().filter(function(res){ return res.id_a0 == id_a0 })[0];

        $('#assessmentModal').modal({
            backdrop: false
        }).find('.modal-body').load( site_url('assessment/detail_assessment_on_dashboard'), data )
    }

    function open_dataReAssessment(event, id_rs, id_company)
    {
        var data = window.tableReAssessment.data().filter(function(res){ return res.id_rs == id_rs })[0];

        $('#assessmentModal').modal({
            backdrop: false
        }).find('.modal-body').load( site_url('assessment/detail_reassessment_on_dashboard'), data )
    }

    /*
    |--------------
    | buka halaman pilih auditor. 
    |--------------
    */
    function assessment_assigned()
    {
        // reset company that has been added
        $.fn.auditor_placement.company_added = []
        $.fn.auditor_assignment.records = []
        $.fn.auditor_placement.records = []
        $.fn.auditor_placement.draft = []

        // check jika tidak ada schedule yang dipilih
        if($('input[type="checkbox"][name="schedules_confirmed[]"]:checked').length < 1)
        {
            swal('Pilih Jadwal','Silahkan pilih jadwal terlebih dahulu!','error');
            return false;
        }

       // data = {company: dataCompany}
        var data = []

        $('input[type="checkbox"][name="schedules_confirmed[]"]:checked').each(function(){
            var tr      = $(this).parents('tr')
            var trdata  = $(this).data()
            var setdata = (trdata.type == 'single')? window.tableConfirmedSingle.row(tr).data() : window.tableConfirmedGroup.row(tr).data()
            var typeas  = (setdata.type_schedule === 'new assessment')? 'assessment' : 'reassessment';
            var d0      = $.extend({company: data.id_company, type_assessment:typeas}, setdata);

            if(trdata.type == 'single')
            {
                data = d0;
                // data.push(d0) ?? 
                addSingleCompanyToSelected(this)
            }else
            {

                data = d0;
            }
        })
        
        // mapping untuk mencari type assessment apakah yang digunakan.
        // jika yang keluar adalah 2. maka adalah kesalahan.
        // karena yang keluar haruslah 1. single atau group. 
        var mapping = (Array.isArray(data) )? $.unique(data.map(function(res){ return res.type_coordination })) : ['group'];
        if(mapping.length > 1)
        {
            swal('terdapat kesalahan saat memilih jadwal assessment','Terdapat 2 assessment yang terdeteksi. seharusnya hanya 1 jadwal yang dapat dipilih. silahkan refresh halaman ini. jika masih tetap terjadi hal tersebut, mohon untuk  melaporkan kepada admin LSBBKKP.','error');
            return false;
        }

        window.dataSelectedForAuditorAssignment = data;
        
        var url_params = URL.params({
            type_coordination:data.type_coordination, 
            type_assessment: data.type_assessment,
            id: (data.type_coordination == 'single')? data.id : data.id_assessment_group,
            id_company: data.id_company
        },site_url('auditor/assigned'));

        window.open(url_params)
        
        
    }

    function dataTypeReassessment(ui)
    {
        $(ui).siblings('.btn-primary').removeClass('btn-primary').addClass('btn-default'); $(ui).addClass('btn-primary');
        $('.tableConfirmed').find('input[type="checkbox"][name="schedules_confirmed[]"]:checked').prop('checked',false)
        $('.tableConfirmed').find('.sign').addClass('sr-only')

        $.fn.auditor_placement.company_added = []
    }

    /*
    * resend email confirmation
    */
    function resend_email()
    {
        var data = $('input[type="checkbox"][name="resend_email_data[]"]').serializeArray(),
            dataInp = [];

        $('input[type="checkbox"][name="resend_email_data[]"]:checked').closest('tr').each(function(res){
            dataInp.push( window.unconfirmedSchedules.row(this).data() );
        })

        if(data.length < 1)
        {
            swal('Jadwal tidak ada yang dipilih','Silahkan pilih jadwal terlebih dahulu!','error');
            return false;
        }
        
        swal({
            title: 'mengirimkan ulang jadwal assessment',
            text: 'mengirimkan ulang jadwal assessment. silahkan tunggu!',
            showConfirmButton: false,
            allowEscapeKey: false,
            type: 'info'
        })
        Snackbar.manual({ message: 're-send certification!', spinner: true });
        
        $.post(site_url('assessment/process/post/resend_email'), {data: dataInp})
        .done(function(res){

            refreshMainTable()

            swal('Jadwal terkirim','Jadwal telah terkirim dengan sukses.', 'success');
            Snackbar.show('Jadwal telah terkirim dengan sukses');
        })
        .error(function(res){
            console.log(res)
            Snackbar.show('Terjadi kesalahan saat mengirimkan jadwal. Silahkan untuk coba lagi!');
            swal('Terjadi kesalahan saat mengirimkan jadwal', 'Silahkan untuk coba lagi', 'error');

        })
    }

    /*
    * function add selected-all-schedules to records 
    */
    // element yang digunakan oleh checkbox
    $.fn.selecting_all_schedules = function(event, ui){
        
    }

    $.fn.selecting_all_schedules.records = []
    $.fn.selecting_all_schedules.add = function(data){
        
        var existkah = $.fn.selecting_all_schedules.check(data);

        if(existkah.index < 0)
        {
            data['identifier'] = data.id+'|'+data.type+'|'+data.id_company;
            $.fn.selecting_all_schedules.records.push(data);
        }
    };
    $.fn.selecting_all_schedules.remove = function(data){
        var existkah = $.fn.selecting_all_schedules.check(data);
        if(existkah.index > -1)
        {
            delete $.fn.selecting_all_schedules.records[existkah.index];
            $.fn.selecting_all_schedules.records = $.fn.selecting_all_schedules.records.filter(function(res){ return res !== undefined })
        }
    };
    
    $.fn.selecting_all_schedules.check = function(data){
        
        var records = $.fn.selecting_all_schedules.records;
        var index = records.map(function(res){ return res.identifier }).indexOf(data.id+'|'+data.type+'|'+data.id_company);
        var data = records.filter(function(res){ return res.id == data.id && res.type == data.type });
        return {data: data, index:index, records: records}
    };
    
    /*
    * function notify as group
    */
    function notify_as_group()
    {
        var data = $.sendAs.records;

        if(data.length < 1)
        {
            swal('Terjadi kesalahan','Silahkan pilih jadwal terlebih dahulu!', 'error');
        }else
        {
            Doctab.show({

                onShow: function(e)
                {
                    $(e.tabContent).editorSendAsGroup();
                }
            
            })
        }
    }

    /*
    * function notify as group
    */
    function notify_as_single()
    {
        var data = $.sendAs.records;
        if(data.length < 1)
        {
            swal('Tidak ada jadwal terpilih','Mohon untuk memilih jadwal terlebih dahulu sebelum mengirimkan jadwal surveilen secara individu / single!','error');
            return false;
        }
        swal({ type:'info',  title: "Mengirimkan email jadwal assessment",   text: "Mengirimkan email jadwal assessment. silahkan tunggu!",   html: true, showConfirmButton:false, allowEscapeKey:false });
        Snackbar.manual({ message: 'Mengirimkan email jadwal assessment. Silahkan tunggu!', spinner: true });
        $.post(site_url('assessment/process/post/assessment/single'), {data: JSON.stringify(data)})
        .done(function(res){        
            console.log(res);
            refreshMainTable()
            swal({title:'Email konfirmasi telah terkirim',text:'Email konfirmasi untuk jadwal assessment telah terkirim ke perusahaan.', type:'success'});
            Snackbar.show('Email konfirmasi telah terkirim dengan sukses.');
            $.sendAs.records = []
            $('#assessment-group--send-as-single').prop('disabled',true)
        })
    }

    /*
    * function onChange all schedule notified
    */
    function all_schedules_notified_onchange(ui)
    {
        // change sign check in table 
        var isChecked = $(ui).is(':checked'),
            id_company = $(ui).val(),
            lengthOfAssessmentAssociatedWithCompany = $.sendAs.records.filter(function(res){ return res.id_company == id_company }).length;
            
        
            if( lengthOfAssessmentAssociatedWithCompany < 1 )
            {
                $('.icons-preview--all-schedule-'+id_company).text('check_box_outline_blank');
            }else
            {
                $('.icons-preview--all-schedule-'+id_company).text('check_box');
            }
    }

    /*
    |
    | to add single company to selected company
    |
    */
    function addSingleCompanyToSelected(ui)
    {
        var tr = $(ui).parents('tr');
        var data = tableConfirmedSingle.row(tr).data();
        var isChecked = $(ui).prop('checked')
        if(isChecked)
        {
            $.fn.auditor_placement.company_add(data);
        }else
        {
            $.fn.auditor_placement.company_remove(data.id_company);            
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $(function(){
        ////////////////////////////// panel counter /////////////////////////////////
        counter_panel();
        //////////////////////////// end panel counter //////////////////////////////
        

        window.tableConfirmedSingle = $('#tableConfirmed--single').DataTable({
            info: false,
            lengthChange: true,
            ajax: {
                url: site_url('assessment/process/get/schedules/confirmed/single'),
                dataSrc: function(json)
                {
                    json = (json.data)? json.data : json;
                    $('.confirmed-single-badge').text(json.length)
                    if(!json){return false; }
                    $.each(json, function(a,b){
                        json[a]['checkbox_assign']  = ' <span class="material-icons confirmed-sign " style="color:#4183D7">check_box_outline_blank</span> <input type="checkbox" value="'+b.id_a0+'" data-type="single" name="schedules_confirmed[]" class="sr-only schedules_confirmed">';
                        json[a]['keterangan']       = (b.type_schedule == 're assessment')? 'Surveilen '+b.description : 'Permintaan Awal' 
                    });

                    console.log(json)
                    return json;
                }
            },
            columns:[
                {data: 'execution'},
                {data: 'company_name'},
                {data: 'country_name'},
                {data: 'company_region'},
                {data: 'keterangan'},
                {data: 'checkbox_assign'},
            ],
            initComplete: function()
            {
                deferSingle.resolve();
            }
        })

        window.tableConfirmedGroup = $('#tableConfirmed--group').DataTable({
            info: false,
            lengthChange: true,
            ajax: {
                url: site_url('assessment/process/get/schedules/confirmed/group'),
                dataSrc: function(json)
                {
                    json = (json.data)? json.data : json;
                    $('.confirmed-group-badge').text(json.length)
                    if(!json){return false; }
                    $.each(json, function(a,b){
                        json[a]['checkbox_assign'] = '<span class="material-icons confirmed-sign" style="color:#4183D7">check_box_outline_blank</span>  <input type="checkbox" value="'+b.id_a0+'" data-type="group" name="schedules_confirmed[]" class="sr-only schedules_confirmed">';
                    });

                    return json;
                }
            },
            columns:[
                {data: 'execution'},
                {data: 'coordinator_name'},
                {data: 'country_name'},
                {data: 'company_region'},
                {data: 'checkbox_assign'},
            ],
            initComplete: function()
            {
                deferGroup.resolve();

            }
        })
        /*
        |-------------------
        | Update counter card
        |------------------
        */
        $.when(deferSingle, deferGroup)
        .done(function(){
            // update counter number 
            update_counter_num();    
        })

        // complete schedules datatable
        window.completeSchedules = $('#allSchedules').DataTable({
            info: false,
            lengthChange: true,
            ajax: {
                url: site_url('assessment/process/get/schedules/complete'),
                dataSrc: function ( json ) {
                    json = (json.data)? json.data : json;
                    $('.mdl-all-schedules-badge').attr('data-badge', json.length)    
                    if( json.length < 1 ) return false;

                    

                    // json = json.filter(function(res){ var isValid = (moment(res.execution, 'YYYY-MM-DD').isSameOrAfter( moment().format('YYYY-MM-DD') ) ); return (isValid)? res : false; })

                    var i = 1, 
                        url = URL.get();

                    url.hash.dataBottom = (url.hash.dataBottom)? url.hash.dataBottom : moment().add(3,'months').format("YYYY, MMM 01");
                    url.hash.dataTop = (url.hash.dataTop)? url.hash.dataTop : moment().format("YYYY, MMM 01");
                    
                    $.each(json, function(a,b){

                        var urlDetail = site_url('assessment/detail/'+encodeURIComponent( b.type_schedule )+'/'+b.id ),
                            action = (b.type_schedule == 'reassessment')? 'open_dataReAssessment(event, '+b.id+', '+b.id_company+')' : 'openAssessment(event, '+b.id+', '+b.id_company+')',
                            dataFilter = $.fn.selecting_all_schedules.check(b),
                            checked = dataFilter.index > -1 ? 'checked' : '';

                        json[a]['execution_edited'] = (b.execution)? moment(b.execution).fromNow()+' ('+moment(b.execution).format("MMM Do YYYY")+')' : 'not confirmed yet!';
                        json[a]['deadline_edited'] = (moment(b.deadline).isValid())? moment(b.deadline).format("YYYY, MMM DD") : b.deadline;
                        json[a]['type_edited'] = (b.type_schedule == 'reassessment')? b.type_schedule+'/'+b.certificate : b.type_schedule+'/'+b.type;
                        json[a]['notified_checkbox'] = '<label><input type="checkbox" id="all_schedules_notified--'+b.id_company+'" class="sr-only" name="all_schedules_notified[]" value="'+b.id_company+'" '+checked+' onchange="all_schedules_notified_onchange(this)"> <span class="material-icons icons-preview--all-schedule icons-preview--all-schedule-'+b.id_company+'">check_box_outline_blank</span> </label> '
                        json[a]['action'] = '<button class="btn btn-primary detail-all-schedule">buka</button>';
                        i++;
                    })

                    
                        jsonFilter = []
                        $.each(json, function(a,b){

                            var isValid = ( moment(b.deadline, 'YYYY-MM-DD').isBetween(url.hash.dataTop, url.hash.dataBottom, 'month', '[}')  )? true : false;
                            
                            if(isValid || !moment(b.deadline).isValid() )
                            {
                                jsonFilter.push(b);
                            }
                        })
                        json = jsonFilter;

                    $('.mdl-all-schedules-badge').attr('data-badge', json.length)    

                    // filter based on company
                    jsona = []
                    $.each(json, function(a,b){
                        var exs = jsona.map(function(res){
                            return res.id_company
                        }).indexOf(b.id_company)
                        if(exs < 0)
                        {
                            jsona.push(b);
                        }
                    })

                    json = jsona;
                    
                    return json;
                }
            },
            columns: [
                {data: 'notified_checkbox'},
                {data: 'deadline_edited'},
                {data: 'company_name'},
                {data: 'country_name'},
                {data: 'company_region'},
                {data: 'type_edited'},
                {data: 'action'},
            ],
            initComplete: function(res){
                deferCompleteSchedules.resolve(res);
            }
        })

        /*
        * waiting confirmation schedules
        */

        window.unconfirmedSchedules = $('#unconfirmedSchedules').DataTable({
            info: false,
            lengthChange: true,
            ajax: {
                url: site_url('assessment/process/get/schedules/unconfirmed'),
                dataSrc: function(json)
                {
                    json = (json.data)? json.data : json;

                    if(!json){return false; }

                    $('.mdl-new-assessment-badge').text(json.length)
                    $('.mdl-unconfirmed-schedules-badge').attr('data-badge', json.length)

                    $.each(json, function(a,b){
                        json[a]['checkbox_notified'] = '<input type="checkbox" class="sr-only" name="resend_email_data[]" value="'+b.id_company+'"> <span class="material-icons sign">check_box_outline_blank</span>';
                        json[a]['deadline'] = 'N/A';
                        json[a]['contact'] = 'Company Phone Number';
                        json[a]['company_name_url'] = b.company_name+' <a href="'+site_url('company/'+b.id_company)+'" target="_blank"> <i class="material-icons middle">link</i> </a>';
                    })
                    
                    return json;
                }
            },
            columns:[
                {data: 'deadline'},
                {data: 'company_name_url'},
                {data: 'country_name'},
                {data: 'company_region'},
                {data: 'checkbox_notified'},
            ],
            initComplete: function(res){
                deferUnconfirmedSchedules.resolve(res);
            }
        })

        // passed schedules datatable
        window.passedSchedule = $('#passedSchedule--table').DataTable({
            info: false,
            lengthChange: true,
            ajax: {
                url: site_url('assessment/complete_schedule'),
                dataSrc: function ( json ) {
                    json = (json.data)? json.data : json;
                    $('.mdl-missed-schedules-badge').attr('data-badge', json.length)    
                    if( json.length < 1 ) return false;

                    json = json.filter(function(res){ var isValid = (moment(res.execution, 'YYYY-MM-DD').isBefore( moment().format('YYYY-MM-DD') )); return (isValid)? res : false; })

                    var i = 1, url = URL.get();
                    $.each(json, function(a,b){
                        var urlDetail = site_url( 'assessment/detail/'+encodeURIComponent( b.type_schedule )+'/'+b.id ), 
                            action = (b.type_schedule == 'reassessment')? 'open_dataReAssessment(event, '+b.id+', '+b.id_company+')' : 'openAssessment(event, '+b.id+', '+b.id_company+')';
                        
                        json[a]['no'] = i;
                        json[a]['action'] = '<button class="btn btn-default" onclick="'+action+'"> Detail </button>'
                        // json[a]['action'] = '<button class="btn btn-sm btn-primary" onclick="Tools.popupCenter(\''+urlDetail+'#id='+b.id+'\',\'detail\', 600 , 500 )"> detail </button>';
                        json[a]['notification_edited'] = (b.notification_time)? moment(b.notification_time).format("MMM Do YY") : 'not notify yet';
                        json[a]['execution_edited'] = (b.execution)? '<span class="label label-danger">'+moment(b.execution).fromNow()+'</span> ('+moment(b.execution).format("MMM Do YYYY")+')' : 'not confirmed yet!';
                        i++;
                    })

                    if(url.hash.dataTop && url.hash.dataBottom)
                    {
                        json = json.filter(function(res){
                            // console.log(moment(res.execution).isValid(), moment(res.execution, 'YYYY-MM-DD').isBetween(url.hash.dataTop, url.hash.dataBottom, 'month', '[]' ), res.execution)
                            var isValid = (moment(res.execution).isValid() && moment(res.execution, 'YYYY-MM-DD').isBetween(url.hash.dataTop, url.hash.dataBottom, 'month', '[]')  )? true : false;
                            return (isValid)? res : false;
                        })
                    }

                    $('.mdl-missed-schedules-badge').attr('data-badge', json.length)    
                    return json;
                }
            },
            columns: [
                {data: 'no'},
                {data: 'notification_edited'},
                {data: 'execution_edited'},
                {data: 'type_schedule'},
                {data: 'action'},
            ]
        })


        //////////////////////////////////////////// fetch between month ///////////////////////////////////////////
        var deffDate = $.Deferred();
        // $('#fetch-between--start').val( moment().format('YYYY-MM-01') )
        // $('#fetch-between--end').val( moment().add(3,'M').format('01/MM/YYYY') );

        window.assessmentFilterDate = $('#fetch-between--end').Zebra_DatePicker({
            direction: 2,
            format: 'M Y',
            onSelect: function(a,b,c,d)
            {
                var startDate = $('#fetch-between--start').val()
                FilterDashboard.setDate(startDate, b);
                return b;
            }
        });
        window.assessmentFilterDateData = $('#fetch-between--end').data('Zebra_DatePicker')

        $('.clear--fetch_date').on('click', function(){
            $('#fetch-between--end, #fetch-between--start').val('');
            nav.to({url:'#fn=true&fn_name=window.completeSchedules.ajax.reload'})
        })
        //////////////////////////////////////////// end fetch between month ///////////////////////////////////////////

        $(document).ready(function(){

            $(document).delegate('#allSchedules tbody tr input[type="checkbox"]', 'change', function(event){
                var row = $(this).parents('tr');
                var data = window.completeSchedules.row(row).data();
                
                var isChecked = $(event.target).is(':checked');
                if(isChecked)
                {
                    $.fn.selecting_all_schedules.add(data);
                }else
                {
                    $.fn.selecting_all_schedules.remove(data);
                }
            });

            $(document).delegate('#allSchedules tbody tr .detail-all-schedule', 'click', function(event){
                
                var tr = $(this).closest('tr');
                var data = window.completeSchedules.row(tr).data();
                // hapus text notified checbox
                delete data.notified_checkbox;

                Doctab
                .show({
                    load:
                    {
                        url:site_url('assessment/detail/schedules/all'),
                        data: data,
                        onShow: function()
                        {
                            Snackbar.manual({message: 'Memuat halaman', spinner: true});
                        },
                        onShown: function()
                        {
                            Snackbar.show('Halaman selesai dimuat');
                        }
                    },
                   /* onShow: function(e)
                    {
                        $(e.tabContent).load(site_url('assessment/detail/schedules/all'), data, function(){})
                        event.stopPropagation()
                    }*/
                })
            })

            $(document).delegate('.tableConfirmed tbody tr', 'click', function(event){
                // console.log( $(this) )
                // siblings
                $('.tableConfirmed tbody tr').find('.confirmed-sign').text('check_box_outline_blank')
                $(this).siblings('tr').find('input[type="checkbox"]').prop('checked',false)

                // this
                if( $(this).find('input[type="checkbox"]').prop('checked') )
                {
                    $(this).find('.confirmed-sign').text('check_box_outline_blank')
                    $(this).find('input[type="checkbox"]').prop('checked',false)
                }else
                {
                    $(this).find('.confirmed-sign').text('check_circle')
                    $(this).find('input[type="checkbox"]').prop('checked',true)

                }
                // var data = window.completeSchedules.row(this).data();
               
            })

            $('#unconfirmedSchedules').delegate('tbody tr td:last-child', 'click', function (e){
                var $this = $(this)
                    ,$sign = $this.find('.sign')
                    ,$checkbox = $this.find('input[type="checkbox"]')
                    ,$isChecked = $checkbox.is(':checked')

                $checkbox.trigger('click');
                if($isChecked)
                {
                    $sign.text('check_box_outline_blank');
                } else {
                    $sign.text('check_box');
                }
            })

        })
    })