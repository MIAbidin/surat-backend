<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UnitKerja;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $ft = UnitKerja::where('kode', 'FT')->first();
        $ti = UnitKerja::where('kode', 'TI')->first();
        $tu = UnitKerja::where('kode', 'TU')->first();

        $users = [
            [
                'name'         => 'Super Admin',
                'email'        => 'admin@test.com',
                'role'         => 'admin',
                'unit_kerja_id'=> $ft->id,
            ],
            [
                'name'         => 'Staf TU',
                'email'        => 'tu@test.com',
                'role'         => 'tu',
                'unit_kerja_id'=> $tu->id,
            ],
            [
                'name'         => 'Dr. Ketua Prodi',
                'email'        => 'kaprodi@test.com',
                'role'         => 'kaprodi',
                'nidn'         => '0011223344',
                'unit_kerja_id'=> $ti->id,
            ],
            [
                'name'         => 'Dr. Wakil Dekan',
                'email'        => 'wadek@test.com',
                'role'         => 'wadek',
                'nidn'         => '0055667788',
                'unit_kerja_id'=> $ft->id,
            ],
            [
                'name'         => 'Prof. Dekan',
                'email'        => 'dekan@test.com',
                'role'         => 'dekan',
                'nidn'         => '0099001122',
                'unit_kerja_id'=> $ft->id,
            ],
            [
                'name'         => 'Dosen Contoh',
                'email'        => 'dosen@test.com',
                'role'         => 'dosen',
                'nidn'         => '0012345678',
                'unit_kerja_id'=> $ti->id,
            ],
            [
                'name'         => 'Mahasiswa Contoh',
                'email'        => 'mhs@test.com',
                'role'         => 'mahasiswa',
                'nim'          => '2021001001',
                'unit_kerja_id'=> $ti->id,
            ],
        ];

        foreach ($users as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                array_merge($data, ['password' => Hash::make('password123')])
            );
        }
    }
}