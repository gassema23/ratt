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
        Schema::dropIfExists('biri_assignments');
        Schema::create('biri_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desn_user_id')->references('id')->on('users');
            $table->foreignId('tech_user_id')->references('id')->on('users');
            $table->string('network_no')->index();
            $table->string('fox_order')->nullable();
            $table->integer('priority')->default(0);
            $table->foreignId('technology_id')->references('id')->on('biri_technologies');
            $table->foreignId('equipment_id')->references('id')->on('biri_equipment');
            $table->foreignId('activity_id')->references('id')->on('biri_category_activities');
            $table->date('desn_req');
            $table->date('fich_eng_req');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biri_assignments');
    }
};
