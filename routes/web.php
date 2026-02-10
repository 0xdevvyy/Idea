<?php

use App\Http\Controllers\IdeasController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', fn () => view('welcome'));
Route::redirect('/', '/ideas');

Route::middleware('auth')->group(function () {
    Route::get('/ideas', [IdeasController::class, 'index'])->name('ideas.index');
    Route::get('/idea/{ideas}', [IdeasController::class, 'show'])->name('ideas.show');

    Route::post('logout', [SessionsController::class, 'destroy']);
});

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});
