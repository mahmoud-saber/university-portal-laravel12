@extends('backend.layout.index')

@section('title', '✏️ Edit Course')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>✏️ Edit Course</h3>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">⬅️ Back</a>
    </div>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit Form --}}
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">📘 Course Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $course->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">📝 Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $course->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="teacher_id" class="form-label">👨‍🏫 Assigned Teacher</label>
            <select name="teacher_id" class="form-select" required>
                <option value="">-- Select Teacher --</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Course</button>
    </form>
</div>
@endsection
