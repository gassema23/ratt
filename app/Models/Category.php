<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Approval\Traits\RequiresApproval;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Mpociot\Versionable\VersionableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{
    use HasFactory,
        HasTranslations,
        SoftDeletes,
        Userstamps,
        LogsActivity,
        HasSlug,
        CascadeSoftDeletes,
        VersionableTrait,
        RequiresApproval;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'slug' => 'string',
        'deleted_at' => 'datetime',
    ];
    protected $observables = [
        'validating',
        'validated',
    ];
    public $translatable = [
        'name',
        'description',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Category {$eventName}")
            ->useLogName('CacetgoriesLog');
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->doNotGenerateSlugsOnUpdate()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function entries(string $class): MorphToMany
    {
        return $this->morphedByMany($class, 'categorizable', 'categorizables', 'category_id', 'categorizable_id', 'id', 'id')->withTimestamps();
    }

    public function documentations(): HasMany
    {
        return $this->hasMany(Documentation::class);
    }
}
