<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

// Redirect ke login
Route::get('/', fn() => redirect()->route('login'));


// ----------------------
// AUTH ROUTES (GUEST)
// ----------------------
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


// ----------------------
// ROUTES BUTUH LOGIN (AUTH)
// ----------------------
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ----------------------
    // TASKS (CRUD + DONE)
    // ----------------------
    Route::prefix('tasks')->name('tasks.')->group(function () {

        Route::get('/', [TaskController::class, 'index'])->name('index');

        // create & edit tidak diperlukan (pakai modal)
        Route::post('/', [TaskController::class, 'store'])->name('store');
        Route::put('/{task}', [TaskController::class, 'update'])->name('update');
        Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');

        // Tandai selesai
        Route::put('/{task}/done', [TaskController::class, 'done'])->name('done');
    });
});
