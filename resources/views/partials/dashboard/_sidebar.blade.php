<style>
    .sidebar .nav-link {
        padding-top: 0.3rem;
        padding-bottom: 0.3rem;
        margin-bottom: 0.1rem; /* Optional: reduce spacing between links */
    }

    .sidebar .nav-item {
        margin-bottom: 0.2rem;
    }

    .sidebar .nav-link i {
        margin-right: 0.5rem; /* Adjust spacing between icon and text */
    }

    .sidebar-nav {
        gap: 0 !important; /* If using flex/grid with gaps */
    }
</style>


@if(Route::has('login'))
    @auth
        @if(Auth::user()->role_id == '1')
            <!-- ======= Sidebar for Role 1 (Admin) ======= -->
            <aside id="sidebar" class="sidebar">
                <ul class="sidebar-nav" id="sidebar-nav">
                    <li class="nav-item">
                        <i class="bi bi-speedometer2" style="font-size: 1.5rem;"></i>
                        <span class="ken-menu">Admin Dashboard</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door" style="font-size: 1.5rem;"></i>
                            <span>Home</span>
                        </a>
                      
                        <a class="nav-link collapsed" href="{{ route('profile.index') }}">
                            <i class="bi bi-person-lines-fill" style="font-size: 1.5rem;"></i>
                            <span>Edit Profile</span>
                        </a>

                        <a class="nav-link collapsed" href="{{ route('documents.index') }}">
                            <i class="bi bi-file-earmark-text-fill" style="font-size: 1.5rem;"></i>
                            <span>Reviews & Posts</span>
                        </a>


                        
                        <a class="nav-link collapsed" href="{{ route('documents.index') }}">
                            <i class="bi bi-file-earmark-text-fill" style="font-size: 1.5rem;"></i>
                            <span>Posts </span>
                        </a>
                        <a class="nav-link collapsed" href="{{ route('documents.index') }}">
                            <i class="bi bi-bar-chart-fill" style="font-size: 1.5rem;"></i>
                            <span>Statistics</span>
                        </a>

                        <a class="nav-link collapsed" href="{{ route('users.index') }}">
                            <i class="bi bi-people-fill" style="font-size: 1.5rem;"></i>
                            <span>Users</span>
                        </a>

                        <a class="nav-link collapsed" href="{{ route('documents.index') }}">
                            <i class="bi bi-folder-fill" style="font-size: 1.5rem;"></i>
                            <span>Documents</span>
                        </a>

                        <a class="nav-link collapsed" href="{{ route('notifications.index') }}">
                            <i class="bi bi-bell-fill" style="font-size: 1.5rem;"></i>
                            <span>Notifications</span>                            
                        </a>

                        <a class="nav-link collapsed" href="{{ route('notifications.index') }}">
                            <i class="bi bi-envelope-fill" style="font-size: 1.5rem;"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                </ul>
            </aside>
        
        @elseif(Auth::user()->role_id == 2 || Auth::user()->role_id === null)

            <!-- ======= Sidebar for Role 2 (Editor/User) ======= -->
            <aside id="sidebar" class="sidebar">
                <ul class="sidebar-nav" id="sidebar-nav">
                    <li class="nav-item">
                        <i class="bi bi-layout-text-sidebar-reverse" style="font-size: 1.5rem;"></i>
                        <span class="ken-menu">My Dashboard</span>
                    </li>

                    <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door" style="font-size: 1.5rem;"></i>
                        <span>Home</span>
                    </a>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('profile.index') }}">
                            <i class="bi bi-person-lines-fill" style="font-size: 1.5rem;"></i>
                            <span>Edit Profile</span>
                        </a>

                        <a class="nav-link collapsed" href="{{ route('documents.index') }}">
                            <i class="bi bi-file-earmark-text-fill" style="font-size: 1.5rem;"></i>
                            <span>Posts & Reviews</span>
                        </a>
                        <a class="nav-link collapsed" href="{{ route('notifications.index') }}">
                            <i class="bi bi-bell-fill" style="font-size: 1.5rem;"></i>
                            <span>Notifications</span>
                        </a>
                        <a class="nav-link collapsed" href="{{ route('notifications.index') }}">
                            <i class="bi bi-envelope-fill" style="font-size: 1.5rem;"></i>
                            <span>Messages</span>
                        </a>
                        <a class="nav-link collapsed" href="{{ route('submission.progress') }}">
                            <i class="bi bi-hourglass-split" style="font-size: 1.5rem;"></i>
                            <span>Review Progress</span>
                        </a>
                    </li>
                </ul>
            </aside>
        @elseif(Auth::user()->role_id == '3')
            <!-- ======= Sidebar for Role 3 (Analyst/Other) ======= -->
            <aside id="sidebar" class="sidebar">
                <ul class="sidebar-nav" id="sidebar-nav">
                    <li class="nav-item">
                        <i class="bi bi-bar-chart-line" style="font-size: 1.5rem;"></i>
                        <span class="ken-menu">My Dashboard</span>
                    </li>

                    <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door" style="font-size: 1.5rem;"></i>
                        <span>Home</span>
                    </a>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('profile.index') }}">
                            <i class="bi bi-person-lines-fill" style="font-size: 1.5rem;"></i>
                            <span>Edit Profile</span>
                        </a>
                        <a class="nav-link collapsed" href="{{ route('documents.index') }}">
                            <i class="bi bi-file-earmark-text-fill" style="font-size: 1.5rem;"></i>
                            <span>Reviews & Posts</span>
                        </a>

                        <a class="nav-link collapsed" href="">
                            <i class="bi bi-bar-chart-fill" style="font-size: 1.5rem;"></i>
                            <span>Statistics</span>
                        </a>

                        <a class="nav-link collapsed" href="{{ route('notifications.index') }}">
                            <i class="bi bi-bell-fill" style="font-size: 1.5rem;"></i>
                            <span>Notifications</span>
                        </a>

                        <a class="nav-link collapsed" href="{{ route('notifications.index') }}">
                            <i class="bi bi-envelope-fill" style="font-size: 1.5rem;"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                </ul>
            </aside>
            @elseif(Auth::user()->role_id == '4')
            <!-- ======= Sidebar for Role 4 (Custom Role) ======= -->
            <aside id="sidebar" class="sidebar">
                <ul class="sidebar-nav" id="sidebar-nav">
                    <li class="nav-item">
                        <i class="bi bi-clipboard-data" style="font-size: 1.5rem;"></i>
                        <span class="ken-menu">ERC Dashboard</span>
                    </li>

                    <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door" style="font-size: 1.5rem;"></i>
                        <span>Home</span>
                    </a>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('profile.index') }}">
                            <i class="bi bi-person-lines-fill" style="font-size: 1.5rem;"></i>
                            <span>Edit Profile</span>
                        </a>

                        <a class="nav-link collapsed" href="{{ route('documents.index') }}">
                            <i class="bi bi-file-earmark-text-fill" style="font-size: 1.5rem;"></i>
                            <span>Posts & Reviews</span>
                        </a>

                        <a class="nav-link collapsed" href="">
                            <i class="bi bi-bar-chart-fill" style="font-size: 1.5rem;"></i>
                            <span>Reports</span>
                        </a>

                        <a class="nav-link collapsed" href="{{ route('notifications.index') }}">
                            <i class="bi bi-bell-fill" style="font-size: 1.5rem;"></i>
                            <span>Notifications</span>
                        </a>

                        <a class="nav-link collapsed" href="">
                            <i class="bi bi-envelope-fill" style="font-size: 1.5rem;"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                </ul>
            </aside>
        @endif
    @endauth
@endif