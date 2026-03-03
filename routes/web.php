<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductStatementController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', [AuthController::class, 'login']);

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
});

Route::get('/user', [UserController::class, 'index'])->name('users.index'); //search
Route::post('/user', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category', [CategoryController::class, 'store']);
Route::put('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

Route::get('/product', [ProductController::class, 'index']);
Route::post('/product', [ProductController::class, 'store']);
Route::put('/product/{id}', [ProductController::class, 'update']);
Route::delete('/product/{id}', [ProductController::class, 'destroy']);

Route::get('/product-statement', [ProductStatementController::class, 'index']);
Route::post('/product-statements', [ProductStatementController::class, 'store'])
    ->name('product-statements.store');
