<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BiriNetworkPlan extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'plan' => 'float',
        'actual' => 'float'
    ];
    public function assignation(): BelongsTo
    {
        return $this->belongsTo(BiriAssignment::class);
    }
}
