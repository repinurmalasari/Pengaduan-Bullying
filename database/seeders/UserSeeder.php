<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'name' => 'Admin',
            'email' => 'admin@smkn1padaherang.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::updateOrCreate([
            'name' => 'Kepala Sekolah',
            'email' => 'kepalasekolah@smkn1padaherang.com',
            'password' => Hash::make('password123'),
            'role' => 'kepala_sekolah',
        ]);

        User::updateOrCreate([
            'name' => 'Guru BK',
            'email' => 'gurubk@smkn1padaherang.com',
            'password' => Hash::make('password123'),
            'role' => 'guru_bk',
        ]);

        User::updateOrCreate([
            'name' => 'Wali Kelas',
            'email' => 'walikelas@smkn1padaherang.com',
            'password' => Hash::make('password123'),
            'role' => 'wali_kelas',
        ]);

        User::updateOrCreate([
            'name' => 'Siswa',
            'email' => 'siswa@smkn1padaherang.com',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);
    }
}
