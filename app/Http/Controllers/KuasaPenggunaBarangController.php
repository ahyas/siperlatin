<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KuasaPenggunaBarangController extends Controller
{
    public function index(){
        $table = DB::table('tb_kuasa_pengguna_barang')->first();

        return view('kuasa_pengguna_barang.index', compact('table'));
    }

    public function tambah(){
        return view('kuasa_pengguna_barang.tambah');
    }

    public function simpan(Request $request){
        DB::table('tb_kuasa_pengguna_barang')
        ->insert([
            'nama' => $request->nama,
            'nip' => $request->nip,
        ]);

        return redirect()->route('kuasa_pengguna_barang.index')->with('success','Kuasa pengguna barang successfuly added');
    }

    public function edit($id){
        $table = DB::table('tb_kuasa_pengguna_barang')->first();

        return view('kuasa_pengguna_barang.edit', compact('table'));
    }

    public function update(Request $request, $id){
        DB::table('tb_kuasa_pengguna_barang')
        ->where('id', $id)
        ->update([
            'nama' => $request->nama,
            'nip' => $request->nip
        ]);

        return redirect()->route('kuasa_pengguna_barang.index')->with('success','Kuasa pengguna barang successfuly updated');
    }
}
