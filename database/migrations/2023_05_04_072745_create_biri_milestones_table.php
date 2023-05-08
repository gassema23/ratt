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
        Schema::create('biri_milestones', function (Blueprint $table) {
            $table->id();
            $table->string('project')->nullable();
            $table->string('title')->nullable();
            $table->string('planner_ntwk')->nullable();
            $table->string('designer_ntwk')->nullable();
            $table->string('designer_mgr_ntwk')->nullable();
            $table->string('network')->nullable();
            $table->string('sap_header')->nullable();
            $table->integer('priority')->nullable();
            $table->string('system_status')->nullable();
            $table->string('user_status')->nullable();
            $table->date('sheduled_finish')->nullable();
            $table->string('wbs_element')->nullable();
            $table->string('technology')->nullable();
            $table->string('ntwk_type')->nullable();
            $table->string('cpr_ntwk')->nullable();
            $table->date('crtd_status')->nullable();
            $table->date('rfa_status')->nullable();
            $table->date('app1_status')->nullable();
            $table->date('app2_mist')->nullable();
            $table->date('app2_status')->nullable();
            $table->date('dapp_mist')->nullable();
            $table->date('dapp_status')->nullable();
            $table->date('nrtb_mist')->nullable();
            $table->date('rtb_status')->nullable();
            $table->date('fcom_mist')->nullable();
            $table->date('fcom_status')->nullable();
            $table->date('cprd_mist')->nullable();
            $table->date('nisr_mist')->nullable();
            $table->date('nis2_mist')->nullable();
            $table->date('rfs_status')->nullable();
            $table->date('ncom_mist')->nullable();
            $table->date('teco_status')->nullable();
            $table->date('crtd_fmo_status')->nullable();
            $table->date('rfa_fmo_status')->nullable();
            $table->date('rjt_fmo_status')->nullable();
            $table->date('appd_fmo_status')->nullable();
            $table->date('dcom_fmo_status')->nullable();
            $table->date('dapp_fmo_mist')->nullable();
            $table->date('dapp_fmo_status')->nullable();
            $table->date('rgh_fmo_status')->nullable();
            $table->date('nrtb_fmo_mist')->nullable();
            $table->date('rtb_fmo_status')->nullable();
            $table->date('fcom_fmo_mist')->nullable();
            $table->date('fcom_fmo_status')->nullable();
            $table->date('cprd_fmo_mist')->nullable();
            $table->date('nisr_fmo_mist')->nullable();
            $table->date('rfs_fmo_status')->nullable();
            $table->date('clos_fmo_status')->nullable();
            $table->integer('counter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biri_milestones');
    }
};
