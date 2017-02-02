	<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->

			<div class="form-group">
				<label>Nama Perusahaan *</label>
				<input class="form-control" name="company_name" placeholder="Nama Perusahaan" autocomplete="off" required>
			</div>
			
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Negara *</label>
						<input class="form-control" id="company_country" placeholder="Nama Negara" required list="datalist--country">
						<input type="hidden"  name="country_code" id="company_country_value">
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label>Provinsi *</label>
						<input class="form-control" id="company_province" name="company_province" placeholder="Provinsi" list="datalist--province" required>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Kota / Kabupaten *</label>
						<input class="form-control" name="company_city" placeholder="Kota / kabupaten" required list="datalist--city">
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label>Kode pos</label>
						<input class="form-control" name="company_postzip" placeholder="Kodepos perusahaan" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Alamat  *</label>
				<textarea class="form-control" name="company_address" placeholder="Contoh = RT.10/RW.4, No.10, Dsn. XXXXXX, Ds. XXXXX" autocomplete="off" required style="height:100px; "></textarea>
				<span class="help-block">hanya diisikan RT/RW, nama Gang, nomor bangunan, nama dusun, nama desa, nama kecamatan</span>
			</div>
			
			
			<div class="form-group">
				<label>Email *</label>
				<input class="form-control"  type="email" name="company_email" placeholder="Email perusahaan" autocomplete="off" required>
			</div>
			
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>No. Telephone Perusahaan *</label>
						<div class="input-group">
						  	<span class="input-group-addon" id="addon--handphone-area">+00</span>
							<input class="form-control" name="company_telephone" placeholder="No. Telephone perusahaan" autocomplete="off" type="tel" required>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label>faksimile</label>
						<div class="input-group">
						  	<span class="input-group-addon" id="addon--fax">+00</span>
							<input class="form-control" name="company_fax" placeholder="company fax" autocomplete="off" type="" >
						</div>
					</div>
				</div>
				
			</div>