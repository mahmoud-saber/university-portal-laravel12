<?php

namespace App\Http\Controllers\Backend\admin\Course;

use App\Models\User;
use App\Models\Course;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('teacher')->latest()->get();
        return view('backend.admin.course.index', compact('courses'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::where('role', UserRole::Teacher)->get();
        return view('backend.admin.course.create', compact('teachers'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $request->validate();

        Course::create([
            'name'        => $request->name,
            'description' => $request->description,
            'teacher_id'  => $request->teacher_id,
        ]);

        return redirect()->route('courses.index')->with('success', '✅ Course created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        $teachers = User::where('role', UserRole::Teacher)->get();
        return view('backend.admin.course.update', compact('course', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(StoreCourseRequest $request, string $id)
    {
        $course = Course::findOrFail($id);

        $request->validate();

        $course->update([
            'name'        => $request->name,
            'description' => $request->description,
            'teacher_id'  => $request->teacher_id,
        ]);

        return redirect()->route('courses.index')->with('update', '📝 Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Course::findOrFail($id)->delete();
        return redirect()->route('courses.index')->with('danger', '🗑️ Course deleted successfully.');
    }
}
