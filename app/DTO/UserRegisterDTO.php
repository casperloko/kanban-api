<?php

namespace App\DTO;

class UserRegisterDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?bool $isAdmin
    )
    {
    }
}
