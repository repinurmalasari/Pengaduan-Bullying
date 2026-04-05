<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pengaduan')) {
            Schema::table('pengaduan', function (Blueprint $table) {
                // Add id column if it doesn't exist
                if (!Schema::hasColumn('pengaduan', 'id')) {
                    $table->id()->first();
                }
                
                // Add user_id if it doesn't exist
                if (!Schema::hasColumn('pengaduan', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pengaduan') && Schema::hasColumn('pengaduan', 'user_id')) {
            Schema::table('pengaduan', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }
};
