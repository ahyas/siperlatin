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
        
        $detail = DB::table("tb_detail_barang")
        ->where("tb_detail_barang.id_barang",$id_barang)
        ->select(
            "tb_detail_barang.id",
            "tb_detail_barang.id_barang",
            "tb_detail_barang.nama",
            "tb_detail_barang.kode",
            "tb_detail_barang.tgl_perolehan",
            "tb_detail_barang.harga_perolehan",
            "tb_satuan_barang.nama_satuan",
            "tb_satuan_barang.id AS id_satuan",
            "tb_detail_barang.id_kondisi_barang",
            "tb_detail_barang.keterangan",
            "tb_detail_barang.foto",
            "tb_kondisi_barang.nama AS kondisi_barang",
            'tb_ruang.nama_ruang AS ruang',
            'tb_brand.nama_brand AS brand')
        ->leftJoin("tb_satuan_barang","tb_detail_barang.satuan","=","tb_satuan_barang.id")
        ->leftJoin("tb_kondisi_barang","tb_detail_barang.id_kondisi_barang","=","tb_kondisi_barang.id")
        ->leftJoin('tb_ruang', 'tb_detail_barang.ruang','=','tb_ruang.id')
        ->leftJoin('tb_brand', 'tb_detail_barang.brand','=','tb_brand.id')
        ->orderBy('id', 'DESC')
        ->get();        

        if($count_detail->count() > 0){
            $info="";
            
        }else{
            $info="Belum ada detail barang";
            
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

        $kondisi_barang = DB::table("tb_kondisi_barang")
        ->select("nama AS keterangan","id")
        ->get();

        $satuan_barang = DB::table("tb_satuan_barang")
        ->select("nama_satuan","id")
        ->get();

        $ruang = DB::table('tb_ruang')
        ->select('id','nama_ruang', 'keterangan')
        ->get();

        $brand = DB::table('tb_brand')
        ->select('id','nama_brand', 'keterangan')
        ->get();

        return view("barang/detail/new", compact("table","satuan_barang","kondisi_barang",'ruang','brand'));
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
        $table=DB::table("tb_barang")
        ->where("id",$id_barang)
        ->first();

        $last_id=DB::table("tb_detail_barang")
        ->where('id_barang', $id_barang)
        ->orderBy('id','DESC')
        ->first();
        //get 
        $a = (int)substr($last_id->kode, -2);

        $kode = $table->kode.".".($a+1);

        if($request->hasFile("foto")){
            $fileName = time().'.'.$request->foto->extension();
            
            $tujuan_upload = storage_path('foto');

            $request->foto->move($tujuan_upload, $fileName);

            DB::table("tb_detail_barang")
            ->insert([
                "id_barang"=>$id_barang,
                "kode"=>$kode,
                "nama"=>$request["nama_barang"],
                "tgl_perolehan"=>$request["tgl_perolehan"],
                "harga_perolehan"=>$request["harga_perolehan"],
                "satuan"=>$request["satuan"],
                "id_kondisi_barang"=>$request["kondisi_barang"],
                "ruang"=>$request["ruang"],
                "brand"=>$request["brand"],
                "keterangan"=>$request["keterangan"],
                "foto"=>$fileName
            ]);
        }else{
            DB::table("tb_detail_barang")
            ->insert([
                "id_barang"=>$id_barang,
                "kode"=>$kode,
                "nama"=>$request["nama_barang"],
                "tgl_perolehan"=>$request["tgl_perolehan"],
                "harga_perolehan"=>$request["harga_perolehan"],
                "satuan"=>$request["satuan"],
                "id_kondisi_barang"=>$request["kondisi_barang"],
                "ruang"=>$request["ruang"],
                "brand"=>$request["brand"],
                "keterangan"=>$request["keterangan"]
            ]);
        }

        return redirect()->route("barang.detail",["id_barang"=>$id_barang])->with('success', 'Data saved successfully!');
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

        $kondisi_barang = DB::table("tb_kondisi_barang")
        ->select("nama AS kondisi_barang","id")
        ->get();

        $satuan_barang = DB::table("tb_satuan_barang")
        ->select("nama_satuan","id")
        ->get();

        $ruang = DB::table('tb_ruang')
        ->select('id','nama_ruang', 'keterangan')
        ->get();

        $brand = DB::table('tb_brand')
        ->select('id','nama_brand', 'keterangan')
        ->get();

        $table=DB::table("tb_detail_barang")
        ->select(
            "tb_detail_barang.id",
            "tb_detail_barang.id_barang",
            "tb_detail_barang.nama",
            "tb_detail_barang.tgl_perolehan",
            "tb_detail_barang.harga_perolehan",
            "tb_detail_barang.id_kondisi_barang",
            "tb_satuan_barang.nama_satuan",
            "tb_satuan_barang.id AS id_satuan",
            "tb_detail_barang.ruang AS id_ruang",
            "tb_detail_barang.brand AS id_brand",
            "tb_detail_barang.keterangan")
        ->leftJoin("tb_satuan_barang","tb_detail_barang.satuan","=","tb_satuan_barang.id")
        ->leftJoin('tb_ruang', 'tb_detail_barang.ruang','=','tb_ruang.id')
        ->where("tb_detail_barang.id_barang",$id_barang)
        ->where("tb_detail_barang.id", $id_detail)
        ->first();

        return view("barang/detail/edit", compact("table","info_barang","satuan_barang","kondisi_barang",'ruang','brand'));
    }

    public function update(Request $request, $id_barang){
        DB::table("tb_barang")
        ->where("id",$id_barang)
        ->update([
            "kode"=>$request["kode_barang"],
            "nama"=>$request["nama_barang"],
        ]);
        return redirect()->route("barang.index");
    }

    public function update_detail(Request $request, $id_barang, $id_detail){
        if($request->hasFile("foto")){ 

            $exist = DB::table("tb_detail_barang")
            ->where("id_barang",$id_barang)
            ->select("foto")
            ->first();
            
            if(!empty($exist->foto)){
                if(file_exists(storage_path().'/foto/'.$exist->foto)){
                    $previous_file = DB::table("tb_detail_barang")
                    ->where("id_barang",$id_barang)
                    ->select("foto")
                    ->first();
                    //delete previous file
                    unlink(storage_path('foto/'.$previous_file->foto));
                }
            }

            $fileName = time().'.'.$request->foto->extension();
            
            $tujuan_upload = storage_path('foto');
            $request->foto->move($tujuan_upload, $fileName);

            DB::table("tb_detail_barang")
            ->where("id",$id_detail)
            ->where("id_barang", $id_barang)
            ->update([
                "nama"=>$request["nama_barang"],
                "tgl_perolehan"=>$request["tgl_perolehan"],
                "harga_perolehan"=>$request["harga_perolehan"],
                "satuan"=>$request["satuan"],
                "id_kondisi_barang"=>$request["kondisi_barang"],
                "ruang"=>$request["ruang"],
                "brand"=>$request["brand"],
                "keterangan"=>$request["keterangan"],
                "foto"=>$fileName
            ]);
            
        }else{
            DB::table("tb_detail_barang")
            ->where("id",$id_detail)
            ->where("id_barang", $id_barang)
            ->update([
                "nama"=>$request["nama_barang"],
                "tgl_perolehan"=>$request["tgl_perolehan"],
                "harga_perolehan"=>$request["harga_perolehan"],
                "satuan"=>$request["satuan"],
                "id_kondisi_barang"=>$request["kondisi_barang"],
                "ruang"=>$request["ruang"],
                "brand"=>$request["brand"],
                "keterangan"=>$request["keterangan"],
            ]);
        }
        return redirect()->route("barang.detail",["id_barang"=>$id_barang])->with('success', 'Data updated successfully!');
    }

    public function hapus($id_barang){
        DB::table("tb_barang")
        ->where("id",$id_barang)
        ->delete();

        return redirect()->back()->with('success', 'Data deleted successfully!');
    }

    public function delete_detail($id_barang, $id_detail){
        DB::table("tb_detail_barang")
        ->where("id_barang",$id_barang)
        ->where("id",$id_detail)
        ->delete();

        return redirect()->route("barang.detail",["id_barang"=>$id_barang])->with('success', 'Data deleted successfully!');
    }

    public function pencarian(Request $request){
        $table = DB::table("tb_barang")
        ->where('tb_barang.nama','like',"%".$request->kata_kunci."%")
        ->orWhere('tb_barang.kode','like',"%".$request->kata_kunci."%")
        ->select("tb_barang.id","tb_barang.kode","tb_barang.nama", DB::raw("count(tb_detail_barang.id_barang) as jumlah_detail_barang"))
        ->leftJoin("tb_detail_barang","tb_barang.id","=","tb_detail_barang.id_barang")
        ->groupBy("tb_barang.id","tb_barang.kode","tb_barang.nama","tb_detail_barang.id_barang")
        ->paginate(10);

        return view("barang/index", ["table"=>$table]);
    }
}
