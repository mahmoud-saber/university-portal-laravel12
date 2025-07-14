@extends('backend.layout.index')

@section('title', '👤 Admin Profile')

@section('content')
<div class="container mt-4">
    <h3>👤 Admin Profile</h3>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Profile Info --}}
    <div class="mb-3">
        <label class="form-label">📝 Name</label>
        <input type="text" class="form-control" value="{{ $admin->name }}" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">📧 Email</label>
        <input type="email" class="form-control" value="{{ $admin->email }}" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">🕒 Created At</label>
        <input type="text" class="form-control" value="{{ $admin->created_at->format('Y-m-d H:i') }}" readonly>
    </div>

    <a href="{{ route('backend.admin.dashboard') }}" class="btn btn-secondary">⬅️ Back to Dashboard</a>
</div>
@endsection
