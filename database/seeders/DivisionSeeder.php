<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = [
            'IT / Engineering',
            'Human Resources',
            'Finance',
            'Operations',
            'Legal & Compliance',
        ];

        foreach ($divisions as $name) {
            DB::table('divisions')->updateOrInsert(
                ['Nama_Divisi' => $name],
                ['Deskripsi' => null]
            );
        }
    }
}
