<!DOCTYPE html>
<html lang="id">
    <head>
    	@include('app.partials.head')
    	<link rel="stylesheet" href="{{asset('vendor/croppie/croppie.css')}}">
    </head>
    <body class="header-fixed">
    	@include('app.partials.header')
        <div class="page-body">
        	@include('app.partials.sidebar')
            <div class="page-content-wrapper">
                <div class="page-content-wrapper-inner">
                    <div class="content-viewport">
						<div class="pb-2 d-flex justify-content-md-start justify-content-center">
							<ul class="list-inline">
								<li class="list-inline-item"><a href="./dashboard" class="text-danger">Dashboard</a></li>
								<li class="list-inline-item">></li>
								<li class="list-inline-item text-muted">Profil Usaha</li>
							</ul>
						</div>
						<div class="alert alert-warning fade show none" role="alert" id="warning">
							<i class="mdi mdi-alert-circle-outline pr-2"></i> Harap lengkapi profil usaha.
						</div>
						<div class="alert alert-success fade show none" role="alert" id="alert">
							<i class="mdi mdi-check-circle-outline pr-2"></i> Profil usaha berhasil disimpan.
						</div>
                        <div class="grid border">
                            <div class="grid-body">
                                <div class="row border-bottom pb-2 mb-4">
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
                                </div>
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
	                                            <input type="text" class="form-control" id="company" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="alamat_usaha">Alamat Usaha</label>
	                                            <textarea rows="4" class="form-control" id="alamat_usaha" required></textarea>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="enum_sektor">Sektor Usaha</label>
	                                            <select class="custom-select pointer" id="enum_sektor" required>
	                                            	<option value="" disabled selected>Pilih</option>
	                                            </select>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="enum_bidang">Bidang Usaha</label>
	                                            <select class="custom-select pointer" id="enum_bidang" required>
	                                            	<option value="" disabled selected>Pilih</option>
	                                            </select>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="tgl_b_us">Tanggal Pendirian Usaha</label>
	                                            <input type="date" class="form-control" id="tgl_b_us" start="2020" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="iumkm">Nomor IUMK atau NIB (Nomor Induk Berusaha)</label>
	                                            <input type="text" class="form-control" id="iumkm" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="npwp_usaha">NPWP Usaha</label>
	                                            <input type="tel" class="form-control npwp" id="npwp_usaha" maxlength="20" required>
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
	                                            <input type="text" class="form-control" id="capacity" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="koperasi">Anggota Koperasi</label>
	                                            <select class="custom-select pointer" id="koperasi" required>
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FOOTER -->
            </div>
            <div class="modal fade" id="modal-avatar" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <div class="my-3" id="avatar-form">
                            	<input type="file" class="d-none" id="avatar">
                            	<!-- <input type="file" class="d-none" id="avatar" accept="image/jpeg"> -->
                            	<label class="avatar-text" for="avatar" style="cursor:pointer;">
                            		<i class="mdi mdi-upload mdi-7x"></i>
                            		<p>Pilih file</p>
                            	</label>
                            </div>
                            <div id="avatar-preview" class="text-left" style="display:none;">
                            	<i class="mdi mdi-arrow-left mdi-3x text-left" style="cursor:pointer" id="back"></i>
                            </div>
                            <div class="container">
                            	<p class="text-danger none pb-3" id="feedback-file"></p>
                                <div class="row">
                                    <button class="col btn btn-outline mr-2" data-dismiss="modal">Batal</button>
                                    <button class="col btn btn-danger ml-2" id="upload" disabled>
					        			<i class="mdi mdi-loading mdi-1x mdi-spin pr-2 none" id="loadingAvatar"></i> Simpan
					        		</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('app.partials.footer')
        <script src="{{asset('vendor/jquery/number.js')}}"></script>
        <script src="{{asset('vendor/croppie/croppie.js')}}"></script>
        <script src="{{asset('api/avatar.js')}}"></script>
        <script src="{{asset('api/profil-usaha.js')}}"></script>
        <!-- <script src="{{asset('api/profil-usaha-update.js')}}"></script> -->
    </body>
</html>