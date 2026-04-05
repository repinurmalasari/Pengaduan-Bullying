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
        Schema::table('tindak_lanjut_awal', function (Blueprint $table) {
            $table->date('tanggal_tindak_lanjut_awal')->nullable()->after('pengaduan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tindak_lanjut_awal', function (Blueprint $table) {
            $table->dropColumn('tanggal_tindak_lanjut_awal');
        });
    }
};