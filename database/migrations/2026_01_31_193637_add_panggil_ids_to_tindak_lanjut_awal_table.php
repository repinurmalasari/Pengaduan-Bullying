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
            // Add columns for storing the actual student IDs
            $table->unsignedBigInteger('panggil_korban_id')->nullable()->after('catatan');
            $table->unsignedBigInteger('panggil_pelaku_id')->nullable()->after('panggil_korban_id');
            
            // Add foreign keys
            $table->foreign('panggil_korban_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('panggil_pelaku_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tindak_lanjut_awal', function (Blueprint $table) {
            $table->dropForeign(['panggil_korban_id']);
            $table->dropForeign(['panggil_pelaku_id']);
            $table->dropColumn(['panggil_korban_id', 'panggil_pelaku_id']);
        });
    }
};
