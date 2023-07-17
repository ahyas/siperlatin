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
        return view('home');
    }

    public function laporan_transaksi(){
        $table=DB::table("tb_transaksi")
                ->selectRaw('SUM(tb_transaksi.nominal) AS nominal, tb_barang.nama AS nama_barang' )
                ->join("tb_barang","tb_transaksi.id_barang","=","tb_barang.id")
                ->groupBy("tb_barang.nama", "tb_transaksi.id_barang")
                ->get();

        return response()->json($table);
    }

}
