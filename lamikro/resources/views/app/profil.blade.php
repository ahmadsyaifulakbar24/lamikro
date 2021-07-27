<!DOCTYPE html>
<html lang="id">
    <head>
    	@include('app.partials.head')
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
								<li class="list-inline-item text-muted">Profil</li>
							</ul>
						</div>
						<div class="alert alert-warning fade show none" role="alert" id="warning">
							<i class="mdi mdi-alert-circle-outline pr-2"></i>Harap lengkapi profil sebelum menggunakan aplikasi Lamikro.
						</div>
						<div class="alert alert-success fade show none" role="alert" id="alert">
							<i class="mdi mdi-check-circle-outline pr-2"></i>Profil berhasil disimpan.
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
	                                            <input type="text" class="form-control" id="username" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="row pb-2">
	                                    <div class="d-none d-md-block col-md-4">
	                                        <div class="font-weight-bold">
	                                            <i class="mdi mdi-account-circle-outline pr-1 mdi-1x"></i>
	                                            <span>Data Pribadi</span>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-8">
	                                        <div class="form-group">
	                                            <label for="name">Nama Lengkap</label>
	                                            <input type="text" class="form-control" id="name" required>
	                                            <div class="invalid-feedback"></div>
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
	                                            <label for="enum_religi">Agama</label>
	                                            <select class="custom-select pointer" id="enum_religi" required>
	                                            	<option value="" disabled selected>Pilih</option>
	                                            </select>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="ktp">Nomor Induk Kependudukan (NIK)</label>
	                                            <input type="tel" class="form-control" id="ktp" maxlength="16" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="npwp">NPWP Pribadi</label>
	                                            <input type="tel" class="form-control npwp" id="npwp" maxlength="20" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-row">
	                                            <div class="col-sm-6 form-group">
	                                                <label for="tmp_lahir">Tempat Lahir</label>
	                                                <input type="text" class="form-control" id="tmp_lahir" required>
	                                                <div class="invalid-feedback"></div>
	                                            </div>
	                                            <div class="col-sm-6 form-group">
	                                                <label for="date">Tanggal Lahir</label>
	                                                <input type="date" class="form-control" id="date" required>
	                                                <div class="invalid-feedback"></div>
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="enum_edu">Pendidikan Terakhir</label>
	                                            <select class="custom-select pointer" id="enum_edu" required>
	                                            	<option value="" disabled selected>Pilih</option>
	                                            </select>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="phone">Nomor Telepon</label>
	                                            <input type="tel" class="form-control" id="phone" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="email">Email</label>
	                                            <input type="email" class="form-control" id="email" required>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="address">Alamat Rumah</label>
	                                            <textarea rows="4" class="form-control" id="address" required></textarea>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="enum_prov">Provinsi</label>
	                                            <select class="custom-select pointer" id="enum_prov" required>
	                                            	<option value="" disabled selected>Pilih</option>
	                                            </select>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="enum_city">Kabupaten/Kota</label>
	                                            <select class="custom-select pointer" id="enum_city" required>
	                                            	<option value="" disabled selected>Pilih</option>
	                                            </select>
	                                            <div class="invalid-feedback"></div>
	                                        </div>
	                                        <div class="d-flex">
	                                            <button class="btn btn-sm btn-danger mt-4 ml-auto border-0 font-weight-bold" id="submit" disabled>
								        			<i class="mdi mdi-loading mdi-spin pr-2 none" id="loading"></i> Simpan
	                                            </button>
	                                        </div>
	                                    </div>
	                                </div>
	                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FOOTER -->
            </div>
        </div>
        @include('app.partials.footer')
        <script src="{{asset('api/profil.js')}}"></script>
    </body>
</html>