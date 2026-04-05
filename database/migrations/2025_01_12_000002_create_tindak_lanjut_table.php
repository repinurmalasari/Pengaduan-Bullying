<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tindak_lanjut')) {
            Schema::create('tindak_lanjut', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('pengaduan_id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('nomor_tindakan')->unique();
                $table->enum('jenis_tindakan', ['pembinaan', 'konseling', 'skorsing', 'peringatan', 'lainnya']);
                $table->text('deskripsi');
                $table->date('tanggal_tindakan');
                $table->date('tanggal_selesai')->nullable();
                $table->enum('status', ['direncanakan', 'sedang_berjalan', 'selesai'])->default('direncanakan');
                $table->text('hasil')->nullable();
                $table->string('attachment')->nullable();
                $table->timestamps();
                
                $table->foreign('pengaduan_id')->references('id')->on('pengaduan')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut');
    }
};
