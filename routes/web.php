<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function (): JsonResponse {
    return response()->json(['Pong' => true]);
});

Route::get('/states', [StatesController::class, 'index'])->name('states');
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');

Route::post('user/signup', [UserController::class, 'signup'])->name('signup');
Route::post('user/signin', [UserController::class, 'signin'])->name('signin');
Route::get('user/me', [UserController::class, 'me'])->middleware('auth:sanctum');
