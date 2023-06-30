<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DetailBarangController extends Controller
{
    public function index($id_detail_barang){
        $table=DB::table("tb_detail_barang")
        ->where("tb_detail_barang.id",$id_detail_barang)
        ->select("tb_detail_barang.nama AS nama_detail_barang", "tb_barang.nama AS nama_barang", "tb_detail_barang.kode AS kode_detail_barang", "tb_detail_barang.keterangan")
        ->join("tb_barang", "tb_detail_barang.id_barang","=","tb_barang.id")
        ->first();

        $transaksi = DB::table("tb_transaksi")
        ->where("id_sub_barang",$id_detail_barang)
        ->get();

        return view("detail_barang/index", compact("table","transaksi"));
    }
}
