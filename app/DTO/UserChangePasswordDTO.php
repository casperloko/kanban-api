<?php

namespace App\DTO;

class UserChangePasswordDTO
{
    public function __construct(
        public int $id,
        public string $password,
        public string $passwordOld
    )
    {
    }
}
