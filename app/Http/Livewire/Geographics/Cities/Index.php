<?php

namespace App\Http\Livewire\Geographics\Cities;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        $this->authorize('cities-viewAny');
        return view('livewire.geographics.cities.index')
        ->layoutData([
            'title' => __('Cities list'),
            'subtitle' => trans('Cities list lets you easily gather informations of geography'),
            'action' => [
                'name' => trans('New city'),
                'icon' => 'plus',
                'route' => 'geographics.cities.create',
                'permission' => 'cities-create'
            ]
        ]);
    }
}
