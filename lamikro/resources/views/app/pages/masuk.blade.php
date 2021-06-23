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
        <div class="card border">
        	<div class="card-body">
                <div class="text-center pt-4 pb-3">
                    <!-- <h6 class="text-uppercase pb-4" style="color:#FBC818; text-shadow: 1px 1px #BA9393;">Kementerian Koperasi dan Usaha Kecil dan Menengah<br> Republik Indonesia</h6> -->
                    <img src="{{asset('images/logo/lamikro.garuda.png')}}" width="200">
                    <small class="pt-4">(sistem aplikasi ini sudah sesuai dengan SAK EMKM)</small>
                </div>
                <form id="form">
		        	<div class="form-group">
	                    <hr class="mb-4">
	        			<label>Nama Akun</label>
	        			<input type="text" class="form-control bg-white" id="username" autofocus>
	                    <div class="invalid-feedback" id="feedback">Nama Akun atau Kata Sandi salah.</div>
	        		</div>
		        	<div class="form-group position-relative">
	        			<label>Kata Sandi</label>
	        			<input type="password" class="form-control bg-white" id="password" autocomplete="on">
	                    <i class="password mdi mdi-eye-off" data-id="password"></i>
	        			<a href="{{url('app/reset_password')}}" class="text-danger float-right mt-3">
	        				<small>Lupa kata sandi?</small>
	        			</a>
	        		</div>
		        	<div class="form-group" style="padding-top:35px">
	                    <hr class="mt-0 mb-4">
		        		<button class="btn btn-danger btn-sm btn-block font-weight-bold" id="submit">
		        			<span id="text">Masuk</span>
		        			<i class="mdi mdi-loading mdi-1x mdi-spin none" id="loading"></i>
		        		</button>
	        		</div>
	        	</form>
	        	<div class="form-group text-center pt-2">
	        		<span class="text-muted">Belum punya akun?</span>
        			<a href="{{url('app/daftar')}}" class="text-danger">
        				<small>Daftar</small>
        			</a>
        		</div>
        	</div>
        </div>
		@include('app.partials.footer')
        <script src="{{asset('api/oauth.js')}}"></script>
        @if(Session::has('token'))
        <script>console.log(`{{ Session::get('token')}}`)</script>
        @endif
    </body>
</html>