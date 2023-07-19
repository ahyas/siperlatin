<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use QrCode;

class QRCodeController extends Controller
{
    public function index(){
        $table=DB::table("tb_detail_barang")
        ->select("tb_detail_barang.id as id_detail_barang","tb_detail_barang.foto", "tb_detail_barang.kode AS kode_detail_barang", "tb_detail_barang.nama AS nama_detail_barang","tb_barang.nama AS nama_barang")
        ->join("tb_barang","tb_detail_barang.id_barang","=","tb_barang.id")
        ->get();

        return view("cetak/index", compact("table"));
    }

    public function print(){
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));
        $table=DB::table("tb_detail_barang")
        ->select("tb_detail_barang.id as id_detail_barang","tb_detail_barang.foto", "tb_detail_barang.kode AS kode_detail_barang", "tb_detail_barang.nama AS nama_detail_barang","tb_barang.nama AS nama_barang")
        ->join("tb_barang","tb_detail_barang.id_barang","=","tb_barang.id")
        ->get();

        $pdf = PDF::loadView('cetak/print', ['table'=>$table, 'qrcode'=>$qrcode]);
        return $pdf->stream("file.pdf");
    }
}
