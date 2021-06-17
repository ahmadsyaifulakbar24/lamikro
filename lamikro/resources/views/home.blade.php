<!DOCTYPE html>
<html lang="id">
	<head>
		@include('layouts.head')
	</head>
	<body>
		@include('layouts.nav')
		<section class="section-one">
			<div class="container">
				<div class="row flex-lg-row-reverse">
					<div class="col-lg-7 col-md-10 my-5">
						<img src="{{asset('images/background/device.png')}}" class="img-fluid">
					</div>
					<div class="col-lg-5 col-md-12">
						<h1 class="display-3 font-weight-bold text-lamikro">LAMIKRO</h1>
						<h5 class="mb-5">Laporan Akuntansi Usaha Mikro.</h5>
						<a href="https://play.google.com/store/apps/details?id=alcorp.aldian.akutansi_ukm" target="_blank">
							<img src="{{asset('images/download/google.play.png')}}" width="150">
						</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="section-about bg-danger">
			<div class="container text-white">
				<h1 class="display-4 text-center font-weight-bold">Aplikasi</h1>
				<div class="row mt-5 text-justify">
					<div class="col-lg-2 col-md-12 pb-3">
						<h4 class="text-right">Pembukuan akuntansi sederhana untuk usaha mikro.</h4>
					</div>
					<div class="col-lg-5 col-md-6">
						<p>Mengembangkan bisnis dengan menggunakan Aplikasi Laporan Keuangan Akuntansi sudah sangat diharuskan, tujuannya agar para pengguna dalam hal ini para penggerak UKM Mikro seluruh Indonesia dapat memonitoring aktfitas keuangan UKM mereka. Aplikasi Laporan Keuangan Akuntansi ini memungkinkan pengguna dapat membuat laporan keuangan dengan lebih cepat dan efisien.</p>
					</div>
					<div class="col-lg-5 col-md-6">
						<p>Aplikasi pembukuan ini dapat diakses kapan saja & di mana saja. Aplikasi ini dirancang untuk menjadi fleksibel dengan banyak pilihan berbasis pengguna. Ini akan beradaptasi dengan berbagai prosedur penganggaran dan cukup kuat untuk menggantikan metode tradisional pencatatan manual.</p>
					</div>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="card mb-4">
							<div class="card-body">
								<i class="fa fa-landmark fa-3x text-lamikro"></i>
								<h4 class="font-weight-bold pt-3">Aset</h4>
								<p class="text-secondary text-justify">Aset diakui dalam laporan posisi keuangan ketika manfaat ekonominya di masa depan dapat dipastikan akan mengalir ke dalam entitas dan aset tersebut memiliki biaya yang dapat diukur dengan andal.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="card mb-4">
							<div class="card-body">
								<i class="fa fa-receipt fa-3x text-lamikro"></i>
								<h4 class="font-weight-bold pt-3">Liabilitas</h4>
								<p class="text-secondary text-justify">Liabilitas diakui dalam laporan posisi keuangan jika pengeluaran sumber daya yang mengandung manfaat ekonomi dipastikan akan dilakukan untuk menyelesaikan kewajiban entitas dan jumlah yang harus diselesaikan dapat diukur secara andal.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="card mb-4">
							<div class="card-body">
								<i class="fa fa-money-bill-wave fa-3x text-lamikro"></i>
								<h4 class="font-weight-bold pt-3">Penghasilan</h4>
								<p class="text-secondary text-justify">Penghasilan diakui dalam laporan laba rugi jika kenaikan manfaat ekonomi di masa depan yang berkaitan dengan kenaikan aset atau penurunan liabilitas telah terjadi dan dapat diukur secara andal.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="card mb-4">
							<div class="card-body">
								<i class="fa fa-percent fa-3x text-lamikro"></i>
								<h4 class="font-weight-bold pt-3">Beban</h4>
								<p class="text-secondary text-justify">Beban diakui dalam laporan laba rugi jika penurunan manfaat ekonomi di masa depan yang berkaitan dengan penurunan aset atau kenaikan liabilitas telah terjadi dan dapat diukur secara andal.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="card mb-4">
							<div class="card-body">
								<i class="fa fa-balance-scale fa-3x text-lamikro"></i>
								<h4 class="font-weight-bold pt-3">Ekuitas</h4>
								<p class="text-secondary text-justify">Ekuitas adalah hak residual atas aset setelah dikurangi seluruh liabilitasnya.</p>
							</div>
						</div>
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