<?php echo $this->load->component('js', 'jsdata/jsdata.upload.js') ?>

<div>
	<h2 class="text-center">Upload perusahaan</h2>
</div>
<div class="alert alert-danger">  
	File harus berupa excel. untuk format excel, silahkan download form berikut <a href=""> Download Excel </a>
</div>

<fieldset>
	<legend>Upload file company</legend>
	<div class="form-group">
		<label> Upload excel perusahaan </label>
		<input type="file" name="files">
	</div>

</fieldset>

<script type="text/javascript">
	$(document).ready(function(res){
		$('input[type="file"]').on('change', function(res){
			var $this = $(this)
            var $data = $this.data()

            
            $.Upload( $this )
            .done(function(res){
                $this.val('');
                $.Upload.submit({
		            url: site_url('company/upload_excel_company'),
		        })
		        .done(function(res){
		            console.log(res)
		        
		        })
            })
		})
	})
</script>