@extends('backend.layout.index')

@section('title', '✏️ Edit Teacher')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>✏️ Edit Teacher</h3>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">⬅️ Back</a>
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
    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">👤 Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $teacher->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">📧 Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">🔒 New Password (optional)</label>
            <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
        </div>

        <button type="submit" class="btn btn-primary">Update Teacher</button>
    </form>
</div>
@endsection
