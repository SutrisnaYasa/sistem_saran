<?php

use App\Divisi;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Divisi::insert([
            [
                'nama' => 'WAKA 1',
                'parent' => null,
            ],
            [
                'nama' => 'BAAK',
                'parent' => 1
            ],
            [
                'nama' => 'PPTI',
                'parent' => 1
            ],
            [
                'nama' => 'WAKA 2',
                'parent' => null,
            ],
            [
                'nama' => 'UPT',
                'parent' => 4
            ],
            [
                'nama' => 'Keuangan',
                'parent' => 4
            ]
        ]);
    }
}
