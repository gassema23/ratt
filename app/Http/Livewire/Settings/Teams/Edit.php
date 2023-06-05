<?php

namespace App\Http\Livewire\Settings\Teams;

use App\Models\Team;
use App\Models\User;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Teams\TeamEditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $name, $users, $owner_id, $team;

    public function mount($team)
    {
        $this->authorize('teams-update');
        $this->team = Team::findOrFail($team);
        $this->users = User::role(['Admin', 'Super-Admin'])->orderBy('name')->select('id', 'name', 'employe_id as description')->get();
    }

    protected function rules()
    {
        return (new TeamEditRequest)->rules($this->team->id);
    }

    public function save()
    {
        $this->authorize('teams-update');
        $this->validate();
        $this->team->update($this->validate());
        $this->saved();
    }

    public function render()
    {
        return view('livewire.settings.teams.edit');
    }
}
