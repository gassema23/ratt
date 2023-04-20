<?php

namespace App\Http\Livewire\Settings\Teams;

use App\Models\Team;
use App\Models\User;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Teams\TeamCreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $name, $owner_id;
    protected function rules()
    {
        return (new TeamCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('teams-create');
        $this->validate();
        Team::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('teams-create');
        return view('livewire.settings.teams.create', [
            'users' => User::role( ['Admin','Super-Admin'] )->orderBy('name')->select('id', 'name', 'employe_id as description')->get()
        ]);
    }
}
