<?php

namespace App\Http\Livewire\Geographics\States;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        $this->authorize('states-viewAll');
        return view('livewire.geographics.states.index')
            ->layoutData([
                'title' => __('States list'),
                'subtitle' => trans('States list lets you easily gather informations of geography'),
                'action' => [
                    'name' => trans('New state'),
                    'icon' => 'plus',
                    'route' => 'geographics.states.create',
                    'permission' => 'states-create'
                ]
            ]);
    }
}
