<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class TransaksiController extends Controller
{
    public function index(){
        $table=DB::table("tb_transaksi")
        ->select("tb_transaksi.id as kode_transaksi","tb_transaksi.tanggal","tb_transaksi.file_name","tb_transaksi.nominal","tb_transaksi.nominal","tb_transaksi.keterangan","tb_barang.nama as nama_barang", "tb_detail_barang.nama as nama_sub_barang","tb_detail_barang.kode AS kode_detail_barang")
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->paginate(10);

        $total = DB::table("tb_transaksi")
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->sum("tb_transaksi.nominal");

        $barang=DB::table("tb_barang")
        ->select("nama AS nama_barang","id AS id_barang")
        ->get();

        return view("laporan/transaksi/index", compact("table","total","barang"));
    }

    public function cari(Request $request){
        $dari_tgl = $request["dari_tanggal"];
        $sampai_tgl = $request["sampai_tanggal"];

        $table=DB::table("tb_transaksi")
        ->whereBetween("tb_transaksi.tanggal", [$dari_tgl, $sampai_tgl])
        ->select("tb_transaksi.id as kode_transaksi","tb_transaksi.tanggal","tb_transaksi.file_name","tb_transaksi.nominal","tb_transaksi.nominal","tb_transaksi.keterangan","tb_barang.nama as nama_barang", "tb_detail_barang.nama as nama_sub_barang","tb_detail_barang.kode AS kode_detail_barang")
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->paginate(10);

        $total = DB::table("tb_transaksi")
        ->whereBetween("tb_transaksi.tanggal", [$dari_tgl, $sampai_tgl])
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->sum("tb_transaksi.nominal");

        $barang=DB::table("tb_barang")
        ->select("nama AS nama_barang","id AS id_barang")
        ->get();

        return view("laporan/transaksi/index", compact("table","total","barang","dari_tgl","sampai_tgl"));
    }

    public function print_transaksi($dari_tgl, $sampai_tgl){

        $table=DB::table("tb_transaksi")
        ->whereBetween("tb_transaksi.tanggal", [$dari_tgl, $sampai_tgl])
        ->select("tb_transaksi.id as kode_transaksi","tb_transaksi.tanggal","tb_transaksi.file_name","tb_transaksi.nominal","tb_transaksi.nominal","tb_transaksi.keterangan","tb_barang.nama as nama_barang", "tb_detail_barang.nama as nama_sub_barang","tb_detail_barang.kode AS kode_detail_barang")
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->paginate(10);

        $total = DB::table("tb_transaksi")
        ->whereBetween("tb_transaksi.tanggal", [$dari_tgl, $sampai_tgl])
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->sum("tb_transaksi.nominal");

        $barang=DB::table("tb_barang")
        ->select("nama AS nama_barang","id AS id_barang")
        ->get();

        $pdf = Pdf::loadView('laporan/transaksi/print', ['table'=>$table,"total"=>$total,"dari_tgl"=>$dari_tgl, "sampai_tgl"=>$sampai_tgl]);
        return $pdf->stream("file.pdf");
    }

}
