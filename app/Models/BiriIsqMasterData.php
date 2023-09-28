<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BiriIsqMasterData extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_date' => 'date',
        'order_start' => 'date',
        'order_end' => 'date',
        'updated_date' => 'date',
        'version_date' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Biri ISQ003 {$eventName}")
            ->useLogName('BiriISQ003Log');
    }

    public function assignment(): HasOne
    {
        return $this->hasOne(BiriAssignment::class, 'network_no', 'network_no');
    }

    public function getClliNameAttribute()
    {
        $arr = explode(':', $this->network_header);
        if (count($arr) > 0 && isset($arr[1])) {
            return $arr[1];
        } else {
            return 'N/A';
        }
    }
}
