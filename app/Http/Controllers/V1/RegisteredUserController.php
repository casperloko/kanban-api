<?php

namespace App\Http\Controllers\V1;

use App\DTO\UserDTO;
use App\DTO\UserRegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserAuthResourse;
use App\Services\User\UserService;
use Illuminate\Http\Responce;

class RegisteredUserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function store(UserCreateRequest $request)
    {
        $dto = new UserRegisterDTO(
            $request->name,
            $request->email,
            $request->password,
            false
        );

        $user = $this->service->store($dto);

        $user = new UserDTO(
            $user,
            auth()->login($user)
        );

        return new UserAuthResourse($user);
    }
}
