<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index2($kdstatus)
    {
        
        if($kdstatus != 0){
            $status = $kdstatus;
        }else{
            $status = DB::table('transaksis')->select('status_id')->latest('created_at')->first();
            $status = $status->status_id; 
        }

        $transaksi = Transaksi::where('status_id', $status)->get();
        if ($status != 2) {
            return view('transaksi.dompetmasuk.dmasuk', ['transaksi'=>$transaksi, 'status'=>'Masuk']);
        }else{
            return view('transaksi.dompetkeluar.dkeluar', ['transaksi'=>$transaksi, 'status'=>'Keluar']);
        }
        
    }

    public function create()
    {
        $dompet = DB::table('dompets')->orderBy('nama', 'asc')->get();
        $kategori = DB::table('kategoris')->orderBy('nama', 'asc')->get();
        return view('transaksi.tambah', ['dompet'=>$dompet, 'kategori'=>$kategori]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nilai' => 'required|numeric|min:0',
            'deskripsi'=>'max:255',
            'kategori'=>'required',
            'dompet'=>'required'
        ]);

        if($request->kategori != 2){
            $status = 1;
            $code = 'WIN';
        }
        else{
            $status = 2;
            $code = "WOUT";
        }
        
        $count = DB::table('transaksis')->where('kode', 'like', $code."%")->count() + 1;
        $count = str_pad($count, 6, "0", STR_PAD_LEFT) ;
        $code = $code . $count++;
        
        $transaksi = new Transaksi;
        $transaksi->nilai = $request->nilai;
        $transaksi->kategori_id = $request->kategori;
        $transaksi->deskripsi = $request->deskripsi;
        $transaksi->dompet_id = $request->dompet;
        $transaksi->status_id = $status;
        $transaksi->tanggal = $request->tanggal;

        $transaksi->kode = $code;

        $transaksi->save();
        
        return redirect('transaksi/index/0')->with('status', 'Data Baru Berhasil Ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
