<!DOCTYPE html>
<html lang="id">
	<head>
		@include('app.partials.head')
		<style type="text/css">
			.subrek {
				overflow-wrap: break-word;
				word-wrap: break-word;
				word-break: break-all;
				word-break: break-word;
				hyphens: auto;
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
						<div class="pb-2 d-flex justify-content-md-start justify-content-center">
							<ul class="list-inline">
								<li class="list-inline-item"><a href="./dashboard" class="text-danger">Dashboard</a></li>
								<li class="list-inline-item">></li>
								<li class="list-inline-item text-muted">Kontak</li>
							</ul>
						</div>
						<div class="grid border">
                            <div class="grid-body">
                                <div class="item-wrapper">
                                	<div class="row">
                                		<div class="col-12 mb-4 pb-4 border-bottom">
                                			<p class="font-weight-bold"><i class="mdi mdi-account-multiple mdi-1x pr-2"></i>Fasilitator</p>
		                                    <p class="pl-4">Luluk Syofiatun Ekaningsih: +62 822-2570-1225</p>
		                                    <p class="pl-4">Aditya Bayu: +62 812-1029-4688</p>
		                                </div>
                                		<div class="col-12 mb-4 pb-4 border-bottom subrek">
                                			<p class="font-weight-bold"><i class="mdi mdi-email-outline mdi-1x pr-2"></i>Email</p>
		                                    <p class="pl-4">infolamikro@kemenkopukm.go.id</p>
		                                </div>
                                		<div class="col-12">
                                			<p class="font-weight-bold"><i class="mdi mdi-map-marker-outline mdi-1x pr-2"></i>Alamat</p>
		                                    <p class="pl-4">Kantor Kementerian Koperasi dan UKM RI, Gedung Annex Lt.3, Jl. HR. Rasuna Said Kav 3-4 Jakarta Selatan</p>
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