@extends("layouts.dashboard")
@section('content')

@section('head')

<link href="{{ asset('assets/admin/css/students-users-page.css') }}" rel="stylesheet">
@endsection



  <main id="main" class="main">

    <div class="pagetitle">
      <h1></h1>
      <nav>
        @include('includes.success-message')
    </nav>
	    <center><div class = "my-tt">Applicants Dashboard</div></center>

       

    </div><!-- End Page Title -->



    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">

      
	  
	  <!-- Add this to your HTML <head> if not already included -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
  .dashboard-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
    border: none;
  }

  .dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  }

  .dashboard-icon {
    font-size: 2.5rem;
    color: #4e73df;
    margin-bottom: 10px;
  }

  .card-body h5 {
    font-weight: bold;
    color: #333;
  }

  .card-body p {
    color: #666;
  }
</style>

<section id="testimonials" class="testimonials py-5">
  <div class="container">
    <div class="row g-4">

      <!-- Box 1: Edit Profile -->
      <div class="col-md-4">
        <a href="/profile/edit" class="text-decoration-none">
          <div class="card text-center dashboard-card shadow h-100">
            <div class="card-body">
              <i class="fas fa-user-circle dashboard-icon"></i>
              <h5 class="card-title">Edit Profile</h5>
              <p class="card-text">Update your personal info and preferences.</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Box 2: Posts -->
      <div class="col-md-4">
        <a href="/posts" class="text-decoration-none">
          <div class="card text-center dashboard-card shadow h-100">
            <div class="card-body">
              <i class="fas fa-file-alt dashboard-icon"></i>
              <h5 class="card-title">Posts</h5>
              <p class="card-text">Create, edit, and manage your submissions.</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Box 3: Reviews -->
      <div class="col-md-4">
        <a href="/reviews" class="text-decoration-none">
          <div class="card text-center dashboard-card shadow h-100">
            <div class="card-body">
              <i class="fas fa-star dashboard-icon"></i>
              <h5 class="card-title">Reviews</h5>
              <p class="card-text">Check feedback and review status.</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Box 4: Notifications -->
      <div class="col-md-4">
        <a href="/notifications" class="text-decoration-none">
          <div class="card text-center dashboard-card shadow h-100">
            <div class="card-body">
              <i class="fas fa-bell dashboard-icon"></i>
              <h5 class="card-title">Notifications</h5>
              <p class="card-text">View alerts and updates from the system.</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Box 5: Review Progress -->
      <div class="col-md-4">
        <a href="/review-progress" class="text-decoration-none">
          <div class="card text-center dashboard-card shadow h-100">
            <div class="card-body">
              <i class="fas fa-tasks dashboard-icon"></i>
              <h5 class="card-title">Review Progress</h5>
              <p class="card-text">Monitor all your review activities and stages.</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Box 6: Review Progress (Duplicate or Replace if Needed) -->
      <div class="col-md-4">
        <a href="/review-progress" class="text-decoration-none">
          <div class="card text-center dashboard-card shadow h-100">
            <div class="card-body">
              <i class="fas fa-chart-line dashboard-icon"></i>
              <h5 class="card-title">Review Progress</h5>
              <p class="card-text">Track how your documents are progressing.</p>
            </div>
          </div>
        </a>
      </div>

    </div>
  </div>
</section>

	  
	  
	  
	  
	  
      </div>
    </section><!-- End Testimonials Section -->
  </main><!-- End #main -->

@endsection
