<section class="navbar navbar-fluid" data-title="Upload File">
    <!-- Colored raised button -->
    <button onclick="$('input[type=\'file\']').trigger('click')" class="mdl-button mdl-js-button btn-warning">
        <i class="material-icons">add</i> Tambah file 
    </button>
    <input type="file" class="sr-only" name="files" multiple>

    <button class="pull-right mdl-button mdl-js-button btn-primary" onclick="uploadFile(event)">
        <i class="material-icons">file_upload</i> Upload 
    </button>
</section>

 <div class="container-file-uploaded" style="margin-top:30px;">
    <fieldset class="sr-only">
        <legend><center>Draft File</center></legend>
        <div class="file-draft-list-group flat list-group"></div>
    </fieldset>

    <fieldset>
        <legend><center>Uploaded File</center></legend>
        <div class="file-uploaded-list-group flat list-group"> <center> <h3 class="" style="color:rgba(0,0,0,.4);">Tidak ada file ditemukan</h3></center> </div>
    </fieldset>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        fetching_files();

        $('input[type="file"]').on('change', function(){
            var $this = $(this)
                ,$files = $this[0].files

            $.Upload($this, {
                not_accepted_files: 'rar'
            })
            .done(function(res){
                appendPreviewUploaded( res )
            })


        })

    })

    function fetching_files()
    {

        var $template = '<div class="list-group-item flat list-group-item-uploaded" upload-key="::file_id::"> <a href="'+site_url('files/download_file/::file_id::')+'" target="_blank" class="pull-right mdl-button mdl-js-button mdl-button--icon" > <i class="material-icons">get_app</i> </a> <i class="material-icons  icons-middle">attach_file</i> <span>::original_name::</span> <span class="label label-default">Uploaded</span>  </div>'
        $.post(site_url('assessment/get_files_a0_documents'), {id_a0: <?php echo $id_a0 ?>})
        .done(function(res){
            // console.log(res)
            res = JSON.parse(res);
            $('.file-uploaded-list-group.list-group').html('');
            Tools.write_data({
                records: res,
                template: $template,
                target: $('.file-uploaded-list-group.list-group'),                
            })
        })

    }

    function removeExistedFiles(event, ui)
    {
        event.preventDefault();
        Snackbar.manual({message: 'Sedang memperbarui dokumen.', spinner: true})
        var $this = $(ui)
            ,$parent = $this.closest('.list-group-item')
            ,$data = $this.closest('.list-group-item').data()
            ,documents = []

        $parent.remove();

        $('.list-group-item-uploaded').each(function(){
            var data = $(this).data();
            documents.push(data.file_id)
        })
        $.post(site_url('assessment/update_documents_a0'), {documents: documents.join(',') , id_a0: <?php echo $id_a0 ?>} )
        .done(function(res){
            Snackbar.show('Dokumen sudah diperbarui')
            console.log(res)
        })
        .fail(function(res){
            Snackbar.show('Dokumen gagal diperbarui')
            console.log(res)
        })
    }

    function removeUplodedFile(event, ui)
    {
        event.preventDefault();
        var $this = $(ui)
            ,$parent = $this.closest('.list-group-item')
            ,$data = $parent.data()


        $.Upload.delete($data.name, $data.key)
        .done(function(res){
            $parent.remove();
            if(Object.keys($.Upload.records).length < 1)
            {
                $('.file-draft-list-group').parents('fieldset').addClass('sr-only');
            }
        })
    }

    function appendPreviewUploaded(files)
    {
        var $template = '<div class="list-group-item flat list-group-item-preview" upload-key="::key::"> <button class="pull-right btn-danger preventDefault mdl-button mdl-js-button mdl-button--icon" onclick="removeUplodedFile(event, this)"> <i class="material-icons">remove</i> </button> <i class="material-icons icons-middle">attach_file</i> <span>::name::</span> <span class="sign-exist"></span>  </div>'
        var def = $.Deferred()
        // $('.file-uploaded-list-group.list-group').html('')
        $('.file-draft-list-group.list-group').parents('fieldset').removeClass('sr-only')
        Tools.write_data({
            records: files,
            template: $template,
            target: $('.file-draft-list-group.list-group'),
            afterAppend: function(a,b,c){

                if( $.Upload.count_files(c.name) > 1 )
                {
                    $(b).find('.sign-exist').addClass('label label-info').text('file sudah ditambahkan')
                }
            }
            
        })
        .done(function(res){
            $('input[type="file"]').val('');
            def.resolve(res)
        })

        return $.when(def.promise())
    }

    function uploadFile(event)
    {
        event.preventDefault();
        $.Upload.submit({
            url: site_url('company/assessmentDocumentUpload'),
            data: {id_a0: <?php echo $id_a0 ?>}
        })
        .done(function(ress){
            console.log(ress)
            $('.list-group-item-preview').remove()
            fetching_files()
        })
    }

</script>