<?php

namespace App\Models;

use App\Traits\HasFilter;
use Conner\Tagging\Taggable;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Conner\Tagging\TaggingUtility;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Approval\Traits\RequiresApproval;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Versionable\VersionableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documentation extends Model implements HasMedia
{
    use HasFactory,
        SoftDeletes,
        Userstamps,
        LogsActivity,
        CascadeSoftDeletes,
        VersionableTrait,
        Taggable,
        RequiresApproval,
        InteractsWithMedia,
        HasSlug,
        HasFilter;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'slug' => 'string',
        'deleted_at' => 'datetime',
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
    public static function existingTags(): Collection
    {
        $model = TaggingUtility::taggedModelString();
        return $model::query()
            ->distinct()
            ->join('tagging_tags', 'tag_slug', '=', 'tagging_tags.slug')
            ->where('taggable_type', '=', (new static)->getMorphClass())
            ->orderBy('count', 'DESC')
            ->get(['tag_slug as slug', 'tag_name as name', 'tagging_tags.count as count']);
    }

    public function getLastMediaAttribute()
    {
        if (!is_null($this->getFirstMedia())) {
            return $this->getMedia()->last()->getUrl();
        }
        return asset('images/ef3-placeholder-image.jpg');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tagsPills($value)
    {
        $tags = [];
        foreach ($this->tagNames() as $tag) {
            $class = $tag === $value ? 'bg-teal-500' : 'bg-slate-500';
            $tags[] = '<span class="outline-none inline-flex justify-center items-center group gap-x-1 text-xs font-semibold px-2.5 py-0.5 text-white '.$class.'">' . $tag . '</span>';
        }
        return $tags;
    }
}
