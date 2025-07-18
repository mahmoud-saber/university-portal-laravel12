<?php

namespace App\Http\Controllers\Backend\admin\Teacher;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = User::where('role', UserRole::Teacher)
                        ->where('status', User::STATUS_ACTIVE)
                        ->latest()
                        ->get();



        return view('backend.admin.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.teacher.create', );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
        ]);

        return redirect()->route('teachers.index')->with('success', '✅ Teacher created successfully.');
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
        $teacher = User::where('role', 'teacher')->findOrFail($id);
        return view('backend.admin.teacher.update', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, string $id)
    {
        $teacher = User::where('role', 'teacher')->findOrFail($id);

        $request->validate();

        $teacher->name = $request->name;
        $teacher->email = $request->email;

        if ($request->filled('password')) {
            $teacher->password = Hash::make($request->password);
        }

        $teacher->save();

        return redirect()->route('teachers.index')->with('update', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = User::where('role', 'teacher')->findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('danger', '🗑️ Teacher deleted successfully.');
    }
    ////////////////////////////////////////////////////////////////


}
