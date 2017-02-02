<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>


<?php echo $this->load->component('css', 'plugins/easyautocomplete/easy-autocomplete.min.css') ?>
<?php echo $this->load->component('js', 'plugins/easyautocomplete/jquery.easy-autocomplete.min.js') ?>



<section class="navbar">
    <div class="btn-group" role="group" aria-label="...">
        <!-- Icon button -->
        <button class="btn btn-default mdl-button mdl-js-button mdl-button--icon" onclick="refreshMainTable()">
          <i class="material-icons">replay</i>
        </button>

    </div>
</section>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="assessment-schedule-dashboard--home">
    
		<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
		                
		    <div class="mdl-tabs mdl-js-tabs">
		        <div class="mdl-tabs__tab-bar">
		            <a href="#assigned-assessment-panel" class="mdl-tabs__tab is-active "> <span class="mdl-badge mdl-assigned-assessment-badge" data-badge="0">Jadwal ditetapkan </span> </a>
		            <a href="#conducted-assessment-panel" class="mdl-tabs__tab "> <span class="mdl-badge mdl-conducted-assessment-badge" data-badge="0">Jadwal sedang dilaksakan</span> </a>
		            <a href="#waiting-result-panel" class="mdl-tabs__tab "> <span class="mdl-badge mdl-waiting-result-badge" data-badge="0">Menunggu konfirmasi</span> </a>
		            <!-- other tab href -->
		        </div>

		        <div class="mdl-tabs__panel is-active" id="assigned-assessment-panel">
		            <div class="table-responsive col-md-12" style=" margin-top:20px;">
		                <table class="table table-stripped  table-hover" id="assigned-assessment-table" style="width:100%;">
		                    <thead>
		                        <tr>
		                            <th>Dilaksanakan pada</th>
		                            <th>Lead auditor</th>
		                            <th>Perusahaan</th>
		                            <th>Negara</th>
		                            <th>Kabupaten</th>
                                    <th>action</th>
		                        </tr>
		                    </thead>
		                </table>
		            </div>
		        </div>
		        <div class="mdl-tabs__panel" id="conducted-assessment-panel">
		            <div class="table-responsive col-md-12" style=" margin-top:20px;">
		                <table class="table table-stripped  table-hover" id="conducted-assessment-table" style="width:100%;">
		                    <thead>
		                        <tr>
		                            <th>Dilaksanakan pada</th>
                                    <th>Lead auditor</th>
                                    <th>Perusahaan</th>
                                    <th>Negara</th>
                                    <th>Kabupaten</th>
                                    <th>action</th>
		                        </tr>
		                    </thead>
		                </table>
		            </div>
		        </div>
		        <div class="mdl-tabs__panel" id="waiting-result-panel">
		            <div class="table-responsive col-md-12" style=" margin-top:20px;">
		                <table class="table table-stripped  table-hover" id="waiting-result-table" style="width:100%;">
		                    <thead>
		                        <tr>
		                            <th>Dilaksanakan pada</th>
                                    <th>Lead auditor</th>
                                    <th>Perusahaan</th>
                                    <th>Negara</th>
                                    <th>Kabupaten</th>
                                    <th>action</th>
		                        </tr>
		                    </thead>
		                </table>
		            </div>
		        </div>
		        <!-- other tabpanel -->
		        
		    </div>

		</div>

	</div>
	<!-- end tab home -->

	<div role="tabpanel" class="tab-pane" id="assessment-schedule-dashboard--conducted">
		<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">

	    	<div class="form-group">
	    		<button href="#assessment-schedule-dashboard--home" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" role="tab" data-toggle="tab" onclick="$('#assessment-schedule-dashboard--conducted-body').html('')">
				  	<i class="material-icons" style="vertical-align:middle">keyboard_backspace_</i> Kembali
				</button>
			</div>
	    	<div id="assessment-schedule-dashboard--conducted-body"></div>

	    </div>
	</div>

</div>

<script type="text/javascript">
    
    var deferAssigned = $.Deferred();
    var deferConduct = $.Deferred();
    var deferWaiting = $.Deferred();

    function set_assigned_assessment()
    {
        window.assignedassessment = $('#assigned-assessment-table').DataTable({
            ajax:
            {
                url: site_url('assessment/get__assigned_assessment'),
                dataSrc: function(json)
                {
                    json = (json.data)? json.data : json;
                    // set badge
                    $('.mdl-assigned-assessment-badge').attr('data-badge', json.length)
                    
                    if( json.length < 1 ){ return false };

                    $.each(json, function(a,b){
                        json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="openAssignedSchedules(this)"> Buka jadwal <i class="material-icons">open_in_new</i> </button>'
                    })
                    return json;
                }
            },
            columns: [
                {data: 'assessment_date'},
                {data: 'fullname'},
                {data: 'company_name'},
                {data: 'country_name'},
                {data: 'company_region'},
                {data: 'action'},
            ],
            initComplete: function()
            {
                deferAssigned.resolve();
            }
        })

    }

    function set_conducted_assessment()
    {
        window.conductedassessment = $('#conducted-assessment-table').DataTable({
            ajax:
            {
                url: site_url('assessment/get__conducted_assessment'),
                dataSrc: function(json)
                {
                    json = (json.data)? json.data : json;
                    $('.mdl-conducted-assessment-badge').attr('data-badge', json.length)
                    if( json.length < 1 ){ return false };

                    $.each(json, function(a,b){
                        json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="openConductedSchedules(this)"> Buka jadwal <i class="material-icons">open_in_new</i> </button>'
                    })
                    // set badge
                    return json;
                }
            },
            columns: [
                {data: 'data_assessment_date'},
                {data: 'fullname'},
                {data: 'company_name'},
                {data: 'country_name'},
                {data: 'company_region'},
                {data: 'action'},
            ],
            initComplete: function()
            {
                deferConduct.resolve();
            }
        })

    }

     function set_waiting_result()
    {
        window.waitingresult = $('#waiting-result-table').DataTable({
            ajax:
            {
                url: site_url('assessment/get__conducted_assessment'),
                dataSrc: function(json)
                {
                    json = (json.data)? json.data : json;
                    $('.mdl-waiting-result-badge').attr('data-badge', json.length)
                    if( json.length < 1 ){ return false };

                    $.each(json, function(a,b){
                        json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="openWaitingSchedules(this)"> Buka jadwal <i class="material-icons">open_in_new</i> </button>'
                    })


                    return json;
                }
            },
            columns: [
                {data: 'data_assessment_date'},
                {data: 'fullname'},
                {data: 'company_name'},
                {data: 'country_name'},
                {data: 'company_region'},
                {data: 'action'},
            ],
            initComplete: function()
            {
                deferWaiting.resolve();
                
            }
        })

    }

    function refreshMainTable()
    {
        Snackbar.manual({message:'Memuat data. Silahkan tunggu!', spinner: true});
        
        window.waitingresult.ajax.reload()
        window.conductedassessment.ajax.reload()
        window.assignedassessment.ajax.reload()

        $.when(deferWaiting, deferConduct, deferAssigned)
        .done(function(){
            Snackbar.show('Data selesai dimuat!');
        })
    }

    $.when(deferWaiting, deferConduct, deferAssigned)
    .done(function(){
        Snackbar.show('Data selesai dimuat!');
    })


    function openWaitingSchedules(ui)
    {
        var $this = $(ui);
        var $parents = $this.closest('tr');
        
        var data = window.waitingresult.row($parents).data();
        console.log(data)
        delete data.company_password;
        
        var url = 'assessment/result/'+data.id_a0
        window.location.href = site_url(url);
       /* Doctab.show({
            // load: {
            //     url: site_url(url),
            //     data: data
            // }
            onShow: function(e){
                Snackbar.show({message:'Mengambil jadwal assessment yang belum di nilai. Silahkan tunggu!', spinner:true})
                $(e.tabContent).load(site_url(url), data, function(){
                })
            }
        });*/
    }

    function openConductedSchedules(ui)
    {
        var $this = $(ui);
        var $parents = $this.closest('tr');
        var data = window.conductedassessment.row($parents).data();
        delete data.company_password;

        Doctab.show({
            load: {
                url: site_url('auditor/list_conducted_auditor/'+data.id_company),
                data: data,
            },
            onShow: function()
            {
                Snackbar.show('Data telah dimuat')
            }

        })
    }

    function openAssignedSchedules(ui)
    {
        var $this = $(ui);
        var $parents = $this.closest('tr');
        var data = window.assignedassessment.row($parents).data();
        var company_name = $(this).children().eq(2).text();
        delete data.company_password;
        // var data = window.assignedassessment.data().filter(function(res){ return res.company_name == company_name })[0];
        // nav.to({url:'#!auditor&a0='+data.id_a0})
        Doctab.show({
            load:
            {
                url: site_url('auditor/list_assigned_auditor?type='+data.type_report+'&auditor=1&a0='+data.id_a0),
                data: data
            }
        })
    }
$(document).ready(function(){
    Snackbar.manual({message:'Memuat data. Silahkan tunggu!', spinner: true});

    set_waiting_result();
    set_conducted_assessment();
    set_assigned_assessment();

    // #assigned-assessment-table tbody tr on dbl click
   /* $('#assigned-assessment-table tbody').delegate('tr', 'click', function(event){
        var data = window.assignedassessment.row(this).data();
        var company_name = $(this).children().eq(2).text();
        delete data.company_password;
        // var data = window.assignedassessment.data().filter(function(res){ return res.company_name == company_name })[0];
    	// nav.to({url:'#!auditor&a0='+data.id_a0})
        Doctab.show({
            load:
            {
                url: site_url('auditor/list_assigned_auditor?type='+data.type_report+'&auditor=1&a0='+data.id_a0),
                data: data
            }
        })
    	
    })*/

	/*// #assigned-assessment-table tbody tr on dbl click
    $(document).delegate('#conducted-assessment-table tbody tr', 'click', function(event){
 
            
        var data = window.conductedassessment.row(this).data();
        delete data.company_password;

        Doctab.show({
            load: {
                url: site_url('auditor/list_conducted_auditor/'+data.id_company),
                data: data,
            },
            onShow: function()
            {
                Snackbar.show('Data telah dimuat')
            }

        })

    })*/

    /*$(document).delegate('#waiting-result-table tbody tr', 'click', function(event){
    	
        

    })*/



})

</script>
