<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin FasTrack',
            'email' => 'admin@fastrack.test',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Mahasiswa Test',
            'email' => 'mahasiswa@fastrack.test',
            'password' => 'password123',
            'role' => 'mahasiswa',
        ]);
    }
}