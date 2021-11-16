<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dompet;

class DompetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dompet = 
        [
        	[
	        	'nama'=> 'Dompet Utama',
	        	'referensi'=>'5270072502',
	        	'deskripsi'=>'Bank BCA',
	        	'status_id'=>1
	        	
        	],
        	[
        		'nama'=> 'Dompet Tagihan',
	        	'referensi'=>'5270072503',
	        	'deskripsi'=>'Bank BCA',
	        	'status_id'=>1
        	],
        	[
        		'nama'=> 'Dompet Cadangan',
	        	'referensi'=>'5270072504',
	        	'deskripsi'=>'Bank Permata',
	        	'status_id'=>1
        	]
        ];
        foreach ($dompet as $d) {
        	$dompetBaru = new Dompet;
        	$dompetBaru->nama = $d['nama'];
        	$dompetBaru->referensi = $d['referensi'];
        	$dompetBaru->deskripsi = $d['deskripsi'];
        	$dompetBaru->status_id = $d['status_id'];
        	$dompetBaru->save();
        }
    }
}
