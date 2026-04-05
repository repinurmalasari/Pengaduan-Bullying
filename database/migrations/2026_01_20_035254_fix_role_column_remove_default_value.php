<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // LANGKAH 1: Set semua role yang tidak valid menjadi NULL dulu
        DB::statement("UPDATE users SET role = NULL WHERE role NOT IN ('admin', 'guru_bk', 'wali_kelas', 'siswa', 'kepala_sekolah', 'guru')");
        
        // LANGKAH 2: Baru ubah struktur kolom
        DB::statement("
            ALTER TABLE users 
            MODIFY COLUMN role ENUM('admin', 'guru_bk', 'wali_kelas', 'siswa', 'kepala_sekolah', 'guru') NULL
        ");
    }

    public function down(): void
    {
        // Tidak perlu rollback
    }
};