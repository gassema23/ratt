<?php

namespace App\Http\Livewire\Geographics\Regions;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    public function render()
    {
        $this->authorize('regions-viewAll');
        return view('livewire.geographics.regions.index')
        ->layoutData([
            'title' => __('Regions list'),
            'subtitle' => trans('Regions list lets you easily gather informations of geography'),
            'action' => [
                'name' => trans('New region'),
                'icon' => 'plus',
                'route' => 'geographics.regions.create',
                'permission' => 'regions-create'
            ]
        ]);
    }
}
