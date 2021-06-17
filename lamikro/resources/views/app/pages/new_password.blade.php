<!DOCTYPE html>
<html lang="id">
	<head>
		@include('app.partials.head')
		<link rel="stylesheet" href="{{asset('/vendor/theme/form.css')}}"></link>
		<style type="text/css">
			body {
				background-image: url({{asset('images/background/login.png')}});
			}
		</style>
	</head>
	<body>
        <div class="card border">
        	<div class="card-body">
        		<div id="step1">
	        		<div class="text-center pb-5">
	                    <i class="mdi mdi-7x mdi-account-lock-outline"></i>
	                    <h6 class="font-weight-bold">Buat Kata Sandi Baru</h6>
	                </div>
                    <form id="form">
	                    <div class="form-group position-relative">
	                        <label>Kata Sandi Baru</label>
	                        <input type="password" class="form-control bg-white" id="npassword" autocomplete="on" autofocus="autofocus">
	                        <div class="invalid-feedback" id="npassword-feedback">Masukkan kata sandi dengan benar.</div>
	                        <i class="password mdi mdi-eye-off" data-id="npassword"></i>
	                    </div>
	                    <div class="form-group position-relative">
	                        <label>Konfirmasi Kata Sandi</label>
	                        <input type="password" class="form-control bg-white" id="cpassword" autocomplete="on">
	                        <div class="invalid-feedback" id="cpassword-feedback">Kata sandi tidak sesuai.</div>
	                        <i class="password mdi mdi-eye-off" data-id="cpassword"></i>
	                    </div>
			        	<div class="form-group pt-4" id="button">
		                    <button class="btn btn-danger btn-sm btn-block font-weight-bold" id="submit">
		                    	<span id="text">Buat Kata Sandi Baru</span>
			        			<i class="mdi mdi-loading mdi-spin mdi-1x none" id="loading"></i>
			        		</button>
		                </div>
		            </form>
	            </div>
	            <div class="none" id="step2">
	                <div class="text-center pb-3" id="success">
	                    <i class="mdi mdi-7x mdi-check-circle-outline"></i>
	                    <h6 class="font-weight-bold">Kata Sandi Berhasil Diubah</h6>
	                    <p class="text-muted pt-3">
	                        Jaga selalu keamanan akun Anda.<br>Ubah kata sandi secara berkala.
	                    </p>
	                </div>
		        	<div class="form-group pt-4" id="button">
	                    <a href="{{url('app')}}" class="btn btn-danger btn-sm btn-block font-weight-bold">Oke, Masuk</a>
	        		</div>
	        	</div>
        	</div>
        </div>
		@include('app.partials.footer')
        <script type="text/javascript">const d = '{{Request::get("d")}}'</script>
        <script src="{{asset('api/new_password.js')}}"></script>
    </body>
</html>