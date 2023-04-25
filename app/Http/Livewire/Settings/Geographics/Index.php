<?php

namespace App\Http\Livewire\Settings\Geographics;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.settings.geographics.index')
            ->layoutData([
                'title' => __('Geographic types'),
                'action' => [
                    'name' => trans('New geographic type'),
                    'icon' => 'plus',
                    'route' => 'settings.geographics.create',
                    'permission' => 'geographics-create'
                ]
            ]);
    }
}
