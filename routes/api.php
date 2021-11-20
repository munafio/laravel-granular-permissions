<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;


Route::group(['prefix' => 'auth'], function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/sign-up', [AuthController::class, 'signUp']);
    Route::post('/sign-in', [AuthController::class, 'signIn']);
    Route::post('/sign-out', [AuthController::class, 'signOut']);
});

Route::group(['prefix' => 'posts', 'middleware'=>'auth:sanctum'], function () {
    Route::get('/', [PostController::class, 'get']);
    Route::post('/', [PostController::class, 'create']);
    Route::put('/', [PostController::class, 'update']);
    Route::delete('/{id}', [PostController::class, 'destroy']);
});
