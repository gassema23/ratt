<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelFollow\Traits\Followable;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Network extends Model implements HasMedia
{
    use HasFactory,
        SoftDeletes,
        CascadeSoftDeletes,
        InteractsWithMedia,
        Userstamps,
        LogsActivity,
        Followable;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'completed_at' => 'datetime',
        'started_at' => 'date',
        'ended_at' => 'date',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Network {$eventName}")
            ->useLogName('NetworksLog');
    }
    // Attribute Getter / Setter
    protected function NetworkNo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => '#' . preg_replace('~\D~', '', $value),
            set: fn (string $value) => str_replace('#', '', $value, $count)
        );
    }
    public function colorPercent($percent)
    {
        if ($percent < 35) {
            return 'red';
        } elseif ($percent > 35 && $percent < 60) {
            return 'orange';
        } else {
            return 'teal';
        }
    }
    public function getBadgePriorityNameAttribute()
    {
        return collect(config('biri.App_priority.' . App::getLocale()))->where('id', $this->priority)->first()['name'];
    }
    public function getBadgePriorityColorAttribute()
    {
        return collect(config('biri.App_priority.en'))->where('id', $this->priority)->first()['color'];
    }
    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class)->withTrashed();
    }
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class)->withTrashed();
    }
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function followersUsers()
    {
        return $this->followers()->where('user_id', auth()->user()->id)->first();
    }
    public function networktasks(): HasMany
    {
        return $this->hasMany(NetworkTask::class, 'network_id', 'id');
    }

    public function networktask(){
        return $this->hasOne(NetworkTask::class, 'network_id', 'id')->oldest();
    }

    public function getNetworkTaskCountAttribute(){
        return $this->networktasks()->whereNull('deleted_at')->count();
    }
    public function getLocationsAttribute()
    {
        return '<span class="font-medium text-slate-800">' . $this->site->name . '</span><br> ' .
            $this->site->clli . ', ' .
            $this->site->city->name . ', ' .
            $this->site->city->region->state->name . ', ' .
            $this->site->city->region->state->country->name;
    }
}
