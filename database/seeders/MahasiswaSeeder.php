<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        Mahasiswa::create([
            'nama' => 'Budi Santoso',
            'nim' => '123456789',
            'prodi' => 'Teknik Informatika',
            'ttl' => 'Semarang, 25-03-2000',
        ]);
    }
}
