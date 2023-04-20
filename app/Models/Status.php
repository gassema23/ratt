<?php

namespace App\Models;

use Spatie\ModelStatus\Status as SpatieStatus;
use Spatie\Translatable\HasTranslations;

class Status extends SpatieStatus
{
    use HasTranslations;
    public $translatable = ['reason'];
}
