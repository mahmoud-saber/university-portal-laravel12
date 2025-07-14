<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ route('backend.admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard Admin
                </a>
                <a class="nav-link" href="{{ route('admin.profile') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                     Profile
                </a>
                <a class="nav-link" href="{{ route('teachers.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                     Teacher
                </a>

                  <a class="nav-link" href="{{ route('students.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                     Student
                </a>

                  <a class="nav-link" href="{{ route('courses.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                     Course
                </a>


            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>
