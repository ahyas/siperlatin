<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RuangController extends Controller
{
    public function index(){
        $table = DB::table('tb_ruang')
        ->get();

        return view('ruang.index', compact('table'));
    }

    public function tambah(){
        return view('ruang.new');
    }

    public function simpan(Request $request){
        DB::table('tb_ruang')
        ->insert([
            'nama_ruang' => $request['nama_ruang'],
            'keterangan' => $request['keterangan']
        ]);

        return redirect()->route('ruang.index');
    }

    public function edit($id){
        $table = DB::table('tb_ruang')
        ->where('id', $id)
        ->first();

        return view('ruang.edit', compact('table'));
    }

    public function update(Request $request, $id){
        DB::table('tb_ruang')
        ->where('id',$id)
        ->update([
            'nama_ruang' => $request['nama_ruang'],
            'keterangan' => $request['keterangan']
        ]);

        return redirect()->route('ruang.index');
    }

    public function delete($id){
        $isinuse = DB::table('tb_detail_barang')
        ->where('ruang', $id)
        ->count();

        if($isinuse == 0){
            DB::table('tb_ruang')
            ->where('id',$id)
            ->delete();
        }

        return redirect()->back();
    }
}
