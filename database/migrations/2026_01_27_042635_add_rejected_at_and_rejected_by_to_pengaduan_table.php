<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            // Tambah kolom rejected_at
            if (!Schema::hasColumn('pengaduan', 'rejected_at')) {
                $table->timestamp('rejected_at')->nullable()->after('alasan_penolakan');
            }
            
            // Tambah kolom rejected_by
            if (!Schema::hasColumn('pengaduan', 'rejected_by')) {
                $table->unsignedBigInteger('rejected_by')->nullable()->after('rejected_at');
                $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            if (Schema::hasColumn('pengaduan', 'rejected_by')) {
                $table->dropForeign(['rejected_by']);
                $table->dropColumn('rejected_by');
            }
            if (Schema::hasColumn('pengaduan', 'rejected_at')) {
                $table->dropColumn('rejected_at');
            }
        });
    }
};