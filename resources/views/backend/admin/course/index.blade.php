@extends('backend.layout.index')

@section('title', '📘 Courses')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>📘 Courses</h3>
            <a href="{{ route('courses.create') }}" class="btn btn-success">➕ Add Course</a>
        </div>

        {{-- ✅ Flash Messages --}}
        @foreach (['success', 'update', 'danger'] as $msg)
            @if (session($msg))
                <div class="alert alert-{{ $msg === 'danger' ? 'danger' : 'success' }} alert-dismissible fade show"
                    role="alert">
                    {{ session($msg) }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        @endforeach

        {{-- 📋 Table --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Course Name</th>
                        <th>Description</th>
                        <th>Teacher</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>{{ Str::limit($course->description, 50) }}</td>
                            <td>{{ $course->teacher->name ?? 'N/A' }}</td>
                            <td>{{ $course->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-primary"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Delete"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No courses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
