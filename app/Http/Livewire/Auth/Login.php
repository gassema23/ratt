<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Traits\HasLogin;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use WireUi\Traits\Actions;

class Login extends Component
{
    use Actions;

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function save()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));

            return;
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function mysave()
    {
        $this->validate();
        $this->authenticate($this->email, $this->password, $this->remember);
        session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Login successfully');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.guest');
    }
}
