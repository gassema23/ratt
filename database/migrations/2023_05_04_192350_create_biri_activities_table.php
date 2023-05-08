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
        Schema::create('biri_activities', function (Blueprint $table) {
            $table->id();
            $table->string('technology_name');
            $table->string('equipment_name');
            $table->string('activity_name');
            $table->string('activity_description');
            $table->float('average', 8, 2);
            $table->float('ps50_plan', 8, 2);
            $table->float('ps50_activity', 8, 2);
            $table->float('average_actual', 8, 2);
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
