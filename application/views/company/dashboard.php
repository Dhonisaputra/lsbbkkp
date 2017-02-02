<!-- 
    yang perlu ditampilkan
    
 -->

<?php echo $this->load->component('js','js/library.company.js'); ?>

<?php echo $this->load->component('js', 'plugins/datatable/dist/datatable.min.js') ?>
<?php echo $this->load->component('css', 'plugins/datatable/dist/datatables.min.css') ?>
<!-- Left aligned menu below button -->

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

<div class="alert alert-info">
    Klik 2 kali pada baris perusahaan yang diinginkan. atau Anda bisa klik sekali, dan klik detail perusahaan.
</div>
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary pull-right mdl-button mdl-js-button" onclick="openDetailCompany()">Detail perusahaan</button>
    </div>
</div>

<?php $this->load->view('company/company--list-company'); ?>


<script type="text/javascript">
    var __row_id_company;
    function openDetailCompany()
    {
        if(!__row_id_company)
        {
            swal('Tidak ada perusahaan yang dipilih','Silahkan pilih salah satu perusahaan dengan cara klik pada salah satu baris perusahaan!', 'error');
            return false;
        }
        openCompany(__row_id_company);
    }

    function openCompany(id_company)
    {
        if(id_company)
        {
            var ref = site_url('company/'+id_company);
            window.location.href = ref;
        }
    }   

    

    function remove()
    {

    }
    $(function(){
        

        $.when(Company.get_company()).done(function(res){
            var dataSet = {data: res}
            /*res = res.filter(function(res){
                res.telephone = '(+62) '+res.telephone;
                return res;
            })*/


            // $('#table-company_filter').addClass('sr-only')
        });

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

        
        $('.mdl-textfield__input').on('keyup', function(event){
            window.companyTable.search( this.value ).draw();
        })
    })
</script>


<?php if( $this->agent->is_mobile() ) { ?>
    <script type="text/javascript">
        $(document).delegate( '#table-company tbody tr', 'click', function (e) {
            var data = window.companyTable.row( $(this) ).data();
            var ref = site_url('company/'+data.id_company);
            window.location.href = ref;
        });
        
    </script>
<?php }else{ ?>
    <script type="text/javascript">
        $(document).delegate( '#table-company tbody tr', 'dblclick', function (e) {
            var data = window.companyTable.row( $(this) ).data();
            var ref = site_url('company/'+data.id_company);
            window.location.href = ref;
        });
    </script>
<?php } ?>