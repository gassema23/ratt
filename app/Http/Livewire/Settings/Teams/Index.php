<?php

namespace App\Http\Livewire\Settings\Teams;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('teams-viewAny');
        return view('livewire.settings.teams.index')
        ->layoutData([
            'title' => __('Teams'),
            'subtitle' => trans('Organize Your staff: view and modify team details.'),
            'action' => [
                'name' => trans('New team'),
                'icon' => 'plus',
                'route' => 'settings.teams.create',
                'permission'=>'teams-create'
            ]
        ]);
    }
}
