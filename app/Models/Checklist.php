<?php

namespace App\Models;

use Carbon\Carbon;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Checklist extends Model
{
    use HasFactory, SoftDeletes, Notifiable, HasTranslations, Userstamps, LogsActivity;

    public $translatable = ['name'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Checklist {$eventName}")
            ->useLogName('ChecklistsLog');
    }

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function checklistable(): MorphTo
    {
        return $this->morphTo();
    }

    // Attributes
    protected function UpdatedAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->toFormattedDateString(),
            set: fn (string $value) => Carbon::parse($value)->format('Y-m-d H:i:s')
        );
    }
}
