<?php

use App\Http\Controllers\GeographyController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/elevation', [GeographyController::class, 'elevation'])->withoutMiddleware(ValidateCsrfToken::class)->name('elevation');
Route::get('/api/user/{id}', [UserController::class, 'show'])->withoutMiddleware(ValidateCsrfToken::class)->name('user');
