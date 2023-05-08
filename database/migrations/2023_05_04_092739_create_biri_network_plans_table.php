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
        Schema::create('biri_network_plans', function (Blueprint $table) {
            $table->id();
            $table->string('project')->nullable();
            $table->string('network')->nullable();
            $table->string('network_name')->nullable();
            $table->string('network_activity')->nullable();
            $table->string('work_center')->nullable();
            $table->string('wc_name')->nullable();
            $table->float('plan', 8, 2)->nullable();
            $table->float('actual', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biri_network_plans');
    }
};
