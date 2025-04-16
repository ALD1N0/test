<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\login;
use App\Http\Controllers\loginControll;

use App\Http\Controllers\LoginJwtControll;

Route::post('/register', [LoginJwtControll::class, 'register']);
Route::post('/login', [LoginJwtControll::class, 'login']);
Route::get('/user', [LoginJwtControll::class, 'getUser']);

// Route::apiResource('posts', AuthController::class);

// Route::apiResource('login', login::class);

// Route::post('/login', [loginControll::class, 'login']);
// Route::post('/register', [loginControll::class, 'register']);
