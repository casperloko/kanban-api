<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index()
    {
        $userCount = DB::table('users')->count();
        $boardCount = DB::table('boards')->count();

        return response()->json(['data'=> [
            'userCount' => $userCount,
            'boardCount' => $boardCount
        ]], 200);

    }
}
