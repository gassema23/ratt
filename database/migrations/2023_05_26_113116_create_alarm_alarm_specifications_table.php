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
        Schema::create('alarm_alarm_specifications', function (Blueprint $table) {
            $table->foreignId('alarm_id')->references('id')->on('alarms');
            $table->foreignId('alarm_specification_id')->references('id')->on('alarm_specifications');
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->primary(['alarm_id', 'alarm_specification_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarm_alarm_specifications');
    }
};
