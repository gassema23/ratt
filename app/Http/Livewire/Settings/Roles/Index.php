<?php

namespace App\Http\Livewire\Settings\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('roles-viewAll');
        return view('livewire.settings.roles.index')
            ->layoutData([
                'title' => __('Roles'),
                'subtitle' => trans('Role is a defined set of permissions or privileges that determine what a user is allowed to do.'),
                'action' => [
                    'name' => trans('New role'),
                    'icon' => 'plus',
                    'route' => 'settings.roles.create',
                    'permission' => 'roles-create'
                ]
            ]);
    }
}
