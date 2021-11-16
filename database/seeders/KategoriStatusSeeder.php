<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriStatus;

class KategoriStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = 
        [
        	[
	        	'nama'=> 'aktif',
        	],
        	[
        		'nama'=> 'tidak aktif',
        	]
        ];
        foreach ($status as $s) {
        	$statusKategori = new KategoriStatus;
        	$statusKategori->nama = $s['nama'];
        	$statusKategori->save();
        }
    }
}
