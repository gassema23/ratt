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
        Schema::create('biri_assigment_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->references('id')->on('biri_assignments');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('name');
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('biri_assigment_statuses');
    }
};
