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
        // Create siswas table
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis', 20)->unique();
            $table->string('kelas', 10);
            $table->string('email')->unique();
            $table->string('no_telepon', 15);
            $table->text('alamat');
            $table->timestamps();
        });

        // Create gurus table
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip', 20)->unique();
            $table->string('email')->unique();
            $table->string('no_telepon', 15);
            $table->string('mata_pelajaran');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
        Schema::dropIfExists('gurus');
    }
};
