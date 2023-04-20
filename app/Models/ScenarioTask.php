<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ScenarioTask extends Pivot
{
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
