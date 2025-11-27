<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//Redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

//Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


//Route yang butuh login
Route::middleware('auth')->group(function () {

    //Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('auth');

    //logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //CRUD
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskContoller::class, 'destroy'])->name('tasks.destroy');

    //Tandai selesai
    Route::put('/tasks/{task}/done', [TaskController::class, 'done'])->name('tasks.done');
});
