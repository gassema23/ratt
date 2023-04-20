<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Activitylog\Models\Activity;

class LoginSuccessful
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $event->subject = trans('login');
        $event->description = trans('Login successful');
        Session::flash('login-success',trans('Hello :name, welcome back',['name'=>$event->user->name]));
        activity($event->subject)
        ->by($event->user)
        ->log($event->description);
    }
}
