
<h2>Certification Requested </h2>
<div class="row" style="padding-top:20px;">

    <div class="col-md-12">
        
        <div class="data-gathering-summary--yq sr-only">
            <h3><a href="#YQ" class="text-muted">#</a><strong>YQ-005</strong></h3>
            <!-- detail yq -->
            <div class="detail-summary--yq">
                <div class="sr-only"><strong>Self Assessment : </strong> <span class="is-self-assessment"></span></div>
                <div><strong>Jenis sertifikat : </strong>
                    <ol class="detail-summary--yq--certification"></ol>
                </div>
                <div class="detail-summary--request">
                    <strong>Ruang Lingkup : </strong> 
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
                    <strong>Jenis sertifikat : </strong>
                    <ol class="detail-summary--jeca--certification"></ol>
                </div>
                <div class="detail-summary--request">
                    <strong>Ruang Lingkup : </strong> 
                    <ol class="detail-summary--jeca--scope"></ol>
                </div> <!-- scope -->

                <div>
                    <strong>Lini Produk : </strong> 
                    <ol class="detail-summary--jeca--product-line"></ol>
                </div>

            </div>
            <!-- end detail jeca -->
        </div>
        <div class="data-gathering-summary--jpa clone sr-only">
            <div class="divider"></div>
            
            <h3><a href="#JPA" class="text-muted">#</a><strong>JPA-009</strong></h3> 
             <!-- detail jpa -->
            <div class="detail-summary--jpa">
                <div class="sr-only"><strong>Self Assessment : </strong> <span class="is-self-assessment"></span></div>
                <div>
                    <strong>Jenis sertifikat : </strong>
                    <ol class="detail-summary--jpa--certification"></ol>
                </div>
                
                <div class="detail-summary--request">
                    <strong>Lini Produk : </strong> 
                    <ol class="detail-summary--jpa--product-line"></ol>
                </div>

                <!-- brand -->
                <div>
                    <strong> Merek : </strong> 
                    <ol class="detail-summary--jpa--brand"></ol>
                </div>

            </div>
            <!-- end detail jpa -->             
        </div>

    </div><!-- col-md-12 -->
</div> <!-- row -->

<div class="" id="new-audit--preview-summary"></div>

<script type="text/javascript">
    var previousTab,
        deferProductLine=$.Deferred();
    $.post(site_url('certification/get_product_line_overall') )
    .done(function(res){
        res = JSON.parse(res)
        deferProductLine.resolve(res);
    })
    $('a[href="#tab-summary-request"][data-toggle="tab"]').on('show.bs.tab', function (e) {
        gatheringSummary();
    });
    $('a[href="#tab-summary-request"][data-toggle="tab"]').on('shown.bs.tab', function (e) {
        previousTab = e.relatedTarget
        console.log(e, e.relatedTarget)
    });

    function open_jpa_request()
    {
        $('a[href="#tab-request"]').tab('show');
        $('a[href="#tab-request--JPA"]').tab('show');
    }

    function gatheringSummary()
    {
        // var data = $.fn.request_assessment.data;
        var data = $.jsdata_accreditation_request.records().filter(function(res){
            return res.is_self_announcement === false
        })
        if( data.length <= 0 )
        {
             swal({   
                 title: "Tidak ada sertifikasi yang dipilih",   
                text: "Anda tidak memilih satu pun sertifikasi oleh LSBBKKP. silahkan pilih minimal satu sertifikasi untuk melakukan sertifikasi oleh LSBKKP!", 
                type: "warning",   
                showCancelButton: false,   
                confirmButtonText: "Ok!",   
                closeOnConfirm: true,   
                allowEscapeKey: false,
            }, 
            function(){   
                // open tab request
                $('a[href="#tab-request"]').tab('show') 
                // open tab request bagian YQ-005
                $('a[href="#tab-request--YQ"]').tab('show')
            });
            return false;
        }

        var a0 = []
        $('#new-audit--preview-summary').find('.data-gathering-summary--jpa').remove()
        $.each($.jsdata_accreditation_request.records(), function(a,b){
            var defer = $.Deferred();

            var a1 = gatheringData(b);
            defer.resolve(a1);                
            a0.push(defer);
        })
        $.when.apply(undefined, a0)
        .done(function(){
            // swal('success', 'gathering data summary request selesai', 'success');
        })
    }

    function gatheringData(request)
    {
        switch(request.type)
        {
            case 'YQ-005':
                gatheringYQ(request)
                break;
            case 'JECA-004':
                gatheringJECA(request)
                break;
            case 'JPA-009':
                gatheringJPA(request)
                break;
        }
    }
    /*
    |
    |
    |
    */
    function gatheringYQ(yq)
    {
        $('.detail-summary--yq--certification, .detail-summary--yq--nace, .detail-summary--yq--scope').html('')

        var dataScope = $.fn.commodity.dataRecords;
        var dataCertification = $.fn.certification.records()
        $('.detail-summary--yq .is-self-assessment').text( yq.is_self_announcement.toString().toUpperCase() )

        if(!yq.is_self_announcement)
        {
            // Jika tidak memilih scope-------------------------------------------------------------------
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
                    $('a[href="#tab-request"]').tab('show')
                    $('a[href="#tab-request--YQ"]').tab('show')
                    $('a[href="#yq-scope-certification"]').tab('show')

                });
                return false;
            }
            $('.data-gathering-summary--yq').removeClass('sr-only')
            $.each(yq.scope, function(a,b){
                b = dataScope.filter(function(res){ return res.id_commodity == b })[0]
                $('.detail-summary--yq--scope').append('<li>'+b.commodity_name+'</li>')
            })

            // jika tidak memilih jenis audit_reference-------------------------------------------------------------------
            if(yq.certification.length < 1)
            {
                swal({   
                    title: "Jenis sertifikasi pada YQ-005 masih kosong",   
                    text: "Jenis sertifikat pada YQ-005 masih belum dipilih. Silahkan pilih minimal 1 jenis sertifikat!",   
                    type: "warning",   
                    showCancelButton: false,   
                    closeOnConfirm: true,   
                }, 
                function(){   
                    $('a[href="#tab-request"]').tab('show')
                    $('a[href="#tab-request--YQ"]').tab('show')
                    $('a[href="#yq-scope-certification"]').tab('show')
                });
                return false;
            }
            dataCertification
            .done(function(res){
                $.each(yq.certification, function(a,b){
                    b = res.filter(function(r){ return r.audit_reference == b })[0]
                    $('.detail-summary--yq--certification').append('<li>'+b.name+'</li>')
                })
            })

            // jika tidak memilih Nace-------------------------------------------------------------------
            $.when( $.fn.nace.records() )
            .done(function(res){
                $.each(yq.nace, function(a,b){
                    b = res.filter(function(r){ return r.nace_item == b })[0]
                    $('.detail-summary--yq--nace').append('<li>'+b.nace_name+'</li>')
                })
            })
        }else
        {
            $('.data-gathering-summary--yq').addClass('sr-only')
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
            if(jeca.scope.length < 1)
            {
                swal({   
                    title: "Ruang Lingkup kosong pada sertifikasi JECA-004",   
                    text: "Anda tidak memilih Ruang Lingkup pada JECA-004. Silahkan pilih minimal 1 Ruang Lingkup!",  
                    type: "warning",   
                    showCancelButton: false,   
                    confirmButtonText: "Ok!",   
                    closeOnConfirm: true,   
                }, 
                function(){   
                    $('a[href="#tab-request"]').tab('show')
                    $('a[href="#tab-request--JECA"]').tab('show')
                    $('a[href="#jeca-scope-certification"]').tab('show')
                });
                return false;
            }
            $('.data-gathering-summary--jeca').removeClass('sr-only')
            $.each(jeca.scope, function(a,b){
                b = dataScope.filter(function(res){ return res.id_commodity == b })[0]
                $('.detail-summary--jeca--scope').append('<li>'+b.commodity_name+'</li>')
            })


            // check jeca product line
            if( jeca.product_line.length < 1 )
            {
                swal({   
                    title: "Product Line belum diisi pada sertifikasi JECA-004",   
                    text: "Anda tidak mengisi Product Line pada JECA-004. Mohon untuk melengkapi permintaan untuk melanjutkan!",  
                    type: "warning",   
                    showCancelButton: false,   
                    confirmButtonText: "Ok!",   
                    closeOnConfirm: true,   
                }, 
                function(){   
                    $('a[href="#tab-request"]').tab('show')
                    $('a[href="#tab-request--JECA"]').tab('show')
                    $('a[href="#jeca-iso-certification"]').tab('show')
                });
                return false;
            }
            $.post(site_url('certification/get_product_line_overall') )
            .done(function(res){
                res = JSON.parse(res)
                $.each(jeca.product_line, function(a,b){
                    b = res.filter(function(r){ return r.product_line_id == b })[0]
                    $('.detail-summary--jeca--product-line').append('<li>'+b.product_line_name+'</li>')
                })
            })

            // check data jeca certification
            if( jeca.certification.length < 1 )
            {
                swal({   
                    title: "Jenis sertifikasi pada JECA-004 masih kosong",   
                    text: "Jenis sertifikat pada JECA-004 masih belum dipilih. Silahkan pilih minimal 1 jenis sertifikat!",    
                    type: "warning",   
                    showCancelButton: false,   
                    closeOnConfirm: true,   
                }, 
                function(){   
                    $('a[href="#tab-request"]').tab('show')
                    $('a[href="#tab-request--JECA"]').tab('show')
                    $('a[href="#jeca-scope-certification"]').tab('show')
                });
                return false;
            }
            dataCertification
            .done(function(res){
                $.each(jeca.certification, function(a,b){
                    b = res.filter(function(r){ return r.audit_reference == b })[0]
                    $('.detail-summary--jeca--certification').append('<li>'+b.name+'</li>')
                })
            })

            
        }else{
            $('.data-gathering-summary--jeca').addClass('sr-only')
        }
    }

    function gatheringJPA(jpa)
    {
        $('.detail-summary--jpa--certification, .detail-summary--jpa--nace, .detail-summary--jpa--product-line, .detail-summary--jpa--scope, .detail-summary--jpa--brand').html('')

        var dataScope = $.fn.commodity.dataRecords;
        var dataCertification = $.fn.certification.records()
        var deferJPAProductLine = $.Deferred();
        var deferCertification = $.Deferred();
        var deferBrand = $.Deferred();

        $('.detail-summary--jpa .is-self-assessment').text( jpa.is_self_announcement.toString().toUpperCase() )

        if(!jpa.is_self_announcement)
        {

            if( jpa.product_line === "" )
            {
                swal({   
                    title: "Product Line belum diisi pada sertifikasi JPA-009",   
                    text: "Anda tidak mengisi Product Line pada JPA-009. Mohon untuk melengkapi permintaan untuk melanjutkan!",  

                    type: "warning",   
                    showCancelButton: false,   
                    confirmButtonText: "Ok!",   
                    closeOnConfirm: true,   
                }, 
                function(){   
                    $('a[href="#tab-request"]').tab('show')
                    $('a[href="#tab-request--JPA"]').tab('show')
                });
                return false;
            }

            var $cloned = $('.data-gathering-summary--jpa.clone').clone().removeClass('sr-only clone')

            // $('.data-gathering-summary--jpa').removeClass('sr-only')
            deferProductLine.done(function(res){
                var a0 = jpa.product_line.split('.'),
                    a1 = a0.shift(),
                    a2 = a0.join(','),
                    a3 = (a0.length > 0)? a2 : ''/*,
                    notes=(a3 !== '')? '('+a2+')':'';*/
                    // a1 = (a1.length > 0)? a1.join(',') : '';

                var b = res.filter(function(r){ return r.product_line_id == parseInt(a1) })[0]
                $cloned.find('.detail-summary--jpa--product-line').append('<li>'+b.product_line_name+' '+jpa.notes+'</li>')
                deferJPAProductLine.resolve();
            })

            if(jpa.certification.length < 1)
            {
                swal({   
                    title: "Jenis sertifikasi pada JPA-009 masih kosong",   
                    text: "Jenis sertifikat pada JPA-009 masih belum dipilih. Silahkan pilih minimal 1 jenis sertifikat!",
                    type: "warning",   
                    showCancelButton: false,   
                    confirmButtonText: "Ok!",   
                    closeOnConfirm: true,   
                }, 
                function(){   
                    $('a[href="#tab-request"]').tab('show')
                });
                return false;
            }
            dataCertification
            .done(function(res){
                $.each(jpa.certification, function(a,b){
                    b = res.filter(function(r){ return r.audit_reference == b })[0]
                    $cloned.find('.detail-summary--jpa--certification').append('<li>'+b.name+'</li>')
                    deferCertification.resolve();

                })
            })

            if( Object.keys(jpa.brand).length < 1 )
            {
                swal({   
                    title: "Tambahkan merek",   
                    text: "Sistem menemukan terdapat product yang tidak memiliki merek. Silahkan tambahkan minimal 1 nama merek!",   
                    type: "warning",   
                    confirmButtonColor: "#DD6B55",   
                    closeOnConfirm: true,   
                }, 
                function(isConfirm){   
                    if (isConfirm) {     
                        
                        $('a[href="#tab-request"]').tab('show')
                    } 
                });
                return false;
            }
            $.each(jpa.brand, function(a,b){
                var brand_name_arr = b.brand_name.split(',')
                if( brand_name_arr.length  < 1 )
                {
                    swal({   
                        title: "Merek tidak boleh kosong!",   
                        text: "Sistem menemukan terdapat kolom nama merek yang belum diisi. Silahkan lengkapi terlebih dahulu sebelum melanjutkan!",   
                        type: "warning",   
                        closeOnConfirm: true,   
                    }, 
                    function(){   
                        $('a[href="#tab-request"]').tab('show')
                    });
                    return false;
                }
                var brand = b.brand_name;
                var t = '<li> <p><strong> Nama Merek :</strong> <span>'+brand+'</span></p> <p> <strong> Importir :</strong> <br>'+b.lampiran+'</p> </li>';
                $cloned.find('.detail-summary--jpa--brand').append(t);
                deferBrand.resolve();

            })
            
            $.when(deferJPAProductLine, deferCertification, deferBrand)
            .then(function(a,b,c){
                // console.log(a,b,c)
                $($cloned).appendTo('#new-audit--preview-summary');
            })
        }
    }
</script>