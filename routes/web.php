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

Route::get("transaksi_perawatan/{id_detail_barang}", "TransaksiPerawatanController@detail")->name("transaksi_perawatan.detail");

Route::group(['middleware' => 'auth'], function () {
    Route::get('register', 'AuthController@showFormRegister')->name('register');
    Route::post('register', 'AuthController@register');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get("home/laporan_transaksi","HomeController@laporan_transaksi")->name("home.laporan");
    
    Route::post("logout", "AuthController@logout")->name("logout");

    Route::get("transaksi_perawatan", "TransaksiPerawatanController@index")->name("transaksi_perawatan.index");
    Route::get("transaksi_perawatan/{id_detail_barang}/add", "TransaksiPerawatanController@tambah_transaksi")->name("transaksi_perawatan.tambah");
    Route::post("transaksi_perawatan/{id_detail_barang}/simpan","TransaksiPerawatanController@simpan_transaksi")->name("transaksi_perawatan.simpan");
    Route::get("transaksi_perawatan/{id_transaksi}/{id_detail_barang}/edit", "TransaksiPerawatanController@edit")->name("transaksi_perawatan.edit");
    Route::post("transaksi_perawatan/{id_transaksi}/{id_detail_barang}/update", "TransaksiPerawatanController@update")->name("transaksi_perawatan.update");
    Route::get("transaksi_perawatan/{id_transaksi}/{id_detail_barang}/delete", "TransaksiPerawatanController@delete")->name("transaksi_perawatan.delete");
    Route::get("transaksi_perawatan/daftar_barang", "TransaksiPerawatanController@get_sub_barang")->name("transaksi_perawatan.get_sub_barang");

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
    Route::post("barang/{id_barang}/detail/{id_detail}/update", "BarangController@update_detail")->name("barang.detail.update");
    Route::get("barang/{id_barang}/detail/{id_detail}/delete","BarangController@delete_detail")->name("barang.detail.delete");
    Route::get("barang/pencarian","BarangController@pencarian")->name("barang.pencarian");

    Route::get("satuan_barang", "SatuanBarangController@index")->name("satuan_barang.index");
    Route::get("satuan_barang/tambah", "SatuanBarangController@tambah")->name("satuan_barang.tambah");
    Route::post("satuan_barang/simpan", "SatuanBarangController@simpan")->name("satuan_barang.simpan");
    Route::get("satuan_barang/{id}/edit", "SatuanBarangController@edit")->name("satuan_barang.edit");
    Route::post("satuan_barang/{id}/update", "SatuanBarangController@update")->name("satuan_barang.update");
    Route::get("satuan_barang/{id}/delete", "SatuanBarangController@delete")->name("satuan_barang.delete");

    Route::get("laporan/transaksi","TransaksiController@index")->name("laporan.transaksi.index");
    Route::get("laporan/transakai/print", "TransaksiController@print_transaksi")->name("laporan.transaksi.print");

    Route::get("cetak/qrcode", "QRCodeController@index")->name("cetak.qrcode.index");
    Route::get("cetak/qrcode/print", "QRCodeController@print")->name("cetak.qrcode.print");
});
