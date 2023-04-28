<?php

namespace App\Http\Livewire\Settings\Permissions;

use App\Traits\HasModal;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Permissions\PermissionCreateRequest;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $name;

    protected function rules()
    {
        return (new PermissionCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('permissions-create');
        $this->validate();
        Permission::create([
            'name' => $this->name,
            'guard' => 'web',
        ]);
        $this->saved();
    }

    public function render()
    {
        $this->authorize('permissions-create');
        return view('livewire.settings.permissions.create');
    }
}
