<div clas="row">
	
	<div class="col-md-6">
		<form onsubmit="save_kondisi_umum(event)">
			<ol>
				<!-- pertanyaan satu -->
				<li>
					<div class="form-group">
						<label>Apakah organisasi yang akan disertifikasi merupakan bagian dari organisasi lain atau grup?</label>
						<div class="radio">
							<label><input type="radio" name="bagian_organisasi_lain" value="ya"> Ya</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="bagian_organisasi_lain" value="tidak"> Tidak</label>
						</div>
					</div>
				</li>

				<!-- pertanyaan dua -->
				<li>
					<div class="form-group">
						<label>Apakah apakah diberlakukan jam shift?</label>
						<div class="radio">
							<label><input type="radio" name="ada_shift" value="ya"> Ya</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="ada_shift" value="tidak"> Tidak</label>
						</div>
					</div>
				</li>

				<!-- pertanyaan 3 -->
				<li>
					<div class="form-group">
						<label>Apakah perusahaan telah mempekerjakan seorang konsultan dalam membantu mempersiapkan sistem manajemen perusahaan</label>
						<div class="radio">
							<label><input type="radio" name="is_consultant" class="ada_konsultan"  value="1" onclick="openDataConsultant()"> Ya</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="is_consultant" class="ada_konsultan" value="0" onclick="openDataConsultant()"> Tidak</label>
						</div>
					</div>
					<div class="form-group sr-only" data-pertanyaan="3" id="data-consultant-in-3"> 
						<label>Tuliskan nama konsultan dan institusi nya</label>
						<textarea class="form-control" name="data_konsultan"></textarea>
					</div>
				</li>

				<!-- pertanyaan 4 -->
				<li>
					<div class="form-group">
						<label>Apakah dokumen dan sistem manajemen yang diajukan sertifikasi sudah lengkap dan diimplementasikan di semua proses?</label>
						<div class="radio">
							<label><input type="radio" name="sm_sudah_diimplementasi" class="is_complete" value="ya" onclick="openDataComplete()"> Ya</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="sm_sudah_diimplementasi" class="is_complete" value="tidak" onclick="openDataComplete()"> Tidak</label>
						</div>
					</div>
					<div class="form-group sr-only" data-pertanyaan="4" id="data-complete-in-3"> 
						<label>Jelaskan secara singkat</label>
						<textarea class="form-control" name="penjelasan_implementasi_sm"></textarea>
					</div>
				</li>

				<!-- pertanyaan 5 -->
				<li>
					<div class="form-group">
						<label>Sebutkan kegiatan proses yang dilakukan diluar pabrik dan berapa jaraknya dengan lokasi pabrik? <i class="text-danger">*) Jika ada</i> </label>
						<div class="row">
							<div class="col-md-5"><input type="text" class="form-control" name="proses_diluar_pabrik[]"></div>
							<div class="col-md-2"> 
								<div class="input-group">
									<input type="text" class="form-control" name="km_proses_diluar_pabrik[]">
									<span class="input-group-addon">KM</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5"><input type="text" class="form-control" name="proses_diluar_pabrik[]"></div>
							<div class="col-md-2"> 
								<div class="input-group">
									<input type="text" class="form-control" name="km_proses_diluar_pabrik[]">
									<span class="input-group-addon">KM</span>
								</div>
							</div>
						</div>
					</div>
				</li>

				<!-- pertanyaan 6 -->
				<li>
					<div class="form-group">
						<label>Sebutkan kegiatan proses yang disubkontrakkan dan kepada pihak mana <i class="text-danger">*) bila ada</i>?</label>
						<textarea class="form-control" name="kegiatan_subkontrak"></textarea> 
					</div>
				</li>

				<!-- pertanyaan 7 -->
				<li>
					<div class="form-group">
						<label>Dokumen sistem manajemen mulai berlaku tanggal</label>
						<input class="form-control" type="date" name="">
					</div>
				</li>

				<!-- pertanyaan 8 -->
				<li>
					<div class="form-group">
						<label>Sertifikasi sistem manajemen yang telah dimiliki dan badan sertifikasi yang menerbitkan. </label>
						<div class="existed-sm">

							<div class="row sm-item">
								<div class="col-md-5"><input type="text" class="form-control sm_yang_similiki" name="sm_dimiliki[]"></div>
								<div class="col-md-2"> 
									<div class="input-group">
										<input type="text" class="form-control badan_yang_menerbitkan" name="sm_penerbit[]">
									</div>
								</div>
								<!-- <div class="col-md-2">  -->
								<button class="mdl-button mdl-js-button" onclick="addExistingSM(this) "><i class="material-icons">add</i></button>
								<!-- </div> -->
							</div>

						</div>

					</div>
				</li>

				<!-- pertanyaan 9 -->
				<li>
					<div class="form-group">
						<label>Audit internal yang terakhir dilaksanakan tanggal</label>
						<input class="form-control" type="date" name="">
					</div>
				</li>

				<!-- pertanyaan 10 -->
				<li>
					<div class="form-group">
						<label>Jumlah auditor internal saat ini </label>
						<div class="input-group">
							<input type="number" name="jumlah_auditor_internal" class="form-control">
							<span class="input-group-addon"> orang </span>
						</div>
					</div>
				</li>
				<!-- pertanyaan 11 -->
				<li>
					<div class="form-group">
						<label>Rapat tinjauan manajemen yang terakhir dilaksanakan tanggal</label>
						<input class="form-control" type="date" name="tinjauan_manajemen_terakhir">
					</div>
				</li>
				<!-- pertanyaan 12 -->
				<li>
					<div class="form-group">
						<label>Bahasa yang akan dipakai sebagai media komunikasi selama audit sertifikasi adalah bahasa</label>
						<input class="form-control" type="text" name="bahasa_komunikasi">
					</div>
				</li>

				<!-- pertanyaan 14 -->
				<li>
					<div class="form-group">
						<label>Peraturan perundangan yang berlaku pada bisnis perusahaan</label>
						<input class="form-control" type="text" name="perpu_berlaku_pada_perusahaan">
					</div>
				</li>

				<!-- pertanyaan 14 -->
				<li>
					<div class="form-group">
						<label>Perusahaan siap diaudit bulan</label>
						<input class="form-control" type="date" name="tanggal_audit">
					</div>
				</li>

				<!-- pertanyaan 15 -->
				<li>
					<div class="form-group">
						<label>Kondisi daerah sekitar</label>
						<div class="radio"> <label><input type="radio" name="kondisi_daerah_sekitar" value="Pemukiman"> Pemukiman</label> </div>
						<div class="radio"> <label><input type="radio" name="kondisi_daerah_sekitar" value="Kawasan Industri"> Kawasan Industri</label> </div>
						<div class="radio"> <label><input type="radio" name="kondisi_daerah_sekitar" value="DAS (Daerah Aliran Sungai)"> DAS (Daerah Aliran Sungai)</label> </div>
						<div class="radio"> <label><input type="radio" name="kondisi_daerah_sekitar" value="Hutan Lindung"> Hutan Lindung</label> </div>
					</div>
				</li>

				<!-- pertanyaan 17 -->
				<li>
					<div class="form-group">
						<label>Informasi Sistem Manajemen Lingkungan dan Lingkup Kegiatan</label>

						<ol type="a">
							<li>
								<div class="form-group">
									<label>Dalam proses produksi, jenis limbah yang dihasilkan adalah : </label>
									<div class="checkbox">
										<label><input type="checkbox" name="jenis_limbah" value="Padat"> Padat</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="jenis_limbah" value="Cair"> Cair</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" name="jenis_limbah" value="Gas"> Gas</label>
									</div>
								</div>

							</li>

							<li>
								<div class="form-group">
									<label>Jenis bahan baku yang digunakan</label>
									<input class="form-control" type="text" name="jenis_bahan_baku">
								</div>
							</li>

							<li>
								<div class="form-group">
									<label>Karakteristik bahan baku termasuk</label>
									<div class="radio">
										<label><input type="radio" name="karakteristik_bahan_baku" value="Bahan Beracun Berbahaya"> Bahan Beracun Berbahaya</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="karakteristik_bahan_baku" value="Bukan Bahan Beracun Berbahaya"> Bukan Bahan Beracun Berbahaya</label>
									</div>
								</div>
							</li>

							<li>
								<div class="form-group">
									<label>Terhadap aspek lingkungan, perusahaan mempunyai : </label>
									<div class="form-group form-inline">
										<label>UPL</label>
										<div class="radio">
											<label><input type="radio" name="UPL" value="Ada"> Ada</label>
										</div>
										<div class="radio">
											<label><input type="radio" name="UPL" value="Tidak ada"> Tidak ada</label>
										</div>
									</div>

									<div class="form-group form-inline">
										<label>UKL</label>
										<div class="radio">
											<label><input type="radio" name="UKL" value="Ada"> Ada</label>
										</div>
										<div class="radio">
											<label><input type="radio" name="UKL" value="Tidak ada"> Tidak ada</label>
										</div>
									</div>

								</div>

							</li>

						</ol>

					</div>
					<!-- end pertanyaan 17 -->
					<div class="form-group">
						<button class="btn btn-primary" type="submit"> Simpan </button>
					</div>
				</li>
			</ol>
		</form>
	</div>
</div>

<script type="text/javascript">
	function openDataConsultant(ui)
	{
		var $checked = $('.is_consultant:checked').val()
		if($checked == 1)
		{
			$('#data-consultant-in-3').removeClass('sr-only')	
			$('#data-consultant-in-3').find('textarea').focus();
		}else
		{
			$('#data-consultant-in-3').addClass('sr-only')

		}
	}

	function openDataComplete()
	{
		var $checked = $('.is_complete:checked').val()
		if($checked == 1)
		{
			$('#data-complete-in-3').removeClass('sr-only')	
			$('#data-complete-in-3').find('textarea').focus();
		}else
		{
			$('#data-complete-in-3').addClass('sr-only')

		}
	}

	function addExistingSM(ui)
	{
		var $sm = $(ui).closest('.row').find('.sm_yang_similiki')
		var $penerbit = $(ui).closest('.row').find('.badan_yang_menerbitkan')
		var $row = $(ui).closest('.row');
		var $parent = $(ui).closest('.existed-sm')
		if( $sm.val() !== '' && $penerbit.val() !== '' )
		{
			var cloned = $row.clone().each(function(){
				$(this).find('.mdl-js-button').attr('onclick','removeExistedSM(this)');			
				$(this).find('.mdl-js-button i').text('clear')
			})
		}


		$(cloned).insertBefore($parent)
		$sm.val('').focus()
		$penerbit.val('')
	}

	function removeExistedSM(ui)
	{
		$(ui).closest('.sm-item').remove();
	}

	function save_kondisi_umum(e)
	{
		e.preventDefault();
		var data = $(e.target).serializeArray()
		console.log(data);
	}

</script>
