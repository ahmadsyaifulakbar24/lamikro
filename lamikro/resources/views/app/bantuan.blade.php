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
								<li class="list-inline-item text-muted">Bantuan</li>
							</ul>
						</div>
						<div class="grid border">
                            <div class="grid-body">
                                <div class="item-wrapper">
                                	<div class="row" id="accordion">
                                		<div class="col-12 d-block d-lg-none">
                                			<div class="grid border pointer p-3" data-toggle="collapse" data-target="#c1" aria-expanded="false" aria-controls="c1">
                                				<p class="font-weight-500">
                                					Saya kesulitan dalam mencetak PDF
                                					<i class="mdi mdi-chevron-down float-right"></i>
                                				</p>
                                				<div class="collapse" id="c1" aria-labelledby="c1" data-parent="#accordion">
                                					<p class="pt-3 pr-3">
                                						Apabila anda kesulitan dalam mencetak PDF, silahkan cetak melalui versi web LAMIKRO <a href="https://lamikro.com/app" class="text-danger font-weight-500">disini</a>.
                                					</p>
                                				</div>
                                			</div>
                                		</div>
                                		<div class="col-12">
                                			<div class="grid border pointer p-3" data-toggle="collapse" data-target="#c2" aria-expanded="false" aria-controls="c2">
                                				<p class="font-weight-500">
                                					Saya ingin mengunduh Modul Laporan Keuangan
                                					<i class="mdi mdi-chevron-down float-right"></i>
                                				</p>
                                				<div class="collapse" id="c2" aria-labelledby="c2" data-parent="#accordion">
                                					<p class="pt-3 pr-3">
                                						<a href="{{asset('pdf/Modul%20Laporan%20Keuangan%20(Lap.%20Posisi%20Keuangan%20dan%20Lap.%20Rugi%20Laba).pdf')}}" target="_blank" class="text-danger">
                                							<button class="btn btn-sm btn-danger">
	                                							<i class="mdi mdi-download"></i>
	                                							<span class="px-1">Unduh</span>
	                                						</button>
                                						</a>
                                					</p>
                                				</div>
                                			</div>
                                		</div>
                                		<div class="col-12">
                                			<div class="grid border pointer p-3" data-toggle="collapse" data-target="#c3" aria-expanded="false" aria-controls="c3">
                                				<p class="font-weight-500">
                                					<span class="mr-3">Saya ingin mengunduh Catatan Laporan Keuangan Entitas & Disclaimer</span>
                                					<i class="mdi mdi-chevron-down float-right"></i>
                                				</p>
                                				<div class="collapse" id="c3" aria-labelledby="c3" data-parent="#accordion">
                                					<p class="pt-3 pr-3">
                                						<a href="{{asset('pdf/Catatan%20Laporan%20Keuangan%20Entitas%20dan%20Discleamer.pdf')}}" target="_blank" class="text-danger">
                                							<button class="btn btn-sm btn-danger">
	                                							<i class="mdi mdi-download"></i>
	                                							<span class="px-1">Unduh</span>
	                                						</button>
                                						</a>
                                					</p>
                                				</div>

                                			</div>
                                		</div>
                                		<div class="col-12">
                                			<div class="grid border pointer p-3" data-toggle="collapse" data-target="#c4" aria-expanded="false" aria-controls="c4">
                                				<p class="font-weight-500">
                                					Saya ingin mengunduh Modul Aktivasi & Penggunaan Lamikro
                                					<i class="mdi mdi-chevron-down float-right"></i>
                                				</p>
                                				<div class="collapse" id="c4" aria-labelledby="c4" data-parent="#accordion">
                                					<p class="pt-3 pr-3">
                                						<a href="{{asset('pdf/Manual Book Lamikro 3.1.pdf')}}" target="_blank" class="text-danger">
                                							<button class="btn btn-sm btn-danger">
	                                							<i class="mdi mdi-download"></i>
	                                							<span class="px-1">Unduh</span>
	                                						</button>
                                						</a>
                                					</p>
                                				</div>
                                			</div>
                                		</div>
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
    </body>
</html>