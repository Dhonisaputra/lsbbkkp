<div class="checkbox" style="display:inline-block;padding-right:7px;"> 
    <label class=""><input type="checkbox" id="filter_YQ" onchange="filteringType(this)"> YQ-005 </label> 
</div>
<div class="checkbox" style="display:inline-block;padding-right:7px;">
    <label><input type="checkbox" id="filter_JECA" onchange="filteringType(this)"> JECA-004 </label>  
</div>
<div class="checkbox" style="display:inline-block;padding-right:7px;">
    <label><input type="checkbox" id="filter_JPA" onchange="filteringType(this)"> JPA-009 </label> 
</div>
<div class="" style="padding:20px;">

    <!-- Flat button -->
        <div class="row table-responsive">
            

            <table id="table-company" class="table table-bordered table-hovered table-stripped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>id_company</th>
                        <th>Perusahaan</th>
                        <th>Alamat</th>
                        <th>Kabupaten</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>

</div>    

<script type="text/javascript">
    function filteringType(ui)
    {
        Snackbar.manual({message: 'Sedang mengurutkan. Silahkan tunggu!', spinner: true});
        window.companyTable.ajax.reload(function(){
            Snackbar.show('Pengurutan perusahaan selesai')
        })
    }
    $(function(){
        window.companyTable = $('#table-company').DataTable({
            ajax: {
                url: site_url('company/process/get/all/company'),
                dataSrc: function(res){
                    var $YQChecked = $('#filter_YQ').is(':checked');
                    var $JECAChecked = $('#filter_JECA').is(':checked');
                    var $JPAChecked = $('#filter_JPA').is(':checked');
                    $.each(res, function(a,b){
                        res[a]['action'] = '<button class="btn btn-primary btn-sm" onclick="openCompany('+b.id_company+')"> buka </button>'
                    })
                    if($YQChecked)
                    {
                        var filter = [];
                        $.each(res, function(a,b){
                            if(b.requested.indexOf('YQ-005') > -1)
                            {
                                filter.push(b)
                            }
                        })
                        if(filter.length > 0)
                        {
                            res = filter;
                        }
                    }

                    if($JECAChecked)
                    {
                        var filter = [];
                        $.each(res, function(a,b){
                            if(b.requested.indexOf('JECA-004') > -1)
                            {
                                filter.push(b)
                            }
                        })
                        if(filter.length > 0)
                        {
                            res = filter;
                        }
                    }

                    if($JPAChecked)
                    {
                        var filter = [];
                        $.each(res, function(a,b){
                            if(b.requested.indexOf('JPA-009') > -1)
                            {
                                filter.push(b)
                            }
                        })
                        if(filter.length > 0)
                        {
                            res = filter;
                        }
                    }
                    return res;
                }
            },
            searching: true,
            columns: [
                {data: 'id_company'},
                {data: 'company_name'},
                {data: 'company_address'},
                {data: 'company_region'},
                {data: 'email'},
                {data: 'telephone'},
                {data: 'action'},
            ],
            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric',
                    
                },
                {
                    "targets": [ 0 ],
                    "visible": false
                }
            ]
        });
    })

</script>