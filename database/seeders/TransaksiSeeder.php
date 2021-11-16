<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaksi = 
        [
        	[
	        	'kode'=> 'Dompet Utama',
	        	'deskripsi'=>'Bank BCA',
	        	'tanggal'=>'',
	        	'nilai'=>5000000,
	        	'dompet_id'=>,
	        	'kategori_id'=>,
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
        foreach ($transaksi as $d) {
        	$transaksiBaru = new Transaksi;
        	$transaksiBaru->nama = $d['nama'];
        	$transaksiBaru->referensi = $d['referensi'];
        	$transaksiBaru->deskripsi = $d['deskripsi'];
        	$transaksiBaru->status_id = $d['status_id'];
        	$transaksiBaru->save();
        }
    }
}
