<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
        
    <div class="mdl-tabs__tab-bar">
        <a href="#commodity-panel--commodity-list" class="mdl-tabs__tab is-active"> Commodity List </a>
    </div>

    <div class="mdl-tabs__panel is-active" id="commodity-panel--commodity-list">
        <table class="table table-hover " id="tableCommodityList">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Commodity name</th>
                    <th>Commodity type</th>
                    <th>subCommodity</th>
                </tr>
            </thead>
        </table>
    </div>

</div>

<script type="text/javascript">
    window.tableCommodity__complete = $('#tableCommodityList').DataTable({
        lengthChange: false,
        ajax:
        {
            url: site_url('commodity/get_commodity'),
            dataSrc: function(json)
            {
                json = (json.data)? json.data : json;
                var i = 1;

                $.each(json, function(a,b){
                    json[a]['no'] = i;
                    json[a]['subcommodity'] = '';
                    json[a]['type'] = '';
                    i++;
                })

                return json;
            }
        },
        columns: [
            {data: 'no'},
            {data: 'commodity_name'},
            {data: 'type'},
            {data: 'subcommodity'},
        ],
    })
</script>