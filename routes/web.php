<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'guest'], function(){ //yang berada didalam group ini hanya untuk yang belum login saja
	Route::get('/login', 'App\Http\Controllers\OtentikasiController@login')->name('login');
	Route::post('/postlogin', 'App\Http\Controllers\OtentikasiController@store');
});


Route::group(['middleware'=>'auth'], function(){ //yang berada didalam group ini hanyta untuk yang sudah login
	Route::get('/', 'App\Http\Controllers\DompetController@index')->name('dompetindex');

	Route::prefix('dompet')->group(function(){
		Route::resource('dompet', 'App\Http\Controllers\DompetController');	
		Route::get('ubahStatus/{id}', 'App\Http\Controllers\DompetController@ubahStatus');

	});

	Route::prefix('kategori')->group(function(){
		Route::resource('kategori', 'App\Http\Controllers\KategoriController');
		Route::get('ubahStatus/{id}', 'App\Http\Controllers\KategoriController@ubahStatus');
	});

	Route::prefix('transaksi')->group(function(){
		Route::resource('transaksi', 'App\Http\Controllers\transaksiController');
		Route::get('index/{id}', 'App\Http\Controllers\transaksiController@index2');
		Route::get('filter', 'App\Http\Controllers\transaksiController@filter');
		Route::post('filter', 'App\Http\Controllers\transaksiController@filterTransaksi')->name('transaksi.filter');
	});

	Route::get('tambahDompetMasuk', 'App\Http\Controllers\TransaksiController@create');

	Route::get('/logout', 'App\Http\Controllers\OtentikasiController@logout')->name('logout');
});