<?php

namespace App\Traits;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


use App\Events\Lockout;
use App\Rules\Throttle;

trait HasLogin
{

    public function rules()
    {
        return [
            'email' => [
                'required',
                new Throttle($this->throttleKey(), 5, 1, Lockout::class)
            ],
            'password' => ['required'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate($email, $password, $remember): void
    {
        $this->ensureIsNotRateLimited();



        $credentials = [
            'password' => $this->password,
        ];

        $loginType = filter_var($this->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'employe_id';
        $credentials[$loginType] = $this->email;


        if (!Auth::attempt($credentials, $remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this->validate()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::lower($this->email) . '|' . request()->ip();
    }
}
