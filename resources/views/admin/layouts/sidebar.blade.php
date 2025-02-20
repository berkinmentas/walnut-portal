<aside class="sidebar">
    <a href="{{route('admin.dashboard')}}">
        <div class="sidebar-logo">
            <img class="img-fluid mb-3" src="{{ Vite::asset('resources/images/logo.png') }}">
            <h5>Walnut Portal</h5>
        </div>
    </a>
    <div class="sidebar-nav">
        <ul class="nav flex-column accordion accordion-flush">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin-users.*') ? 'active' : '' }}"
                   href="{{ route('admin.users.index') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>{{ __('Admin Users') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.incoming-logs.*') ? 'active' : '' }}"
                   href="{{ route('admin.incoming-logs.index') }}">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>{{ __('Incoming Logs') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.incoming-log-data.*') ? 'active' : '' }}"
                   href="{{ route('admin.incoming-log-data.index') }}">
                    <i class="fa-solid fa-database"></i>
                    <span>{{ __('Incoming Log Data') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('callback-logs.*') ? 'active' : '' }}"
                   href="{{ route('admin.callback-logs.index') }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span>{{ __('Callback Log') }}</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
