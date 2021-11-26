<?php

namespace App\Exports;

use App\Models\Dompet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DompetsExport implements FromCollection, WithHeadings
{
    public function headings(): array //menambahkan header 
    {
        return [
            'nama',
            'referensi',
            'deskripsi',
            'status_id'
        ];
    }

    public function collection()
    {
        $dompet = Dompet::select('nama', 'referensi', 'deskripsi', 'status_id')->get();
        return $dompet;
    }
}
