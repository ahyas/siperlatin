<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tb_barang = DB::table("tb_barang")
        ->select("tb_barang.kode","tb_barang.nama","tb_barang.id AS id_barang")
        ->join("tb_detail_barang", "tb_barang.id","=","tb_detail_barang.id_barang")
        ->distinct()
        ->get(["tb_barang.nama","tb_barang.id","tb_barang.kode"]);

        $table=DB::table("tb_detail_barang")
        ->select("tb_detail_barang.id AS id_detail_barang","tb_detail_barang.tgl_perolehan","tb_detail_barang.harga_perolehan","tb_detail_barang.id_barang","tb_detail_barang.foto", "tb_detail_barang.kode AS kode_detail_barang", "tb_detail_barang.nama AS nama_detail_barang","tb_barang.nama AS nama_barang")
        ->join("tb_barang","tb_detail_barang.id_barang","=","tb_barang.id")
        ->get();

        $tb_transaksi=DB::table("tb_transaksi")->get();

        $baris=$table->count();

        return view('home', compact("table","baris","tb_barang","tb_transaksi"));
    }

}
