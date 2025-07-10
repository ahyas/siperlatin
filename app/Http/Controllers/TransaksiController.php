<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function index(){

        return view("laporan/transaksi/index");
    }

    public function cari(Request $request){
        $dari_tgl = $request["dari_tanggal"];
        $sampai_tgl = $request["sampai_tanggal"];

        if(empty($dari_tgl) || empty($sampai_tgl)){
            $err = 'Lengkapi tanggal awal dan tanggal akhir';
        }else{
            $err = null;
        }

        $table=DB::table("tb_transaksi")
        ->whereBetween("tb_transaksi.tanggal", [$dari_tgl, $sampai_tgl])
        ->select("tb_transaksi.id as kode_transaksi","tb_transaksi.tanggal","tb_transaksi.file_name","tb_transaksi.nominal","tb_transaksi.nominal","tb_transaksi.keterangan","tb_barang.nama as nama_barang", "tb_detail_barang.nama as nama_sub_barang","tb_detail_barang.kode AS kode_detail_barang", 'tb_ruang.nama_ruang')
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->leftjoin('tb_ruang', 'tb_detail_barang.ruang', 'tb_ruang.id')
        ->paginate(10);

        $total = DB::table("tb_transaksi")
        ->whereBetween("tb_transaksi.tanggal", [$dari_tgl, $sampai_tgl])
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->sum("tb_transaksi.nominal");

        $barang=DB::table("tb_barang")
        ->select("nama AS nama_barang","id AS id_barang")
        ->get();

        return view("laporan/transaksi/index", compact("table","total","barang","dari_tgl","sampai_tgl","err"));
    }

    public function print_transaksi($dari_tgl, $sampai_tgl){

        $table=DB::table("tb_transaksi")
        ->whereBetween("tb_transaksi.tanggal", [$dari_tgl, $sampai_tgl])
        ->select("tb_transaksi.id as kode_transaksi","tb_transaksi.tanggal","tb_transaksi.file_name","tb_transaksi.nominal","tb_transaksi.nominal","tb_transaksi.keterangan","tb_barang.nama as nama_barang", "tb_detail_barang.nama as nama_sub_barang","tb_detail_barang.kode AS kode_detail_barang", 'tb_ruang.nama_ruang')
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->leftjoin('tb_ruang', 'tb_detail_barang.ruang', 'tb_ruang.id')
        ->paginate(10);

        $total = DB::table("tb_transaksi")
        ->whereBetween("tb_transaksi.tanggal", [$dari_tgl, $sampai_tgl])
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->sum("tb_transaksi.nominal");

        $kuasa_pengguna_barang = DB::table('tb_kuasa_pengguna_barang')->first();

        $pdf = Pdf::loadView('laporan/transaksi/print', ['table'=>$table,"total"=>$total,"dari_tgl"=>$dari_tgl, "sampai_tgl"=>$sampai_tgl, 'kuasa_pengguna_barang' => $kuasa_pengguna_barang]);

        return $pdf->stream("file.pdf");
    }

}
