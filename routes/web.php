<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\DompetController@index');

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