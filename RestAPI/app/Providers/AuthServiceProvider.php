<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('viewAny-user', function (User $user) {
            return $user->role === User::ROLE_ADMIN;
        });

        Gate::define('view-user', function (User $user, User $model) {
            return $user->role === User::ROLE_ADMIN || $user->id === $model->id;
        });

        Gate::define('create-user', function (User $user) {
            return $user->role === User::ROLE_ADMIN;
        });

        Gate::define('update-user', function (User $user, User $model) {
            return $user->role === User::ROLE_ADMIN || $user->id === $model->id;
        });

        Gate::define('delete-user', function (User $user, User $model) {
            return $user->role === User::ROLE_ADMIN;
        });
    }
}


