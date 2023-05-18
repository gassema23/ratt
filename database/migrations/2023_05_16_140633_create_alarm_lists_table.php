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
        Schema::create('alarm_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alarm_severity_id')->references('id')->on('alarm_severities');
            $table->foreignId('alarm_type_id')->references('id')->on('alarm_types');
            $table->string('model');
            $table->string('item_number', 10);
            $table->string('ctl')->nullable();
            $table->string('verb1')->nullable();
            $table->string('verb2')->nullable();
            $table->string('io_terminal')->nullable();
            $table->string('document_code')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('alarm_lists');
    }
};
