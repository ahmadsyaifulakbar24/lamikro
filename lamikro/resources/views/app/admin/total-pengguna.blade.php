<!DOCTYPE html>
<html lang="id">
<head>
	<title>Total Pengguna Lamikro • LAMIKRO</title>
	@include('app.partials.head')
</head>
<body class="header-fixed">
	@include('app.partials.header')
	<div class="page-body">
		@include('app.partials.sidebar')
		<div class="page-content-wrapper">
			<div class="page-content-wrapper-inner">
				<div class="content-viewport">
                    <h5 class="font-weight-bold mb-4">Total Pengguna Lamikro: <span id="total"><i class="mdi mdi-loading mdi-spin"></i></span></h5>
    				<hr>
    				<div class="d-flex justify-content-end">
						<a href="{{ url('app/userExport') }}">
	                    	<button class="btn btn-sm btn-danger mb-4"><i class="mdi mdi-download pr-2"></i> Detail Pengguna</button>
	                    </a>
	                </div>
                    <div class="row">
						@foreach ($userPerTahun as $userTahun)
                    	<div class="col-md-4 col-sm-6 mb-3">
                    		<!-- <a href="{{url('app/nama-akun')}}"> -->
								<div class="grid border background h-100" style="background:url('{{asset('images/background/card.red.png')}}')">	
									<div class="grid-body text-white text-center pb-3">
										<p class="font-weight-bold">Tahun {{ $userTahun->tahun }}</p>
										<h2 class="font-weight-bold pt-3" id="tostal">
											{{ number_format($userTahun->jumlah_user,0,",",".") }}
										</h2>
										<p>Pengguna</p>
									</div>
	                    		</div>
	                    	<!-- </a> -->
						</div>
						@endforeach
					</div>
					<canvas id="totalUser"></canvas>
                </div>
	            <!-- FOOTER -->
	            <footer>
					<div class="container-fluid d-flex flex-column">
						<small class="font-weight-500">"sistem aplikasi ini sudah sesuai dengan SAK EMKM"</small>
						<small class="font-weight-500">Copyright © 2020. Asdep Pengembangan Kewirausahaan - Kementerian KUKM RI</small>
						<small class="font-weight-500">Versi 3.0</small>
					</div>
				</footer>
	        </div>
	    </div>
	</div>
    @include('app.partials.footer')
    <script src="{{asset('vendor/jquery/number.js')}}"></script>
	<script src="{{asset('api/admin.js')}}"></script>
	<script src="{{asset('assets/vendors/chartjs/chartjs.min.js')}}"></script>
	<script>
		$.ajax({
			url: "https://lamikro.com/api/userPerTahun",
			type: "GET",
			dataType: "JSON",
			success: function(result) {
				let data = result.total_user;
				let tahun = []
				let totalUser= []
				$.each(data, function(key, value) {
					tahun.push(value.tahun)
					totalUser.push(value.jumlah_user)
				})
				var ctx = document.getElementById('totalUser').getContext('2d');
				var chart = new Chart(ctx, {
					// The type of chart we want to create
					type: 'bar',

					// The data for our dataset
					data: {
						labels: tahun,
						datasets: [{
							label: 'Time Series Pengguna Lamikro',
							backgroundColor: 'rgb(255, 99, 132)',
							borderColor: 'rgb(255, 99, 132)',
							data: totalUser,
						}]
					},

					// Configuration options go here
					options: {}
				});
			}
		})
	</script>
</body>
</html>