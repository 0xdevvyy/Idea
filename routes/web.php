<?php

use App\Http\Controllers\IdeasController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StepsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', fn () => view('welcome'));
Route::redirect('/', '/ideas');

Route::middleware('auth')->group(function () {
    Route::get('/ideas', [IdeasController::class, 'index'])->name('ideas.index');
    Route::post('/idea/store', [IdeasController::class, 'store'])->name('ideas.create');
    Route::get('/idea/{idea}', [IdeasController::class, 'show'])->name('ideas.show');

    Route::patch('/step/{step}', [StepsController::class, 'update'])->name('steps.update');

    Route::delete('/idea/{idea}',[IdeasController::class, 'destroy'])->name('ideas.delete');

    Route::post('logout', [SessionsController::class, 'destroy']);
});

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});
