<?php echo $this->load->component('js', 'jsdata/jsdata.upload.js') ?>
<?php echo $this->load->component('css', 'css/bootstrap.tab-round.css') ?>
<div>

  <!-- Nav tabs -->
    <ul class="nav nav-tabs sr-only" role="tablist">
        <li role="presentation" class="<?php echo ($a0['pass_the_review'] == 0)?'active' : ''; ?>"><a href="#unpass_the_review" aria-controls="unpass_the_review" role="tab" data-toggle="tab">Tampilan awal</a></li>
        <li role="presentation" class="<?php echo ($a0['pass_the_review'] == 1)?'active' : ''; ?>"><a href="#pass_the_review" aria-controls="pass_the_review" role="tab" data-toggle="tab">when pass the review</a></li>
    </ul>

  <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane <?php echo ($a0['pass_the_review'] == 0)?'active' : ''; ?>" id="unpass_the_review" >
            <div style="display: flex; justify-content: center; align-items: center;">
                
                <div class="alert alert-danger"> Permintaan ini sedang dalam proses review oleh Lembaga Sertifikasi dan Balai kulit dan karet. Kami akan mengirimkan anda email jika proses review telah selesai. </div>
            </div>

        </div>
        <div role="tabpanel" class="tab-pane <?php echo ($a0['pass_the_review'] == 1)?'active' : ''; ?>" id="pass_the_review">
            <div class="" style="display:flex; justify-content: center; align-items: center;flex-direction: column;">
                <?php if($a0['token'] == ''){ ?>
                    <div class="alert alert-danger"> Anda telah mengkonfirmasi tanggal assessment. anda tidak dapat melakukan konfirmasi tanggal kembali! </div>
                <?php 
                    }else
                    {
                ?>
                    <div class="alert alert-info"> Silahkan klik tombol "Konfirmasi tanggal" dibawah ini untuk melakukan konfirmasi tanggal pelaksanaan assessment. </div>
                <?php 
                    }
                    $url = site_url('company/process_confirm_from_company_dashboard/'.$this->uri->segment(5).'/'.$this->uri->segment(6))
                ?>
                <div class="col-md-3">
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <td>Tanggal Pelaksanaan Assessment</td>
                            <td><?php echo $a0['assessment_date'] ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?php echo ($a0['token'] == '')? 'Terkonfirmasi' : 'Belum dikonfirmasi'; ?></td>
                        </tr>
                    </table>
                </div>
                

                <div>
                    <!-- Colored raised button -->
                    <a <?php echo $a0['token'] !== ''? 'href="'.$url.'"' : ''; ?> target="_blank" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored <?php echo $a0['token'] == ''? 'btn disabled' : ''; ?>" >
                        Konfirmasi tanggal 
                    </a>
                </div>

            </div>
        </div>
    </div>

</div>



<script type="text/javascript">
    
    $(document).ready(function () {
        // fetching files
        fetching_files()

        //Wizard
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

            var $target = $(e.target);
        
            if ($target.parent().hasClass('disabled')) {
                return false;
            }
        });

        $(".next-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);

        });
        $(".prev-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            prevTab($active);

        });

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
    });

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

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }
    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }

    function fetching_files()
    {

        var $template = '<div class="list-group-item flat list-group-item-uploaded" upload-key="::file_id::"> <button class="pull-right btn-danger preventDefault mdl-button mdl-js-button mdl-button--icon" onclick="removeExistedFiles(event, this)"> <i class="material-icons">remove</i> </button> <i class="material-icons  icons-middle">attach_file</i> <span>::original_name::</span> <span class="label label-default">Uploaded</span>  </div>'
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

    function load_confirmation_page()
    {
        
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

</script>