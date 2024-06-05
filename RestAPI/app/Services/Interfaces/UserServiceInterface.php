<?php

namespace App\Services\Interfaces;

use App\Models\User;
use App\DTO\UserDTO;

interface UserServiceInterface
{
    public function getAll(): iterable;
    public function getById(int $id): ?User;
    public function create(UserDTO $userDTO): User;
    public function update(int $id, UserDTO $userDTO): User;
    public function delete(int $id): ?User;
}
