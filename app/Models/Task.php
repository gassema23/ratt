<?php

namespace App\Models;

use App\Traits\SelfReferenceTrait;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, Userstamps, LogsActivity, SelfReferenceTrait;

    public $translatable = ['name'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Task {$eventName}")
            ->useLogName('TasksLog');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function scenarios(): BelongsToMany
    {
        return $this->belongsToMany(Scenario::class);
    }

    public function getTaskParentStatusAttribute()
    {
        return $this->parent->name;
    }


    public function parent()
    {
        return $this->belongsTo(Task::class, 'parent_id', 'id');
    }
}
