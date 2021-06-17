<?php

Route::get('session/oauth','SessionController@createSession');
Route::get('session/logout','SessionController@deleteSession');

Route::get('/', function() {
    return view('home');
});
Route::get('fitur', function() {
    return view('fitur');
});
Route::get('unduh', function() {
    return view('unduh');
});
Route::get('kontak', function() {
    return view('kontak');
});
Route::get('historical', function() {
    return view('historical');
});

Route::group(['middleware'=>['afterMiddleware']], function () {
	Route::get('app', function() {
	    return view('app/pages/masuk');
	});
	Route::get('app/daftar', function() {
	    return view('app/pages/daftar');
	});
	Route::get('app/reset_password', function() {
	    return view('app/pages/reset_password');
	});
	Route::get('app/new_password', function() {
	    return view('app/pages/new_password');
	});
});

Route::group(['middleware'=>['beforeMiddleware']], function () {
	Route::get('app/dashboard', function() {
		return view('app/dashboard');
	});
	Route::get('app/admin', 'AdminController@adminDashboard');
	Route::get('app/userExport', 'AdminController@userExport');
	
	Route::get('app/nama-akun', function() {
		return view('app/nama-akun');
	});
	Route::get('app/entri-jurnal', function() {
		return view('app/entri-jurnal');
	});
	Route::get('app/daftar-jurnal', function() {
		return view('app/daftar-jurnal');
	});

	Route::get('app/laporan-laba-rugi', function() {
		return view('app/labarugi');
	});
	Route::get('app/labarugi/download/{date}', function($date) {
		return view('app/labarugi-download');
	});
	Route::get('app/laporan-laba-rugi/account/{acc_code}/{date}', function($acc_code, $date) {
		return view('app/labarugi-account');
	});
	Route::get('app/laporan-laba-rugi/transno/{transno}', function($transno) {
		return view('app/labarugi-transno');
	});

	Route::get('app/laporan-posisi-keuangan', function() {
		return view('app/neraca');
	});
	Route::get('app/neraca/download/{date}', function($date) {
		return view('app/neraca-download');
	});
	Route::get('app/laporan-posisi-keuangan/account/{acc_code}/{date}', function($acc_code, $date) {
		return view('app/neraca-account');
	});
	Route::get('app/laporan-posisi-keuangan/transno/{transno}', function($transno) {
		return view('app/neraca-transno');
	});

	Route::get('app/historical', function() {
		return view('app/historical');
	});
	Route::get('app/bantuan', function() {
		return view('app/bantuan');
	});
	Route::get('app/kontak', function() {
		return view('app/kontak');
	});
	Route::get('app/profil', function() {
		return view('app/profil');
	});
	Route::get('app/profil-usaha', function() {
		return view('app/profil-usaha');
	});
	Route::get('app/pengaturan', function() {
		return view('app/pengaturan');
	});
});
