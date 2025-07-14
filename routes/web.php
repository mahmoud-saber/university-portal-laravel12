<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('backend/admin/dashboard', function () {
    return view('backend/admin/dashboard');
})->middleware(['auth'])->name('backend.admin.dashboard');

Route::get('backend/student/dashboard', function () {
    return view('backend/student/dashboard');
})->middleware(['auth'])->name('backend.student.dashboard');

Route::get('backend/teacher/dashboard', function () {
    return view('backend/teacher/dashboard');
})->middleware(['auth'])->name('backend.teacher.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__ . '/backend.php';
