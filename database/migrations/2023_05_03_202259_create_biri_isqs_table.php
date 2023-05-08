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
        Schema::create('biri_isqs', function (Blueprint $table) {
            $table->id();
            $table->string('network')->nullable();
            $table->string('sap_header')->nullable();
            $table->string('order_type')->nullable();
            $table->string('plant')->nullable();
            $table->string('project_definition')->nullable();
            $table->date('created_on')->nullable();
            $table->date('scheduled_start')->nullable();
            $table->date('scheduled_finish')->nullable();
            $table->string('system_status')->nullable();
            $table->string('user_status')->nullable();
            $table->date('changed_on')->nullable();
            $table->string('planner_1')->nullable();
            $table->string('planner_2')->nullable();
            $table->string('planning_manager')->nullable();
            $table->integer('counter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isqs');
    }
};
