
<h2>Certification Requested </h2>
<div class="row" style="padding-top:20px;">

    <div class="col-md-12">
        
        <div class="data-gathering-summary--yq sr-only">
            <h3><a href="#YQ" class="text-muted">#</a><strong>YQ-005</strong></h3>
            <!-- detail yq -->
            <div class="detail-summary--yq">
                <div class="sr-only"><strong>Self Assessment : </strong> <span class="is-self-assessment"></span></div>
                <div><strong>Certification : </strong>
                    <ol class="detail-summary--yq--certification"></ol>
                </div>
                <div class="detail-summary--request">
                    <strong>Scope : </strong> 
                    <ol class="detail-summary--yq--scope"></ol>
                </div> <!-- scope -->

                <div>
                    <strong>Nace : </strong> 
                    <ol class="detail-summary--yq--nace"></ol>
                </div>

            </div>
            <!-- end detail yq -->
        </div>
        <div class="data-gathering-summary--jeca sr-only">
            <div class="divider"></div>

            <h3><a href="#JECA" class="text-muted">#</a><strong>JECA-004</strong></h3>
             <!-- detail jeca -->
            <div class="detail-summary--jeca">
                <div class="sr-only"><strong>Self Assessment : </strong> <span class="is-self-assessment"></span></div>
                <div>
                    <strong>Certification : </strong>
                    <ol class="detail-summary--jeca--certification"></ol>
                </div>
                <div class="detail-summary--request">
                    <strong>Scope : </strong> 
                    <ol class="detail-summary--jeca--scope"></ol>
                </div> <!-- scope -->

                <div>
                    <strong>Product Line : </strong> 
                    <ol class="detail-summary--jeca--product-line"></ol>
                </div>

            </div>
            <!-- end detail jeca -->
        </div>
        <div class="data-gathering-summary--jpa sr-only">
            <div class="divider"></div>
            
            <h3><a href="#JPA" class="text-muted">#</a><strong>JPA-009</strong></h3> 
             <!-- detail jpa -->
            <div class="detail-summary--jpa">
                <div class="sr-only"><strong>Self Assessment : </strong> <span class="is-self-assessment"></span></div>
                <div>
                    <strong>Certification : </strong>
                    <ol class="detail-summary--jpa--certification"></ol>
                </div>
                
                <div class="detail-summary--request">
                    <strong>Product Line : </strong> 
                    <ol class="detail-summary--jpa--product-line"></ol>
                </div>

                <!-- brand -->
                <div>
                    <strong> Brand : </strong> 
                    <ol class="detail-summary--jpa--brand"></ol>
                </div>

            </div>
            <!-- end detail jpa -->             
        </div>

    </div><!-- col-md-12 -->
</div> <!-- row -->

<script type="text/javascript">
    window.previousTab;


    $('a[href="#tab-summary-request"][data-toggle="tab"]').on('show.bs.tab', function (e) {
        
        gatheringSummary();
    });

    $('a[href="#tab-summary-request"][data-toggle="tab"]').on('shown.bs.tab', function (e) {
        window.previousTab = e.relatedTarget
    });

    function open_jpa_request()
    {
        
        $('.btn-tab-back').trigger('click')
        // $('a[href="#tab-request"]').tab('show');
        $('a[href="#tab-request--JPA"]').tab('show');
    }

    function gatheringSummary()
    {
        var data = $.fn.request_assessment.data;
        if( data['YQ-005']['is_self_announcement'] && data['JECA-004']['is_self_announcement'] && data['JPA-009']['is_self_announcement'] )
        {
             swal({   
                title: "Tidak ada sertifikasi yang dipilih",   
                text: "Anda tidak memilih permintaan apapun. Sistem tidak dapat melanjutkan proses. Silahkan pilih minimal 1 sertifikasi!",   
                type: "warning",   
                showCancelButton: false,   
                confirmButtonText: "Ok!",   
                closeOnConfirm: true,   
            }, 
            function(){   
                
                    $('.btn-tab-back').trigger('click')
                // $('a[href="#tab-request"]').tab('show')
            });
            return false;
        }

        gatheringYQ(data['YQ-005'])
        gatheringJECA(data['JECA-004'])
        gatheringJPA(data['JPA-009'])
    }

    function gatheringYQ(yq)
    {

        $('.detail-summary--yq--certification, .detail-summary--yq--nace, .detail-summary--yq--scope').html('')

        var dataScope = $.fn.commodity.dataRecords;
        var dataCertification = $.fn.certification.records()
        $('.detail-summary--yq .is-self-assessment').text( yq.is_self_announcement.toString().toUpperCase() )

        if(!yq.is_self_announcement)
        {
            
            
            /*
            |-------------------------------------------S C O P E-----------------------------------------
            */
            if(yq.scope.length < 1)
            {
                swal({   
                    title: "Ruang Lingkup kosong pada sertifikasi YQ-005",   
                    text: "Anda tidak memilih Ruang Lingkup pada YQ-005. Silahkan pilih minimal 1 Ruang Lingkup!",  
                    type: "warning",   
                    showCancelButton: false,   
                    confirmButtonText: "Ok!",   
                    closeOnConfirm: true,   
                }, 
                function(){   
                    
                    $('.btn-tab-back').trigger('click')
                    // $('a[href="#tab-request"]').tab('show')
                });
                return false;
            }

            $('.data-gathering-summary--yq').removeClass('sr-only')
            $.each(yq.scope, function(a,b){
                b = dataScope.filter(function(res){ return res.id_commodity == b })[0]
                $('.detail-summary--yq--scope').append('<li>'+b.commodity_name+'</li>')
            })

            /*
            |---------------------------------------------------------------------------------------------
            */

            /*
            |------------------------------------C E R T I F I C A T I O N------------------------------------
            */
            /*if(yq.certification.length < 1)
            {
                swal({   
                    title: "",   
                    text: "data sertifikasi pada YQ-005 masih belum dipilih. silahkan pilih sertifikasi",   
                    type: "warning",   
                    showCancelButton: false,   
                    confirmButtonText: "Ok!",   
                    closeOnConfirm: true,   
                }, 
                function(){   
                    
                    $('.btn-tab-back').trigger('click')
                    // $('a[href="#tab-request"]').tab('show')
                });
                return false;
            }*/
            dataCertification
            .done(function(res){
                $.each(yq.certification, function(a,b){
                    b = res.filter(function(r){ return r.audit_reference == b })[0]
                    $('.detail-summary--yq--certification').append('<li>'+b.name+'</li>')
                })
            })

            $.when( $.fn.nace.records() )
            .done(function(res){
                $.each(yq.nace, function(a,b){
                    b = res.filter(function(r){ return r.nace_item == b })[0]
                    $('.detail-summary--yq--nace').append('<li>'+b.nace_name+'</li>')
                })
            })
            /*
            |---------------------------------------------------------------------------------------------
            */
        }
    }

    /*gathering JECA*/
    function gatheringJECA(jeca)
    {
        $('.detail-summary--jeca--certification, .detail-summary--jeca--nace, .detail-summary--jeca--product-line, .detail-summary--jeca--scope').html('')

        var dataScope = $.fn.commodity.dataRecords;
        var dataCertification = $.fn.certification.records()
        $('.detail-summary--jeca .is-self-assessment').text( jeca.is_self_announcement.toString().toUpperCase() )
        if(!jeca.is_self_announcement)
        {
             // check jeca scope
            /*
            |------------------------------------S C O P E------------------------------------
            */
            if(jeca.scope.length < 1)
            {
                swal({   
                     title: "Ruang Lingkup kosong pada sertifikasi JECA-004",   
                    text: "Anda tidak memilih Ruang Lingkup pada JECA-004. Silahkan pilih minimal 1 Ruang Lingkup!", 
                    type: "warning",   
                    showCancelButton: false,   
                    closeOnConfirm: true,   
                }, 
                function(){   
                    
                    $('.btn-tab-back').trigger('click')
                    // $('a[href="#tab-request"]').tab('show')
                });
                return false;
            }
            $('.data-gathering-summary--jeca').removeClass('sr-only')
            $.each(jeca.scope, function(a,b){
                b = dataScope.filter(function(res){ return res.id_commodity == b })[0]
                $('.detail-summary--jeca--scope').append('<li>'+b.commodity_name+'</li>')
            })
            /*
            |-----------------------------------------------------------------------------------
            */
            
            /*
            |----------------------------C E R T I F I C A T I O N------------------------------ // NOT NEEDED IN AUDIT KHUSUS
            */
            /*if(yq.certification.length < 1)
            {
                swal({   
                    title: "",   
                    text: "data sertifikasi pada YQ-005 masih belum dipilih. silahkan pilih sertifikasi",   
                    type: "warning",   
                    showCancelButton: false,   
                    confirmButtonText: "Ok!",   
                    closeOnConfirm: true,   
                }, 
                function(){   
                    $('a[href="#tab-request"]').tab('show')
                });
                return false;
            }*/
            dataCertification
            .done(function(res){
                $.each(jeca.certification, function(a,b){
                    b = res.filter(function(r){ return r.audit_reference == b })[0]
                    $('.detail-summary--jeca--certification').append('<li>'+b.name+'</li>')
                })
            })
            /*
            |-----------------------------------------------------------------------------------
            */

            /*
            |-------------------------P R O D U C T - L I N E-----------------------------------
            */
            // check jeca product line
            /*if( jeca.product_line.length < 1 )
            {
                swal({   
                    title: "",   
                    text: "mohon memilih product line pada JECA-004. ",   
                    type: "warning",   
                    showCancelButton: false,   
                    confirmButtonText: "Ok!",   
                    closeOnConfirm: true,   
                }, 
                function(){   
                    
                    $('.btn-tab-back').trigger('click')
                    // $('a[href="#tab-request"]').tab('show')
                });
                return false;
            }*/
            $.post(site_url('certification/get_product_line_overall') )
            .done(function(res){
                res = JSON.parse(res)
                $.each(jeca.product_line, function(a,b){
                    b = res.filter(function(r){ return r.product_line_id == b })[0]
                    $('.detail-summary--jeca--product-line').append('<li>'+b.product_line_name+'</li>')
                })
            })
            /*
            |----------------------------------------------------------------------------------
            */
            
        }
    }

    function gatheringJPA(jpa)
    {
        $('.detail-summary--jpa--certification, .detail-summary--jpa--nace, .detail-summary--jpa--product-line, .detail-summary--jpa--scope, .detail-summary--jpa--brand').html('')

        var dataScope = $.fn.commodity.dataRecords;
        var dataCertification = $.fn.certification.records()
        $('.detail-summary--jpa .is-self-assessment').text( jpa.is_self_announcement.toString().toUpperCase() )

        if(!jpa.is_self_announcement)
        {
            /*
            |-------------------------P R O D U C T - L I N E-----------------------------------
            */

            $('.data-gathering-summary--jpa').removeClass('sr-only')

            if(jpa.product_line)
            {
                $.post(site_url('certification/get_product_line_overall') )
                .done(function(res){
                    res = JSON.parse(res)
                    var b = res.filter(function(r){ return r.product_line_id == jpa.product_line })[0]
                    $('.detail-summary--jpa--product-line').append('<li>'+b.product_line_name+'</li>')
                })
            }
            /*
            |----------------------------------------------------------------------------------
            */

             /*
            |----------------------------C E R T I F I C A T I O N------------------------------ // NOT NEEDED IN AUDIT KHUSUS
            */

            if(jpa.certification.length > 0)
            {
                dataCertification
                .done(function(res){
                    $.each(jpa.certification, function(a,b){
                        b = res.filter(function(r){ return r.audit_reference == b })[0]
                        $('.detail-summary--jpa--certification').append('<li>'+b.name+'</li>')
                    })
                })
            }
            /*
            |----------------------------------------------------------------------------------
            */

            /*
            |-----------------------------------B R A N D--------------------------------------
            */
            if( Object.keys(jpa.brand).length < 1 )
            {
                swal({   
                    title: "Tidak ada merek yang ditemukan",   
                    text: "Silahkan tambahkan minimal 1 merek pada masing-masing Product!",   
                    type: "warning",   
                    confirmButtonColor: "#DD6B55",   
                    closeOnConfirm: true,   
                    allowEscapeKey: false,
                }, 
                function(isConfirm){   
                    if (isConfirm) {     
                        
                        
                    $('.btn-tab-back').trigger('click')
                        // $('a[href="#tab-request"]').tab('show')
                    } 
                });
                return false;
            }

            $.each(jpa.brand, function(a,b){
                if( b.item.length  < 1 )
                {
                    swal({   
                        title: "Terdapat beberapa merek tidak diisi",   
                        text: "Sistem menemukan beberapa kolom merek belum diisi. Silahkan lengkapi terlebih dahulu!",   
                        type: "warning",   
                        showCancelButton: false,   
                        closeOnConfirm: true,   
                    }, 
                    function(){   
                        
                $('.btn-tab-back').trigger('click')
                        // $('a[href="#tab-request"]').tab('show')
                    });
                    return false;
                }
                var brand = b.item.join(',');
                var t = '<li> <p><strong> Brand Name :</strong> <span>'+brand+'</span></p> <p> <strong> Lampiran :</strong> <br>'+b.lampiran+'</p> </li>';
                $('.detail-summary--jpa--brand').append(t);
            })
            /*
            |----------------------------------------------------------------------------------
            */
        }
    }
</script>