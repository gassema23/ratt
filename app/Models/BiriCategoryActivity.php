<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BiriCategoryActivity extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity, HasTranslations;
    public $translatable = ['label', 'description'];

    protected $table = "biri_category_activities";

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Biri category activities {$eventName}")
            ->useLogName('BiriCategoryActivitiesLog');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(BiriActivity::class, 'category_id', 'id');
    }
}
