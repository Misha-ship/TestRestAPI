<?php

namespace App\DTO;

class UserDTO
{
    public string $name;
    public string $email;
    public string $password;
    public int $role;

    public function __construct(string $name, string $email, string $password, int $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }
}

