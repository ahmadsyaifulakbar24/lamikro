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
								<li class="list-inline-item text-muted">Historical</li>
							</ul>
						</div>
                        <div class="grid border">
                            <div class="grid-body">
                                <div class="item-wrapper">
                                    <div class="row">
                                        <div class="col-auto text-center flex-column d-sm-flex">
                                            <div class="row h-50">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                            <h5 class="m-2">
                                                <!-- <span class="badge badge-pill bg-danger border px-3">&nbsp;</span> -->
                                                <span class="px-3 py-1" style="border-radius:100px;background:rgba(231,76,60,1)!important;"></span>
                                            </h5>
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="col col-xl-10 py-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <!-- <div class="float-right text-muted">Mon, Jan 9th 2019 7:00 AM</div> -->
                                                    <h6 class="pb-3">Versi 3.0 (2020)</h6>
                                                    <ol class="pl-4">
                                                        <li>Pembuatan tampilan baru Aplikasi Lamikro yang lebih fresh dan ciamik.</li>
                                                        <li>Perombakan struktur database supaya pengaksesan jauh lebih cepat, tercatat pengguna Aplikasi Lamikro sudah lebih dari 24.000 Pengguna Aktif.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto text-center flex-column d-sm-flex">
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                            <h5 class="m-2">
                                                <span class="px-3 py-1 bg-light" style="border-radius:100px"></span>
                                            </h5>
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="col col-xl-10 py-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="pb-3">Versi 2.1 (2019)</h6>
                                                    <ol class="pl-4">
                                                        <li>Pembuatan kata sandi untuk masuk kedalam Laba Rugi dan Neraca (Posisi Keuangan).</li>
                                                        <li>Perbaikan query data supaya lebih stabil dan cepat diakses.</li>
                                                        <li>Pembuatan user level untuk otorisasi Lembaga Keuangan.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto text-center flex-column d-sm-flex">
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                            <h5 class="m-2">
                                                <span class="px-3 py-1 bg-light" style="border-radius:100px"></span>
                                            </h5>
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="col col-xl-10 py-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="pb-3">Versi 2.0 (2018)</h6>
                                                    <ol class="pl-4">
                                                        <li>Pembuatan homepage (beranda awal) Aplikasi Lamikro.</li>
                                                        <li>Pembuatan dan Upload Aplikasi versi Andorid (Google Play Store).</li>
                                                        <li>Security website Aplikasi Lamikro (SSL Secure).</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto text-center flex-column d-sm-flex">
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                            <h5 class="m-2">
                                                <span class="px-3 py-1 bg-light" style="border-radius:100px"></span>
                                            </h5>
                                            <div class="row h-50">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="col col-xl-10 py-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="pb-3">Versi 1.0 (2017)</h6>
                                                    <ol class="pl-4">
                                                        <li>Pembuatan sistem login dan daftar akun pengguna pada Aplikasi Laporan Akuntansi Usaha Mikro (Lamikro) yang didalamnya terdapat fitur Laba Rugi dan Neraca (Posisi Keuangan).</li>
                                                        <li>Pembuatan user monitoring jumlah pengguna Aplikasi Lamikro.</li>
                                                        <li>Pembuatan modul penggunaan Aplikasi Lamikro.</li>
                                                    </ol>
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