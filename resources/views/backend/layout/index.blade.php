<!DOCTYPE html>
<html lang="en">
    @include('backend.layout.partials.head')

<body class="sb-nav-fixed">
    @include('backend.layout.partials.navbar')

    <div id="layoutSidenav">

        @php
            use App\Enums\UserRole;
        @endphp

        {{-- ✅ عرض الشريط الجانبي حسب الدور --}}
        @auth
            @if (Auth::user()->role === UserRole::Admin)
                @include('backend.layout.partials.sidebar_admin')
            @elseif (Auth::user()->role === UserRole::Teacher)
                @include('backend.layout.partials.sidebar_teacher')
            @elseif (Auth::user()->role === UserRole::Student)
                @include('backend.layout.partials.sidebar_student')
            @endif
        @endauth

        <div id="layoutSidenav_content">
            @yield('content')

            @include('backend.layout.partials.footer')
        </div>
    </div>

    @include('backend.layout.partials.script')
</body>
</html>
