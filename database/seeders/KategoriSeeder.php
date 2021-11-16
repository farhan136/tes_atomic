<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = 
        [
        	[
	        	'nama'=> 'Pengeluaran',
	        	'deskripsi'=>'Kategori untuk pengeluaran',
	        	'status_id'=>1
	        	
        	],
        	[
        		'nama'=> 'Pemasukan',
	        	'deskripsi'=>'Kategori untuk pemasukan',
	        	'status_id'=>1
        	],
        	[
        		'nama'=> 'Lain-Lain',
	        	'deskripsi'=>'Kategori lain-lain',
	        	'status_id'=>1
        	]
        ];
        foreach ($kategori as $d) {
        	$kategoriBaru = new Kategori;
        	$kategoriBaru->nama = $d['nama'];
        	$kategoriBaru->deskripsi = $d['deskripsi'];
        	$kategoriBaru->status_id = $d['status_id'];
        	$kategoriBaru->save();
        }
    }
}
