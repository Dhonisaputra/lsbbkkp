
<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>

<style type="text/css">
    .row-selected
    {
        background: #4183D7 !important;
        color: white;
    }
    tr
    {
        cursor: pointer;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary pull-right mdl-button mdl-js-button" onclick="certificationCompany()">Daftarkan sertifikasi</button>
    </div>
</div>

<?php $this->load->view('company/company--list-company'); ?>

<script type="text/javascript">
    var __row_id_company;
	
	function certificationCompany()
    {
        if(!__row_id_company)
        {
            swal('Tidak ada perusahaan yang dipilih','Silahkan pilih salah satu perusahaan dengan cara klik pada salah satu baris perusahaan!', 'error');
            return false;
        }

        var ref = site_url('pjt/panel/company/'+__row_id_company+'/register/certification');
        // nav.toUrl({url: ref, title:'Request new certification', load:{target: '#document-actual-tab'} })
        window.location.href = ref;
    }

	$('#table-company tbody').on( 'click', 'tr', function () {
            var data = window.companyTable.row( $(this) ).data();
            __row_id_company = data.id_company;

            if ( $(this).hasClass('row-selected') ) {
                $(this).removeClass('row-selected');
            }
            else {
                window.companyTable.$('tr.row-selected').removeClass('row-selected');
                $(this).addClass('row-selected');
            }
        });

</script>