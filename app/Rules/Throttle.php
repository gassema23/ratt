<?php

namespace App\Rules;

use Illuminate\Cache\RateLimiter;
use Illuminate\Contracts\Validation\Rule;

class Throttle implements Rule
{
    protected $throttleKey, $maxAttempts, $decayInMinutes, $event;

    public function __construct($throttleKey, $maxAttempts, $decayInMinutes, $event = null)
    {
        $this->throttleKey = $throttleKey;
        $this->maxAttempts = $maxAttempts;
        $this->decayInMinutes = $decayInMinutes;
        $this->event = $event;
    }

    public function passes($attribute, $value): bool
    {
        if ($this->hasTooManyAttempts()) {

            if ($this->event) {

                event(new $this->event($this->throttleKey, $value));
            }

            return false;
        }

        $this->incrementAttempts();

        return true;
    }

    public function message()
    {
        $seconds = $this->limiter()
            ->availableIn($this->throttleKey);

        return trans('auth.throttle', [
            'seconds' => $seconds,
            'minutes' => ceil($seconds / 60),
        ]);
    }

    protected function hasTooManyAttempts()
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey,
            $this->maxAttempts
        );
    }

    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    protected function incrementAttempts()
    {
        $this->limiter()->hit(
            $this->throttleKey,
            $this->decayInMinutes * 60
        );
    }
}
