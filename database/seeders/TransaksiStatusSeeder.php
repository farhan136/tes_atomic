<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiStatus;

class TransaksiStatusSeeder extends Seeder
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
	        	'nama'=> 'masuk',
        	],
        	[
        		'nama'=> 'keluar',
        	]
        ];
        foreach ($status as $s) {
        	$statusTransaksi = new TransaksiStatus;
        	$statusTransaksi->nama = $s['nama'];
        	$statusTransaksi->save();
        }
    }
}
