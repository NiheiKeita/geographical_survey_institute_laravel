<?php

use App\Http\Controllers\GeographyController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::post('/api/code-check', [CodeController::class, 'index'])->withoutMiddleware(ValidateCsrfToken::class);
// Route::post('/api/api/code-check', [CodeController::class, 'check'])->name('check')->withoutMiddleware(ValidateCsrfToken::class);

// Route::get('/api/animations', [AnimationController::class, 'index'])->name('animation_list');
// Route::get('/api/questions/{id}', [QuestionController::class, 'show']);
// Route::get('/api/questions/{id}/ranking', [RankingController::class, 'index']);

// Route::post('/api/users', [UserController::class, 'store'])->withoutMiddleware(ValidateCsrfToken::class);
// Route::put('/api/users', [UserController::class, 'update'])->withoutMiddleware(ValidateCsrfToken::class);

Route::post('/api/elevation', [GeographyController::class, 'elevation'])->withoutMiddleware(ValidateCsrfToken::class)->name('elevation');
