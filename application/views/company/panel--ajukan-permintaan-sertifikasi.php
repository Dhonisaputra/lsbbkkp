<?php echo $this->load->component('js', 'jsdata/jsdata.upload.js') ?>

<style type="text/css">
	.head{
	    font-family: 'Roboto Condensed', sans-serif;
	    font-size: 25px;
	    text-transform: uppercase;
	    padding-bottom: 10px;
	}
	p.narrow{
        width: 60%;
        margin: 10px auto;
    }
</style>

<div class="flex flex-center flex-distributed" style="flex-direction: column;">
	<div class="col-md-12">
		<h3 class="head text-center">Pengajuan sertifikasi baru</h3>
		<p class="narrow form-group text-center">
			Silahkan pilih sertifikasi yang anda inginkan dengan cara klik tombol <br><strong>"AJUKAN PERMINTAAN SERTIFIKASI"</strong> di bawah ini. 
		</p>
	</div>
	<div class="col-md-5">
		
		<div class="form-group text-center">
			<a class="btn btn-primary" href="<?php echo site_url('certification/add/'.$company['id_company']) ?>"> Ajukan permintaan sertifikasi </a>
		</div>
	</div>
</div>
<input type="file" class="sr-only" name="upload_dokumen">

<script type="text/javascript">
	/*function ajukan_permintaan(event)
	{
		event.preventDefault();
		var fLen = $('.master-permintaan-status a').length // FORM LENGTH
		var uLen = Object.keys($.Upload.records).length // UPLOAD LENGTH

		if(fLen != uLen)
		{
			swal('Kesalahan', 'Mohon lengkapi dokumen terlebih dahulu', 'error')
			return false;
		}

		var keys = [];
		$('.master-permintaan-status a').each(function(){ 
			var data = $(this).data(); 
			console.log(data);
			keys.push(data.master) 
		})

		$.Upload.submit({
            url: site_url('certification/insert_dokumen_pengajuan_sertifikasi'),
            data: {id_company: <?php echo $company['id_company'] ?>, master: keys}
        })
        .done(function(res){
        	console.log(res)
        	res = JSON.parse(res);
        	window.location.href = site_url('company/tracker_request/'+<?php echo $company['id_company'] ?>+'/'+res.id_permintaan_sertifikasi);
        })

	}
	function upload_dokumen(e, id_master_kelengkapan_permintaan)
	{
		e.preventDefault();
		var $this = $(e.target)

		
		$('[name="upload_dokumen"]').trigger('click')
		window.lastEvent = e;

	}

	$(document).ready(function(){
		$('[name="upload_dokumen"]').on('change', function(){
			var $this = $(this)
			
			$.Upload( $this, {accepted_files: 'pdf,doc, docx'} )
            .done(function(res){
            	console.log(res)

            	var $data = $(window.lastEvent.target).data()

            	if($data.key)
				{
					$.Upload.delete($data.name, $data.key)
				}

            	// CHANGE TEXT
            	$(window.lastEvent.target).html('<span class="pull-right text-primary"> Ganti file </span>')
            	$(window.lastEvent.target).closest('.master-permintaan-status').find('.file-uploaded').remove();
            	$(window.lastEvent.target).closest('.master-permintaan-status').prepend('<span class="file-uploaded">'+res[0].name+'</span>')
            	$(window.lastEvent.target).data(res[0])
            	$('[name="upload_dokumen"]').val('')
            })
            .fail(function(event, error, data){
            	console.log(error)
            	swal(error.title, error.text, 'error')
            })
		})
	})*/
</script>