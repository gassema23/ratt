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

class BiriActivity extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity, HasTranslations;

    public $translatable = ['description'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Biri activities {$eventName}")
            ->useLogName('BiriActivitiesLog');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BiriCategoryActivity::class, 'category_id', 'id');
    }

    public function technology(): BelongsTo
    {
        return $this->belongsTo(BiriTechnology::class, 'technology_id', 'id');
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(BiriEquipment::class, 'equipment_id', 'id');
    }
}
