<?php

use App\Http\Controllers\V1\AuthController;
use \App\Http\Controllers\V1\BoardController;
use \App\Http\Controllers\V1\ColumnController;
use \App\Http\Controllers\V1\CardController;
use App\Http\Controllers\V1\RegisteredUserController;
use App\Http\Controllers\V1\StatisticController;
use App\Http\Controllers\V1\UserController;
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

Route::group(['prefix' => 'v1'], function (){
    Route::post('/registration', [RegisteredUserController::class, 'store']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['api', 'auth', 'admin'])->group(function(){
        Route::get('/statistic', [StatisticController::class, 'index']);
    });


    Route::middleware(['api', 'auth'])->group(function ($router)
    {
        Route::get('/profile', [UserController::class, 'profile']);
        Route::put('/profile', [UserController::class, 'update']);
        Route::put('/profile/password', [UserController::class, 'changePassword']);
        Route::delete('/profile', [UserController::class, 'destroy']);

        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);

        Route::get('/boards', [BoardController::class, 'index']);
        Route::get('/boards/{id}', [BoardController::class, 'show']);
        Route::post('/boards', [BoardController::class, 'store']);
        Route::put('/boards/{id}', [BoardController::class, 'update']);
        Route::delete('/boards/{id}', [BoardController::class, 'destroy']);

        Route::post('/boards/{boards}/columns', [ColumnController::class, 'store']);
        Route::put('/boards/{boards}/columns/{id}', [ColumnController::class, 'update']);
        Route::delete('/boards/{boards}/columns/{id}', [ColumnController::class, 'destroy']);

        Route::post('/boards/{boards}/columns/{columns}/cards', [CardController::class, 'store']);
        Route::put('/boards/{boards}/cards/{id}', [CardController::class, 'update']);
        Route::delete('/boards/{boards}/cards/{id}', [CardController::class, 'destroy']);
    });

});

