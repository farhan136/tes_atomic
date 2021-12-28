<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $kategori = DB::table('kategoris')
        ->join('kategori_status', 'kategoris.status_id', '=', 'kategori_status.id')
        ->select(
            'kategoris.id as id',
            'kategoris.nama as nama',
            'kategoris.deskripsi as deskripsi',
            'kategori_status.nama as status'
        )->get();

        if ($request->ajax()) {
            return Datatables()->of($kategori)
            ->addColumn('aksi', function($item){
                return '
                <button class="btn btn-secondary" data-toggle="modal" data-target="#modal-edit" id="tombol-edit" data-id="'.$item->id.'">
                <i class="fas fa-pen"></i>
                </button>
                <button class="btn btn-secondary" data-id="'.$item->id.'" id="tombol-ubah-status"> 
                <i class="fas fa-times"></i>
                </button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus" data-id="'.$item->id.'" id="tombol-hapus">
                  Hapus
                </button>
                ';
            })->rawColumns(['aksi'])
            ->make();
        }
        return view('master.kategori.kategori', ['kategori'=>$kategori, 'PARENTTAG'=>'master', 'CHILDTAG'=>'kategori']);
    }

    public function create()
    {
        return view('master.kategori.tambah', ['PARENTTAG'=>'master', 'CHILDTAG'=>'kategori']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi'=>'max:255',
            'status'=>'required'
        ]);
        
        $kategori = new Kategori;
        $kategori->nama = $request->nama;
        $kategori->deskripsi = $request->deskripsi;
        $kategori->status_id = $request->status;
        $kategori->save();
        
        return response()->json(true);
    }

    public function show($id)
    {
        $kategori = Kategori::find($id);
        return view('master.kategori.detail', ['kategori'=>$kategori, 'PARENTTAG'=>'master', 'CHILDTAG'=>'kategori']);
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return response()->json($kategori);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi'=>'max:255',
            'status'=>'required'
        ]);
        $kategori = Kategori::find($id);
        $kategori->nama = $request->nama;
        $kategori->deskripsi = $request->deskripsi;
        $kategori->status_id = $request->status;
        $kategori->save();
        
        // return redirect('kategori/kategori')->with('status', 'Data Berhasil Diubah');
        return response()->json(['status' => 'success']);
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

        if($kategori){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
        // return redirect('kategori/kategori')->with('status', 'Status Telah Berubah');
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $transaksi = Transaksi::where('kategori_id', $id)->firstOrFail();

        if($transaksi){
            $transaksi->delete();
        }
        
        $kategori->delete();        
        
        if($kategori){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
