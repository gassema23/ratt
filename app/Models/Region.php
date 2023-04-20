<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, CascadeSoftDeletes, Userstamps, LogsActivity;

    public $translatable = ['name'];
    protected $cascadeDeletes = ['cities'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Region {$eventName}")
            ->useLogName('RegionsLog');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
