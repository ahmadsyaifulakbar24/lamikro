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
						<div class="alert alert-success fade show none" role="alert" id="alert">
							Profil berhasil disimpan.
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
	                                            <input type="text" class="col-sm-6 col-8 form-control bg-white" id="username">
	                                            <div class="invalid-feedback" id="username-feedback"></div>
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
	                                            <input type="text" class="form-control bg-white" id="name">
	                                            <div class="invalid-feedback" id="name-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="ktp">Nomor KTP</label>
	                                            <input type="tel" class="form-control bg-white" id="ktp" maxlength="16">
	                                            <div class="invalid-feedback" id="ktp-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="npwp">Nomor NPWP (Optional)</label>
	                                            <input type="tel" class="form-control bg-white" id="npwp" maxlength="20">
	                                            <div class="invalid-feedback" id="npwp-feedback"></div>
	                                        </div>
	                                        <div class="form-row">
	                                            <!-- <div class="col-sm-6 form-group">
	                                                <label for="place">Tempat Lahir</label>
	                                                <input type="text" class="form-control bg-white" id="place">
	                                                <div class="invalid-feedback" id="place-feedback"></div>
	                                            </div> -->
	                                            <div class="col-sm-6 form-group">
	                                                <label for="date">Tanggal Lahir</label>
	                                                <input type="date" class="form-control bg-white" id="date">
	                                                <div class="invalid-feedback" id="date-feedback"></div>
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="address">Jenis Kelamin</label><br>
	                                            <div class="custom-control custom-radio custom-control-inline">
		                                            <input type="radio" name="gender" class="custom-control-input" id="male" value="L">
		                                            <label class="custom-control-label" for="male">Laki-Laki</label>
		                                        </div>
	                                            <div class="custom-control custom-radio custom-control-inline">
		                                            <input type="radio" name="gender" class="custom-control-input" id="female" value="P">
		                                            <label class="custom-control-label" for="female">Perempuan</label>
		                                        </div><br>
	                                            <small class="text-danger none" id="gender-feedback"></small>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="address">Alamat Rumah</label>
	                                            <textarea rows="4" class="form-control bg-white" id="address"></textarea>
	                                            <div class="invalid-feedback" id="address-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="email">Email</label>
	                                            <input type="email" class="form-control bg-white" id="email">
	                                            <div class="invalid-feedback" id="email-feedback"></div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="phone">Nomor Telepon</label>
	                                            <input type="tel" class="form-control bg-white" id="phone">
	                                            <div class="invalid-feedback" id="phone-feedback"></div>
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
        <script type="text/javascript" src="{{asset('vendor/jquery/validate.js')}}"></script>
        <script type="text/javascript" src="{{asset('api/profil.js')}}"></script>
        <script type="text/javascript" src="{{asset('api/profil-update.js')}}"></script>
        <script type="text/javascript">
			window.snpwp = true
        	$('#npwp').keyup(function(){
        		let npwp = $(this).val().length
        		if(npwp != 0) {
	        		if(npwp < 15) {
	        			$(this).addClass('is-invalid')
	        			$('#npwp-feedback').html('Masukkan 15 digit angka.')
						window.snpwp = false
	        		}
	        		else if(npwp == 15) {
	        			$(this).val(formatNPWP($(this).val()))
	        			$(this).removeClass('is-invalid')
						window.snpwp = true
	        		}
	        		else if(npwp < 20) {
	        			$(this).val('')
	        			$(this).removeClass('is-invalid')
						window.snpwp = true
	        		}
	        	} else {
        			$(this).removeClass('is-invalid')
					window.snpwp = true
	        	}
        	})
        </script>
    </body>
</html>