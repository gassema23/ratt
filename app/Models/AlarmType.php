<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlarmType extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity, HasTranslations;
    public $translatable = ['label', 'description'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Alarm types {$eventName}")
            ->useLogName('AlarmTypesLog');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(AlarmCategory::class, 'alarm_category_id', 'id');
    }
}
