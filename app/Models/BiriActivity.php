<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BiriActivity extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'average' => 'float',
        'average_actual' => 'float',
        'ps50_plan' => 'float',
        'ps50_activity' => 'float',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Biri Activities {$eventName}")
            ->useLogName('BiriActivitiesLog');
    }
    public function scopeBiriTechnologies($query)
    {
        return $query->select('technology_name')->distinct()->get();
    }
    public function scopeBiriEquipments($query)
    {
        return $query->select('equipment_name')->distinct()->get();
    }
    public function scopeBiriActivities($query)
    {
        return $query->select('activity_name')->distinct()->get();
    }
}
