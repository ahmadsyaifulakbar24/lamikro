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
								<li class="list-inline-item text-muted">Pengaturan</li>
							</ul>
						</div>
						<div class="alert alert-success fade show none" role="alert" id="alert">
							Kata Sandi berhasil diubah.
						</div>
                        <div class="grid border">
                            <div class="grid-body">
                                <div class="row pb-2">
                                    <div class="d-none d-md-block col-md-4">
                                        <div class="font-weight-bold">
                                            <i class="mdi mdi-key mdi-1x pr-1"></i>
                                            <span>Ubah Kata Sandi</span>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                    	<form id="form">
	                                        <div class="form-group position-relative">
	                                            <label for="password" class="text-capitalize">Kata sandi saat ini</label>
	                                            <input type="password" class="form-control bg-white" id="password" maxlength="18" autocomplete="on">
	                                            <div class="invalid-feedback" id="password-feedback"></div>
	                                            <i class="password mdi mdi-eye-off" data-id="password"></i>
	                                        </div>
	                                        <div class="form-group position-relative">
	                                            <label for="npassword" class="text-capitalize">Kata sandi baru</label>
	                                            <input type="password" class="form-control bg-white" id="npassword" maxlength="18" autocomplete="on">
	                                            <div class="invalid-feedback" id="npassword-feedback"></div>
	                                            <i class="password mdi mdi-eye-off" data-id="npassword"></i>
	                                        </div>
	                                        <div class="form-group position-relative">
	                                            <label for="cpassword" class="text-capitalize">Konfirmasi kata sandi</label>
	                                            <input type="password" class="form-control bg-white" id="cpassword" maxlength="18" autocomplete="on">
	                                            <div class="invalid-feedback" id="cpassword-feedback"></div>
	                                            <i class="password mdi mdi-eye-off" data-id="cpassword"></i>
	                                        </div>
	                                        <div class="d-flex">
	                                            <button class="btn btn-sm btn-danger mt-4 ml-auto border-0 font-weight-bold" id="submit">
								        			<i class="mdi mdi-loading mdi-spin pr-2 none" id="loading"></i> Ubah Kata Sandi
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
        </div>
        @include('app.partials.footer')
        <script type="text/javascript" src="{{asset('vendor/jquery/validate.js')}}"></script>
        <script type="text/javascript" src="{{asset('api/pengaturan.js')}}"></script>
    </body>
</html>