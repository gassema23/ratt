<?php

namespace App\Http\Livewire\Geographics\Sites;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        $this->authorize('cities-list');
        return view('livewire.geographics.sites.index')
        ->layoutData([
            'title' => __('Sites list'),
            'subtitle' => trans('Sites list lets you easily gather informations of geography'),
            'action' => [
                'name' => trans('New site'),
                'icon' => 'plus',
                'route' => 'geographics.sites.create',
                'permission' => 'sites-create'
            ]
        ]);
    }
}
