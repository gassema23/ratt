<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Mpociot\Teamwork\Facades\Teamwork;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class Register extends Component
{

    public $name, $employe_id, $email, $password, $password_confirmation, $phone;
    public User $user;
    public $invite;

    public function mount($token)
    {
        $this->invite = Teamwork::getInviteFromAcceptToken($token);
        $this->user = User::where('email', $this->invite->email)->first();

        $this->email = $this->invite->email;
        $this->name = $this->user->name;
        $this->phone = $this->user->phone ?? '';
        $this->employe_id = $this->user->employe_id;
    }


    protected function rules()
    {
        return (new RegisterRequest)->rules($this->user->id);
    }

    public function save()
    {
        $this->validate();
        $this->user->update([
            'name' => $this->name,
            'employe_id' => $this->employe_id,
            'phone' => $this->phone ?? null,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'email_verified_at' => now()
        ]);

        event(new Registered($this->user));
        Auth::login($this->user);
        if ($this->invite) {
            Teamwork::acceptInvite($this->invite);
        }

        return redirect(RouteServiceProvider::HOME);
    }


    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.guest');
    }
}
