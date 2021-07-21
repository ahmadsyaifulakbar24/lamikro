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
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-5">
			                    <p class="font-weight-bold">Total Berdasarkan Jenis Kelamin</p>
								<canvas id="chartGender"></canvas>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-5">
			                    <p class="font-weight-bold">Total Berdasarkan Agama</p>
								<canvas id="chartReligion"></canvas>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-5">
			                    <p class="font-weight-bold">Total Berdasarkan Pendidikan</p>
								<canvas id="chartEducation"></canvas>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-5">
			                    <p class="font-weight-bold">Total Berdasarkan Kepemilikan IUMK atau NIB</p>
								<canvas id="chartIUMK"></canvas>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-5">
			                    <p class="font-weight-bold">Total Berdasarkan Kepemilikan NPWP Usaha</p>
								<canvas id="chartNPWP"></canvas>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-5">
			                    <p class="font-weight-bold">Total Berdasarkan Keanggotaan Koperasi</p>
								<canvas id="chartKoperasi"></canvas>
	                    	</div>
	                    	<div class="col-12 mb-5">
			                    <p class="font-weight-bold">Total Berdasarkan Kekayaan Usaha (Asset) per Tahun</p>
								<canvas id="chartAsset"></canvas>
	                    	</div>
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-5">
			                    <p class="font-weight-bold">Total Berdasarkan Provinsi</p>
		                        <div class="grid border mt-2">
		                            <div class="item-wrapper">
		                                <div class="table-responsive">
		                                    <table class="table table-hover">
		                                        <thead>
		                                            <tr>
		                                                <th class="font-weight-bold">Provinsi</th>
		                                                <th class="font-weight-bold">Total</th>
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
	                    	<div class="col-xl-6 col-lg-12 col-md-6 mb-5">
			                    <p class="font-weight-bold">Total Berdasarkan Bidang Usaha</p>
								<div class="grid border mt-2">
		                            <div class="item-wrapper">
		                                <div class="table-responsive">
		                                    <table class="table table-hover">
		                                        <thead>
		                                            <tr>
		                                                <th class="font-weight-bold">Bidang Usaha</th>
		                                                <th class="font-weight-bold">Total</th>
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
		<script src="{{asset('api/admin/dashboard.js')}}"></script>
		<script src="{{asset('assets/vendors/chartjs/chartjs.min.js')}}"></script>
    </body>
</html>