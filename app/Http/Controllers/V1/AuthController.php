<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Responce;

class AuthController extends Controller
{
    public function login (Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' =>  true,'message' => 'Unauthorized'], 401);
        }

        return response()->json(auth()->user());
    }
}
