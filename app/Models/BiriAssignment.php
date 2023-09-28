<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BiriAssignment extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'desn_req' => 'date',
        'fich_eng_req' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Biri Assignment {$eventName}")
            ->useLogName('BiriAssignmentLog');
    }

    public function isq(): BelongsTo
    {
        return $this->belongsTo(BiriIsqMasterData::class, 'network_no', 'network_no');
    }

    public function milestone(): BelongsTo
    {
        return $this->belongsTo(BiriMilestone::class, 'network_no', 'network_no');
    }

    public function desnTech(): BelongsTo
    {
        return $this->belongsTo(User::class, 'desn_user_id', 'id');
    }

    public function tech(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tech_user_id', 'id');
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(BiriActivity::class);
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(BiriAssigmentStatus::class, 'assignment_id', 'id');
    }

    public function datas(): HasMany
    {
        return $this->hasMany(BiriAssignmentData::class, 'assignment_id', 'id');
    }

    public function lastDesnStatus(): HasOne
    {
        return $this
            ->hasOne(BiriAssigmentStatus::class, 'assignment_id', 'id')
            ->where('user_id', $this->desnTech->id)
            ->latest();
    }

    public function lastDesnCompleted(): HasOne
    {
        return $this
            ->hasOne(BiriAssignmentData::class, 'assignment_id', 'id')
            ->whereNotNull('datas->desn_completed_at')
            ->latest();
    }

    public function AllDesnComments(): HasMany
    {
        return $this
            ->hasMany(BiriAssignmentData::class, 'assignment_id', 'id')
            ->whereNotNull('datas->desn_comment')
            ->orderBy('created_at','desc');
    }
}
