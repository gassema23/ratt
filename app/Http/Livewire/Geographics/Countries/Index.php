<?php

namespace App\Http\Livewire\Geographics\Countries;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use  AuthorizesRequests;
    public function render()
    {
        $this->authorize('countries-viewAll');
        return view('livewire.geographics.countries.index')
            ->layoutData([
                'title' => __('Countries list'),
                'subtitle' => trans('Countries list lets you easily gather informations of geography'),
                'action' => [
                    'name' => trans('New country'),
                    'icon' => 'plus',
                    'route' => 'geographics.countries.create',
                    'permission' => 'countries-create'
                ]
            ]);
    }
}
