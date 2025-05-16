 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/dashboard/img/tum-logo.png" width="40" height="40" alt="">
      <span class="d-none d-lg-block">TUM ERC Portal</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <!-- Start Search Bar -->
  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="GET" action="{{ route('adminsearch') }}" enctype="multipart/form-data">
      <input type="search" name="searchterm" placeholder="Search" title="Enter search keyword" required/>
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div><!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle" href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->

      <!-- Notifications Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number">
            {{ auth()->check() ? auth()->user()->unreadNotifications->count() : 0 }}
          </span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            You have {{ auth()->check() ? auth()->user()->unreadNotifications->count() : 0 }} new notifications
            <a href="{{ route('notifications.index') }}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>

          @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
            @foreach(auth()->user()->unreadNotifications as $notification)
              <li class="notification-item">
                <i class="bi bi-info-circle text-primary"></i>
                <div>
                  <h4>{{ $notification->data['title'] ?? 'No Title' }}</h4>
                  <p>{{ $notification->data['message'] ?? 'No Message' }}</p>
                  <p>{{ $notification->created_at->diffForHumans() }}</p>
                </div>
              </li>
              <li><hr class="dropdown-divider"></li>
            @endforeach
          @else
            <li class="notification-item">
              <p>No new notifications.</p>
            </li>
          @endif

          <li class="dropdown-footer">
            <a href="{{ route('notifications.markAllAsRead') }}">Mark all as read</a>
          </li>
        </ul>
      </li><!-- End Notification Nav -->

      <!-- Messages Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-chat-left-text"></i>
          <span class="badge bg-success badge-number">3</span>
        </a><!-- End Messages Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
          <li class="dropdown-header">
            You have 3 new messages
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/dashboard/img/messages-1.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Maria Hudson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>4 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/dashboard/img/messages-2.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Anna Nelson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>6 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/dashboard/img/messages-3.jpg" alt="" class="rounded-circle">
              <div>
                <h4>David Muldon</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>8 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="dropdown-footer">
            <a href="#">Show all messages</a>
          </li>
        </ul><!-- End Messages Dropdown Items -->
      </li><!-- End Messages Nav -->

      <!-- Profile Dropdown -->
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          @if(Auth::check() && Auth::user()->avatar)
            <img src="{{ '/uploads/avatars/' . Auth::user()->avatar }}" alt="User Avatar" class="rounded-circle" />
          @else
            <img src="{{ asset('assets/dashboard/img/profiles/default.png') }}" alt="Default Avatar" class="rounded-circle" />
          @endif

          @auth
            <span class="d-none d-md-block dropdown-toggle ps-2">
              &nbsp;{{ Auth::user()->name }}
            </span>
          @endauth
        </a><!-- End Profile Image Icon -->

        @auth
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <!-- Profile Link Based on Role/User Type -->
            @if(Auth::user()->role_id === '1')
              <li>
                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                  <i class="bi bi-person"></i>
                  <span>Edit Profile</span>
                </a>
              </li>
            @elseif(Auth::user()->role_id === '2')
              <li>
                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                  <i class="bi bi-person"></i>
                  <span>Edit Profile</span>
                </a>
              </li>
            @else
              <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.index') }}">
                  <i class="bi bi-person"></i>
                  <span>Edit Profile</span>
                </a>
              </li>
            @endif

            <li><hr class="dropdown-divider"></li>

            <!-- Logout Link -->
            <li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <a class="dropdown-item d-flex align-items-center" href="#" 
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
        @endauth
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->