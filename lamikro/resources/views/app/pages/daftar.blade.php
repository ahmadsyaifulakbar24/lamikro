<!DOCTYPE html>
<html lang="id">
	<head>
		@include('app.partials.head')
		<link rel="stylesheet" href="{{asset('vendor/theme/form.css')}}"></link>
		<style type="text/css">
			body {
				background-image: url({{asset('images/background/login.png')}});
			}
		</style>
	</head>
	<body>
		<div class="card border none" id="done">
        	<div class="card-body">
                <div class="text-center pt-4 pb-5">
                    <i class="mdi mdi-check-circle-outline mdi-7x"></i>
                    <h5 class="font-weight-bold">Selamat!</h5>
                    <p class="pt-2 pb-5">Anda berhasil mendaftar.</p>
                    <a href="{{url('app')}}" class="btn btn-danger btn-block">Oke, Masuk</a>
                </div>
	        </div>
	    </div>
		<div class="card border" id="regis">
        	<div class="card-body">
                <div class="text-center pt-4 pb-5">
                    <img src="{{asset('images/logo/lamikro.garuda.png')}}" width="200">
                </div>
                <form id="form">
	                <div id="data">
	    	        	<div class="form-group">
	                        <label for="ktp">Nomor KTP</label>
	            			<input type="tel" class="form-control bg-white" id="ktp" maxlength="16" autofocus>
	                        <div class="invalid-feedback" id="ktp-feedback"></div>
	            		</div>
	    	        	<div class="form-group">
	                        <label for="name">Nama Lengkap</label>
	            			<input type="text" class="form-control bg-white" id="name">
	                        <div class="invalid-feedback" id="name-feedback"></div>
	            		</div>
	                    <div class="form-group">
	                        <label for="npwp">Nomor NPWP (Optional)</label>
	                        <input type="tel" class="form-control bg-white" id="npwp" maxlength="20" autocomplete="off">
	                        <div class="invalid-feedback" id="npwp-feedback"></div>
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
	                    <div class="form-group">
	                        <label for="businessName">Nama Usaha</label>
	                        <input type="text" class="form-control bg-white" id="businessName">
	                        <div class="invalid-feedback" id="businessName-feedback"></div>
	                    </div>
	                    <div class="form-group">
	                        <label for="businessNumber">Nomor IUMK atau NIB (Nomor Induk Berusaha)</label>
	                        <input type="tel" class="form-control bg-white" id="businessNumber">
	                        <div class="invalid-feedback" id="businessNumber-feedback"></div>
	                        <!-- <small class="text-muted text-justify pt-1">*Sebagai UKM yang handal, diharapkan memiliki Izin IUMKM yg mudah. cara mengurusnya cukup sampai dikantor kecamatan, GRATIS</small> -->
	                    </div>
	                    <div class="form-group">
	                        <label for="businessAddress">Alamat Usaha</label>
	                        <textarea class="form-control bg-white" id="businessAddress"></textarea>
	                        <div class="invalid-feedback" id="businessAddress-feedback"></div>
	                    </div>
	                    <div class="form-group">
	                        <label for="username">Nama Akun</label>
	                        <input type="text" class="form-control bg-white first" id="username" maxlength="30">
	                        <div class="invalid-feedback" id="username-feedback"></div>
	                    </div>
	                    <div class="form-group position-relative">
	                        <label for="password">Kata Sandi</label>
	                        <input type="password" class="form-control bg-white" id="password" minlength="6" maxlength="32" autocomplete="on">
	                        <div class="invalid-feedback" id="password-feedback"></div>
	                        <i class="password mdi mdi-eye-off" data-id="password"></i>
	                    </div>
	                    <div class="form-group position-relative">
	                        <label for="cpassword">Konfirmasi Kata Sandi</label>
	                        <input type="password" class="form-control bg-white" id="cpassword" minlength="6" maxlength="32" autocomplete="on">
	                        <div class="invalid-feedback" id="cpassword-feedback"></div>
	                        <i class="password mdi mdi-eye-off" data-id="cpassword"></i>
	                    </div>
	                    <div class="form-group position-relative">
	                        <label class="pt-1">Captcha</label>
	                        <div class="row">
		                        <div class="col-sm-3 col-4 pt-1">
			                        <span id="text-captcha">5 + 5 = </span>
			                    </div>
			                    <div class="col">
			                        <input type="tel" class="form-control bg-white" id="captcha">
			                        <div class="invalid-feedback" id="captcha-feedback"></div>
			                    </div>
			                </div>
	                    </div>
	                </div>
		        	<div class="form-group pt-4">
	                    <button class="btn btn-danger btn-sm btn-block font-weight-bold" id="submit">
	                    	<span id="text">Daftar</span>
	                    	<i class="mdi mdi-loading mdi-spin mdi-1x none" id="loading"></i>
	                    </button>
	        		</div>
	        	</form>
	        	<div class="form-group text-center pt-2">
	        		<span class="text-muted">Sudah punya akun?</span>
        			<a href="{{url('app')}}" class="text-danger">
        				<small>Masuk</small>
        			</a>
        		</div>
        	</div>
        </div>
		@include('app.pages.footer')
        <script src="{{asset('vendor/jquery/validate.js')}}"></script>
        <script src="{{asset('api/daftar.js')}}"></script>
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