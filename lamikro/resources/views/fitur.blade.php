<!DOCTYPE html>
<html lang="id">
	<head>
		@include('layouts.head')
	</head>
	<body>
		@include('layouts.nav')
		<section class="section-page bg-danger">
			<div class="container text-white">
				<h1 class="display-3 font-weight-bold">Fitur</h1>
				<p>Fungsi dan Tampilan Pengguna LAMIKRO.</p>
			</div>
		</section>
		<section class="section-feature">
			<div class="container">
				<div class="row">
					<div class="col-xl-6 col-md-4 text-center">
						<img src="{{asset('images/mobile/entri-jurnal.png')}}" class="img-fluid" width="300">
					</div>
					<div class="col-xl-6 col-md-8">
						<h1 class="display-4 font-weight-bold text-lamikro py-3">Entri Jurnal</h1>
						<p class="text-justify">Catatan untuk transaksi akuntansi berdasarkan urutan kronologis, yaitu pada saat transaksi itu terjadi. Semua transaksi akuntansi dicatat melalui jurnal entri yang menunjukkan nama akun, jumlah, dan apakah akun tersebut dicatat di sisi debit atau kredit rekening.</p>
					</div>
				</div>
			</div>
		</section>
		<section class="section-feature">
			<div class="container">
				<div class="row flex-md-row-reverse">
					<div class="col-xl-6 col-md-4 text-center">
						<img src="{{asset('images/mobile/daftar-jurnal.png')}}" class="img-fluid" width="300">
					</div>
					<div class="col-xl-6 col-md-8">
						<h1 class="display-4 font-weight-bold text-lamikro py-3">Daftar Jurnal</h1>
						<p class="text-justify">Jurnal adalah rincian semua transaksi keuangan dan akun-akun yang mempengaruhi transaksi tersebut. Daftar semua transaksi keuangan suatu badan usaha atau organisasi yang dicatat secara kronologis dan bertujuan untuk pendataan berdasarkan transaksi yang di input pada Entri Jurnal. Atau bisa disebut sebagai catatan transaksi keuangan yang dicatat (dimasukkan) dalam sebuah jurnal.</p>
					</div>
				</div>
			</div>
		</section>
		<section class="section-feature">
			<div class="container">
				<div class="row">
					<div class="col-xl-6 col-md-4 text-center">
						<img src="{{asset('images/mobile/laba-rugi.png')}}" class="img-fluid" width="300">
					</div>
					<div class="col-xl-6 col-md-8">
						<h1 class="display-4 font-weight-bold text-lamikro py-3">Laba & Rugi</h1>
						<p class="text-justify">Bagian dari laporan keuangan suatu perusahaan yang dihasilkan pada suatu periode akuntansi yang menjabarkan unsur-unsur pendapatan dan beban perusahaan sehingga menghasilkan suatu laba (atau rugi) bersih.</p>
					</div>
				</div>
			</div>
		</section>
		<section class="section-feature">
			<div class="container">
				<div class="row flex-md-row-reverse">
					<div class="col-xl-6 col-md-4 text-center">
						<img src="{{asset('images/mobile/neraca.png')}}" class="img-fluid" width="300">
					</div>
					<div class="col-xl-6 col-md-8">
						<h1 class="display-4 font-weight-bold text-lamikro py-3">Neraca</h1>
						<p class="text-justify">Bagian dari laporan keuangan suatu entitas yang dihasilkan pada suatu periode akuntansi yang menunjukkan posisi keuangan entitas tersebut pada akhir periode tersebut.</p>
					</div>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="container text-center bg-danger rounded py-5">
					<h4 class="font-weight-bold text-white pb-3">Unduh LAMIKRO sekarang!</h4>
					<a href="https://play.google.com/store/apps/details?id=alcorp.aldian.akutansi_ukm" target="_blank">
						<img src="{{asset('images/download/google.play.png')}}" width="150">
					</a>
			</div>
		</section>
		@include('layouts.footer')
		@include('layouts.script')
	</body>
</html>