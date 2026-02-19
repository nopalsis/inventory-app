<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', [AuthController::class, 'login']);

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
});

Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::get('/users', [UserController::class, 'index'])->name('users.index'); //search

Route::delete('/user/{id}', [UserController::class, 'destroy']);




