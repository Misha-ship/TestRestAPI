<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }

    public function view(User $user, User $model): bool
    {
        return $user->hasRole(User::ROLE_ADMIN) || $user->id === $model->id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasRole(User::ROLE_ADMIN) || $user->id === $model->id;
    }

    public function delete(User $user, User $model): bool
    {
        return $user->hasRole(User::ROLE_ADMIN);
    }
}

