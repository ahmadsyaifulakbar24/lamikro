			<div class="sidebar">
				<div class="d-lg-none d-block pb-1" style="padding-left:33px">
                    <img src="{{asset('images/logo/lamikro.garuda.png')}}" width="180">
                </div>
                @if (session('role') == 'J1')
				<ul class="navigation-menu pb-0">
					<div class="border-bottom pb-2 mb-2">
						<li class="{{Request::is('app/admin')?'active':''}}">
							<a href="{{url('app/admin')}}">
								<span class="link-title">Dashboard</span>
								<i class="mdi mdi-2x mdi-apps link-icon"></i>
							</a>
						</li>
						<li class="{{Request::is('app/total-pengguna')?'active':''}}">
							<a href="{{url('app/total-pengguna')}}">
								<span class="link-title">Total Pengguna</span>
								<i class="mdi mdi-2x mdi-file-document-box-outline link-icon"></i>
							</a>
						</li>
						<li class="{{Request::is('app/management-pengguna')?'active':''}}">
							<a href="{{url('app/management-pengguna')}}">
								<span class="link-title">Management Pengguna</span>
								<i class="mdi mdi-2x mdi-file-document-box-outline link-icon"></i>
							</a>
						</li>
					</div>
				</ul>
				@else
				<ul class="navigation-menu pb-0">
					<div class="border-bottom pb-2 mb-2">
						<li class="{{Request::is('app/dashboard')?'active':''}}">
							<a href="{{url('app/dashboard')}}">
								<span class="link-title">Dashboard</span>
								<i class="mdi mdi-2x mdi-apps link-icon"></i>
							</a>
						</li>
						<li class="{{Request::is('app/nama-akun')?'active':''}}">
							<a href="{{url('app/nama-akun')}}">
								<span class="link-title">Nama Akun</span>
								<i class="mdi mdi-2x mdi-file-document-box-outline link-icon"></i>
							</a>
						</li>
						<li class="{{Request::is('app/entri-jurnal')?'active':''}}">
							<a href="{{url('app/entri-jurnal')}}">
								<span class="link-title">Entri Jurnal</span>
								<i class="mdi mdi-2x mdi-pencil-outline link-icon"></i>
							</a>
						</li>
						<li class="{{Request::is('app/daftar-jurnal')?'active':''}}">
							<a href="{{url('app/daftar-jurnal')}}">
								<span class="link-title">Daftar Jurnal</span>
								<i class="mdi mdi-2x mdi-notebook-outline link-icon"></i>
							</a>
						</li>
						<li id="laporan-li">
							<a href="javascript:void(0)" id="laporan">
								<span class="link-title">Laporan</span>
								<i class="mdi mdi-2x mdi-chevron-down link-icon" id="laporan-icon"></i>
							</a>
						</li>
						<div id="laporan-submenu" style="display:none">
							<li class="{{Request::is('app/laporan-laba-rugi')?'active':''}}">
								<a href="{{url('app/laporan-laba-rugi')}}" class="ml-3">
									<span class="link-title">Laba Rugi</span>
									<i class="mdi mdi-2x mdi-file-document-box-search-outline link-icon"></i>
								</a>
							</li>
							<li class="{{Request::is('app/laporan-posisi-keuangan')?'active':''}}">
								<a href="{{url('app/laporan-posisi-keuangan')}}" class="ml-3">
									<span class="link-title">Posisi Keuangan</span>
									<i class="mdi mdi-2x mdi-scale-balance link-icon"></i>
								</a>
							</li>
						</div>
					</div>
				</ul>
				@endif
				<ul class="navigation-menu mt-0">
					<div class="border-bottom pb-2 mb-2">
						<li class="{{Request::is('app/bantuan')?'active':''}}">
							<a href="{{url('app/bantuan')}}">
								<span class="link-title">Bantuan</span>
								<i class="mdi mdi-2x mdi-help-circle link-icon"></i>
							</a>
						</li>
						<li class="{{Request::is('app/kontak')?'active':''}}">
							<a href="{{url('app/kontak')}}">
								<span class="link-title">Kontak</span>
								<i class="mdi mdi-2x mdi-phone link-icon"></i>
							</a>
						</li>
					</div>
					<li class="{{Request::is('app/historical')?'active':''}}">
						<a href="{{url('app/historical')}}">
							<span class="link-title">Historical</span>
							<i class="mdi mdi-2x mdi-history link-icon"></i>
						</a>
					</li>
				</ul>
			</div>
			<div></div>