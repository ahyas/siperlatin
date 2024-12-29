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

    Route::get('ruang', 'RuangController@index')->name('ruang.index');
    Route::get('ruang/tambah', 'RuangController@tambah')->name('ruang.tambah');
    Route::post('ruang/simpan', 'RuangController@simpan')->name('ruang.simpan');
    Route::get('ruang/{id}/edit', 'RuangController@edit')->name('ruang.edit');
    Route::post('ruang/{id}/update', 'RuangController@update')->name('ruang.update');
    Route::get('ruang/{id}/delete', 'RuangController@delete')->name('ruang.delete');

    Route::get('brand', 'BrandController@index')->name('brand.index');
    Route::get('brand/tambah', 'BrandController@tambah')->name('brand.tambah');
    Route::post('brand/simpan', 'BrandController@simpan')->name('brand.simpan');
    Route::get('brand/{id}/edit', 'BrandController@edit')->name('brand.edit');
    Route::post('brand/{id}/update', 'BrandController@update')->name('brand.update');
    Route::get('brand/{id}/destroy', 'BrandController@destroy')->name('brand.destroy');

    Route::get('kuasa_pengguna_barang', 'KuasaPenggunaBarangController@index')->name('kuasa_pengguna_barang.index');
    Route::get('kuasa_pengguna_barang/tambah', 'KuasaPenggunaBarangController@tambah')->name('kuasa_pengguna_barang.tambah');
    Route::post('kuasa_pengguna_barang/simpan', 'KuasaPenggunaBarangController@simpan')->name('kuasa_pengguna_barang.simpan');
    Route::get('kuasa_pengguna_barang/{id}/edit', 'KuasaPenggunaBarangController@edit')->name('kuasa_pengguna_barang.edit');
    Route::post('kuasa_pengguna_barang/{id}/update', 'KuasaPenggunaBarangController@update')->name('kuasa_pengguna_barang.update');

    Route::get("satuan_barang", "SatuanBarangController@index")->name("satuan_barang.index");
    Route::get("satuan_barang/tambah", "SatuanBarangController@tambah")->name("satuan_barang.tambah");
    Route::post("satuan_barang/simpan", "SatuanBarangController@simpan")->name("satuan_barang.simpan");
    Route::get("satuan_barang/{id}/edit", "SatuanBarangController@edit")->name("satuan_barang.edit");
    Route::post("satuan_barang/{id}/update", "SatuanBarangController@update")->name("satuan_barang.update");
    Route::get("satuan_barang/{id}/delete", "SatuanBarangController@delete")->name("satuan_barang.delete");

    Route::get("kondisi_barang", "KondisiBarangController@index")->name("kondisi_barang.index");
    Route::get("kondisi_barang/add", "KondisiBarangController@add")->name("kondisi_barang.add");
    Route::post("kondisi_barang/save", "KondisiBarangController@save")->name("kondisi_barang.save");
    Route::get("kondisi_barang/{id}/edit", "KondisiBarangController@edit")->name("kondisi_barang.edit");
    Route::post("kondisi_barang/{id}/update", "KondisiBarangController@update")->name("kondisi_barang.update");
    Route::get("kondisi_barang/{id}/hapus", "KondisiBarangController@hapus")->name("kondisi_barang.hapus");

    Route::get("laporan/transaksi","TransaksiController@index")->name("laporan.transaksi.index");
    Route::get("laporan/transaksi/cari", "TransaksiController@cari")->name("laporan.transaksi.cari");
    Route::get("laporan/transakai/print/{dari_tgl}/{sampai_tgl}", "TransaksiController@print_transaksi")->name("laporan.transaksi.print");

    Route::get("cetak/qrcode", "QRCodeController@index")->name("cetak.qrcode.index");
    Route::get("cetak/qrcode/print", "QRCodeController@print")->name("cetak.qrcode.print");
});
