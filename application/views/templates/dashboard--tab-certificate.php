
<div class="mdl-shadow--2dp col-md-12 ">
                
    <div class="mdl-tabs mdl-js-tabs">
        <div class="mdl-tabs__tab-bar">
            <a href="#allCertificate-panel" class="mdl-tabs__tab is-active "> <span class="mdl-badge mdl-all-certificate-badge" data-badge="-">All Certificates</span> </a>
            <a href="#allCertificate-panel" class="mdl-tabs__tab "> <span class="mdl-badge mdl-active-certificate-badge" data-badge="-">Active Certificates</span> </a>
            <!-- other tab href -->
        </div>

        <div class="mdl-tabs__panel is-active" id="allCertificate-panel">
            <div class="table-responsive col-md-12">
                <table class="table table-stripped  table-hover" id="allCertificate" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Company</th>
                            <th>Certificate Number</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="mdl-tabs__panel" id="activeCertificate-panel">
            <div class="table-responsive col-md-12">
                <table class="table table-stripped  table-hover" id="activeCertificate" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Company</th>
                            <th>Certificate Number</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- other tabpanel -->
        
    </div>

</div>

<script type="text/javascript">
    function get_data_certificate()
    {
        $.post(site_url('Certification/get_certificate_list'))
        .done(function(response){
            response = JSON.parse(response);

        })
    }

    function set_tableCertificate_complete()
    {
        window.tableCertificate_complete = $('#allCertificate').DataTable({
            ajax:
            {
                url: site_url('certification/get_certificate_list'),
                dataSrc: function(json)
                {
                    json = (json.data)? json.data : json;
                    var i = 1;

                    $.each(json, function(a,b){
                        json[a]['no'] = i;
                        json[a]['action'] = '<button class="btn btn-primary btn-sm" onclick="tableAction__detailCertificate(event)"> Action </button>';
                        i++;
                    });

                    $('.mdl-all-certificate-badge').attr('data-badge', json.length)
                    if( json.length < 1 ){ return false };
                    return json;
                }
            },
            columns: [
                {data: 'no'},
                {data: 'company_name'},
                {data: 'id_certificate'},
                {data: 'type'},
                {data: 'certificate_status'},
                {data: 'action'},
            ]
        })

    }

    function set_tableCertificate_active()
    {
        window.tableCertificate_complete = $('#activeCertificate').DataTable({
            ajax:
            {
                url: site_url('certification/get_certificate_list'),
                dataSrc: function(json)
                {
                    json = (json.data)? json.data : json;
                    json = json.filter(function(res){ return res.certificate_status == 'active' })
                    var i = 1;

                    $.each(json, function(a,b){
                        json[a]['no'] = i;
                        json[a]['action'] = '<button class="btn btn-primary btn-sm" onclick="tableAction__detailCertificate(event)"> Action </button>';
                        i++;
                    });

                    $('.mdl-active-certificate-badge').attr('data-badge', json.length)
                    $('.text-sum-certification-active').text(json.length)
                    if( json.length < 1 ){ return false };
                    return json;
                }
            },
            columns: [
                {data: 'no'},
                {data: 'company_name'},
                {data: 'id_certificate'},
                {data: 'type'},
                {data: 'action'},
            ]
        })

    }


    function tableAction__detailCertificate(event)
    {
        console.log(event)
        Bootstrap_helper.modal.set({
            options: {
                id:'#modal_activeCertificate', 
                title:'Detail Certificate', 
            }, 
            showIt:true,
        }) 
    }

    set_tableCertificate_active();
    set_tableCertificate_complete();


</script>
