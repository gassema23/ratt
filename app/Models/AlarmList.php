<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlarmList extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Alarm lists {$eventName}")
            ->useLogName('AlarmListsLog');
    }

    public function severity(): BelongsTo
    {
        return $this->belongsTo(AlarmSeverity::class, 'alarm_severity_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(AlarmType::class, 'alarm_type_id', 'id');
    }
}
