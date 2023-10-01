<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoardResource;
use App\Models\Board;
use App\Models\User;

class BoardController extends Controller
{
    public function index()
    {
        $user = User::find(4);

        return BoardResource::collection($user->boards);
    }
}
