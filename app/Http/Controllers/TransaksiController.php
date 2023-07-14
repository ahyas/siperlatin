<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

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

        return view("transaksi/index", compact("table","total"));
    }

    public function tambah(){
        $tb_barang = DB::table("tb_barang")
        ->select("tb_barang.id","tb_barang.nama as nama_barang")
        ->join("tb_detail_barang","tb_barang.id","=","tb_detail_barang.id_barang")
        ->distinct()
        ->get();

        return view("transaksi/new", compact("tb_barang"));
    }

    public function edit($id_transaksi){
        $tb_barang = DB::table("tb_barang")
        ->select("tb_barang.id","tb_barang.nama as nama_barang")
        ->join("tb_detail_barang","tb_barang.id","=","tb_detail_barang.id_barang")
        ->distinct()
        ->get();

        $tb_transaksi = DB::table("tb_transaksi")
        ->where("tb_transaksi.id",$id_transaksi)
        ->select("tb_transaksi.id as kode_transaksi","tb_transaksi.tanggal","tb_transaksi.nominal","tb_transaksi.nominal","tb_transaksi.keterangan","tb_barang.nama as nama_barang", "tb_detail_barang.nama as nama_sub_barang", "tb_detail_barang.id_barang", "tb_detail_barang.id AS id_sub_barang")
        ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
        ->join("tb_detail_barang","tb_transaksi.id_sub_barang","=","tb_detail_barang.id")
        ->first();

        $tb_detail_barang = DB::table("tb_detail_barang")
        ->select("nama","id")
        ->where("id_barang", $tb_transaksi->id_barang)
        ->get();

        return view("transaksi/edit", compact("tb_barang", "tb_transaksi", "tb_detail_barang","id_transaksi"));
    }

    public function update(Request $request, $id_transaksi){
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
                "id_sub_barang"=>$request->sub_barang,
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

        return redirect()->route("transaksi.index");
    }

    public function delete($id_transaksi){
        $previous_file = DB::table("tb_transaksi")
        ->where("id",$id_transaksi)
        ->select("file_name")
        ->first();

        //delete related file
        unlink(storage_path('files/'.$previous_file->file_name));

        DB::table("tb_transaksi")
        ->where("id",$id_transaksi)
        ->delete();

        return redirect()->route("transaksi.index");
    }

    public function get_sub_barang(Request $request){
        $table=DB::table("tb_detail_barang")
        ->select("id","kode","nama")
        ->where("id_barang",$request->id_barang)
        ->get();

        return response()->json($table);
    }

    public function simpan(Request $request){
     
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

        return redirect()->route("transaksi.index");
        
    }
}
