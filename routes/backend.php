<?php

use App\Http\Controllers\Backend\AdminController;

 use Illuminate\Support\Facades\Route;




Route::get('backend/admin/dashboard', function () {
    return view('backend/admin/dashboard');
})->middleware(['auth'])->name('backend.admin.dashboard');

Route::get('backend/student/dashboard', function () {
    return view('backend/student/dashboard');
})->middleware(['auth'])->name('backend.student.dashboard');

Route::get('backend/teacher/dashboard', function () {
    return view('backend/teacher/dashboard');
})->middleware(['auth'])->name('backend.teacher.dashboard');
//////////////////////////////////////////////////////////////////
Route::resource('teachers', AdminController::class);
