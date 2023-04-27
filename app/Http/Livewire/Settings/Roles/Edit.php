<?php

namespace App\Http\Livewire\Settings\Roles;


use App\Traits\HasModal;
use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;
use App\Models\Permission;
use App\Http\Requests\Roles\RoleEditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $role, $name, $permissions, $permission_id;

    public function mount($id)
    {
        $this->authorize('roles-edit');
        $this->role = Role::with('permissions')->findOrFail($id);
        $this->permissions = Permission::groupedPermission();
        $this->permission_id = collect($this->role->permissions->pluck('id', 'id'))->toArray();
        $this->name = $this->role->name;
    }

    protected function rules()
    {
        return (new RoleEditRequest)->rules($this->role->id);
    }

    public function save()
    {
        $this->authorize('roles-edit');
        $this->validate();
        $this->role->update([
            'name' => $this->name
        ]);

        $this->role->syncPermissions($this->permission_id);
        $this->saved();
    }
    public function render()
    {
        return view('livewire.settings.roles.edit');
    }
}
