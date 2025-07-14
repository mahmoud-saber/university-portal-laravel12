<?php

namespace App\Http\Controllers\Backend\admin\Student;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index()
    {
        $students = User::where('role', UserRole::Student)
                        ->where('status', User::STATUS_ACTIVE)
                        ->latest()
                        ->get();

        return view('backend.admin.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('backend.admin.student.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => UserRole::Student,
        ]);

        return redirect()->route('students.index')->with('success', '✅ Student created successfully.');
    }

    /**
     * Show the form for editing a student.
     */
    public function edit(string $id)
    {
        $student = User::where('role', UserRole::Student)->findOrFail($id);
        return view('backend.admin.student.update', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = User::where('role', UserRole::Student)->findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $student->id,
            'password' => 'nullable|string|min:6',
        ]);

        $student->name  = $request->name;
        $student->email = $request->email;

        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }

        $student->save();

        return redirect()->route('students.index')->with('update', '📝 Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(string $id)
    {
        $student = User::where('role', UserRole::Student)->findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('danger', '🗑️ Student deleted successfully.');
    }
}
