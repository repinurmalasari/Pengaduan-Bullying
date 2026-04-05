<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            // Kolom untuk Step 2: PROSES
            $table->date('tanggal_mulai_proses')->nullable()->after('tanggal_tindakan');
            $table->text('catatan_proses')->nullable()->after('deskripsi');
            $table->string('pihak_terlibat')->nullable()->after('catatan_proses');
            $table->text('kendala')->nullable()->after('pihak_terlibat');
            
            // Kolom untuk Step 3: SELESAI
            $table->text('evaluasi')->nullable()->after('hasil');
            $table->text('rekomendasi')->nullable()->after('evaluasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_mulai_proses',
                'catatan_proses',
                'pihak_terlibat',
                'kendala',
                'evaluasi',
                'rekomendasi'
            ]);
        });
    }
};