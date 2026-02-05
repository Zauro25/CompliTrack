<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('divisions')->insert([
            [
                'division_id' => 1,
                'Nama_Divisi' => 'Default Division',
                'Deskripsi' => 'This is the default division for initial users.'
            ],
        ]);
    }
}
