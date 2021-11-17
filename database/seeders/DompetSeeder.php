<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dompet;

class DompetSeeder extends Seeder
{
    public function run()
    {
        for($i = 0; $i<=50; $i++){
            $dompetBaru = new Dompet;
            $dompetBaru->nama = "tes";
            $dompetBaru->referensi = 1231231231;
            $dompetBaru->deskripsi = "bagus nih bagus";
            $dompetBaru->status_id = 1;
            $dompetBaru->save();
        }
    }
}
