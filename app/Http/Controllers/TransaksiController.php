<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table('dompets')->orderBy('nama', 'asc')->get();
        $users = DB::table('kategoris')->orderBy('nama', 'asc')->get();
        return view('transaksi.dompetmasuk.tambah', ['dompet'=>$dompet, 'kategori'=>$kategori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nilai' => 'required|regex:^[1-9][0-9]+|not_in:0',
            'deskripsi'=>'max:255',
            'kategori'=>'required',
            'dompet'=>'required',
            'status'=>'required'
        ]);

        $transaksi = new Transaksi;
        $transaksi->nilai = $request->nilai;
        $transaksi->kategori_id = $request->kategori;
        $transaksi->deskripsi = $request->deskripsi;
        $transaksi->dompet_id = $request->dompet;
        $transaksi->status_id = $request->status;

        $transaksi->kode = $request->kode;

        $transaksi->save();
        
        return redirect('transaksi/transaksi')->with('status', 'Data Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
