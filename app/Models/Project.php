<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, CascadeSoftDeletes, Userstamps, LogsActivity;
    public $translatable = ['name', 'description'];

    protected $cascadeDeletes = ['networks'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Project {$eventName}")
            ->useLogName('ProjectsLog');
    }

    protected function ProjectNo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => 'P-' . preg_replace('~\D~', '', $value),
            set: fn (string $value) => str_replace('P-', '', $value, $count)
        );
    }

    protected function EndedAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->toFormattedDateString(),
            set: fn (string $value) => Carbon::parse($value)->format('Y-m-d')
        );
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

    // Relationships
    public function prime(): BelongsTo
    {
        return $this->belongsTo(User::class, 'prime_id')->withTrashed();
    }

    public function getPrimesAttribute()
    {
        return $this->prime()->select('name', 'id')->distinct();
    }

    public function planner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'planner_id')->withTrashed();
    }

    public function networks(): HasMany
    {
        return $this->hasMany(Network::class)->withTrashed();
    }
}
