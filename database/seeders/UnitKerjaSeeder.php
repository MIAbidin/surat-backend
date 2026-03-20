<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['nama' => 'Fakultas Teknik',              'kode' => 'FT',    'jenis' => 'fakultas'],
            ['nama' => 'Teknik Informatika',            'kode' => 'TI',    'jenis' => 'prodi'],
            ['nama' => 'Teknik Elektro',                'kode' => 'TE',    'jenis' => 'prodi'],
            ['nama' => 'Teknik Sipil',                  'kode' => 'TS',    'jenis' => 'prodi'],
            ['nama' => 'Tata Usaha Fakultas',           'kode' => 'TU',    'jenis' => 'unit'],
        ];

        foreach ($units as $unit) {
            UnitKerja::firstOrCreate(['kode' => $unit['kode']], $unit);
        }
    }
}