<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BrandController extends Controller
{
    public function index(){
        $table=DB::table('tb_brand')->get();

        return view('brand.index', compact('table'));
    }

    public function tambah(){
        return view('brand.create');
    }

    public function simpan(Request $request){
        DB::table('tb_brand')
        ->insert([
            'nama_brand' => $request['nama_brand'],
            'keterangan' => $request['keterangan']
        ]);

        //return redirect()->route('ruang.index');
        $previous_url = $request['previous_url'];

        return redirect($previous_url)->with('success', 'Brand added successfully!');
    }

    public function edit($id){
        $table = DB::table('tb_brand')
        ->where('id', $id)
        ->first();

        return view('brand.edit', compact('table'));
    }

    public function update(Request $request, $id){
        DB::table('tb_brand')
        ->where('id',$id)
        ->update([
            'nama_brand' => $request['nama_brand'],
            'keterangan' => $request['keterangan']
        ]);

        return redirect()->route('brand.index')->with('success','Brand successfuly updated');
    }

    public function destroy($id){
        $isinuse = DB::table('tb_detail_barang')
        ->where('brand', $id)
        ->count();

        if($isinuse == 0){
            DB::table('tb_brand')
            ->where('id',$id)
            ->delete();
            return redirect()->back()->with('success','Brand successfuly deleted');
        }else{
            return redirect()->back()->with('error','This brand already assign to barang');
        }
    }
}
