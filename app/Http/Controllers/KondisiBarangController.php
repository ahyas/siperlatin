<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KondisiBarangController extends Controller
{
    public function index(){
        $table=DB::table("tb_kondisi_barang")
        ->select("nama AS keterangan", "id")
        ->get();

        return view("kondisi_barang/index", compact("table"));
    }

    public function add(){
        return view("kondisi_barang/new");
    }

    public function save(Request $request){
        DB::table("tb_kondisi_barang")
        ->insert([
            "nama"=>$request["keterangan"]
        ]);

        return redirect()->route("kondisi_barang.index");
    }

    public function edit($id){
        $table=DB::table("tb_kondisi_barang")
        ->where("id",$id)
        ->select("id","nama AS keterangan")
        ->first();

        return view("kondisi_barang/edit",compact("table"));
    }

    public function update(Request $request, $id){
        DB::table("tb_kondisi_barang")
        ->where("id",$id)
        ->update([
            "nama"=>$request["keterangan"]
        ]);

        return redirect()->route("kondisi_barang.index");
    }

    public function hapus($id){
        DB::table("tb_kondisi_barang")
        ->where("id",$id)
        ->delete();

        return redirect()->back();  
    }
}
