<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function milestones(){
        return $this->hasMany(BiriMilestone::class,'network','network');
    }
}
