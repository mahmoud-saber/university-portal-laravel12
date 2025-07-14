<?php

use App\Http\Controllers\Backend\admin\AdminController;
use App\Http\Controllers\Backend\admin\Course\CourseController;
use App\Http\Controllers\Backend\admin\Student\StudentController;
use App\Http\Controllers\Backend\admin\Teacher\TeacherController;

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
Route::resource('teachers', TeacherController::class);
Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
///////////////////////////////////////////////
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
