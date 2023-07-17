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
        Schema::dropIfExists('biri_isqs');

        Schema::create('biri_isq_master_data', function (Blueprint $table) {
            $table->id();
            $table->string('network_no', 15);
            $table->string('network_header')->nullable();
            $table->string('order_type')->nullable();
            $table->integer('division')->default(0)->nullable();
            $table->string('project_no')->nullable();
            $table->date('created_date')->nullable();
            $table->date('order_start')->nullable();
            $table->date('order_end')->nullable();
            $table->string('status_sys')->nullable();
            $table->string('status_util')->nullable();
            $table->date('updated_date')->nullable();
            $table->string('responsible')->nullable();
            $table->string('planner')->nullable();
            $table->string('sr_planner')->nullable();
            $table->integer('count')->nullable();
            $table->dateTime('version_date')->default(now());
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
        Schema::dropIfExists('biri_isq_master_data');
    }
};
