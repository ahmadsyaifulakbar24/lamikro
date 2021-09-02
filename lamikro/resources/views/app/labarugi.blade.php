<!DOCTYPE html>
<html lang="id">
    <head>
        @include('app.partials.head')
		<style type="text/css">
			td:first-child {
				width: 60px;
			}
			td {
				font-size: 12px !important;
			}
		</style>
    </head>
    <body class="header-fixed">
        @include('app.partials.header')
        <div class="page-body">
            @include('app.partials.sidebar')
            <div class="page-content-wrapper">
                <div class="page-content-wrapper-inner">
                    <div class="content-viewport none" id="form-password">
                        <div class="row">
                            <div class="col-md-6 col-sm-8 offset-md-3 offset-sm-2">
                                <div class="grid border p-4">
                                	<form id="verify">
	                                    <p class="text-center pb-2">Masukan kata sandi untuk melihat halaman ini.</p>
	                                    <hr>
	                                    <div class="form-group position-relative">
	                                    	<label for="password">Kata Sandi</label>
	                                        <input type="password" class="form-control bg-white" id="password" autocomplete="on" autofocus="autofocus">
	                                        <div class="invalid-feedback" id="password-feedback"></div>
	                                        <i class="password mdi mdi-eye-off" data-id="password"></i>
	                                    </div>
	                                    <div class="form-group pt-2">
	                                        <button class="btn btn-sm btn-danger btn-block font-weight-bold" id="submit">
	                                        	<span id="text">Oke</span>
							        			<i class="mdi mdi-loading mdi-1x mdi-spin none" id="loading"></i>
							        		</button>
	                                    </div>
	                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-viewport none" id="form-report">
			        	<h5 class="font-weight-bold pb-2 text-center" id="accountCompany"></h5>
						<div class="pb-2 d-flex justify-content-md-start justify-content-center">
							<ul class="list-inline">
								<li class="list-inline-item"><a href="./dashboard" class="text-danger">Dashboard</a></li>
								<li class="list-inline-item">></li>
								<li class="list-inline-item text-muted">Laporan Laba Rugi</li>
							</ul>
						</div>
                        <div class="grid border p-4">
                            <small class="font-weight-500 pb-2">Filter Pencarian:</small>
                            <div class="row">
                                <div class="col-sm-5 col">
                                    <select class="custom-select bg-white" id="year">
                                        @for($i=date("Y");$i>=2017;$i--)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-sm-5 col">
                                    <select class="custom-select bg-white" id="month">
                                        <option value="">Hanya Tahun</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 col-3">
                                    <button class="btn btn-sm btn-danger btn-block font-weight-bold" id="search">Cari</button>
                                </div>
                            </div>
                        </div>
                    	<div class="text-center mt-5" id="loader">
                    		<img src="{{asset('images/ajax-loader.gif')}}">
                    	</div>
                    	<div id="labarugi">
	                        <div id="accountSection"></div>
	                        <!-- <small class="text-right font-weight-500 pt-1" id="accountFilter"></small> -->
	                        <div class="d-flex justify-content-end">
	                            <button class="btn btn-sm btn-danger mt-2 mb-4" id="download">
	                                <i class="mdi mdi-download pr-2" id="ico-d"></i>
	                                <i class="mdi mdi-loading pr-2 mdi-spin none" id="ico-l"></i> Unduh PDF 
	                            </button>
	                        </div>
	                    </div>
                    </div>
                </div>
                <!-- FOOTER -->
                <iframe class="none"></iframe>
            </div>
        </div>
        @include('app.partials.footer')
        <script src="{{asset('assets/js/html2pdf.js')}}"></script>
        <script src="{{asset('vendor/jquery/number.js')}}"></script>
        <script src="{{asset('vendor/jquery/date.js')}}"></script>
        <script src="{{asset('api/labarugi.js')}}"></script>
    </body>
</html>