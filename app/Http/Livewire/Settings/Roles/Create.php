<?php

namespace App\Http\Livewire\Settings\Roles;


use App\Traits\HasModal;
use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;
use App\Models\Permission;
use App\Http\Requests\Roles\RoleCreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $name, $permission_id;

    protected function rules()
    {
        return (new RoleCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('roles-create');
        $this->validate();
        $role = Role::create([
            'name' => $this->name,
            'guard' => 'web',
        ]);
        $role->syncPermissions($this->permission_id);
        $this->saved();
    }
    public function render()
    {
        $this->authorize('roles-create');
        return view('livewire.settings.roles.create', [
            'permissions' => Permission::groupedPermission()
        ]);
    }
}
