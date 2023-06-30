<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $table=DB::table("tb_detail_barang")
        ->select("tb_detail_barang.id AS id_detail_barang", "tb_detail_barang.kode AS kode_detail_barang", "tb_detail_barang.nama AS nama_detail_barang","tb_barang.nama AS nama_barang")
        ->join("tb_barang","tb_detail_barang.id_barang","=","tb_barang.id")
        ->get();

        return view('home', compact("table"));
    }

    public function test(){
        return view("test");
    }
}
