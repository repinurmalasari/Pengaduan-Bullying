<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tindak_lanjut', function (Blueprint $table) {
        $table->enum('status_hasil', [
            'berhasil',
            'cukup_berhasil',
            'perlu_tindak_lanjut'
        ])->nullable()->after('status');
    });
}

public function down()
{
    Schema::table('tindak_lanjut', function (Blueprint $table) {
        $table->dropColumn('status_hasil');
    });
}
};