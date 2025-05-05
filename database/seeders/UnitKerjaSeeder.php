<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unit_kerja')->insert([
            ['nama_unit_kerja' => 'Rektorat', 'jenis_unit_kerja' => 'Rektor', 'parent_unit_kerja' => null],
            ['nama_unit_kerja' => 'Fakultas', 'jenis_unit_kerja' => 'Fakultas', 'parent_unit_kerja' => 1],
            ['nama_unit_kerja' => 'Program Studi', 'jenis_unit_kerja' => 'Prodi', 'parent_unit_kerja' => 2],
            ['nama_unit_kerja' => 'Biro/UPT', 'jenis_unit_kerja' => 'Biro/UPT', 'parent_unit_kerja' => 1],
        ]);
        
    }
}
