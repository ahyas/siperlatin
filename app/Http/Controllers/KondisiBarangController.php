<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

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

        //return redirect()->route('ruang.index');
        $previous_url = $request['previous_url'];

        return redirect($previous_url)->with('success', 'Data saved successfully!');
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
        $count=DB::table("tb_detail_barang")
        ->where("id_kondisi_barang",$id)
        ->count();
        if($count==0){
            DB::table("tb_kondisi_barang")
            ->where("id",$id)
            ->delete();
            Session::flash('success', 'Sukses. Data berhasil dihapus.');
            return redirect()->back();  
        }else{
            Session::flash('error', 'Error. Data ini sudah digunakan.');
            return redirect()->back();
        }
    }
}
