<!-- 
|----------------------------------------------------------------------------
| Email untuk penunjukan kesanggupan tim auditor.
|----------------------------------------------------------------------------
* @params

* type_pelaksanaan [assessment, surveilen, audit khusus]

* auditor # nama auditor

* profesi # profesi auditor dalam tim

* perusahaan # perusahaan

* alamat # alamat perusahaan

* komoditas [e.g Crumb Rubber / SIR 10, SIR 20]

* certification SNI. ISO 9001:2008

* tanggal_pelaksanaan
|----------------------------------------------------------------------------
-->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<div class="box" style="border: 1px solid #d4d4d4; padding: 20px;margin: 0px auto; width: 80%;font-family: 'Roboto', sans-serif;">
	
	<div class="title" style="text-align: center; margin-bottom: 40px; font-size: 20px; text-transform: uppercase; font-weight: 700;"> Penunjukan dan kesanggupan tim audit </div>

	<table class="" style="width: 100%;">
		<tr> 
			<td style="padding: 5px;"> Dari </td> 
			<td style="padding: 5px;"> : </td> 
			<td style="padding: 5px;"> Kepala Seksi Sertifikasi selaku Manajer Operasi </td> 
		</tr>
		<tr> 
			<td style="padding: 5px; "> Kepada </td> 
			<td style="padding: 5px; "> : </td> 
			<td style="padding: 5px; "> <?php echo @$auditor; ?> </td> 
		</tr>

	</table>

	<h2 style="text-align: center;">ISI</h2>
	<p>
		Untuk pelaksanaan <?php echo @$type_pelaksanaan ?> Kami menunjuk Saudara menjadi <?php echo @$profesi ?> pada : 
	</p>
	<table class="" style="width: 100%; border:1px solid gray;">
		<tr style="border-bottom: 1px solid gray;"> 
			<td style="border-bottom: 1px solid gray; width:280px; padding: 10px; background-color: #f7f3f3; "> Nama Perusahaan </td> 
			<td style="border-bottom: 1px solid gray; width:20px;  padding: 10px; background-color: #f7f3f3; "> : </td> 
			<td style="border-bottom: 1px solid gray; padding: 10px; background-color: #f7f3f3; "> <?php echo @$perusahaan ?> </td> 
		</tr>	
		<tr> 
			<td style="border-bottom: 1px solid gray; width:280px; padding: 10px; "> Alamat </td> 
			<td style="border-bottom: 1px solid gray; width:20px;  padding: 10px; "> : </td> 
			<td style="border-bottom: 1px solid gray; padding: 10px; "> <?php echo @$alamat ?> </td> 
		</tr>	
		<tr> 
			<td style="border-bottom: 1px solid gray; width:280px; padding: 10px; background-color: #f7f3f3; "> Komoditas / Jenis Produk </td> 
			<td style="border-bottom: 1px solid gray; width:20px;  padding: 10px; background-color: #f7f3f3; "> : </td> 
			<td style="border-bottom: 1px solid gray; padding: 10px; background-color: #f7f3f3; "> <?php echo @$jenis_produk ?> </td> 
		</tr>	
		<tr> 
			<td style="border-bottom: 1px solid gray; width:280px; padding: 10px; "> Standard Acuan / Standard Produk </td> 
			<td style="border-bottom: 1px solid gray; width:20px;  padding: 10px; "> : </td> 
			<td style="border-bottom: 1px solid gray; padding: 10px; "> <?php echo @$standard_acuan ?> </td> 
		</tr>	
		<tr> 
			<td style=" width:280px;padding: 10px; background-color: #f7f3f3; "> Tanggal pelaksanaan </td> 
			<td style=" width:20px; padding: 10px; background-color: #f7f3f3; "> : </td> 
			<td style="padding: 10px; background-color: #f7f3f3; "> <?php echo @$tanggal_pelaksanaan ?> </td> 
		</tr>	

	</table>

	<div style="width: 300px; margin-top: 50px;">
		
		<div style="text-align: center;">
			<p> Yogyakarta, <?php echo date('d F Y') ?> </p>
			<br><br>
			<p><strong>SATIJA</strong></p>
		</div>
	</div>

</div>	
