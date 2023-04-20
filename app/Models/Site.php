<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Site extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, CascadeSoftDeletes, Userstamps, LogsActivity;
    public $translatable = ['name', 'contact_and_site_access', 'other_site_information'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Site {$eventName}")
            ->useLogName('SitesLog');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(SiteType::class, 'type_id');
    }

    public function getLatLongLinkAttribute()
    {
        return 'http://www.google.com/maps/place/' . $this->latitude . ',' . $this->longitude . '/@' . $this->latitude . ',' . $this->longitude . ',6z';
    }
}
