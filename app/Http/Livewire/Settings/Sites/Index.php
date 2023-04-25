<?php

namespace App\Http\Livewire\Settings\Sites;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.settings.sites.index')
            ->layoutData([
                'title' => __('Sites types'),
                'action' => [
                    'name' => trans('New site type'),
                    'icon' => 'plus',
                    'route' => 'settings.sites.create',
                    'permission' => 'sites-create'
                ]
            ]);
    }
}
