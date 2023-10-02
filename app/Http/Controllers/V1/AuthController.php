<?php

namespace App\Http\Controllers\V1;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserAuthResourse;

class AuthController extends Controller
{

    public function login (AuthRequest $request)
    {
        if (! $token = auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = new UserDTO(
            auth()->user(),
            $token
        );

        return new UserAuthResourse($user);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Ok'], 204);
    }


    public function refresh()
    {
        return response()->json([
            'token' => auth()->refresh()
        ]);
    }

}
