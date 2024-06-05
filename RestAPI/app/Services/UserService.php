<?php

namespace App\Services;

use App\Models\User;
use App\DTO\UserDTO;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(): iterable
    {
        return $this->userRepository->getAll();
    }

    public function getById(int $id): ?User
    {
        return $this->userRepository->getById($id);
    }

    public function create(UserDTO $userDTO): User
    {
        return $this->userRepository->create($userDTO);
    }

    public function update(int $id, UserDTO $userDTO): User
    {
        return $this->userRepository->update($id, $userDTO);
    }

    public function delete(int $id): ?User
    {
        return $this->userRepository->delete($id);
    }
}



