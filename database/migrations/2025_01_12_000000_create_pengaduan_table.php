<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Only create table if it doesn't exist
        if (!Schema::hasTable('pengaduan')) {
            Schema::create('pengaduan', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('nomor_laporan')->unique();
                $table->enum('report_type', ['korban', 'teman_korban', 'orang_tua', 'guru', 'lainnya']);
                $table->string('reporter_name');
                $table->string('reporter_class');
                $table->string('victim_name');
                $table->string('victim_class');
                $table->string('perpetrator_name');
                $table->string('perpetrator_class');
                $table->date('incident_date');
                $table->time('incident_time')->nullable();
                $table->string('location');
                $table->enum('bullying_type', ['fisik', 'verbal', 'cyber', 'pengucilan', 'intimidasi', 'lainnya']);
                $table->text('description');
                $table->string('witnesses')->nullable();
                $table->enum('urgency', ['rendah', 'sedang', 'tinggi']);
                $table->string('attachment')->nullable();
                $table->enum('status', ['draf', 'diproses', 'selesai'])->default('diproses');
                $table->timestamps();
                
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
