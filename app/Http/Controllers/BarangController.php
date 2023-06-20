<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BarangController extends Controller
{
    public function index(){
        $table=DB::table("tb_barang")->paginate(10);
        
        return view("barang/index", ["table"=>$table]);
    }

    public function view($kode){
        $table=DB::table("tb_barang")
        ->where("kode",$kode)
        ->first();
        $transaksi = DB::table("tb_transaksi")
        ->where("kode_barang",$kode)
        ->get();

        $count = $transaksi->count();

        return view("barang/view", compact("table", "transaksi","count"));
    }

    public function tambah($kode){
        $barang = DB::table("tb_barang")
        ->where("kode", $kode)
        ->first();

        return view("barang/transaksi", compact("kode","barang"));
    }

    public function tambah_barang(){

        return view("barang/new");
    }

    public function simpan_barang(Request $request){
        $barang = DB::table("tb_barang")
        ->where("kode",$request->kode_barang)
        ->first();

        if(is_null($barang)){
            DB::table("tb_barang")->insert([
                "kode"=>$request['kode_barang'],
                "nama"=>$request['nama_barang']
            ]);
        }

        return redirect()->route("barang.index");
    }

    public function edit($id_barang){
        $table=DB::table("tb_barang")
        ->where("id",$id_barang)
        ->first();

        return view("barang/edit", compact("table"));
    }

    public function update(Request $request, $id_barang){
        DB::table("tb_barang")
        ->where("id",$id_barang)
        ->update([
            "kode"=>$request["kode_barang"],
            "nama"=>$request["nama_barang"]
        ]);
        return redirect()->route("barang.index");
    }

    public function hapus($id_barang){
        DB::table("tb_barang")
        ->where("id",$id_barang)
        ->delete();

        return redirect()->route("barang.index");
    }
}
