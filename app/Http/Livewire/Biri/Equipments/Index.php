<?php

namespace App\Http\Livewire\Biri\Equipments;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        Log::info("Equipments list viewed by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');
        $this->authorize('biri-equipments-viewAny');
        return view('livewire.biri.equipments.index')
            ->layoutData([
                'title' => __('Equipments list'),
                'subtitle' => trans('Equipments...'),
                'action' => [
                    'name' => trans('New equipment'),
                    'icon' => 'plus',
                    'route' => 'biri.equipments.edit',
                    'permission' => 'biri-equipments-create'
                ]
            ]);
    }
}
