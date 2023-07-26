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
        Schema::dropIfExists('biri_milestones');
        Schema::create('biri_milestones', function (Blueprint $table) {
            $table->id();
            $table->string('project_no');
            $table->text('network_header')->nullable();
            $table->text('planner_ntwk')->nullable();
            $table->text('designer_ntwk')->nullable();
            $table->text('designerMgr_ntwk')->nullable();
            $table->text('network_no');
            $table->text('network_header_tech')->nullable();
            $table->integer('priority')->default(0)->nullable();
            $table->text('active_sys_status')->nullable();
            $table->text('active_user_status')->nullable();
            $table->date('schedule_end')->nullable();
            $table->text('wbs_element')->nullable();
            $table->text('label')->nullable();
            $table->text('ntwk_type')->nullable();
            $table->text('cpr_ntwk')->nullable();
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
            $table->date('telco_status')->nullable();
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
        Schema::dropIfExists('biri_milestones');
    }
};
