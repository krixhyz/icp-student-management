@auth
    @php $role = auth()->user()->role; @endphp

    @if($role === 'teacher' || $role === 'student')
        <aside id="sidebarMenu" class="bg-light border-end vh-100 position-fixed" style="width: 250px;">
            <div class="d-flex flex-column p-3 h-100">
                <h5 class="mb-4">Menu</h5>
                <nav class="nav flex-column">
                    <a href="{{ route('attendances.index') }}" class="nav-link">Attendance</a>
                    <a href="{{ route('users.students') }}" class="nav-link">Students</a>

                    @if($role === 'teacher')
                        <a href="{{ route('users.index') }}" class="nav-link">Users</a>
                    @endif
                </nav>
            </div>
        </aside>
    @endif
@endauth
