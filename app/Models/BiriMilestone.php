<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiriMilestone extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'sheduled_finish' => 'date',
        'crtd_status' => 'date',
        'rfa_status' => 'date',
        'app1_status' => 'date',
        'app2_mist' => 'date',
        'app2_status' => 'date',
        'dapp_mist' => 'date',
        'nrtb_mist' => 'date',
        'rtb_status' => 'date',
        'fcom_mist' => 'date',
        'fcom_status' => 'date',
        'cprd_mist' => 'date',
        'nisr_mist' => 'date',
        'nis2_mist' => 'date',
        'rfs_status' => 'date',
        'ncom_mist' => 'date',
        'teco_status' => 'date',
        'crtd_fmo_status' => 'date',
        'rfa_fmo_status' => 'date',
        'rjt_fmo_status' => 'date',
        'appd_fmo_status' => 'date',
        'dcom_fmo_status' => 'date',
        'dapp_fmo_mist' => 'date',
        'dapp_fmo_status' => 'date',
        'rgh_fmo_status' => 'date',
        'nrtb_fmo_status' => 'date',
        'rtb_fmo_status' => 'date',
        'fcom_fmo_mist' => 'date',
        'fcom_fmo_status' => 'date',
        'cprd_fmo_mist' => 'date',
        'nisr_fmo_mist' => 'date',
        'rfs_fmo_status' => 'date',
        'clos_fmo_status' => 'date',
    ];

    public function isqs()
    {
        return $this->hasMany(BiriIsq::class, 'network', 'network');
    }
    public function isq()
    {
        return $this->hasOne(BiriIsq::class, 'network', 'network')->latest();
    }
}
