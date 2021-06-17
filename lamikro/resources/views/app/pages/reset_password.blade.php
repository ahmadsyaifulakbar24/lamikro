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
        		<div class="text-center pb-5">
                    <i class="mdi mdi-7x mdi-account-lock-outline"></i>
                    <h6 class="font-weight-bold">Atur Ulang Kata Sandi</h6>
                    <p class="text-muted none pt-3" id="codeFeedback">
                        Kode verifikasi telah dikirim.<br>Harap periksa Email Anda.
                    </p>
                </div>
                <form id="form">
	                <div class="form-group">
	        			<label>Email</label>
	        			<input class="form-control bg-white" id="email" autofocus="autofocus">
	                    <div class="invalid-feedback" id="email-feedback">Email tidak ditemukan.</div>
	        		</div>
	        		<button class="btn btn-danger btn-sm btn-block font-weight-bold my-4" id="submit">
	        			<span id="text">Kirim Kode Verifikasi</span>
	        			<i class="mdi mdi-loading mdi-spin mdi-1x none" id="loading"></i>
	        		</button>
	        	</form>
	        	<div class="form-group text-center pt-2">
	        		<span class="text-muted">Kembali ke halaman</span>
        			<a href="{{url('app')}}" class="text-danger">
        				<small>Masuk</small>
        			</a>
        		</div>
        	</div>
        </div>
		@include('app.pages.footer')
        <script src="{{asset('api/reset_password.js')}}"></script>
    </body>
</html>