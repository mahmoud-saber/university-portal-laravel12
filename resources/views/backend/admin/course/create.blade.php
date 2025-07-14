@extends('backend.layout.index')

@section('title', '➕ Add Course')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>➕ Add Course</h3>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">⬅️ Back</a>
    </div>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>⚠️ Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Course Create Form --}}
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">📘 Course Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">📝 Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="teacher_id" class="form-label">👨‍🏫 Select Teacher</label>
            <select name="teacher_id" class="form-select" required>
                <option value="">-- Choose Teacher --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }} ({{ $teacher->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">💾 Save Course</button>
    </form>
</div>
@endsection
