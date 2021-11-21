<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Farhan Anshari';
        $user->email = 'fanshari62@gmail.com';
        $user->password = bcrypt('kepokepo');
        $user->save();
    }
}
