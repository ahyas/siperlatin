<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BarangController extends Controller
{
    public function index(){
        //$table=DB::table("tb_barang")->paginate(10);
        
        $table = DB::table("tb_barang")
        ->select("tb_barang.id","tb_barang.kode","tb_barang.nama", DB::raw("count(tb_detail_barang.id_barang) as jumlah_detail_barang"))
        ->leftJoin("tb_detail_barang","tb_barang.id","=","tb_detail_barang.id_barang")
        ->groupBy("tb_barang.id","tb_barang.kode","tb_barang.nama","tb_detail_barang.id_barang")
        ->paginate(10);

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

    public function detail($id_barang){
        $table=DB::table("tb_barang")
        ->where("id",$id_barang)
        ->first();
        
        $count_detail=DB::table("tb_detail_barang")
        ->where("id_barang", $id_barang);

        if($count_detail->count() > 0){
            $info="";
            $detail = DB::table("tb_detail_barang")->where("id_barang",$id_barang)->get();
        }else{
            $info="Belum ada detail barang";
            $detail = DB::table("tb_detail_barang")->where("id_barang",$id_barang)->get();
        }

        return view("barang/detail/index", compact("table","detail","info"));
    }

    public function tambah($kode){
        $barang = DB::table("tb_barang")
        ->where("kode", $kode)
        ->first();

        return view("barang/transaksi", compact("kode","barang"));
    }

    public function tambah_detail($id_barang){
        $table=DB::table("tb_barang")
        ->where("id",$id_barang)
        ->first();

        $last_id=DB::table("tb_detail_barang")
        ->where("id_barang",$id_barang)
        ->count();

        $kode = $table->kode.".".($last_id+1);

        return view("barang/detail/new", compact("kode","table"));
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

    public function simpan_detail(Request $request, $id_barang){
        if($request->hasFile("foto")){
            $fileName = time().'.'.$request->foto->extension();
            
            $tujuan_upload = storage_path('foto');

            $request->foto->move($tujuan_upload, $fileName);

            DB::table("tb_detail_barang")
            ->insert([
                "id_barang"=>$id_barang,
                "kode"=>$request["kode_barang"],
                "nama"=>$request["nama_barang"],
                "keterangan"=>$request["keterangan"],
                "foto"=>$fileName
            ]);
        }else{
            DB::table("tb_detail_barang")
            ->insert([
                "id_barang"=>$id_barang,
                "kode"=>$request["kode_barang"],
                "nama"=>$request["nama_barang"],
                "keterangan"=>$request["keterangan"]
            ]);
        }

        return redirect()->route("barang.detail",["id_barang"=>$id_barang]);
    }

    public function edit($id_barang){
        $table=DB::table("tb_barang")
        ->where("id",$id_barang)
        ->first();

        $count = DB::table("tb_detail_barang")
        ->where("id_barang",$id_barang)
        ->count();

        return view("barang/edit", compact("table","count"));
    }

    public function edit_detail($id_barang, $id_detail){
        $info_barang=DB::table("tb_barang")
        ->where("id",$id_barang)
        ->first();

        $table=DB::table("tb_detail_barang")
        ->select("id","id_barang","nama","kode","keterangan")
        ->where("id_barang",$id_barang)
        ->where("id", $id_detail)
        ->first();

        return view("barang/detail/edit", compact("table","info_barang"));
    }

    public function update(Request $request, $id_barang){
        DB::table("tb_barang")
        ->where("id",$id_barang)
        ->update([
            "kode"=>$request["kode_barang"],
            "nama"=>$request["nama_barang"],
            "keterangan"=>$request["keterangan"],
        ]);
        return redirect()->route("barang.index");
    }

    public function update_detail(Request $request, $id_barang, $id_detail){
        if($request->hasFile("foto")){
            $exist = DB::table("tb_detail_barang")
            ->where("id_barang",$id_barang)
            ->select("foto")
            ->first();

            if(file_exists(storage_path().'/foto/'.$exist->foto)){
                $previous_file = DB::table("tb_detail_barang")
                ->where("id_barang",$id_barang)
                ->select("foto")
                ->first();
                //delete previous file
                unlink(storage_path('foto/'.$previous_file->foto));
            }

            $fileName = time().'.'.$request->foto->extension();
            
            $tujuan_upload = storage_path('foto');
            $request->foto->move($tujuan_upload, $fileName);

            DB::table("tb_detail_barang")
            ->where("id",$id_detail)
            ->where("id_barang", $id_barang)
            ->update([
                "kode"=>$request["kode_barang"],
                "nama"=>$request["nama_barang"],
                "keterangan"=>$request["keterangan"],
                "foto"=>$fileName
            ]);
            
        }else{
            DB::table("tb_detail_barang")
            ->where("id",$id_detail)
            ->where("id_barang", $id_barang)
            ->update([
                "kode"=>$request["kode_barang"],
                "nama"=>$request["nama_barang"],
                "keterangan"=>$request["keterangan"],
            ]);
        }
        return redirect()->route("barang.detail",["id_barang"=>$id_barang]);
    }

    public function hapus($id_barang){
        DB::table("tb_barang")
        ->where("id",$id_barang)
        ->delete();

        return redirect()->route("barang.index");
    }

    public function delete_detail($id_barang, $id_detail){
        DB::table("tb_detail_barang")
        ->where("id_barang",$id_barang)
        ->where("id",$id_detail)
        ->delete();

        return redirect()->route("barang.detail",["id_barang"=>$id_barang]);
    }
}
