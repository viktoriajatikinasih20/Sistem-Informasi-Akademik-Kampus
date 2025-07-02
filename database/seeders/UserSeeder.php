<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Siakad',
            'email' => 'admin@siakad.test',
            'password' => Hash::make('admin123'), // penting: manual hash
        ]);
    }
}
