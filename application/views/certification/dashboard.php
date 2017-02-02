<!-- 
    yang perlu ditampilkan
    
 -->
<style type="text/css">
    .list-group-item
    {
        display: flex;
        align-content: center;
        justify-content: space-between;
    }
    .list-group-item .btn-action-group i
    {
        color: #9E9B9B;
    }
</style>

<div>

  <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"></li>
    <li role="presentation"><a href="#certification-dashboard--edit" aria-controls="profile" role="tab" data-toggle="tab"></a></li>
</ul>

  <!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="certification-dashboard--home">

        <div class="" style="padding:20px;">
            
            <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                <!-- Flat button -->

                <div class="col-md-7">

                  <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#panel--yq-005" aria-controls="home" role="tab" data-toggle="tab">YQ-005</a></li>
                        <li role="presentation"><a href="#panel--jeca-004" aria-controls="profile" role="tab" data-toggle="tab">JECA-004</a></li>
                        <li role="presentation"><a href="#panel--jpa-009" aria-controls="messages" role="tab" data-toggle="tab">JPA-009</a></li>
                    </ul>

                  <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="panel--yq-005">
                            <div class="list-group" id="list-group--yq-005"></div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="panel--jeca-004">
                            <div class="list-group" id="list-group--jeca-004"></div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="panel--jpa-009">
                            <div class="list-group" id="list-group--jpa-009"></div>
                        </div>

                    </div>

                </div> <!-- end  -->

            </div>
        </div>    

    </div>
    <div role="tabpanel" class="tab-pane" id="certification-dashboard--edit">
        <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <a href="#certification-dashboard--home" class="mdl-button mdl-js-button mdl-button--icon" aria-controls="home" role="tab" data-toggle="tab"> <i class="material-icons">keyboard_backspace</i> </a>
        </div>

        <div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">

            <form type="post" action="<?php echo site_url('certification/process/update/certification_category') ?>" onsubmit="submitUpdateCertificationCategory(event)">
                <input class="form-control" type="hidden" name="audit_reference">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control input--edit-certification-category" name="name">
                </div>

                <div class="form-group">
                    <label>use_period</label>
                    <input class="form-control input--edit-certification-category" type="number" min="0" name="use_period">
                </div>

                <div class="form-group">
                    <label>resurvey_attempt</label>
                    <input class="form-control input--edit-certification-category" type="number" min="0" name="resurvey_attempt">
                </div>

                <div class="form-group">
                    <label>grace_period</label>
                    <input class="form-control input--edit-certification-category" type="number" min="0" name="">
                </div>

                <div class="form-group">
                    <label>expired_period</label>
                    <input class="form-control input--edit-certification-category" type="number" min="0" name="expired_period">
                </div>

                <div class="form-group">
                    <label>Type</label>
                    <input class="form-control input--edit-certification-category" type="text"  name="type">
                </div>

                <!-- Colored raised button -->
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">
                    Update
                </button>


            </form>

        </div>

    </div>

</div>

</div>
<script type="text/javascript">
    var dataCertification = JSON.parse( '<?php echo json_encode( $certification ) ?>' );
    function submitUpdateCertificationCategory(event)
    {
        event.preventDefault();
        var action = $(event.target).attr('action');
        var data = $(event.target).serializeArray();
        

    }

    function write_data__yq(data)
    {
        data = data.filter(function(res){ return res.type == 'YQ-005' })
        Tools.write_data({
            records: data,
            template: '<div class="list-group-item"> ::name:: <div class="btn-action-group"> <a class="mdl-button mdl-js-button mdl-button--icon" href="#certification-dashboard--edit" aria-controls="home" role="tab" data-toggle="tab"  data-role="pushstate" ref-attribute="?_=::audit_reference::#fn=true&fn_name=fetchData&_h=::audit_reference::"> <i class="material-icons">create</i> </a> </div> </div>',
            target: '#list-group--yq-005'
        })
    }   

    function write_data__jeca(data)
    {
        data = data.filter(function(res){ return res.type == "JECA-004" })
        Tools.write_data({
            records: data,
            template: '<div class="list-group-item"> ::name:: <div class="btn-action-group"> <a class="mdl-button mdl-js-button mdl-button--icon" href="#certification-dashboard--edit" aria-controls="home" role="tab" data-toggle="tab"  data-role="pushstate" ref-attribute="?_=::audit_reference::#fn=true&fn_name=fetchData&_h=::audit_reference::"> <i class="material-icons">create</i> </a> </div> </div>',
            target: '#list-group--jeca-004'
        })
    }

    function write_data__jpa(data)
    {
        data = data.filter(function(res){ return res.type == 'JPA-009' })
        Tools.write_data({
            records: data,
            template: '<div class="list-group-item"> ::name:: <div class="btn-action-group"> <a class="mdl-button mdl-js-button mdl-button--icon" href="#certification-dashboard--edit" aria-controls="home" role="tab" data-toggle="tab"  data-role="pushstate" ref-attribute="?_=::audit_reference::#fn=true&fn_name=fetchData&_h=::audit_reference::"> <i class="material-icons">create</i> </a> </div> </div>',
            target: '#list-group--jpa-009'
        })
    }

    function fetchData()
    {  

        var _h = URL.get().hash._h;
        var data = dataCertification.filter(function(res){ return res.audit_reference == _h })[0];
        $.each(data, function(a,b){
            $('.input--edit-certification-category[name="'+a+'"]').val(b);
        })

    }

    $(function(){
        write_data__yq(dataCertification);
        write_data__jeca(dataCertification);
        write_data__jpa(dataCertification);
    })
</script>