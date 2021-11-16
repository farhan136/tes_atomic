<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DompetStatus;

class DompetStatusSeeder extends Seeder
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
        	$statusDompet = new DompetStatus;
        	$statusDompet->nama = $s['nama'];
        	$statusDompet->save();
        }
    }
}
