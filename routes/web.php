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
    // Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/dashboard', function () {
    $tasks = \App\Models\Task::where('user_id', auth()->id())
                ->latest()
                ->take(5) // tampilkan 5 task terbaru (opsional)
                ->get();

    return view('dashboard', compact('tasks'));
    })->name('dashboard');
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //schedule
    Route::get('/schedule', [TaskController::class, 'weekSchedule'])->name('tasks.schedule');

    // ----------------------
    // TASKS (CRUD + DONE)
    // ----------------------
    Route::prefix('tasks')->name('tasks.')->group(function () {

        Route::get('/', [TaskController::class, 'index'])->name('index');

        Route::get('/history', [TaskController::class, 'history'])->name('history');
        
        // create & edit tidak diperlukan (pakai modal)
        Route::post('/', [TaskController::class, 'store'])->name('store');
        Route::put('/{task}', [TaskController::class, 'update'])->name('update');
        Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');

        // Tandai selesai
        Route::put('/{task}/done', [TaskController::class, 'done'])->name('done');
    });
});
