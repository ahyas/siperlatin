<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransaksiPerawatanController extends Controller
{
    public function index()
    {
        $tb_barang = DB::table("tb_barang")
        ->select("tb_barang.kode","tb_barang.nama","tb_barang.id AS id_barang")
        ->join("tb_detail_barang", "tb_barang.id","=","tb_detail_barang.id_barang")
        ->distinct()
        ->get(["tb_barang.nama","tb_barang.id","tb_barang.kode"]);

        $table=DB::table("tb_detail_barang")
        ->select("tb_detail_barang.id AS id_detail_barang","tb_detail_barang.tgl_perolehan","tb_detail_barang.harga_perolehan","tb_detail_barang.id_barang","tb_detail_barang.foto", "tb_detail_barang.kode AS kode_detail_barang", "tb_detail_barang.nama AS nama_detail_barang","tb_barang.nama AS nama_barang")
        ->join("tb_barang","tb_detail_barang.id_barang","=","tb_barang.id")
        ->get();

        $tb_transaksi=DB::table("tb_transaksi")->get();

        $baris=$table->count();

        return view('transaksi_perawatan/index', compact("table","baris","tb_barang","tb_transaksi"));
    }

    public function detail($id_detail_barang){
        $table=DB::table("tb_detail_barang")
        ->where("tb_detail_barang.id",$id_detail_barang)
        ->select("tb_detail_barang.nama AS nama_detail_barang", "tb_barang.nama AS nama_barang", "tb_detail_barang.kode AS kode_detail_barang", "tb_detail_barang.keterangan","tb_detail_barang.foto", "tb_detail_barang.harga_perolehan","tb_detail_barang.tgl_perolehan")
        ->join("tb_barang", "tb_detail_barang.id_barang","=","tb_barang.id")
        ->first();

        $transaksi = DB::table("tb_transaksi")
        ->select("tb_transaksi.id as kode_transaksi","tb_transaksi.tanggal","tb_transaksi.file_name","tb_transaksi.nominal","tb_transaksi.nominal","tb_transaksi.keterangan")
        ->where("id_sub_barang",$id_detail_barang)
        ->get();

        $total = $transaksi->sum("nominal");

        $count = $transaksi->count();

        return view("transaksi_perawatan/detail", compact("table","transaksi","count","id_detail_barang","total"));
    }

    public function tambah_transaksi($id_detail_barang){
        $tb = DB::table("tb_detail_barang")
        ->select("id_barang")
        ->where("id",$id_detail_barang)
        ->first();

        $tb_barang = DB::table("tb_barang")
        ->where("tb_barang.id","=",$tb->id_barang)
        ->select("tb_barang.id","tb_barang.nama as nama_barang")
        ->first();

        $tb_detail_barang=DB::table("tb_detail_barang")
        ->select("id","kode","nama")
        ->where("id",$id_detail_barang)
        ->first();

        return view("transaksi_perawatan/new_transaksi", compact("id_detail_barang","tb_barang","tb_detail_barang"));
    }

    public function simpan_transaksi(Request $request, $id_detail_barang){
        $fileName = time().'.'.$request->lampiran->extension();
        
        $tujuan_upload = storage_path('files');
        $request->lampiran->move($tujuan_upload, $fileName);

        DB::table("tb_transaksi")
        ->insert([
            "id_barang"=>$request->barang,
            "id_sub_barang"=>$request->sub_barang,
            "tanggal"=>$request->tanggal,
            "keterangan"=>$request->keterangan,
            "nominal"=>$request->nominal,
            "file_name"=>$fileName
        ]);
        return redirect()->route("transaksi_perawatan.detail",["id_detail_barang"=>$id_detail_barang]);
    }

    public function edit($id_transaksi, $id_detail_barang){

        $tb_transaksi = DB::table("tb_transaksi")
        ->where("tb_transaksi.id",$id_transaksi)
        ->select("tb_transaksi.id as kode_transaksi","tb_transaksi.tanggal","tb_transaksi.nominal","tb_transaksi.nominal","tb_transaksi.keterangan","tb_barang.nama as nama_barang", "tb_detail_barang.nama as nama_sub_barang", "tb_detail_barang.id_barang", "tb_detail_barang.id AS id_sub_barang")
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->first();

        $tb_barang = DB::table("tb_barang")
        ->where("tb_detail_barang.id", $id_detail_barang)
        ->select("tb_barang.id AS id_barang","tb_barang.nama as nama_barang")
        ->join("tb_detail_barang","tb_barang.id","=","tb_detail_barang.id_barang")
        ->first();

        $tb_detail_barang = DB::table("tb_detail_barang")
        ->select("nama","id","kode")
        ->where("id_barang", $tb_transaksi->id_barang)
        ->first();

        return view("transaksi_perawatan/edit", compact("tb_barang", "tb_transaksi", "tb_detail_barang","id_transaksi","id_detail_barang"));
    }

    public function update(Request $request, $id_transaksi, $id_detail_barang){
        if($request->hasFile("lampiran")){
            $exist = DB::table("tb_transaksi")
            ->where("id",$id_transaksi)
            ->select("file_name")
            ->first();

            if(file_exists(storage_path().'/files/'.$exist->file_name)){
                $previous_file = DB::table("tb_transaksi")
                ->where("id",$id_transaksi)
                ->select("file_name")
                ->first();
                //delete previous file
                unlink(storage_path('files/'.$previous_file->file_name));
            }

            $fileName = time().'.'.$request->lampiran->extension();
        
            $tujuan_upload = storage_path('files');
            $request->lampiran->move($tujuan_upload, $fileName);

            DB::table("tb_transaksi")
            ->where("id",$id_transaksi)
            ->update([
                "id_barang"=>$request->barang,
                "id_sub_barang"=>$id_detail_barang,
                "tanggal"=>$request->tanggal,
                "keterangan"=>$request->keterangan,
                "nominal"=>$request->nominal,
                "file_name"=>$fileName
            ]);
        }else{
            DB::table("tb_transaksi")
            ->where("id",$id_transaksi)
            ->update([
                "id_barang"=>$request->barang,
                "id_sub_barang"=>$request->sub_barang,
                "tanggal"=>$request->tanggal,
                "keterangan"=>$request->keterangan,
                "nominal"=>$request->nominal
            ]);
        }

        return redirect()->route("transaksi_perawatan.detail",["id_detail_barang"=>$id_detail_barang]);
    }

    public function delete($id_transaksi, $id_detail_barang){
        $previous_file = DB::table("tb_transaksi")
        ->where("id",$id_transaksi)
        ->select("file_name")
        ->first();

        //delete related file
        unlink(storage_path('files/'.$previous_file->file_name));

        DB::table("tb_transaksi")
        ->where("id",$id_transaksi)
        ->delete();

        return redirect()->route("transaksi_perawatan.detail", ["id_detail_barang"=>$id_detail_barang]);
    }

    public function get_sub_barang(Request $request){
        $table=DB::table("tb_detail_barang")
        ->select("id","kode","nama")
        ->where("id_barang",$request->id_barang)
        ->get();

        return response()->json($table);
    }
}
