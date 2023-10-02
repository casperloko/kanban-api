<?php

namespace App\Http\Controllers\V1;

use App\DTO\UserChangePasswordDTO;
use App\DTO\UserUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\ErrorResourse;
use App\Http\Resources\ProfileResourse;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function profile()
    {
        $user = auth()->user();

        return new ProfileResourse($user);
    }

    public function update(UserUpdateRequest $request)
    {
        $dto = new UserUpdateDTO(
            auth()->id(),
            $request->name,
            $request->email
        );

        $user = $this->service->update($dto);

        return new ProfileResourse($user);
    }

    public function changePassword(UserChangePasswordRequest $request)
    {
        $dto = new UserChangePasswordDTO(
            auth()->id(),
            $request->password,
            $request->passwordOld
        );

        $user = $this->service->changePassword($dto);

        return new ProfileResourse($user);
    }

    public function destroy()
    {
        $this->service->delete(auth()->id());

        return response()->json([], 204);
    }

}
