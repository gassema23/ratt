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
        Schema::dropIfExists('biri_activities');
        Schema::create('biri_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technology_id')->references('id')->on('biri_technologies');
            $table->foreignId('equipment_id')->references('id')->on('biri_equipment');
            $table->foreignId('category_id')->references('id')->on('biri_category_activities');
            $table->text('description')->nullable();
            $table->integer('avg_single')->default(0)->nullable();
            $table->integer('ps50_plan')->default(0)->nullable();
            $table->integer('ps50_act')->default(0)->nullable();
            $table->integer('avg_actual')->default(0)->nullable();
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
        Schema::dropIfExists('biri_activities');
    }
};
