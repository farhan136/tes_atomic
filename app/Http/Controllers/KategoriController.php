<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('master.kategori.kategori', ['kategori'=>$kategori, 'PARENTTAG'=>'master', 'CHILDTAG'=>'kategori']);
    }

    public function create()
    {
        return view('master.kategori.tambah', ['PARENTTAG'=>'master', 'CHILDTAG'=>'kategori']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:5',
            'deskripsi'=>'max:255',
            'status'=>'required'
        ]);

        $kategori = new Kategori;
        $kategori->nama = $request->nama;
        $kategori->deskripsi = $request->deskripsi;
        $kategori->status_id = $request->status;
        $kategori->save();
        
        return redirect('kategori/kategori')->with('status', 'Data Baru Berhasil Ditambahkan');
    }

    public function show($id)
    {
        $kategori = Kategori::find($id);
        return view('master.kategori.detail', ['kategori'=>$kategori, 'PARENTTAG'=>'master', 'CHILDTAG'=>'kategori']);
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('master.kategori.ubah', ['kategori'=>$kategori, 'PARENTTAG'=>'master', 'CHILDTAG'=>'kategori']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|max:5',
            'deskripsi'=>'max:255',
            'status'=>'required'
        ]);

        $kategori = Kategori::find($id);
        $kategori->nama = $request->nama;
        $kategori->deskripsi = $request->deskripsi;
        $kategori->status_id = $request->status;
        $kategori->save();
        
        return redirect('kategori/kategori')->with('status', 'Data Berhasil Diubah');
    }

    public function ubahStatus($id)
    {
        $kategori = Kategori::find($id);
        if ($kategori->status_id == 1) {
            $kategori->status_id = 2;
        }else{
            $kategori->status_id = 1;
        }
        $kategori->save();
        return redirect('kategori/kategori')->with('status', 'Status Telah Berubah');
    }
}
