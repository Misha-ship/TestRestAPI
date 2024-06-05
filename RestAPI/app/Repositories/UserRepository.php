<?php

namespace App\Repositories;

use App\Models\User;
use App\DTO\UserDTO;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): iterable
    {
        return User::all();
    }

    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    public function create(UserDTO $userDTO): User
    {
        return User::create([
            'name' => $userDTO->name,
            'email' => $userDTO->email,
            'password' => Hash::make($userDTO->password),
            'role' => $userDTO->role,
        ]);
    }

    public function update(int $id, UserDTO $userDTO): User
    {
        $user = User::findOrFail($id);
        $user->name = $userDTO->name;
        $user->email = $userDTO->email;
        if ($userDTO->password) {
            $user->password = Hash::make($userDTO->password);
        }
        $user->role = $userDTO->role;
        $user->save();
        return $user;
    }

    public function delete(int $id): ?User
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }
}

