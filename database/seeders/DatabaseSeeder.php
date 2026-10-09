<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
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

        $kelas = Category::create([
            'name' => 'Ruang Kelas',
            'description' => 'Fasilitas ruang pembelajaran.',
        ]);

        $umum = Category::create([
            'name' => 'Fasilitas Umum',
            'description' => 'Fasilitas umum kampus.',
        ]);

        Facility::create([
            'category_id' => $kelas->id,
            'name' => 'Ruang Kelas A101',
            'location' => 'Gedung A Lantai 1',
            'description' => 'Ruang kelas utama.',
        ]);

        Facility::create([
            'category_id' => $umum->id,
            'name' => 'Toilet Gedung A',
            'location' => 'Gedung A Lantai 1',
            'description' => 'Toilet umum mahasiswa.',
        ]);
    }
}
