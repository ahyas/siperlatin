<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SatuanBarangController extends Controller
{
    public function index(){
        $table=DB::table("tb_satuan_barang")
        ->get();
        return view("satuan_barang/index", compact("table"));
    }

    public function tambah(){
        return view("satuan_barang/new");
    }

    public function simpan(Request $request){
        DB::table("tb_satuan_barang")
        ->insert([
            "nama_satuan"=>$request->nama_satuan,
            "keterangan"=>$request->keterangan
        ]);
        return redirect()->route("satuan_barang.index");
    }

    public function edit($id){
        $table=DB::table("tb_satuan_barang")
        ->where("id",$id)
        ->first();

        return view("satuan_barang/edit", compact("table"));
    }

    public function update(Request $request, $id){
        DB::table("tb_satuan_barang")
        ->where("id",$id)
        ->update([
            "nama_satuan"=>$request->nama_satuan,
            "keterangan"=>$request->keterangan
        ]);
        return redirect()->route("satuan_barang.index");
    }

    public function delete($id){
        DB::table("tb_satuan_barang")
        ->where("id",$id)
        ->delete();
        return redirect()->route("satuan_barang.index");
    }
}
