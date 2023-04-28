<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;
use Spatie\ModelStatus\Status as SpatieStatus;
use Wildside\Userstamps\Userstamps;

class Status extends SpatieStatus
{
    use HasTranslations, Userstamps;
    public $translatable = ['reason'];

    public function getStatusNameAttribute()
    {
        return collect(config('biri.App_statuses.' . App::getLocale()))->where('id', $this->name)->first()['name'];
    }
}
