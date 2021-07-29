<!DOCTYPE html>
<html lang="id">
	<head>
		@include('layouts.head')
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
	<body>
		@include('layouts.nav')
		<section class="section-page bg-danger">
			<div class="container text-white">
				<h1 class="display-3 font-weight-bold">Kontak</h1>
				<p>Kementerian Koperasi Usaha Kecil dan Menengah Republik Indonesia.</p>
			</div>
		</section>
		<section>
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 mb-2">
                        <div class="card p-4">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-fw fa-map-marker-alt fa-3x"></i>
                                </div>
                                <div class="col">
                                    <h5 class="font-weight-bold">Alamat Kantor</h5>
                                    <small class="text-secondary">
                                        Deputi Bidang Pengembangan Sumber Daya Manusia (SDM), Jl. H.R. Rasuna Said Kav. 3-4, Lantai 3 Jakarta Selatan, Jakarta 12940
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 mb-2">
                        <div class="card p-4">
                            <div class="row">
                                <div class="col-3">
                                    <i class="far fa-fw fa-envelope fa-3x"></i>
                                </div>
                                <div class="col subrek">
                                    <h5 class="font-weight-bold">Email</h5>
                                    <small class="text-secondary">infolamikro@kemenkopukm.go.id</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 mb-2">
                        <div class="card p-4">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-fw fa-phone fa-3x"></i>
                                </div>
                                <div class="col">
                                    <h5 class="font-weight-bold pb-3">Kontak</h5>
                                    <p class="my-2">Fasilitator : </p>
                                    <small class="text-secondary">
                                        <ol class="pl-4">
                                            <li class="mb-2">
                                                Luluk Syofiatun Ekaningsih<br>
                                                +62 822-2570-1225
                                            </li>
                                            <li>
                                                Aditya Bayu<br>
                                                +62 812-1029-4688
                                            </li>
                                        </ol>
                                    </small>
                                    <p class="my-2 pt-2">Technical Support : </p>
                                    <small class="text-secondary">
                                    	Asisten Deputi Pengembangan Kewirausahaan, Deputi Bidang Pengembangan SDM - Kementerian KUMKM RI
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.349439080333!2d106.82859331431764!3d-6.219167062648527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3f79a35f997%3A0x3877c5bc98573b28!2sKementerian%20Koperasi%20dan%20Usaha%20Kecil%20dan%20Menengah%20Republik%20Indonesia!5e0!3m2!1sid!2sid!4v1573619052628!5m2!1sid!2sid" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" class="mt-3"></iframe>
                    </div>
                </div>
            </div>
        </section>
		@include('layouts.footer')
		@include('layouts.script')
	</body>
</html>