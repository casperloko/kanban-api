<?php

namespace App\Services\User;

use App\DTO\AuthDTO;
use App\DTO\UserDTO;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AuthService
{
    public function login(AuthDTO $dto)
    {

        if (!$token = auth()->attempt($dto->getArray())) {
            throw new ModelNotFoundException('Incorrect login or password', 404);
        }

        $user = auth()->user();
        return new UserDTO($user, $token);
    }
}
