<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DetailBarangController extends Controller
{
    public function index($id_detail_barang){
        $table=DB::table("tb_detail_barang")
        ->where("tb_detail_barang.id",$id_detail_barang)
        ->select(
            "tb_detail_barang.nama AS nama_detail_barang", 
            "tb_barang.nama AS nama_barang", 
            "tb_detail_barang.kode AS kode_detail_barang", 
            "tb_detail_barang.keterangan",
            "tb_detail_barang.foto",
            "tb_detail_barang.id AS id_detail_barang", 
            "tb_detail_barang.harga_perolehan",
            "tb_detail_barang.tgl_perolehan",
            'tb_ruang.nama_ruang AS ruang')
        ->join("tb_barang", "tb_detail_barang.id_barang","=","tb_barang.id")
        ->leftJoin('tb_ruang', 'tb_detail_barang.ruang','=','tb_ruang.id')
        ->first();

        $transaksi = DB::table("tb_transaksi")
        ->where("id_sub_barang",$id_detail_barang)
        ->get();

        $total = $transaksi->sum("nominal");

        $count = $transaksi->count();

        return view("detail_barang/index", compact("table","transaksi","count","id_detail_barang","total"));
    }

    
}
