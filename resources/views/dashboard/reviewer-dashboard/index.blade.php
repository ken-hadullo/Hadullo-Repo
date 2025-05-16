@extends("layouts.dashboard")

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

<style>
  .dashboard-icons {
      display: grid;
      grid-template-columns: repeat(3, 1fr); /* 3 columns */
      grid-template-rows: repeat(2, auto);   /* 2 rows */
      gap: 20px;
      padding: 30px;
      max-width: 800px;
      margin: 0 auto;
  }
  
  .icon-box {
      background: #f8f9fa;
      border: 2px solid #dee2e6;
      border-radius: 15px;
      padding: 20px;
      text-align: center;
      text-decoration: none;
      color: #333;
      transition: background 0.3s, transform 0.3s;
  }
  
  .icon-box:hover {
      background: #e2e6ea;
      transform: translateY(-5px);
  }
  
  .icon {
      font-size: 48px; /* Icon size */
      margin-bottom: 10px;
  }
  
  .label {
      font-size: 18px; /* Label font size */
      font-weight: bold;
  }
  </style>
  
  

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1><b>Reviewer Dashboard Home</b></h1>
        <nav>
            @include('includes.flash-message')
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="column">
            <div class="ken-heading">Research Documents</div>
        </div>
        <div class="column">
            <a href="{{ route('create.documents') }}">
                <button type="button" class="btn btn-primary btn-sm admin-add-button">Add a Document</button>
            </a>
            <a href="">
                <button type="button" class="btn btn-secondary btn-sm admin-add-button">Manage Documents</button>
            </a>
        </div>
    </div>

    <hr><br>

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">


                   

                      <div class="dashboard-icons">
                        <a href="{{ route('dashboard') }}" class="icon-box">
                            <div class="icon">&#8962;</div> <!-- Home icon (⌂) -->
                            <div class="label">Home</div>
                        </a>
                    
                        <a href="{{ route('profile.index') }}" class="icon-box">
                            <div class="icon">&#9998;</div> <!-- Edit icon (✎) -->
                            <div class="label">Edit Profile</div>
                        </a>
                    
                        <a href="{{ route('documents.index') }}" class="icon-box">
                            <div class="icon">&#128221;</div> <!-- Memo/Posts icon (📝) -->
                            <div class="label">Posts & Reviews</div>
                        </a>
                    
                        <a href="{{ route('dashboard') }}" class="icon-box">
                            <div class="icon">&#128276;</div> <!-- Bell icon (🔔) -->
                            <div class="label">Notifications</div>
                        </a>
                    
                        <a href="{{ route('dashboard') }}" class="icon-box">
                            <div class="icon">&#9993;</div> <!-- Envelope icon (✉) -->
                            <div class="label">Messages</div>
                        </a>
                    
                        <a href="{{ route('dashboard') }}" class="icon-box">
                            <div class="icon">&#128202;</div> <!-- Bar chart icon (📊) -->
                            <div class="label">Statistics</div>
                        </a>
                    </div>
                    



                    
                    
  
           
                    </div>
                    

                </div>
            </div>
        </div>        
    </section>

</main><!-- End #main -->
@endsection

