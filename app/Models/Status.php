<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\ModelStatus\Status as SpatieStatus;

class Status extends SpatieStatus
{
    use Userstamps, LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Status {$eventName}")
            ->useLogName('StatusTaskLog');
    }
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function getStatusNameAttribute()
    {
        return collect(config('biri.App_statuses.' . App::getLocale()))->where('id', $this->name)->first()['name'];
    }
    public function getStatusColorAttribute()
    {
        return collect(config('biri.App_statuses.' . App::getLocale()))->where('id', $this->name)->first()['color'];
    }
}
