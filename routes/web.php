<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
});

Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);


