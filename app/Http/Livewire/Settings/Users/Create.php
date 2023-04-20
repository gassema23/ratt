<?php

namespace App\Http\Livewire\Settings\Users;

use App\Models\Team;
use App\Models\User;
use App\Traits\HasModal;
use App\Mail\MemberInvitation;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use LivewireUI\Modal\ModalComponent;
use Mpociot\Teamwork\Facades\Teamwork;
use App\Http\Requests\Users\UserCreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $teams, $roles;
    public $name, $email, $phone, $role_id, $team_id, $employe_id;

    public $emits = [
        'refresh'
    ];

    public function mount()
    {
        $this->authorize('users-create');
        $this->teams = Team::orderBy('name')
        ->when(!auth()->user()->hasRole(['Admin', 'Super-Admin']), function ($query) {
            $query->where('id', auth()->user()->currentTeam->id);
        })->get();
        $this->roles = Role::orderBy('name')
        ->when(!auth()->user()->hasRole(['Admin', 'Super-Admin']), function ($query) {
            $query->whereNotIn('id', ['1', '2']);
        })->whereNotIn('id', ['1'])->get();
    }

    protected function rules()
    {
        return (new UserCreateRequest)->rules();
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?? null,
            'employe_id' => $this->employe_id,
            'password' => md5(config('biri.App_password_temp'))
        ]);

        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($this->team_id);

        if (!Teamwork::hasPendingInvite($this->email, $team)) {
            Teamwork::inviteToTeam($user, $team, function ($invite) {
                Mail::to($invite->email)->send(new MemberInvitation($invite->team, auth()->user(), $invite));
            });
        } else {
            return redirect()->back()->withErrors([
                'email' => trans('The email address is already invited to the team.'),
            ]);
        }
        $user->assignRole($this->role_id);
        $this->saved();
    }

    public function render()
    {
        return view('livewire.settings.users.create');
    }
}
