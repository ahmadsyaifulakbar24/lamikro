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
                                @if (session('role') != 'J1')
                                <div class="dropdown-body border-top py-2">
                                    <a class="dropdown-list border-0 py-1" href="{{url('app/profil')}}">
                                        <div class="image-wrapper">
                                            <i class="mdi mdi-account-circle mdi-2x"></i>
                                        </div>
                                        <div class="content-wrapper">
                                            <small class="name pl-2">Profil</small>
                                        </div>
                                    </a>
                                    <a class="dropdown-list border-0 py-1" href="{{url('app/profil-usaha')}}">
                                        <div class="image-wrapper">
                                            <i class="mdi mdi-storefront mdi-2x"></i>
                                        </div>
                                        <div class="content-wrapper">
                                            <small class="name pl-2">Profil Usaha</small>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                <div class="dropdown-body border-top py-2">
                                    <a class="dropdown-list border-0 py-1" href="{{url('app/pengaturan')}}">
                                        <div class="image-wrapper">
                                            <i class="mdi mdi-settings-outline mdi-2x"></i>
                                        </div>
                                        <div class="content-wrapper">
                                            <small class="name pl-2">Pengaturan</small>
                                        </div>
                                    </a>
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