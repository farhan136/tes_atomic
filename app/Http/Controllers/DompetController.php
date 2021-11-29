<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dompet;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DompetsImport;
use App\Exports\DompetsExport;

class DompetController extends Controller
{
    public function index(Request $request)
    {
        $dompet = DB::table('dompets')
        ->join('dompet_status', 'dompets.status_id', '=', 'dompet_status.id')
        ->select(
            'dompets.id as id',
            'dompets.nama as nama',
            'dompets.referensi as referensi',
            'dompets.deskripsi as deskripsi',
            'dompet_status.nama as status'
        );
        // dump('hai');
        if($request->input('status')!=null){
            // $dompet->where('dompets.status_id', $request->status)->get();
            dump('hai');
        }else{
            $dompet->get();
        }

        if ($request->ajax()) {
            return Datatables()->of($dompet)
            ->addColumn('aksi', function($item){

                return '
                <button class="btn btn-secondary tombol'.$item->id.'" data-toggle="modal" data-target="#editModal" id="tombol_edit" data-id="'.$item->id.'">
                <i class="fas fa-pen"></i>
                </button>
                <a href="'. route('dompet.show', $item->id) .'" class="btn btn-secondary">
                <i class="fas fa-search"></i>
                </a>
                <button class="btn btn-secondary" data-id="'.$item->id.'" id="tombol_ubah_status"> 
                <i class="fas fa-times"></i>
                </button>
                ';
            })->addColumn('cb', function($item){

                return '
                <input id="cb-child" type="checkbox" data-id="'.$item->id.'">
                </input>
                ';
            })->rawColumns(['cb', 'aksi'])
            ->make();
        }
        // dd($request->input('status'));
        return view('master.dompet.dompet', ['dompet'=>$dompet, 'PARENTTAG'=>'master', 'CHILDTAG'=>'dompet']);
    }

    public function create()
    {
        return view('master.dompet.tambah', ['PARENTTAG'=>'master', 'CHILDTAG'=>'dompet']);
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
        
        
        return response()->json(true);   
    }

    public function show($id)
    {
        $dompet = Dompet::find($id);
        return view('master.dompet.detail', ['dompet'=>$dompet, 'PARENTTAG'=>'master', 'CHILDTAG'=>'dompet']);
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
        
        return response()->json($dompet);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|max:5',
            'deskripsi'=>'max:255',
            'status'=>'required'
        ]);
        $id = $request->id;
        $dompet = Dompet::find($id);
        $dompet->nama = $request->nama;
        $dompet->referensi = $request->referensi;
        $dompet->deskripsi = $request->deskripsi;
        $dompet->status_id = $request->status;
        $dompet->save();
        
        // return redirect('/')->with('status', 'Data Berhasil Diubah');
        return response()->json(true);
    }

    public function ubahStatus($id)
    {
        $dompet = Dompet::find($id);
        if ($dompet->status_id == 1) {
            $dompet->status_id = 2;
        }else{
            $dompet->status_id = 1;
        }
        $dompet->save();
        // return redirect('/')->with('status', 'Status Telah Berubah');
        return response()->json(true);
    }

    public function import(request $request) 
    {
        try {
            $file = $request->file('excel');

            Excel::import(new DompetsImport, $file);

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             
             foreach ($failures as $failure) {
                 $failure->row(); // row that went wrong
                 $failure->attribute(); // either heading key (if using heading row concern) or column index
                 $failure->errors(); // Actual error messages from Laravel validator
                 $failure->values(); // The values of the row that has failed.
             }

             return redirect()->back()->withErrors($failures);
        }
        
        return redirect()->back()->with('status', 'Data berhasil ditambahkan melalui excel');
    }

    public function export() 
    {
        return Excel::download(new DompetsExport, 'dompet.xlsx');
    }
}
