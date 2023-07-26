<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BiriMilestone extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'schedule_end' => 'date',
        'crtd_status' => 'date',
        'rfa_status' => 'date',
        'app1_status' => 'date',
        'app2_status' => 'date',
        'dapp_mist' => 'date',
        'dapp_status' => 'date',
        'nrtb_mist' => 'date',
        'rtb_status' => 'date',
        'fcom_mist' => 'date',
        'fcom_status' => 'date',
        'cprd_mist' => 'date',
        'nisr_mist' => 'date',
        'nis2_mist' => 'date',
        'rfs_status' => 'date',
        'ncom_mist' => 'date',
        'telco_status' => 'date',
        'crtd_fmo_status' => 'date',
        'rfa_fmo_status' => 'date',
        'rjt_fmo_status' => 'date',
        'appd_fmo_status' => 'date',
        'dcom_fmo_status' => 'date',
        'dapp_fmo_mist' => 'date',
        'dapp_fmo_status' => 'date',
        'rgh_fmo_status' => 'date',
        'nrtb_fmo_status' => 'date',
        'nrtb_fmo_mist' => 'date',
        'rtb_fmo_status' => 'date',
        'fcom_fmo_mist' => 'date',
        'fcom_fmo_status' => 'date',
        'cprd_fmo_mist' => 'date',
        'nisr_fmo_mist' => 'date',
        'rfs_fmo_status' => 'date',
        'clos_fmo_status' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "PS44B Milestone {$eventName}")
            ->useLogName('BiriMilestoneLog');
    }
}
