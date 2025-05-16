@extends("layouts.dashboard")
@section('content')

@section('head')

@endsection

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Admin Dashboard Home</h1>
      

      <nav>
        @include('includes.success-message')
    </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

           
<!-- Home Page Card -->
<div class="col-xxl-4 col-md-4">
  <div class="card info-card home-card">

    <div class="filter">
      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <li class="dropdown-header text-start">
          <h6>Filter</h6>
        </li>
        <li><a class="dropdown-item" href="#">Today</a></li>
        <li><a class="dropdown-item" href="#">This Month</a></li>
        <li><a class="dropdown-item" href="#">This Year</a></li>
      </ul>
    </div>

    <div class="card-body">
      <h5 class="card-title">Home Page <span>| Overview</span></h5>

      <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
          <i class="bi bi-house-door"></i>
        </div>
        <div class="ps-3">
          <h6>Welcome Back!</h6>
          <span class="text-muted small pt-2">Quick access to stats</span>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- End Home Page Card -->


<!-- Clickable Edit Profile Card -->
<div class="col-xxl-4 col-md-4">
  <a href="{{ route('profile.index') }}" class="text-decoration-none">
    <div class="card info-card profile-card text-dark">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Actions</h6>
          </li>
          <li><a class="dropdown-item" href="{">View Profile</a></li>
          <li><a class="dropdown-item" href="#">Change Password</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Edit Profile <span>| Manage Account</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-person-gear"></i>
          </div>
          <div class="ps-3">
            <h6>Update Info</h6>
            <span class="text-muted small pt-2">Keep your profile up to date</span>
          </div>
        </div>
      </div>

    </div>
  </a>
</div>
<!-- End Clickable Edit Profile Card -->

			
			
			<!-- Clickable My Posts Card -->
<div class="col-xxl-4 col-md-4">
  <a href="" class="text-decoration-none">
    <div class="card info-card posts-card text-dark">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Options</h6>
          </li>
          <li><a class="dropdown-item" href="">Create New Post</a></li>
          <li><a class="dropdown-item" href="">View All Posts</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">My Posts <span>| Activity</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-file-post"></i>
          </div>
          <div class="ps-3">
            <h6>See All Posts</h6>
            <span class="text-muted small pt-2">Manage your contributions</span>
          </div>
        </div>
      </div>

    </div>
  </a>
</div>
<!-- End Clickable My Posts Card -->

	<!-- Clickable My Reviews Card -->
<div class="col-xxl-4 col-md-4">
  <a href="" class="text-decoration-none">
    <div class="card info-card reviews-card text-dark">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Quick Actions</h6>
          </li>
          <li><a class="dropdown-item" href="">Pending Reviews</a></li>
          <li><a class="dropdown-item" href="">All My Reviews</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">My Reviews <span>| Feedback Tasks</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-check2-square"></i>
          </div>
          <div class="ps-3">
            <h6>View Your Reviews</h6>
            <span class="text-muted small pt-2">Track & complete review tasks</span>
          </div>
        </div>
      </div>

    </div>
  </a>
</div>
<!-- End Clickable My Reviews Card -->

	<!-- Clickable Users Card -->
<div class="col-xxl-4 col-md-4">
  <a href="{{ route('users.index') }}" class="text-decoration-none">
    <div class="card info-card users-card text-dark">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>User Actions</h6>
          </li>
          <li><a class="dropdown-item" href="">Add New User</a></li>
          <li><a class="dropdown-item" href="">Manage Users</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Users <span>| System Accounts</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-people"></i>
          </div>
          <div class="ps-3">
            <h6>Manage Users</h6>
            <span class="text-muted small pt-2">Administer all accounts</span>
          </div>
        </div>
      </div>

    </div>
  </a>
</div>
<!-- End Clickable Users Card -->

<!-- Clickable Documents Card -->
<div class="col-xxl-4 col-md-4">
  <a href="{{ route('documents.index') }}" class="text-decoration-none">
    <div class="card info-card documents-card text-dark">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Document Actions</h6>
          </li>
          <li><a class="dropdown-item" href="">Upload New Document</a></li>
          <li><a class="dropdown-item" href="">View All Documents</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Documents <span>| Submissions</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-folder2-open"></i>
          </div>
          <div class="ps-3">
            <h6>Manage Documents</h6>
            <span class="text-muted small pt-2">Review & submit files</span>
          </div>
        </div>
      </div>

    </div>
  </a>
</div>
<!-- End Clickable Documents Card -->

	

          
</div>
</div><!-- End Left side columns -->

      
          

      </div>
    </section>

  </main><!-- End #main -->
  
 @endsection