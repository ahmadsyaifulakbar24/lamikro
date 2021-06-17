<nav class="navbar navbar-expand-md navbar-light d-flex fixed-top bg-white py-2" id="navigation">
	<div class="container">
		<a class="navbar-brand" href="{{url('/')}}">
			<img src="{{asset('images/logo/lamikro.garuda.png')}}" width="170" alt="LAMIKRO">
		</a>
		<div class="ml-auto">
			<button class="navbar-toggler border-0" type="button" id="menuSidebar" style="outline:none">
				<i class="fa fa-bars"></i>
			</button>
		</div>
		<div class="collapse navbar-collapse float-right" id="menu">
			<ul class="navbar-nav ml-auto">
				@if (\Request::is('fitur'))
				<li class="nav-item active mr-3">
					<a class="nav-link font-weight-bold" href="javascript:void(0)">Fitur</a>
				</li>
				@else
				<li class="nav-item mr-3">
					<a class="nav-link" href="{{url('fitur')}}">Fitur</a>
				</li>
				@endif

				@if (\Request::is('unduh'))
				<li class="nav-item active mr-3">
					<a class="nav-link font-weight-bold" href="javascript:void(0)">Unduh</a>
				</li>
				@else
				<li class="nav-item mr-3">
					<a class="nav-link" href="{{url('unduh')}}">Unduh</a>
				</li>
				@endif

				@if (\Request::is('historical'))
				<li class="nav-item active mr-4">
					<a class="nav-link font-weight-bold" href="javascript:void(0)">Historical</a>
				</li>
				@else
				<li class="nav-item mr-4">
					<a class="nav-link" href="{{url('historical')}}">Historical</a>
				</li>
				@endif

				@if (\Request::is('kontak'))
				<li class="nav-item active mr-3">
					<a class="nav-link font-weight-bold" href="javascript:void(0)">Kontak</a>
				</li>
				@else
				<li class="nav-item mr-3">
					<a class="nav-link" href="{{url('kontak')}}">Kontak</a>
				</li>
				@endif

				<li class="nav-item btn-danger px-2" style="border-radius:100px">
					<a class="nav-link text-white" href="{{url('app')}}">Lamikro Web</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<nav id="sidebar" class="navbar-light">
	<i class="fa fa-times float-right pointer menuClose p-3"></i>
	<div class="container">
		<ul class="navbar-nav ml-auto" style="padding-top: 40px">
			<li class="nav-item btn-danger px-2 my-2 text-center" style="border-radius:100px">
				<a class="nav-link text-white" href="{{url('app')}}">Lamikro Web</a>
			</li>
			<li><hr></li>
			@if (\Request::is('fitur'))
			<li class="nav-item active activeSidebar mr-3">
				<a class="nav-link font-weight-bold" href="javascript:void(0)">Fitur</a>
			</li>
			@else
			<li class="nav-item mr-3">
				<a class="nav-link" href="{{url('fitur')}}">Fitur</a>
			</li>
			@endif

			@if (\Request::is('unduh'))
			<li class="nav-item active activeSidebar mr-3">
				<a class="nav-link font-weight-bold" href="javascript:void(0)">Unduh</a>
			</li>
			@else
			<li class="nav-item mr-3">
				<a class="nav-link" href="{{url('unduh')}}">Unduh</a>
			</li>
			@endif

			@if (\Request::is('historical'))
			<li class="nav-item active activeSidebar mr-4">
				<a class="nav-link font-weight-bold" href="javascript:void(0)">Historical</a>
			</li>
			@else
			<li class="nav-item mr-4">
				<a class="nav-link" href="{{url('historical')}}">Historical</a>
			</li>
			@endif

			@if (\Request::is('kontak'))
			<li class="nav-item active activeSidebar mr-3">
				<a class="nav-link font-weight-bold" href="javascript:void(0)">Kontak</a>
			</li>
			@else
			<li class="nav-item mr-3">
				<a class="nav-link" href="{{url('kontak')}}">Kontak</a>
			</li>
			@endif
		</ul>
	</div>
</nav>
<div class="overlay menuClose"></div>