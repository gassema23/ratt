<?php

namespace App\Http\Livewire\Settings\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        $this->authorize('users-list');
        return view('livewire.settings.users.index', [
            'innactiveCount' => User::countInnactive()
        ])->layoutData([
            'title' => __('Employees'),
            'subtitle' => trans('Your workforce at a glance: access and control employee details.'),
            'action' => [
                'name' => trans('New employee'),
                'icon' => 'plus',
                'route' => 'settings.users.create',
                'permission' => 'users-create'
            ]
        ]);
    }
}
