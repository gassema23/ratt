<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Database\Eloquent\Builder;

class Permission extends SpatiePermission
{
    use HasFactory;
    public function scopeGroupedPermission(Builder $query)
    {
        $groupedData = collect($query->orderBy('name')->get())->groupBy(function ($item) {
            // Utilisation de explode pour extraire la première partie du titre (avant le '-')
            $titleParts = explode('-', $item['name'], 2);
            return $titleParts[0]; // Retourne la première partie du titre comme clé de groupe
        });
        return $groupedData;
    }
}
