<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<table class="table table-stripped table-hover table-bordered table-auditor--add-competency" id="table-auditor--add-competency" style="width:100%;">
	<thead>
		<tr>
            <th>Kompetensi</th>
            <th>Nama</th>
			<th>Type</th>
			<th>aksi</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

<script type="text/javascript">
    function sign_document_done()
    {
        Snackbar.show('Dokumen telah ditambahkan');
    }

	function add_competeny(ui)
	{
		Snackbar.manual({message: 'Sedang menambahkan. Silahkan tunggu!', spinner: true});
		$('.mdl-button--add-competency').prop('disabled',true)
		var tr = $(ui).parents('tr')[0];
        var data = window.tableAddCompetency.row(tr).data();

        $.post( site_url('auditor/process/post/insert/competency'), {id_auditor: '<?php echo $profile["id_auditor"] ?>', competency: data.audit_reference} )
        .done(function(res){
            
            // Tools.popupCenter(site_url('auditor/panel/add/competency/documents/<?php echo $profile["id_auditor"] ?>/'+data.audit_reference+'?ajax=1'), 'Tambahkan dokumen kompetensi', '700', '500');

            $(tr).remove();
        	Snackbar.show('Kompetensi telah ditambahkan')
            $('.mdl-button--add-competency').prop('disabled',false)

            Notify.send({notification_for_level: 1,  notification_text: window.cookie.username+' menambahkan kompetensi. Silahkan klik pemberitahuan untuk membuka halaman moderasi', notification_link: site_url('auditor/panel/profile/'+window.cookie.id_users+'?openTab=content--auditor-profile--category-competency,competency--requested') })
            nav.toUrl({
                url: site_url('auditor/panel/add/competency/documents/'+window.cookie.id_users+'/'+data.audit_reference+'?ajax=1'), 
                title: 'asdasd',
                load:
                {
                    target: '#document-actual-tab'
                }
            })
        })
        .error(function(res){
        	console.log(res)
        	swal('kesalahan saat menambahkan kompetensi', 'Terdapat kesalahan saat menambahkan kompetensi auditor. Silahkan ulangi kembali!', 'error')
  			Snackbar.hide('#snackbarTemp')
        })
	}
	window.tableAddCompetency = $('#table-auditor--add-competency').DataTable({
        info: false,
        lengthChange: false,
        ajax: {
            url: site_url('auditor/process/get/unrequested_competency'),
            type: 'POST',
            data: function(d){
                return {id_auditor: '<?php echo $profile["id_auditor"] ?>'}
            },
            dataSrc: function(json)
            {
                json = (json.data)? json.data : json;
                var i = 1;
                if(!json){return false; }

                $.each(json, function(a,b){
                    json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--icon mdl-button--add-competency" onclick="add_competeny(this)"><i class="material-icons">add</i></button>';
                    i++;
                })
                return json;
            }
        },
        columns:[
            {data: 'name'},
            {data: 'certificate_title'},
            {data: 'type'},
            {data: 'action'},
        ],
    })
</script>
