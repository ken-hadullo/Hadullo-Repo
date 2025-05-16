@extends("layouts.admin")

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1><b>Reviewer's Dashboard</b></h1>
        <nav>
            @include('includes.flash-message')
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="column">
            <div class="ken-heading">Proposal Document Checklist</div>
        </div>
        
    </div>

    <hr><br>

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">                      
						
						<h5 class="card-title"><strong>Title:<strong>{{ $documentTitle }}</h5>


<div class="container">
    <h1>1.Scientific Design and Conduct of the Study</h1>
    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studyModal">
        Provide Response
    </button>

    <!-- Bootstrap Modal -->
    
	 <div class="modal fade" id="studyModal" tabindex="-1" aria-labelledby="studyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studyModalLabel">Scientific Design and Conduct of the Study</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        This must be in line with the field of study’s research design and procedure for carrying out research. 
                        If otherwise, it will be considered unethical.
                    </p>
                    <form method="POST" action="{{ route('sdcs.submit', $review->id) }}">
						@csrf
                        <div class="mb-3">
                            <label for="response" class="form-label">Your Response</label>
                            <textarea class="form-control" id="sdcs_response" name="sdcs_response" rows="4" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit Response</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


  

                    </div>                  

                </div>
            </div>
        </div>        
    </section>

</main><!-- End #main -->
@endsection

