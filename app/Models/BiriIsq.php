<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BiriIsq extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_on' => 'date',
        'scheduled_start' => 'date',
        'scheduled_finish' => 'date',
        'changed_on' => 'date',
    ];
    public function milestones(): HasMany
    {
        return $this->hasMany(BiriMilestone::class, 'network', 'network');
    }
    public function milestone(): BelongsTo
    {
        return $this->belongsTo(BiriMilestone::class, 'network', 'network');
    }
    public function networkplans(): HasMany
    {
        return $this->hasMany(BiriNetworkPlan::class, 'network', 'network');
    }
    public function assignation(): HasMany
    {
        return $this->hasMany(BiriAssignment::class, 'network', 'network');
    }
}
