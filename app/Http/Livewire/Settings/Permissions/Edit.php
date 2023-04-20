<?php

namespace App\Http\Livewire\Settings\Permissions;


use App\Traits\HasModal;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Permissions\PermissionEditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $name, $permission;

    public function mount($id)
    {
        $this->authorize('permissions-edit');
        $this->permission = Permission::findOrFail($id);
    }

    protected function rules()
    {
        return (new PermissionEditRequest)->rules($this->permission->id);
    }

    public function save()
    {
        $this->authorize('permissions-edit');
        $this->validate();
        $this->permission->update(['name' => Str::slug($this->permission->name)]);
        $this->saved();
    }
    public function render()
    {
        return view('livewire.settings.permissions.edit');
    }
}
