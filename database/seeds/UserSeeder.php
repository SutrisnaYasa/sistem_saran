<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('password!@#'),
            'akses' => 1,
            'divisi_id' => null
        ]);
        User::create([
            'name' => 'User',
            'username' => 'user',
            'password' => Hash::make('password!@#'),
            'akses' => 2,
            'divisi_id' => 3
        ]);
    }
}
