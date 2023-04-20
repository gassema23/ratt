<?php

namespace App\Models;

use Mpociot\Teamwork\TeamworkTeam;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends TeamworkTeam
{
    use HasFactory, HasTranslations, SoftDeletes, Userstamps, LogsActivity;
    public $translatable = ['name'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn(string $eventName) => "Team {$eventName}")
            ->useLogName('TeamsLog');
    }
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
