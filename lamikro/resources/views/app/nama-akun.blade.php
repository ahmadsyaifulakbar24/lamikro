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
            	<h5 class="font-weight-bold pb-2 text-center" id="accountCompany"></h5>
                <div class="page-content-wrapper-inner">
                    <div class="content-viewport">
						<div class="pb-2 d-flex justify-content-md-start justify-content-center">
							<ul class="list-inline">
								<li class="list-inline-item"><a href="./dashboard" class="text-danger">Dashboard</a></li>
								<li class="list-inline-item">></li>
								<li class="list-inline-item text-muted">Nama Akun</li>
							</ul>
						</div>
                        <div class="grid border p-4">
                            <div class="row">
                                <div class="col-xl-2 col-lg-3 col-sm-3 col-12">
                                    <small class="font-weight-500 py-2">Cari Nama Akun:</small>
                                </div>
                                <div class="col">
                                    <input type="search" name="search" class="form-control bg-white">
                                </div>
                                <div class="col-sm-2 col-3">
                                    <button class="btn btn-sm btn-danger btn-block font-weight-bold">Cari</button>
                                </div>
                            </div>
                        </div>
                        <div class="grid border pt-1">
                            <div class="item-wrapper">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="font-weight-bold">Kode</th>
                                                <th class="font-weight-bold" width="500">Nama Akun</th>
                                                <th class="font-weight-bold">Grup</th>
                                                <th class="font-weight-bold">R/L or Neraca</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-nama-akun">
                                        	<tr>
                                        		<td colspan="4" class="text-center">
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
                <!-- FOOTER -->
            </div>
        </div>
        @include('app.partials.footer')
        <script type="text/javascript" src="{{asset('api/nama-akun.js')}}"></script>
    </body>
</html>