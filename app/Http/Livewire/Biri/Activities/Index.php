<?php

namespace App\Http\Livewire\Biri\Activities;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.biri.activities.index')
            ->layoutData([
                'title' => __('Activities list'),
                'subtitle' => trans('##'),
                'action' => [
                    'name' => trans('New activity'),
                    'icon' => 'plus',
                    'route' => 'biri.activities.create',
                    'permission' => 'activities-create'
                ]
            ]);
    }
}
