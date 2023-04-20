<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Multitenantable
{

    protected static function bootMultitenantable()
    {
        if (auth()->check()) {
            static::creating(function ($model) {
                $model->team_id = auth()->user()->current_team_id;
            });
            if (!auth()->user()->hasRole(['Super-Admin', 'Admin'])) {
                static::addGlobalScope('team_id', function (Builder $builder) {
                    $builder->where('team_id', auth()->user()->current_team_id);
                });
            }
        }
    }
}
