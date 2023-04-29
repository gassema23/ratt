<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\App;
use Spatie\ModelStatus\HasStatuses;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NetworkTask extends Model implements HasMedia
{
    use HasFactory, HasTranslations, SoftDeletes, InteractsWithMedia, Userstamps, LogsActivity, HasStatuses;

    public $translatable = ['comment'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Network task {$eventName}")
            ->useLogName('NetworkTaskLog');
    }
    public function network(): BelongsTo
    {
        return $this->belongsTo(Network::class)->withTrashed();
    }
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class)->withTrashed();
    }
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class)->withTrashed();
    }
    public function scenario(): BelongsTo
    {
        return $this->belongsTo(Scenario::class)->withTrashed();
    }
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function checklists(): MorphMany
    {
        return $this->morphMany(Checklist::class, 'checklistable');
    }
    public function checklistscompletes()
    {
        return $this->morphMany(Checklist::class, 'checklistable')->where('status', 1);
    }
    // Attribute Getter / Setter
    public function getBadgePriorityNameAttribute()
    {
        return collect(config('biri.App_priority.' . App::getLocale()))->where('id', $this->priority)->first()['name'];
    }
    public function getBadgePriorityColorAttribute()
    {
        return collect(config('biri.App_priority.en'))->where('id', $this->priority)->first()['color'];
    }
    public function getStatusNameAttribute()
    {
        return collect(config('biri.App_statuses.' . App::getLocale()))->where('id', $this->status)->first()['name'];
    }
    public function getStatusColorAttribute()
    {
        return collect(config('biri.App_statuses.en'))->where('id', $this->status)->first()['color'];
    }
    public function getStatusBadgeAttribute()
    {
        if ($this->status) {
            return $this->status_name;
        }
        return __('New');
    }
    public function getStatusBadgeColorAttribute()
    {
        if ($this->status) {
            return $this->status_color;
        }
        return "slate";
    }
}
