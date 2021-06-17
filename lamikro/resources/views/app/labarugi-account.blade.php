<!DOCTYPE html>
<html lang="id">
    <head>    	
    	<meta charset="utf-8">
        <title> • LAMIKRO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{asset('/assets/vendors/iconfonts/mdi/css/materialdesignicons.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/shared/style.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/light/style.css')}}">
        <link rel="shortcut icon" href="{{asset('/images/logo/logo.ico')}}" />
        <style type="text/css">
            .font-weight-500 {
                font-weight: 500 !important;
            }
            .form-group label {
                font-weight: 500 !important;
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
        </style>
    </head>
    <body class="header-fixed">
        @include('app.partials.header')
        <div class="page-body">
            @include('app.partials.sidebar')
            <div class="page-content-wrapper">
	        	<h5 class="font-weight-bold pb-2 text-center" id="accountCompany"></h5>
                <div class="page-content-wrapper-inner">
                    <div class="content-viewport">
						<div class="pb-2 d-flex justify-content-md-start justify-content-center">
							<ul class="list-inline">
								<li class="list-inline-item"><a href="../../../laporan-laba-rugi" class="text-danger">Laporan Laba Rugi</a></li>
								<li class="list-inline-item">></li>
								<li class="list-inline-item text-muted acc_name">Account</li>
							</ul>
						</div>
                    	<div class="grid border">
                    		<div class="item-wrapper pt-1">
                    			<div class="table-responsive">
					                <table class="table table-hover">
					                    <thead>
					                        <tr>
					                            <th class="font-weight-bold">Tanggal</th>
					                            <th class="font-weight-bold text-right">Debit</th>
					                            <th class="font-weight-bold text-right">Kredit</th>
					                            <th class="font-weight-bold">Keterangan</th>
					                        </tr>
					                    </thead>
					                    <tbody id="journalReport"></tbody>
					                </table>
					            </div>
                    		</div>
                    	</div>
                        <!-- <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-danger mt-2">
                                <i class="mdi mdi-download pr-2"></i> Unduh PDF
                            </button>
                        </div> -->
                    </div>
                </div>
                <!-- FOOTER -->
            </div>
        </div>
        @include('app.partials.footer')
        <script type="text/javascript">const acc_code = '{{Request::route("acc_code")}}'</script>
        <script type="text/javascript">const date = '{{Request::route("date")}}'</script>
        <script type="text/javascript" src="{{asset('vendor/jquery/number.js')}}"></script>
        <script type="text/javascript" src="{{asset('api/labarugi-account.js')}}"></script>
    </body>
</html>