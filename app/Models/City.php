<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, Userstamps, LogsActivity;
    public $translatable = ['name'];
    //protected $cascadeDeletes = ['sites'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn(string $eventName) => "City {$eventName}")
            ->useLogName('CitiesLog');
    }
    // Relations
    public function sites(): HasMany
    {
        return $this->hasMany(Site::class)->withTrashed();
    }
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class)->withTrashed();
    }
    public function networks()
    {
        return $this->hasMany(Network::class);
    }
}
