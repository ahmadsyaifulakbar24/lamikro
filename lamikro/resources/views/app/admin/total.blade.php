<!DOCTYPE html>
<html lang="id">
	<head>
    	<meta charset="utf-8">
        <title>Admin • LAMIKRO</title>
        <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/shared/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/light/style.css')}}">
        <link rel="shortcut icon" href="{{asset('images/logo/logo.ico')}}" />
        <style type="text/css">
			.font-weight-500 {
			    font-weight: 500 !important;
			}
			.form-group label {
			    font-weight: bold !important;
			}
			.grid-header {
			    border-left: 3px solid #db504a !important;
			}
			.header-footer small {
			    font-size: 10px !important;
			    color: #525c5d !important;
			}
			.background {
			    background-size: cover !important;
			    background-position: center !important;
			    background-repeat: no-repeat !important;
			}
			.active {
			    background: rgba(231, 76, 60, 0.1) !important;
			    border-top-right-radius: 100px;
			    border-bottom-right-radius: 100px;
			}
			.sidebar .navigation-menu li {
			    margin-right: 20px;
			}
			.sidebar .navigation-menu li:hover {
			    background-color: rgba(241, 242, 246, 0.5);
			    border-top-right-radius: 100px;
			    border-bottom-right-radius: 100px;
			}
			.sidebar .navigation-menu li.nav-category-divider:hover {
			    background-color: #ffffff;
			}
			.navbar-dropdown .dropdown-body .dropdown-list {
			    color: #525c5d;
			}
			.navbar-dropdown .dropdown-body .dropdown-list:hover {
			    background-color: rgba(236, 240, 241, 0.5);
			}
			.submenu-hover {
			    background-color: rgba(241, 242, 246, 0.5);
			    border-top-right-radius: 100px;
			    border-bottom-right-radius: 100px;
			}
			.text-mute {
			    color: #525c5d;
			}
			.password {
			    position: absolute;
			    right: 0px;
			    top: 30px;
			    cursor: pointer;
			    color: rgb(0,0,0,0.5);
			    padding: 5px 10px;
			}
			.none {
			    display: none;
			}
			.list-inline-item {
				/*font-size: 12px !important;*/
			}
			/*a .grid {
				transition: 0.2s;
			}*/
			/*a .grid:hover {
				transform: scale(1.05);
			}*/
			footer small {
				font-size: 10px;
			}
		</style>
	</head>
	<body class="header-fixed">
        <nav class="t-header">
            <div class="t-header-content-wrapper bg-white border-bottom">
                <div class="t-header-brand-wrapper border-bottom">
                    <a href="{{url('app/dashboard')}}">
	                    <img class="d-none d-lg-block" src="{{asset('images/logo/lamikro.garuda.png')}}" width="180">
                    </a>
                </div>
                <div class="t-header-content">
                    <button class="t-header-toggler t-header-mobile-toggler d-block d-lg-none">
                        <i class="mdi mdi-menu mdi-2x"></i>
                    </button>
                    <ul class="nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="appsDropdown" data-toggle="dropdown" aria-expanded="false">
                                <img class="profile-img img-md rounded-circle accountAvatar" src="{{asset('images/profile/user.png')}}" alt="Avatar">
                            </a>
                            <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="appsDropdown">
                                <div class="dropdown-header">
                                    <img class="profile-img img-lg rounded-circle accountAvatar mb-4" src="{{asset('images/profile/user.png')}}" alt="Avatar">
                                    <p class="dropdown-title font-weight-bold" id="accountName"></p>
                                    <p class="dropdown-title-text" id="accountEmail"></p>
                                </div>
                                <div class="dropdown-body border-top py-2">
                                    <a class="dropdown-list text-danger py-1" href="javascript:void(0)" id="logout">
                                        <div class="image-wrapper">
                                            <i class="mdi mdi-exit-to-app mdi-2x"></i>
                                        </div>
                                        <div class="content-wrapper">
                                            <small class="name pl-2">Keluar</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="overlay"></div>
		<div class="page-body">
			<div class="sidebar">
				<div class="d-lg-none d-block pb-1" style="padding-left:33px">
                    <img src="{{asset('images/logo/lamikro.garuda.png')}}" width="180">
                </div>
				<ul class="navigation-menu">
					<li class="active">
						<a href="{{url('app/admin')}}">
							<span class="link-title">Dashboard</span>
							<i class="mdi mdi-2x mdi-apps link-icon"></i>
						</a>
					</li>
				</ul>
			</div>
			<div></div>
			<div class="page-content-wrapper">
				<div class="page-content-wrapper-inner">
					<div class="content-viewport">
	                    <p class="font-weight-bold pb-3">Dashboard</p>
        				<h3 class="font-weight-bold">
        					Total Pengguna Lamikro:
        					<span id="total"><i class="mdi mdi-loading mdi-spin"></i></span>
        				</h3><hr>
        				<div class="d-flex justify-content-end">
							<a href="{{ url("app/userExport") }}">
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
        @include('app.partials.footer')
        <script src="{{asset('vendor/jquery/number.js')}}"></script>
		<script src="{{asset('api/admin/total.js')}}"></script>
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