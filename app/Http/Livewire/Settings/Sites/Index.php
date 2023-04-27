<?php

namespace App\Http\Livewire\Settings\Sites;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        $this->authorize('siteTypes-viewAny');
        return view('livewire.settings.sites.index')
            ->layoutData([
                'title' => __('Sites types'),
                'action' => [
                    'name' => trans('New site type'),
                    'icon' => 'plus',
                    'route' => 'settings.sites.create',
                    'permission' => 'siteTypes-create'
                ]
            ]);
    }
}
