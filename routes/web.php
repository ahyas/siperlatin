<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("welcome");

Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');

Route::get("barang/{kode}/view","BarangController@view")->name("barang.view");

Route::group(['middleware' => 'auth'], function () {
    Route::get('register', 'AuthController@showFormRegister')->name('register');
    Route::post('register', 'AuthController@register');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post("logout", "AuthController@logout")->name("logout");

    Route::get("test","HomeController@test")->name("test");

    Route::get("barang/transaksi","TransaksiController@index")->name("barang.transaksi.index");
    Route::get("barang/transaksi/tambah","TransaksiController@index")->name("barang.transaksi.index");
    Route::get("barang/{kode}/transaksi","BarangController@tambah")->name("barang.transaksi.tambah");

    Route::get("barang","BarangController@index")->name("barang.index");
    Route::get("barang/tambah","BarangController@tambah_barang")->name("barang.tambah_barang");
    Route::post("barang/simpan","BarangController@simpan_barang")->name("barang.simpan_barang");
    Route::get("barang/{id_barang}/hapus","BarangController@hapus")->name("barang.hapus");
    Route::get("barang/{id_barang}/edit", "BarangController@edit")->name("barang.edit");
    Route::post("barang/{id_barang}/update", "BarangController@update")->name("barang.update");
    Route::get("barang/{id_barang}/detail","BarangController@detail")->name("barang.detail");
    Route::get("barang/{id_barang}/detail/tambah","BarangController@tambah_detail")->name("barang.detail.tambah");
    Route::post("barang/{id_barang}/detail/simpan","BarangController@simpan_detail")->name("barang.detail.simpan");
    Route::get("barang/{id_barang}/detail/{id_detail}/edit", "BarangController@edit_detail")->name("barang.detail.edit");
});
