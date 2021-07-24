<!DOCTYPE html>
<html lang="id">
    <head>
    	<title>Management Pengguna • LAMIKRO</title>
    	@include('app.partials.head')
    </head>
    <body class="header-fixed">
    	@include('app.partials.header')
        <div class="page-body">
        	@include('app.partials.sidebar')
            <div class="page-content-wrapper">
                <div class="page-content-wrapper-inner">
                    <div class="content-viewport">
                    	<h5 class="font-weight-bold mb-4">Management Pengguna</h5>
                        <div class="grid border p-4">
                        	<form id="form-search">
	                            <div class="row">
	                                <div class="col-xl-2 col-lg-3 col-sm-3 col-12">
	                                    <small class="font-weight-500 py-2">Cari Pengguna:</small>
	                                </div>
	                                <div class="col">
	                                    <input type="text" id="search" class="form-control bg-white" autocomplete="off" placeholder="Nama Lengkap/Nomor KTP/Nama Akun">
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
                                                <th class="font-weight-bold text-center">No.</th>
                                                <th class="font-weight-bold">Nama Lengkap</th>
                                                <th class="font-weight-bold">Nomor KTP</th>
                                                <th class="font-weight-bold">Nama Akun</th>
                                                <th class="font-weight-bold">Email</th>
                                                <th class="font-weight-bold">Nomor Telepon</th>
                                                <th class="font-weight-bold">Nama Usaha</th>
                                                <th class="font-weight-bold"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-pengguna"></tbody>
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
                <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content p-2">
							<div class="modal-header border-0">
								<h5 class="modal-title">Hapus Pengguna</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Anda yakin ingin hapus pengguna <span class="font-weight-bold" id="name"></span>?
							</div>
							<div class="modal-footer border-0">
								<button type="button" class="btn btn-transparent border-0" data-dismiss="modal">Batal</button>
								<button type="button" class="btn btn-danger" id="delete">Hapus</button>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
        @include('app.partials.footer')
		<script src="{{asset('api/admin/user.js')}}"></script>
    </body>
</html>