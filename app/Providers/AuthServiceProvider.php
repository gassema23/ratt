<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Checklist;
use App\Policies\UserPolicy;
use App\Policies\CommentPolicy;
use App\Policies\ChecklistPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Comment::class => CommentPolicy::class,
        Checklist::class => ChecklistPolicy::class,
        //User::class => UserPolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super-Admin') ? true : null;
        });
    }
}
