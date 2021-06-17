<!DOCTYPE html>
<html lang="id">
	<head>
		@include('layouts.head')
	</head>
	<body>
		@include('layouts.nav')
		<section class="section-page bg-danger">
			<div class="container text-white">
				<h1 class="display-3 font-weight-bold">Unduh</h1>
				<p>Unduh LAMIKRO untuk smartphone.</p>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-6 text-center mb-5">
						<h2>Google Play</h2>
						<a href="https://play.google.com/store/apps/details?id=alcorp.aldian.akutansi_ukm" target="_blank">
							<img src="{{asset('images/mobile/playstore.png')}}" width="300">
						</a>
					</div>
					<div class="col-md-6 text-center">
						<h2>QR Code</h2>
						<img src="{{asset('images/mobile/qr-code.png')}}">
					</div>
				</div>
			</div>
		</section>
		@include('layouts.footer')
		@include('layouts.script')
	</body>
</html>