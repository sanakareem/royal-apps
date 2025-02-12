<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::group(['middleware' => ['web', \App\Http\Middleware\ApiAuthentication::class]], function () {
    Route::resource('authors', AuthorController::class);
    Route::resource('books', BookController::class);
});