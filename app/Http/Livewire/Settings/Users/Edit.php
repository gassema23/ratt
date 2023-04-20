<?php

namespace App\Http\Livewire\Settings\Users;


use App\Models\Team;
use App\Models\User;
use App\Traits\HasModal;
use Mpociot\Teamwork\TeamInvite;
use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Users\UserEditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit  extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $user, $role_id, $team_id, $teams, $roles;
    public $emits = [
        'refresh'
    ];


    public function mount($id)
    {
        $this->authorize('users-edit');
        $this->user = User::with('roles')->findOrFail($id);

        $this->teams = Team::orderBy('name')->when(!auth()->user()->hasRole(['Admin', 'Super-Admin']), function ($query) {
            $query->where('id', auth()->user()->currentTeam->id);
        })->get();
        $this->roles = Role::orderBy('name')->when(!auth()->user()->hasRole(['Admin', 'Super-Admin']), function ($query) {
            $query->whereNotIn('id', ['5', '6']);
        })->get();

        $this->team_id = $this->user->currentTeam->id ?? TeamInvite::where('email',$this->user->email)->first()->team_id;
        $this->role_id = $this->user->roles->first()->id ?? '';
    }

    protected function rules()
    {
        return (new UserEditRequest)->rules($this->user->id);
    }

    public function save()
    {
        $this->validate();
        $this->user->update([
            'name' => $this->user->name,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'employe_id' => $this->user->employe_id
        ]);

        if ($this->team_id !== $this->user->currentTeam->id) {
            //$this->user->detachTeam($this->user->currentTeam());
            $this->user->teams()->attach($this->team_id);
            $this->user->switchTeam($this->team_id);
        }

        if ($this->role_id !== $this->user->roles->first()->id) {
            $this->user->syncRoles([$this->role_id]);
        }
        $this->saved();
    }

    public function render()
    {
        return view('livewire.settings.users.edit');
    }
}
