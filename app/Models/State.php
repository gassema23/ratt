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

class State extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, CascadeSoftDeletes, Userstamps, LogsActivity;
    public $translatable = ['name'];
    protected $cascadeDeletes = ['regions'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "State {$eventName}")
            ->useLogName('StatesLog');
    }
    // Relations
    public function regions(): HasMany
    {
        return $this->hasMany(Region::class)->withTrashed();
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class)->withTrashed();
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(GeographicType::class, 'type_id')->withTrashed();
    }
}
