<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlarmGeneratorType extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity, HasTranslations;
    public $translatable = ['label', 'prerequiste', 'deployment_procedure', 'emergency_contact', 'generator_available'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Alarm Generator Type {$eventName}")
            ->useLogName('AlarmGeneratorTypesLog');
    }
}
