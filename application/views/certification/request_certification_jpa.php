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

    #jpa-product-line--new>.product-line--container .product-line--container
    {
        padding-left: 15px;
    }
    .product-line--container .handler-toggle[aria-expanded="false"] .material-icons
    {
        content: 'add';
    }
    .product-line--container .handler-toggle[aria-expanded="true"] .material-icons
    {
        content: 'chevron_bottom';
    }

</style>

<div class="form-group">
    <div class="radio">
        <label><input type="radio" name="jpa-type" class="self-announcement" data-certification="JPA-009" value="0" onchange="jpa_onchange_type()" checked> Self Announcement</label>
        <span class="help-block text-warning">Jika anda sudah memiliki sertifikasi sendiri, silahkan pilih ini!</span>
    </div>
</div>

<div class="form-group">
    <div class="radio">
        <label><input type="radio" name="jpa-type" class="self-announcement" data-certification="JPA-009" value="1" onchange="jpa_onchange_type('LSBBKKP')"> LSBBKKP </label>
        <span class="help-block text-warning">Jika Anda ingin disertifikasi oleh LSBBKKP , silahkan pilih ini terlebih dahulu!</span>
    </div>
</div>
    
<div id="jpa-audit-baru--certification">

    

</div> <!-- end of jpa-audit-baru--certification -->

<div>

    <div class="form-group">
        <hr>
            
            <button class="btn btn-info mdl-button mdl-js-button " id="jpa-audit-baru--insert-new-product">
                <i class="material-icons">confirmation_number</i> Tambahkan produk
            </button>


        <hr>
    </div>

</div>



<?php echo $this->load->component('js', 'js/jspage/jspage.request_certification_jpa.js') ?>

<script type="text/javascript">
    function insertNewBrand(ui)
    {
        var $this = $(ui),
            $parents = $this.parents('.section--certification'),
            $tabpane_brand = $this.parents('.tab-pane--brand'),
            $list_brand = $tabpane_brand.find('#list-group-brand'),
            $key = $parents.attr('key'),
            jsdata = $.jsdata_accreditation_request.find($key)

        var brand = $key+$.jsdata_accreditation_request.key()
        var oBrand = {key: brand, brand_name:'', lampiran:''}
        var data = $.jsdata_accreditation_request.records()[jsdata.index];
        data.brand.push(oBrand);

        var target = $tabpane_brand.find('#list-group-brand');
        var brandItem = $('.clone-brand-item').clone().removeClass('clone-brand-item')

        brandItem = $(brandItem).attr({ _:brand, 'data-brand': brand, 'data-id':brand }).data({key: brand});
        brandItem = $(brandItem);
        $(brandItem).find('textarea.list-brand--form-component').attr({'name':'text'+brand, id:'text'+brand})
        // $(brandItem).find('input').focus();
        $(brandItem).prependTo(target)
        .each(function(){
            $(target).find('.list-group--brand-item').removeClass('open');
            $(this).addClass('open');  
            $(this).find('#text'+brand).ckeditor()
            $(this).find('input[type="text"]').focus();
        })

        if($list_brand.children().length > 0)
        {
            $tabpane_brand.find('.sign-brand').hide();
        }
    }

    function changeBrandName(ui)
    {
        var parent = ($(ui).hasClass('list-group--brand-item') == false)? $(ui).parents('.list-group--brand-item') : $(ui),
            data = $(parent).data(),
            $this = $(ui),
            $parents = $this.parents('.section--certification'),
            $tabpane_brand = $this.parents('.tab-pane--brand'),
            $list_brand = $tabpane_brand.find('#list-group-brand'),
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
        var index = records.brand.map(function(res){
            return res.key
        }).indexOf(data.key)
        records.brand[index].brand_name = value;

        $(parent).find('.brand--overview--item-text').text(value);
    }

    function checkInput(ui)
    {
        var parent = ($(ui).hasClass('list-group--brand-item') == false)? $(ui).parents('.list-group--brand-item') : $(ui),
            data = $(parent).data(),
            $this = $(ui),
            $parents = $this.parents('.section--certification'),
            value = $(ui).val(),
            $noSpacing = value.replace(/\s+/g, '')

        if($noSpacing.length > 0)
        {
            $this.parents('.form-group').removeClass('has-warning has-error').addClass('has-success').find('.form-control-feedback').removeClass('glyphicon-warning-sign glyphicon-remove').addClass('glyphicon-ok')
        }else
        {
            $this.parents('.form-group').removeClass('has-warning has-success').addClass('has-error').find('.form-control-feedback').removeClass('glyphicon-warning-sign glyphicon-ok').addClass('glyphicon-remove')
        }
    }

    function changeBrandlampiran(ui)
    {
        var parent = ($(ui).hasClass('list-group--brand-item') == false)? $(ui).parents('.list-group--brand-item') : $(ui),
            data = $(parent).data(),
            $this = $(ui),
            $parents = $this.parents('.section--certification'),
            $tabpane_brand = $this.parents('.tab-pane--brand'),
            $list_brand = $tabpane_brand.find('#list-group-brand'),
            $key = $parents.attr('key'),
            jsdata = $.jsdata_accreditation_request.find($key),
            records = $.jsdata_accreditation_request.records()[jsdata.index];
        

        var value = $('#text'+data.id).val();
        // $.fn.request_assessment.addProduct.brand.lampiran('JPA-009', data.key, value);
        var index = records.brand.map(function(res){
            return res.key
        }).indexOf(data.key)
        records.brand[index].lampiran = value;

        $(parent).find('.brand--overview--item-lampiran').text( $(value).text() );
        Snackbar.show('Lampiran tersimpan..')
    }

    function removeBrandItem(ui)
    {
        var $this = $(ui),
            $parents = $this.parents('.section--certification'),
            $tabpane_brand = $this.parents('.tab-pane--brand'),
            $list_brand = $tabpane_brand.find('#list-group-brand')
            $key = $parents.attr('key'),
            jsdata = $.jsdata_accreditation_request.find($key),
            parent = ($(ui).hasClass('list-group--brand-item') == false)? $(ui).parents('.list-group--brand-item') : $(ui),
            data = $(parent).data(),
            // cari brand dengan key data.key
            indexBrand = $.jsdata_accreditation_request.records()[jsdata.index].brand.map(function(res){
                return res.key
            }).indexOf(data.key)

        // ambil records lalu hapus brand dengan @index: indexBrand
        $.jsdata_accreditation_request.records()[jsdata.index].brand.splice(indexBrand, 1)
        
        $(parent).remove();

        var d0 = $('#list-group-brand').children().eq(0)
        if( $(d0).hasClass('open') == false )
        {
            $(d0).addClass('open');
        }

        if($('#list-group-brand').children().length < 1)
        {
            $('.sign-brand').show();
        }
    }

    function clearAllBrand(ui)
    {
        var $this = $(ui),
            $parents = $this.parents('.section--certification')
        var d0 = $parents.find('#list-group-brand').children();
        if(d0.length < 1)
        {
            swal('Tidak ada merek ditemukan', 'Tidak dapat mereset merek karena anda belum menambahkannya.', 'info');
            return false;
        }
        swal({   
            title: "Hapus semua brand",   
            text: "Aksi ini akan menghapus semua brand yang sudah ditambahkan. Apakah anda yakin ingin melanjutkan?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Ya, Lanjutkan",   
            closeOnConfirm: true 
        }, 
        function(){   
            $(d0)
            .each(function(){
                removeBrandItem( $(this) )
            })
        });
    }

    function clone_jpa(isSelfAssessment)
    {
         var a0 = $.jsdata_accreditation_request.request('JPA-009')
        $('.clone-jpa')
        .clone()
        .removeClass('clone-jpa clone')
        .attr({key: a0.key})
        .appendTo('#jpa-audit-baru--certification')
        .each(function(){

            // define id untuk tab akreditasi
            var $tab_akreditasi_id = $(this).find('.tab-pane--akreditasi').attr('id')
            $(this).find('.tab-pane--akreditasi').attr('id', $tab_akreditasi_id+'_'+a0.key)

            // define id untuk tab brand
            var $tab_brand_id = $(this).find('.tab-pane--brand').attr('id')
            $(this).find('.tab-pane--brand').attr('id', $tab_brand_id+'_'+a0.key)

            // change alamat tab ke brand
            $(this).find('.btn-tambah-brand').attr('href', '#'+$tab_brand_id+'_'+a0.key)

            // change alamat tab ke akreditasi
            $(this).find('.btn-tambah-akreditasi').attr('href', '#'+$tab_akreditasi_id+'_'+a0.key)

            product_line_MLM( $(this).find('#jpa-product-line--new') )


        })
    }

    $(document).delegate('.list-group--brand-item', 'click', function(){
        var $this = $(this),
            $tabpane = $this.parents('.tab-pane--brand')
            $list_group_brand = $tabpane.find('#list-group-brand')

        $list_group_brand.find('.list-group--brand-item').removeClass('open');
        $(this).addClass('open');
    })

    $(document).delegate('textarea.list-brand--form-component', 'input', function(){
        var id = $(this).attr('id')
        var d0 = $(id).val();
    })

    $('#jpa-audit-baru--insert-new-product').on('click', function(event){
        var LSBBKKP = $('.self-announcement[data-certification="JPA-009"]:checked').val()
        if(LSBBKKP == '1')
        {
           clone_jpa();
        }else {
            swal('Kesalahan saat menambahkan product', 'Silahkan pilih LSBBKKP terlebih dahulu sebelum memilih Product Line', 'error');
        }
    })

    $(document).on('click', '.jpa_product_line_picker', function(e){

        var data = $(this).data(),
            $parents = $(this).closest('.section--certification'),
            $key = $parents.attr('key')

        Snackbar.manual({message: 'Mengambil daftar jenis sertifikat', spinner: true});

        // reset jsdata accreditation request records
        jstools_accreditation_request($(this), 'JPA-009', 'certification', true, [], 'remove');

        // ganti data product line yang sebelumnya dengan yang baru.
        jstools_accreditation_request($(this), 'JPA-009', 'product_line', true);

        $.fn.product_line_SNI(data.product_line_id)
        .done(function(res){
            
            $parents.find('#jpa-certification').html('')

            // tulis sertifikasi baru
            Tools.write_data({
                target:  $parents.find('#jpa-certification'),
                template: '<div class=" parent-certificate-SNI checkbox-childrens"> <div class="checkbox"> <label> <input type="checkbox" class="SNI--choose-product_line-available" form="helper-form--request-certification"  value="::audit_reference::" > <span> <strong> (::name::) </strong> ::certificate_title:: </span> </label </div>  </div>',
                records: res.SNI 
            })
            .done(function(){
                Snackbar.show('daftar jenis sertifikat berhasil di tampilkan.');
            })


        })
    })

    $(document).on('click', '.SNI--choose-product_line-available', function(e){
        var $this = $(this),
        $parent = $this.closest('.section--certification'),
        $key = $parent.attr('key')
        
        var index = $.jsdata_accreditation_request.records().map(function(res){
            return res.key
        }).indexOf($key)
        var data = $.jsdata_accreditation_request.records()[index];

        // prevent to add same value in records
        if(data.certification.indexOf($this.val()) < 0)
        {
            jstools_accreditation_request($(this), 'JPA-009', 'certification');
        }
    })

    var idleTime = null;
    $(document).on('keyup', '.insert-notes-product-line', function(e){
        var $this = $(this),
            $container = $this.closest('.notes-container')

        $container.find('.form-group').addClass('has-warning').removeClass('has-success')
        $container.find('.form-control-feedback').addClass('glyphicon-warning-sign').removeClass('glyphicon-ok')

        if (idleTime) {
            clearTimeout(idleTime);
        }
        idleTime = setTimeout(function() {
            $container.find('.form-group').removeClass('has-warning').addClass('has-success')
            $container.find('.form-control-feedback').removeClass('glyphicon-warning-sign').addClass('glyphicon-ok')

            var value = $this.val();
            jstools_accreditation_request( $this , 'JPA-009', 'notes', true, value, 'insert');
            Snackbar.show('Product Spesification successfully saved!');
        }, 5000);

    })
    $(document).on('change', '.insert-notes-product-line', function(e){
        var $this = $(this),
            $container = $this.closest('.notes-container')

        $container.find('.form-group').removeClass('has-warning').addClass('has-success')
        $container.find('.form-control-feedback').removeClass('glyphicon-warning-sign').addClass('glyphicon-ok')

        var value = $this.val();
        jstools_accreditation_request( $this , 'JPA-009', 'notes', true, value, 'insert');
        Snackbar.show('Product Spesification successfully saved!');

        if (idleTime) {
            clearTimeout(idleTime);
        }

    })
   
   $(document).on('click', '.btn-remove-jpa', function(){
        var $this = $(this),
            $parents = $this.parents('.section--certification'),
            $tabpane_brand = $this.parents('.tab-pane--brand'),
            $list_brand = $tabpane_brand.find('#list-group-brand')
            $key = $parents.attr('key'),
            jsdata = $.jsdata_accreditation_request.find($key),
            records = $.jsdata_accreditation_request.records()[jsdata.index];


        swal({
            title: 'Hapus sertifikasi JPA-009',
            text: 'Aksi ini akan menghapus sertifikasi JPA-009 yang sudah anda tambahkan. apakah anda ingin melanjutkan?.',
            showCancelButton: true,
            closeOnCancel: true,
            // closeOnConfirm: false
        }, function(res){
            if(res)
            {
                $parents.remove()
                $.jsdata_accreditation_request.records().splice(jsdata.index, 1)
            }
            // swal('')
        })
   })

</script>