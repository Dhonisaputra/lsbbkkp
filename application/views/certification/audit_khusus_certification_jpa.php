<?php echo $this->load->component('js', 'plugins/ckeditor/ckeditor.js') ?>
<?php echo $this->load->component('js', 'plugins/ckeditor/adapters/jquery.js') ?>

<style type="text/css">
    .list-group--brand-item.open .brand--overview, .list-group--brand-item .brand--editor{display: none;}
    .list-group--brand-item .brand--overview, .list-group--brand-item.open .brand--editor{display: inherit;}
    
    .brand--overview--item-lampiran
    {
        display:inline-block;
        width:180px;
        white-space: nowrap;
        overflow:hidden !important;
        text-overflow: ellipsis;
    }

</style>

<section class="navbar ">
    <a href="#tab-summary-request"  role="tab" data-toggle="tab" class="mdl-button mdl-js-button" onclick="window.close()">
        <i class="material-icons">close</i> Batal 
    </a>
    <a href="#tab-summary-request"  role="tab" data-toggle="tab" class="btn btn-primary mdl-button mdl-js-button pull-right">
        Selanjutnya <i class="glyphicon glyphicon-chevron-right"></i>
    </a>
</section>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="jpa-audit-khusus--certification">
        <div class="form-group sr-only">
            <label>Spesifikasi Produk</label>
            <input type="hidden" class="form-control" name="product_line" id="audit_khusus_product_line">
            <div id="audit_khusus_spesifikasi_produk--active"></div>
            <input class="form-control" name="spesifikasi_khusus" id="audit_khusus_spesifikasi_produk">
            <div class="help-block">Pisahkan tiap spesifikasi produk dengan koma ','</div>
        </div>
        <div class="form-group" >
            
            <div class="">
                <button class="mdl-button mdl-js-button btn btn-info" onclick="insertNewBrand()">
                     Tambah merek <i class="material-icons">add</i>
                </button>
                <button class="mdl-button mdl-js-button mdl-button--icon" onclick="clearAllBrand()"  data-toggle="tooltip" data-placement="top" title="Clear All Brand">
                    <i class="material-icons">clear_all</i>
                </button>
            </div>
        </div>

        <div class="" id="list-group-brand" style="margin-top:20px; border-top:1px solid #eee;padding-top:20px;">

        </div>

    </div>
</div>




<script type="text/javascript">
    $.fn.request_assessment.data['JPA-009']['is_self_announcement'] = false;

     function insertNewBrand()
    {
        var target = $('#list-group-brand');
        var brand = $.fn.request_assessment.addProduct.brand.add('JPA-009');
        var brandItem = $('.clone-brand-item').clone().removeClass('clone-brand-item')

        brandItem = $(brandItem).attr({ _:brand.key, 'data-brand': brand.key, 'data-id':brand.id }).data(brand);
        brandItem = $(brandItem);
        $(brandItem).find('textarea.list-brand--form-component').attr({'name':'text'+brand.id, id:'text'+brand.id})

        $(brandItem).prependTo(target)
        .each(function(){
            $(target).find('.list-group--brand-item').removeClass('open');
            $(this).addClass('open');  
            $('#text'+brand.id).ckeditor()
        })
    }

    function changeBrandName(ui)
    {
        var parent = ($(ui).hasClass('list-group--brand-item') == false)? $(ui).parents('.list-group--brand-item') : $(ui),
            data = $(parent).data(),
            $this = $(ui),
            $parents = $this.parents('.section--certification'),
            $tabpane_brand = $this.parents('.tab-pane--brand'),
            $list_brand = $tabpane_brand.find('#list-group-brand')
            $key = $parents.attr('key'),
            jsdata = $.jsdata_accreditation_request.find($key),
            records = $.jsdata_accreditation_request.records()[jsdata.index],
            value = $(ui).val(),
            $noSpacing = value.replace(/\s+/g, '')

        if($noSpacing.length > 0)
        {
            $this.parents('.form-group').removeClass('has-warning has-error').addClass('has-success').find('.form-control-feedback').removeClass('glyphicon-warning-sign glyphicon-remove').addClass('glyphicon-ok')
        }else
        {
            $this.parents('.form-group').removeClass('has-warning has-success').addClass('has-error').find('.form-control-feedback').removeClass('glyphicon-warning-sign glyphicon-ok').addClass('glyphicon-remove')
        }

        $.fn.request_assessment.addProduct.brand.item('JPA-009', data.key,value);

        $(parent).find('.brand--overview--item-text').text(value);
    }

    function changeBrandlampiran(ui)
    {
        var parent = ($(ui).hasClass('list-group--brand-item') == false)? $(ui).parents('.list-group--brand-item') : $(ui),
            data = $(parent).data();
        

        var value = $('#text'+data.id).val();
        $.fn.request_assessment.addProduct.brand.lampiran('JPA-009', data.key, value);

        $(parent).find('.brand--overview--item-lampiran').text( $(value).text() );
        Snackbar.show('Spesifikasi produk berhasil disimpan')

       
    }

    function removeBrandItem(ui)
    {

        var parent = ($(ui).hasClass('list-group--brand-item') == false)? $(ui).parents('.list-group--brand-item') : $(ui),
            data = $(parent).data();

        $.fn.request_assessment.addProduct.brand.remove('JPA-009', data.key);
        $(parent).remove();

        var d0 = $('#list-group-brand').children().eq(0)
        if( $(d0).hasClass('open') == false )
        {
            $(d0).addClass('open');
        }
    }

    function clearAllBrand()
    {
        var d0 = $('#list-group-brand').children();
        swal({   
            title: "Reset merek",   
            text: "Aksi ini akan melakukan reset pada merek yang telah terdaftar. apakah anda yakin ingin melanjutkan aksi ini?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, reset!",   
            closeOnConfirm: true 
        }, 
        function(){   
            $(d0)
            .each(function(){
                removeBrandItem( $(this) )
            })
        });
    }

    $(document).delegate('.list-group--brand-item', 'click', function(){
        $('#list-group-brand').find('.list-group--brand-item').removeClass('open');
        $(this).addClass('open');
    })

    $(document).delegate('textarea.list-brand--form-component', 'input', function(){
        var id = $(this).attr('id')
        console.log(id)
        var d0 = $(id).val();
    })

    $(document).delegate('#audit_khusus_spesifikasi_produk', 'input', function(){
        
        var spesifikasi_produk = $(this).val(),
        $noSpacing = spesifikasi_produk.replace(/\s+/g, '')

        $.fn.request_assessment.data['JPA-009']['notes'] = (spesifikasi_produk.length < 1)? '' : spesifikasi_produk;

    })

    $.post(site_url('assessment/detail_certification/assessment/<?php echo $data["id_a0_cat"] ?>') )
    .done(function(res){
        res = JSON.parse(res);
        var pl = res.product_line.map(function(a){
            return parseInt(a.product_line);
        })
        pl = $.unique(pl).join(',');

        $.fn.request_assessment.data['JPA-009']['product_line'] = pl;

        if(res.spesifikasi_produk.length > 0)
        {
            $('#audit_khusus_spesifikasi_produk--active').parents('.form-group').removeClass('sr-only')
            
            $.each(res.spesifikasi_produk, function(a,b){

                $('#audit_khusus_spesifikasi_produk--active').append('<span class="label label-info" style="margin-right:3px;">'+b+'</label>');
            })
        }
    })
</script>