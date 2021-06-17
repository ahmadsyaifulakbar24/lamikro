    	<meta charset="utf-8">
        
        @if (\Request::is('app'))
        <title>Masuk • LAMIKRO</title>

        @elseif (\Request::is('app/daftar'))
        <title>Daftar • LAMIKRO</title>

        @elseif (\Request::is('app/reset_password'))
        <title>Atur Ulang Kata Sandi • LAMIKRO</title>

        @elseif (\Request::is('app/new_password'))
        <title>Buat Kata Sandi Baru • LAMIKRO</title>

        @elseif (\Request::is('app/dashboard'))
        <title>Dashboard • LAMIKRO</title>

        @elseif (\Request::is('app/nama-akun'))
        <title>Nama Akun • LAMIKRO</title>

        @elseif (\Request::is('app/entri-jurnal'))
        <title>Entri Jurnal • LAMIKRO</title>

        @elseif (\Request::is('app/daftar-jurnal'))
        <title>Daftar Jurnal • LAMIKRO</title>

        @elseif (\Request::is('app/laporan-laba-rugi'))
        <title>Laporan Laba Rugi • LAMIKRO</title>

        @elseif (\Request::is('app/laporan-posisi-keuangan'))
        <title>Laporan Posisi Keuangan • LAMIKRO</title>

        @elseif (\Request::is('app/bantuan'))
        <title>Bantuan • LAMIKRO</title>

        @elseif (\Request::is('app/historical'))
        <title>Historical • LAMIKRO</title>

        @elseif (\Request::is('app/kontak'))
        <title>Kontak • LAMIKRO</title>
        
        @elseif (\Request::is('app/profil'))
        <title>Profil • LAMIKRO</title>

        @elseif (\Request::is('app/profil-usaha'))
        <title>Profil Usaha • LAMIKRO</title>

        @elseif (\Request::is('app/pengaturan'))
        <title>Pengaturan • LAMIKRO</title>

        @elseif (\Request::is('app/masukan'))
        <title>Kirim Masukan • LAMIKRO</title>

        @endif
        <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/shared/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/light/style.css')}}">
        <link rel="shortcut icon" href="{{asset('images/logo/logo.ico')}}" />
        <script data-ad-client="ca-pub-9788717261813063" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-8NBNGQPDTV"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-8NBNGQPDTV');
		</script>
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
        </style>