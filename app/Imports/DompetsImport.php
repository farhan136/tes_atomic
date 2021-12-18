<?php

namespace App\Imports;

use App\Models\Dompet;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class DompetsImport implements ToModel, WithHeadingRow, WithValidation

{
    public function model(array $row)
    {
        return new Dompet([
           'nama'     => $row['nama'],
           'referensi'    => $row['referensi'], 
           'deskripsi' =>$row['deskripsi'],
           'status_id' => $row['status_id'],
        ]);
    }

    public function rules(): array
    {
      return [ //mmembuat validation rule untuk tiap kolom
        'nama' => 'required|max:5',
        'deskripsi' => 'max:255',
        'status_id' => 'required|in:1,2',
      ];
    }

    public function customValidationMessages()
    {
        return [
            'nama.required' => 'Gaboleh kosong',
        ];
    }

}
