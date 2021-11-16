<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dompet;

class DompetController extends Controller
{
    public function index()
    {
        $dompet = Dompet::all();
        return view('master.dompet.dompet', ['dompet'=>$dompet]);
    }

    public function create()
    {
        return view('master.dompet.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:5',
            'deskripsi'=>'max:255',
            'status'=>'required'
        ]);

        $dompet = new Dompet;
        $dompet->nama = $request->nama;
        $dompet->referensi = $request->referensi;
        $dompet->deskripsi = $request->deskripsi;
        $dompet->status_id = $request->status;
        $dompet->save();
        
        return redirect('/')->with('status', 'Data Baru Berhasil Ditambahkan');
    }

    public function show($id)
    {
        $dompet = Dompet::find($id);
        return view('master.dompet.detail', ['dompet'=>$dompet]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dompet = Dompet::find($id);
        return view('master.dompet.ubah', ['dompet'=>$dompet]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|max:5',
            'deskripsi'=>'max:255',
            'status'=>'required'
        ]);

        $dompet = Dompet::find($id);
        $dompet->nama = $request->nama;
        $dompet->referensi = $request->referensi;
        $dompet->deskripsi = $request->deskripsi;
        $dompet->status_id = $request->status;
        $dompet->save();
        
        return redirect('/')->with('status', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ubahStatus($id)
    {
        $dompet = Dompet::find($id);
        if ($dompet->status_id == 1) {
            $dompet->status_id = 2;
        }else{
            $dompet->status_id = 1;
        }
        $dompet->save();
        return redirect('/')->with('status', 'Status Telah Berubah');
    }
}
