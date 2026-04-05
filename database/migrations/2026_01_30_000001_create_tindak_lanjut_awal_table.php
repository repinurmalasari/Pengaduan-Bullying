<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tindak_lanjut_awal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaduan_id');
            $table->unsignedBigInteger('user_id')->nullable(); // wali kelas yang menangani
            $table->text('catatan')->nullable(); // Rencana Tindak Lanjut
            $table->boolean('panggil_korban')->default(false);
            $table->boolean('panggil_pelaku')->default(false);
            $table->boolean('rekomendasi_bk')->default(false);
            $table->enum('status', ['diproses', 'selesai', 'direkomendasi_bk'])->default('diproses');
            $table->timestamps();
            
            $table->foreign('pengaduan_id')->references('id')->on('pengaduan')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut_awal');
    }
};
