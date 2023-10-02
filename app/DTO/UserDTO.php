<?php

namespace App\DTO;

use App\Http\Resources\AuthUserResource;
use App\Models\User;

class UserDTO
{
    private ?User $user;
    private ?string $token;

    public function __construct(?User $user, ?string $token)
    {
        $this->user = $user;
        $this->token = $token;

    }

    public function getUser()
    {
        if(empty($this->user)) return [];
        return $this->user;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }
}
