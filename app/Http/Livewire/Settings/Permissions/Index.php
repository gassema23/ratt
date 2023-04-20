<?php

namespace App\Http\Livewire\Settings\Permissions;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use  AuthorizesRequests;

    public function render()
    {
        $this->authorize('permissions-list');
        return view('livewire.settings.permissions.index')
            ->layoutData([
                'title' => __('Permissions'),
                'subtitle' => trans('Permissions are the specific actions or operations that a user is allowed to perform.'),
                'action' => [
                    'name' => trans('New permission'),
                    'icon' => 'plus',
                    'route' => 'settings.permissions.create',
                    'permission' => 'permissions-create'
                ]
            ]);
    }
}
