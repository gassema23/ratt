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
        Schema::create('network_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('network_id')->constrained();
            $table->foreignId('scenario_id')->constrained();
            $table->foreignId('task_id')->constrained();
            $table->unsignedInteger('team_id')->unsigned();
            $table->boolean('priority')->default(3)->nullable();
            $table->date('due_date');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_tasks');
    }
};
