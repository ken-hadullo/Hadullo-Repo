@extends("layouts.frontend")
@section('head')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .reviewer-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #007bff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .reviewer-card {
            background: #f8f9fa;
            border-radius: 15px;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .reviewer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .reviewer-name {
            font-weight: bold;
            margin-top: 10px;
            font-size: 1.2rem;
        }
        .reviewer-specialization {
            font-style: italic;
            color: #555;
            font-size: 0.9rem;
        }
        .full-info-link {
            text-decoration: none;
            color: #007bff;
            font-size: 0.9rem;
        }
    </style>

@section('content')




    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            
              
                
                <div class="row g-4">
        
                    <div class="col-md-3">
                        <div class="reviewer-card p-3">
                            <img src="" alt="Reviewer Image" class="reviewer-img">
                            <div class="reviewer-name"></div>
                            <div class="reviewer-specialization"></div>
                            <a href="" class="full-info-link">
                                <i class="fas fa-info-circle"></i> View Full Profile
                            </a>
                        </div>
                    </div>
                
            
                
                
               
            </div>
        </div>
    </div>
    <!-- Service End -->


   


        
    </div>


    
 @endsection      

   