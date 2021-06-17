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
								<li class="list-inline-item text-muted">Daftar Jurnal</li>
							</ul>
						</div>
                        <div class="grid border p-4">
                        	<form id="form-search">
	                            <div class="row">
	                                <div class="col-xl-2 col-lg-3 col-sm-3 col-12">
	                                    <small class="font-weight-500 py-2">Cari Jurnal:</small>
	                                </div>
	                                <div class="col">
	                                    <input type="text" id="search" class="form-control bg-white" autocomplete="off">
	                                </div>
	                                <div class="col-sm-2 col-3">
	                                    <button class="btn btn-sm btn-danger btn-block font-weight-bold">Cari</button>
	                                </div>
	                            </div>
	                        </form>
                        </div>
                        <div class="grid border pt-1">
                            <div class="item-wrapper">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <!-- <th class="font-weight-bold"><i class="mdi mdi-2x mdi-check-all pointer mdi-checkbox-blank-outline"></i></th> -->
                                                <th class="font-weight-bold">Kategori</th>
                                                <th class="font-weight-bold">Keterangan Akun</th>
                                                <th class="font-weight-bold text-right">Nominal</th>
                                                <th class="font-weight-bold">Deskripsi</th>
                                                <th class="font-weight-bold">Tanggal</th>
                                                <!-- <th class="font-weight-bold">
                                                	<i class="mdi mdi-2x mdi-trash-all mdi-trash-can-outline text-danger pointer none" id="check-all"></i>
                                                </th> -->
                                            </tr>
                                        </thead>
                                        <tbody id="table-daftar-jurnal"></tbody>
                                        <tbody id="loading">
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
                        <div id="empty" class="pt-2 pb-4 text-center"></div>
                        <nav class="d-flex justify-content-end">
                        	<ul class="pagination" id="pagination">
                        		<li class="page-item" id="prev">
                        			<a class="page-link" href="javascript:void(0)">
                        				<i class="mdi mdi-chevron-double-left"></i>
                        			</a>
                        		</li>
                        		<li class="page-item" id="next">
                        			<a class="page-link" href="javascript:void(0)">
                        				<i class="mdi mdi-chevron-double-right"></i>
                        			</a>
                        		</li>
                        	</ul>
                        </nav>
                    </div>
                </div>
				<div class="modal fade" id="modalJurnal" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content p-2">
							<div class="modal-header border-0">
								<h5 class="modal-title">Hapus Jurnal</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Anda yakin ingin menghapus <span class="font-weight-bold" id="jurnalName"></span>?
							</div>
							<div class="modal-footer border-0">
								<button type="button" class="btn btn-transparent border-0" data-dismiss="modal">Batal</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal" id="jurnalId">Hapus</button>
							</div>
						</div>
					</div>
				</div>
                <!-- FOOTER -->
			</div>
		</div>
        @include('app.partials.footer')
        <script type="text/javascript" src="{{asset('vendor/jquery/date.js')}}"></script>
        <script type="text/javascript" src="{{asset('vendor/jquery/number.js')}}"></script>
        <script type="text/javascript" src="{{asset('api/daftar-jurnal.js')}}"></script>
        <script type="text/javascript" src="{{asset('api/daftar-jurnal-delete.js')}}"></script>
    </body>
</html>