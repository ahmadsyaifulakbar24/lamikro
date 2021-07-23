<!DOCTYPE html>
<html lang="id">
    <head>
    	<title>Dashboard Admin • LAMIKRO</title>
    	@include('app.partials.head')
    </head>
	<body class="header-fixed">
		@include('app.partials.header')
		<div class="page-body">
			@include('app.partials.sidebar')
			<div class="page-content-wrapper">
				<div class="page-content-wrapper-inner">
					<div class="content-viewport">
	                    <h5 class="font-weight-bold mb-4">Dashboard</h5>
	                    <div class="row">
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-4">
	                    		<div class="grid border p-4" style="height:100%">
				                    <h6 class="font-weight-bold pb-3">Total Berdasarkan Jenis Kelamin</h6>
									<canvas id="chartGender"></canvas>
									<div class="d-flex flex-column" id="gender"></div>
								</div>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-4">
	                    		<div class="grid border p-4" style="height:100%">
				                    <h6 class="font-weight-bold pb-3">Total Berdasarkan Agama</h6>
									<canvas id="chartReligion"></canvas>
									<div class="d-flex flex-column" id="religion"></div>
								</div>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-4">
	                    		<div class="grid border p-4" style="height:100%">
				                    <h6 class="font-weight-bold pb-3">Total Berdasarkan Pendidikan</h6>
									<canvas id="chartEducation"></canvas>
									<div class="d-flex flex-column" id="education"></div>
								</div>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-4">
	                    		<div class="grid border p-4" style="height:100%">
				                    <h6 class="font-weight-bold pb-3">Total Berdasarkan Kepemilikan IUMK atau NIB</h6>
									<canvas id="chartIUMK"></canvas>
									<div class="d-flex flex-column" id="iumk"></div>
								</div>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-4">
	                    		<div class="grid border p-4" style="height:100%">
				                    <h6 class="font-weight-bold pb-3">Total Berdasarkan Kepemilikan NPWP Usaha</h6>
									<canvas id="chartNPWP"></canvas>
									<div class="d-flex flex-column" id="npwp"></div>
								</div>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-4">
	                    		<div class="grid border p-4" style="height:100%">
				                    <h6 class="font-weight-bold pb-3">Total Berdasarkan Keanggotaan Koperasi</h6>
									<canvas id="chartKoperasi"></canvas>
									<div class="d-flex flex-column" id="koperasi"></div>
								</div>
	                    	</div>
	                    	<div class="col-12 mb-4">
	                    		<div class="grid border p-4" style="height:100%">
				                    <h6 class="font-weight-bold pb-3">Total Berdasarkan Kekayaan Usaha (Asset) per Tahun</h6>
									<canvas id="chartAsset"></canvas>
									<div class="d-flex flex-column" id="asset"></div>
								</div>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-5">
		                        <div class="grid border">
		                            <div class="item-wrapper">
		                                <div class="table-responsive">
		                                    <table class="table table-hover">
		                                        <thead>
		                                            <tr>
		                                                <th colspan="2">
										                    <h6 class="font-weight-bold py-3">Total Berdasarkan Provinsi</h6>
										                </th>
		                                            </tr>
		                                            <tr>
		                                                <th class="font-weight-bold">Provinsi</th>
		                                                <th class="font-weight-bold text-right">Total</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody id="table-province"></tbody>
		                                        <tbody id="loading-province">
		                                        	<tr>
		                                        		<td colspan="7" class="text-center">
		                                        			<img src="{{asset('images/ajax-loader.gif')}}">
		                                        		</td>
		                                        	</tr>
		                                        </tbody>
		                                    </table>
		                                </div>
		                            </div>
		                        </div>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6">
								<div class="grid border">
		                            <div class="item-wrapper">
		                                <div class="table-responsive">
		                                    <table class="table table-hover">
		                                        <thead>
		                                            <tr>
		                                                <th colspan="2">
										                    <h6 class="font-weight-bold py-3">Total Berdasarkan Bidang Usaha</h6>
										                </th>
		                                            </tr>
		                                            <tr>
		                                                <th class="font-weight-bold">Bidang Usaha</th>
		                                                <th class="font-weight-bold text-right">Total</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody id="table-bidang-usaha"></tbody>
		                                        <tbody id="loading-bidang-usaha">
		                                        	<tr>
		                                        		<td colspan="7" class="text-center">
		                                        			<img src="{{asset('images/ajax-loader.gif')}}">
		                                        		</td>
		                                        	</tr>
		                                        </tbody>
		                                    </table>
		                                </div>
		                            </div>
		                        </div>
	                    	</div>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
        @include('app.partials.footer')
        <script src="{{asset('vendor/jquery/number.js')}}"></script>
		<script src="{{asset('api/admin/dashboard.js')}}"></script>
		<script src="{{asset('assets/vendors/chartjs/chartjs.min.js')}}"></script>
    </body>
</html>