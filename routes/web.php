<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TaskStepsController;
use App\Http\Controllers\RealityAnchorsController;
use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\DailyReflectionsController;
use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// Task routes
Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
Route::get('/task/create', [TasksController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
Route::patch('/tasks/{task}/start', [TasksController::class, 'start'])->name('tasks.start');
Route::post('/tasks/{id}/complete', [TasksController::class, 'complete'])->name('tasks.complete');
// failed tasks
Route::get('/tasks/failed', [TasksController::class, 'failed'])->name('tasks.failed');
Route::post('/tasks/{id}/update', [TasksController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}/delete', [TasksController::class, 'destroy'])->name('tasks.delete');
// reality acnhors response save
Route::post('/anchors/save', [RealityAnchorsController::class, 'save'])->name('anchors.save');

// Steps routes
Route::get('/steps/create/{task_id}', [TaskStepsController::class, 'create'])->name('steps.create');
Route::post('/steps', [TaskStepsController::class, 'store'])->name('steps.store');
Route::get('/steps/show/{id}', [TaskStepsController::class, 'show'])->name('steps.show');

// Action logs route
Route::get('/logs', [\App\Http\Controllers\ActionLogsController::class, 'index'])->name('logs.index');

// Daily reflections route
Route::post('/daily-reflection/save', [\App\Http\Controllers\DailyReflectionsController::class, 'store'])->name('dailyReflections.save');

// Calendar route
Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar.index');