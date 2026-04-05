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
    Schema::create('pengaduans', function (Blueprint $table) {
        $table->id();
        $table->string('report_number')->unique();
        $table->string('report_type');
        $table->string('reporter_name');
        $table->string('reporter_class');
        $table->string('victim_name');
        $table->string('victim_class')->nullable();
        $table->string('perpetrator_name')->nullable();
        $table->string('perpetrator_class')->nullable();
        $table->date('incident_date');
        $table->time('incident_time')->nullable();
        $table->string('location');
        $table->string('bullying_type');
        $table->text('description');
        $table->string('witnesses')->nullable();
        $table->enum('urgency', ['low', 'medium', 'high'])->default('medium');
        $table->enum('status', ['Menunggu', 'Diproses', 'Selesai'])->default('Menunggu');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
