<!DOCTYPE html>
<html lang="id">
    <head>
    	<title>Detail Pengguna • LAMIKRO</title>
    	@include('app.partials.head')
    </head>
    <body class="header-fixed">
    	@include('app.partials.header')
        <div class="page-body">
        	@include('app.partials.sidebar')
            <div class="page-content-wrapper">
                <div class="page-content-wrapper-inner">
                    <div class="content-viewport">
                    	<h5 class="font-weight-bold mb-4">Detail Pengguna</h5>
						<div class="alert alert-warning fade show none" role="alert" id="warning">
							<i class="mdi mdi-alert-circle-outline pr-2"></i> Harap lengkapi profil.
						</div>
						<div class="alert alert-success fade show none" role="alert" id="alert">
							<i class="mdi mdi-check-circle-outline pr-2"></i> Profil berhasil disimpan.
						</div>
                        <div class="grid border">
                            <div class="grid-body">
                            	<form id="form">
	                                <div class="row border-bottom pb-2 mb-4">
	                                    <div class="d-none d-md-block col-md-4">
	                                        <div class="font-weight-bold">
	                                            <i class="mdi pr-1 mdi-lock-outline mdi-1x"></i>
	                                            <span>Data Akun</span>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-8">
	                                        <div class="form-group">
	                                            <label for="username">Nama Akun</label>
	                                            <input type="text" class="form-control bg-white" id="username" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="row border-bottom pb-2 mb-4">
	                                    <div class="d-none d-md-block col-md-4">
	                                        <div class="font-weight-bold">
	                                            <i class="mdi mdi-account-circle-outline pr-1 mdi-1x"></i>
	                                            <span>Data Pribadi</span>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-8">
	                                        <div class="form-group">
	                                            <label for="name">Nama Lengkap</label>
	                                            <input type="text" class="form-control bg-white" id="name" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="no_ktp">Nomor KTP</label>
	                                            <input type="tel" class="form-control bg-white" id="no_ktp" maxlength="16" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="npwp">Nomor NPWP (Optional)</label>
	                                            <input type="tel" class="form-control bg-white npwp" id="npwp" maxlength="20" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-row">
	                                            <div class="col-sm-6 form-group">
	                                                <label for="tmp_lahir">Tempat Lahir</label>
	                                                <input type="text" class="form-control bg-white" id="tmp_lahir" required>
	                                                <div class="invalid-feedback"></div>
	                                            </div>
	                                            <div class="col-sm-6 form-group">
	                                                <label for="tgl_lahir">Tanggal Lahir</label>
	                                                <input type="date" class="form-control bg-white" id="tgl_lahir" required>
	                                                <div class="invalid-feedback"></div>
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="address">Jenis Kelamin</label><br>
	                                            <div class="custom-control custom-radio custom-control-inline">
		                                            <input type="radio" name="gender" class="custom-control-input" id="male" value="L">
		                                            <label class="custom-control-label pointer" for="male">Laki-Laki</label>
		                                        </div>
	                                            <div class="custom-control custom-radio custom-control-inline">
		                                            <input type="radio" name="gender" class="custom-control-input" id="female" value="P">
		                                            <label class="custom-control-label pointer" for="female">Perempuan</label>
		                                        </div><br>
	                                            <small class="text-danger none" id="gender-feedback"></small>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="religi_">Agama</label>
	                                            <select class="custom-select bg-white pointer" id="religi_" required>
	                                            	<option value="" disabled selected>Pilih</option>
	                                            </select>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="edu_">Pendidikan</label>
	                                            <select class="custom-select bg-white pointer" id="edu_" required>
	                                            	<option value="" disabled selected>Pilih</option>
	                                            </select>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="provinsi_">Provinsi</label>
	                                            <select class="custom-select bg-white pointer" id="provinsi_" required>
	                                            	<option value="" disabled selected>Pilih</option>
	                                            </select>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="kab_kota_">Kabupaten/Kota</label>
	                                            <select class="custom-select bg-white pointer" id="kab_kota_" required>
	                                            	<option value="" disabled selected>Pilih</option>
	                                            </select>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="address">Alamat Rumah</label>
	                                            <textarea rows="4" class="form-control bg-white" id="address" required></textarea>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="email">Email</label>
	                                            <input type="email" class="form-control bg-white" id="email" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="phone_number">Nomor Telepon</label>
	                                            <input type="tel" class="form-control bg-white" id="phone_number" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <!-- <div class="row border-bottom pb-2 mb-4">
	                                    <div class="d-none d-md-block col-md-4">
	                                        <div class="font-weight-bold">
	                                            <i class="mdi mdi-image-outline mdi-1x pr-1"></i>
	                                            <span>Foto Profil Usaha</span>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-8">
	                                        <div class="row form-group">
	                                            <img class="profile-img img-lg rounded-circle mr-5 mb-3" src="{{asset('images/store/business.svg')}}" id="businessAvatar">
	                                            <div>
	                                                <button class="btn btn-sm mt-3 mb-2 py-0" id="btn-avatar" data-toggle="modal" data-target="#modal-avatar">Ubah foto</button><br>
	                                                <small class="text-muted">Ukuran maksimum 500KB (JPG)</small>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div> -->
	                                <div class="row pb-2">
	                                    <div class="d-none d-md-block col-md-4">
	                                        <div class="font-weight-bold">
	                                            <i class="mdi mdi-storefront mdi-1x pr-1"></i>
	                                            <span>Data Usaha</span>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-8">
	                                    	<form id="form">
		                                        <div class="form-group">
		                                            <label for="company">Nama Usaha</label>
		                                            <input type="text" class="form-control bg-white" id="company" required>
		                                            <div class="invalid-feedback"></div>
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="alamat_usaha">Alamat Usaha</label>
		                                            <textarea rows="4" class="form-control bg-white" id="alamat_usaha" required></textarea>
		                                            <div class="invalid-feedback"></div>
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="sektor_">Sektor Usaha</label>
		                                            <select class="custom-select bg-white pointer" id="sektor_" required>
		                                            	<option value="" disabled selected>Pilih</option>
		                                            </select>
		                                            <div class="invalid-feedback"></div>
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="bidang_">Bidang Usaha</label>
		                                            <select class="custom-select bg-white pointer" id="bidang_" required>
		                                            	<option value="" disabled selected>Pilih</option>
		                                            </select>
		                                            <div class="invalid-feedback"></div>
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="tgl_b_us">Tanggal Pendirian Usaha</label>
		                                            <input type="date" class="form-control bg-white" id="tgl_b_us" start="2020" required>
		                                            <div class="invalid-feedback"></div>
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="npwp_usaha">Nomor NPWP Usaha</label>
		                                            <input type="tel" class="form-control bg-white npwp" id="npwp_usaha" maxlength="20" required>
		                                            <div class="invalid-feedback"></div>
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="iumkm">Nomor IUMK atau NIB (Nomor Induk Berusaha)</label>
		                                            <input type="text" class="form-control bg-white" id="iumkm" required>
		                                            <div class="invalid-feedback"></div>
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="kaya_usaha">Kekayaan Usaha (Asset) per Tahun</label>
			                                        <div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text"><small>Rp</small></span>
														</div>
														<input type="tel" class="form-control number" id="kaya_usaha" required>
			                                            <div class="invalid-feedback"></div>
													</div>
												</div>
		                                        <div class="form-group">
		                                            <label for="volume_usaha">Volume Usaha (Omset) per Tahun</label>
			                                        <div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text"><small>Rp</small></span>
														</div>
														<input type="tel" class="form-control number" id="volume_usaha" required>
			                                            <div class="invalid-feedback"></div>
													</div>
												</div>
		                                        <div class="form-group">
		                                            <label for="emp_amount">Jumlah Karyawan</label>
			                                        <div class="input-group mb-3">
														<input type="tel" class="form-control number" id="emp_amount" required>
														<div class="input-group-append">
															<span class="input-group-text"><small>Orang</small></span>
														</div>
			                                            <div class="invalid-feedback"></div>
													</div>
												</div>
		                                        <div class="form-group">
		                                            <label for="capacity">Kapasitas Produksi per Tahun</label>
		                                            <input type="text" class="form-control bg-white" id="capacity" required>
		                                            <div class="invalid-feedback"></div>
		                                        </div>
		                                        <div class="form-group">
		                                            <label for="koperasi">Anggota Koperasi</label>
		                                            <select class="custom-select bg-white pointer" id="koperasi" required>
		                                            	<option value="" disabled selected>Pilih</option>
		                                            	<option value="1">Ya</option>
		                                            	<option value="0">Tidak</option>
		                                            </select>
		                                            <div class="invalid-feedback"></div>
		                                        </div>
		                                        <div class="d-flex">
		                                            <button class="btn btn-sm btn-danger mt-4 ml-auto border-0 font-weight-bold" id="submit" disabled>
									        			<i class="mdi mdi-loading mdi-spin pr-2 none" id="loading"></i> Simpan
									        		</button>
		                                        </div>
		                                    </form>
	                                    </div>
	                                </div>
	                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('app.partials.footer')
        <script>const user_id = '{{$user_id}}'</script>
        <script src="{{asset('vendor/jquery/number.js')}}"></script>
        <script src="{{asset('api/admin/view-user.js')}}"></script>
    </body>
</html>