<!DOCTYPE html>
<html lang="id">
	<head>
		@include('app.partials.head')
		<style type="text/css">
			a .grid {
				transition: 0.2s;
			}
			a .grid:hover {
				transform: scale(1.05);
			}
			footer small {
				font-size: 10px;
			}
		</style>
	</head>
	<body class="header-fixed">
		@include('app.partials.header')
		<div class="page-body">
			@include('app.partials.sidebar')
			<div class="page-content-wrapper">
				<div class="page-content-wrapper-inner">
					<div class="content-viewport">
						<div class="row">
	                        <div class="col-sm-4 equel-grid">
	                        	<div class="grid border">
	                        		<div class="grid-body">
	                        			<div class="user-profile text-center">
	                        				<img class="profile-img img-lg rounded-circle" src="{{asset('images/store/business.svg')}}" alt="Foto Usaha">
	                        				<div class="info-wrapper">
	                        					<h6 class="user-name mt-3" id="nama_usaha"><i class="mdi mdi-loading mdi-2x mdi-spin"></i></h6>
	                        				</div>
	                        			</div>
	                        		</div>
	                        	</div>
	                        </div>
	                        <div class="col-sm-8 equel-grid">
	                        	<div class="grid border">
	                        		<div class="grid-body">
	                        			<a href="profil-usaha" class="float-right text-danger">
	                        				<i class="mdi mdi-pencil pr-1"></i>Ubah
	                        			</a>
	                        			<p class="font-weight-bold pb-3">Profil Usaha</p>
	                        			<hr class="mt-0">
	                        			<div class="row">
	                        				<div class="col-3">Nomor IUMK atau NIB</div>
	                        				<div class="col-1">:</div>
	                        				<div class="col-8" id="iumk"><i class="mdi mdi-loading mdi-2x mdi-spin"></i></div>
	                        			</div>
	                        			<div class="row">
	                        				<div class="col-3">Alamat Usaha</div>
	                        				<div class="col-1">:</div>
	                        				<div class="col-8" id="alamat_usaha"><i class="mdi mdi-loading mdi-2x mdi-spin"></i></div>
	                        			</div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <p class="font-weight-bold py-3 pt-4">Menu Utama</p>
	                    <div class="row">
	                    	<div class="col-xl-3 col-md-4 col-6 mb-3">
	                    		<a href="{{url('app/nama-akun')}}">
		                    		<div class="grid border background h-100" style="background:url('{{asset('images/background/card.red.png')}}')">
		                    			<div class="grid-body text-white">
		                    				<i class="mdi mdi-4x mdi-file-document-box-outline"></i>
		                    				<p class="font-weight-bold">Nama Akun</p>
		                    			</div>
		                    		</div>
		                    	</a>
	                    	</div>
	                    	<div class="col-xl-3 col-md-4 col-6 mb-3">
	                    		<a href="{{url('app/entri-jurnal')}}">
		                    		<div class="grid border background h-100" style="background:url('{{asset('/images/background/card.red.png')}}')">
		                    			<div class="grid-body text-white">
		                    				<i class="mdi mdi-4x mdi-pencil-outline"></i>
		                    				<p class="font-weight-bold">Entri Jurnal</p>
		                    			</div>
		                    		</div>
		                    	</a>
	                    	</div>
	                    	<div class="col-xl-3 col-md-4 col-6 mb-3">
	                    		<a href="{{url('app/daftar-jurnal')}}">
		                    		<div class="grid border background h-100" style="background:url('{{asset('/images/background/card.red.png')}}')">
		                    			<div class="grid-body text-white">
		                    				<i class="mdi mdi-4x mdi-notebook-outline"></i>
		                    				<p class="font-weight-bold">Daftar Jurnal</p>
		                    			</div>
		                    		</div>
		                    	</a>
	                    	</div>
	                    </div>
	                    <p class="font-weight-bold py-3 pt-4">Laporan</p>
	                    <div class="row">
	                    	<div class="col-xl-3 col-md-4 col-6 mb-3">
	                    		<a href="{{url('app/laporan-laba-rugi')}}">
		                    		<div class="grid border background h-100" style="background:url('{{asset('/images/background/card.blue.png')}}')">
		                    			<div class="grid-body text-white">
		                    				<i class="mdi mdi-4x mdi-file-document-box-search-outline"></i>
		                    				<p class="font-weight-bold">Laba Rugi</p>
		                    			</div>
		                    		</div>
		                    	</a>
	                    	</div>
	                    	<div class="col-xl-3 col-md-4 col-6 mb-3">
	                    		<a href="{{url('app/laporan-posisi-keuangan')}}">
		                    		<div class="grid border background h-100" style="background:url('{{asset('/images/background/card.blue.png')}}')">
		                    			<div class="grid-body text-white">
		                    				<i class="mdi mdi-4x mdi-scale-balance"></i>
		                    				<p class="font-weight-bold">Posisi Keuangan</p>
		                    			</div>
		                    		</div>
		                    	</a>
	                    	</div>
	                    </div>
	                    <p class="font-weight-bold py-3 pt-4">Informasi</p>
	                    <div class="row">
	                    	<div class="col-xl-3 col-md-4 col-6 mb-3">
	                    		<a href="{{url('app/bantuan')}}">
		                    		<div class="grid border background h-100" style="background:url('{{asset('/images/background/card.black.png')}}')">
		                    			<div class="grid-body text-white">
		                    				<i class="mdi mdi-4x mdi-help-circle"></i>
		                    				<p class="font-weight-bold">Bantuan</p>
		                    			</div>
		                    		</div>
		                    	</a>
	                    	</div>
	                    	<div class="col-xl-3 col-md-4 col-6 mb-3">
	                    		<a href="{{url('app/kontak')}}">
		                    		<div class="grid border background h-100" style="background:url('{{asset('/images/background/card.black.png')}}')">
		                    			<div class="grid-body text-white">
		                    				<i class="mdi mdi-4x mdi-phone"></i>
		                    				<p class="font-weight-bold">Kontak</p>
		                    			</div>
		                    		</div>
		                    	</a>
	                    	</div>
	                    </div>
	                    <p class="font-weight-bold py-3 pt-4">Tentang</p>
	                    <div class="row">
	                    	<div class="col-xl-3 col-md-4 col-6 mb-3">
	                    		<a href="{{url('app/historical')}}">
		                    		<div class="grid border background h-100" style="background:url('{{asset('/images/background/card.green.png')}}')">
		                    			<div class="grid-body text-white">
		                    				<i class="mdi mdi-4x mdi-history"></i>
		                    				<p class="font-weight-bold">Historical</p>
		                    			</div>
		                    		</div>
		                    	</a>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	            <!-- FOOTER -->
	            <footer class="pb-5">
					<div class="container-fluid d-flex flex-column">
						<small class="font-weight-500">"sistem aplikasi ini sudah sesuai dengan SAK EMKM"</small>
						<small class="font-weight-500">Copyright © 2020. Asdep Pengembangan Kewirausahaan - Kementerian KUKM RI</small>
						<small class="font-weight-500">Versi 3.0</small>
					</div>
				</footer>
	        </div>
	    </div>
        @include('app.partials.footer')
        <script type="text/javascript" src="{{asset('api/dashboard.js')}}"></script>
    </body>
</html>