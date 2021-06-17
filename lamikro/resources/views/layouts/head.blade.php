		<meta charset="utf-8">
        @if (\Request::is('/'))
		<title>Laporan Akuntansi Usaha Mikro</title>
        @elseif (\Request::is('fitur'))
		<title>Fitur • LAMIKRO</title>
        @elseif (\Request::is('unduh'))
		<title>Unduh • LAMIKRO</title>
        @elseif (\Request::is('kontak'))
		<title>Kontak • LAMIKRO</title>
        @elseif (\Request::is('historical'))
		<title>Historical • LAMIKRO</title>
        @endif
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('vendor/fontawesome/css/all.min.css')}}">
		<link rel="stylesheet" href="{{asset('vendor/theme/style.css')}}">
		<link rel="shorcut icon" href="{{asset('images/logo/logo.ico')}}">
        <script data-ad-client="ca-pub-6148368763442121" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-8NBNGQPDTV"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-8NBNGQPDTV');
		</script>