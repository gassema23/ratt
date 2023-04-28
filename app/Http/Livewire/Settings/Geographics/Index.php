<?php

namespace App\Http\Livewire\Settings\Geographics;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        $this->authorize('geographicTypes-viewAny');
        return view('livewire.settings.geographics.index')
            ->layoutData([
                'title' => __('Geographic types'),
                'action' => [
                    'name' => trans('New geographic type'),
                    'icon' => 'plus',
                    'route' => 'settings.geographics.create',
                    'permission' => 'geographicTypes-create'
                ]
            ]);
    }
}
