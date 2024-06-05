<?php

namespace App\Repositories\Interfaces;

use App\DTO\UserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function getAll(): iterable;
    public function getById(int $id): ?User;
    public function create(UserDTO $userDTO): User;
    public function update(int $id, UserDTO $userDTO): User;
    public function delete(int $id): ?User;
}
