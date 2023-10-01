<?php

use App\Http\Controllers\V1\AuthController;
use \App\Http\Controllers\V1\BoardController;
use App\Http\Controllers\V1\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['prefix' => 'v1'], function (){
    Route::post('/registration', [RegisteredUserController::class, 'store']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/boards', [BoardController::class, 'index']);
});

