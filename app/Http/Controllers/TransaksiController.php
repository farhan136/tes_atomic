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
        $dompet = DB::table('dompets')->where('status_id', 1)->orderBy('nama', 'asc')->get();
        $kategori = DB::table('kategoris')->where('status_id', 1)->orderBy('nama', 'asc')->get();
        return view('transaksi.tambah', ['dompet'=>$dompet, 'kategori'=>$kategori]);
    }

    public function filter()
    {
        $dompet = DB::table('dompets')->where('status_id', 1)->orderBy('nama', 'asc')->get();
        $kategori = DB::table('kategoris')->where('status_id', 1)->orderBy('nama', 'asc')->get();
        return view('laporan.filter', ['dompet'=>$dompet, 'kategori'=>$kategori]);
    }

    public function store(Request $request)
    {
        //Memambahkan dompet masuk dan dompet keluar hanya dari 1 form, akan dikondisikan dibawah
        $validated = $request->validate([
            'nilai' => 'required|numeric|min:0',
            'deskripsi'=>'max:255',
            'kategori'=>'required',
            'dompet'=>'required'
        ]);

        //jika kategorinya bukan pengeluarana
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

    public function filterTransaksi(Request $request)
    {
        //mengambil data dari form
        $awal = $request->awal?: '';
        $akhir = $request->akhir?: '';
        $status = $request->status?: '';
        $dompet = $request->dompet?: '';
        $kategori = $request->kategori?: '';

        $filtered = DB::table('transaksis')
            ->join('kategoris', 'transaksis.kategori_id', '=', 'kategoris.id')
            ->join('dompets', 'transaksis.dompet_id', '=', 'dompets.id')
            ->join('transaksi_status', 'transaksis.status_id', '=', 'transaksi_status.id')
            ->whereBetween('tanggal', [$awal, $akhir])
            ->orWhere('transaksis.status_id', $status)
            ->orWhere('transaksis.dompet_id', $dompet)
            ->orWhere('transaksis.kategori_id', $kategori)
            ->select('transaksis.tanggal as tanggal',
                'transaksis.kode as kode',
                'transaksis.deskripsi as deskripsi',
                'transaksis.nilai as nilai',
                'transaksis.status_id as status_id',
                'dompets.nama as dompet',
                'kategoris.nama as kategori',)
            ->get();
        
        if($filtered->isEmpty()){
            $filtered = DB::table('transaksis')
            ->join('kategoris', 'transaksis.kategori_id', '=', 'kategoris.id')
            ->join('dompets', 'transaksis.dompet_id', '=', 'dompets.id')
            ->join('transaksi_status', 'transaksis.status_id', '=', 'transaksi_status.id')
            ->select('transaksis.tanggal as tanggal',
                'transaksis.kode as kode',
                'transaksis.deskripsi as deskripsi',
                'transaksis.nilai as nilai',
                'transaksis.status_id as status_id',
                'dompets.nama as dompet',
                'kategoris.nama as kategori',)
            ->get();
        }
        return view('laporan.laporan', ["filtered"=>$filtered]);
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
