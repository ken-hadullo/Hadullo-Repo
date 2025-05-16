@extends("layouts.dashboard")

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1><b>Commitee Member Dashboard</b></h1>
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
                        <h5 class="card-title">Reviewer Assignment</h5>

                        <!-- Button to Trigger Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignReviewerModal">
    Assign Reviewer
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="assignReviewerModal" tabindex="-1" aria-labelledby="assignReviewerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="assignReviewerModalLabel">Assign Reviewer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Research Document Text Box -->
          <div class="mb-3">
            <label for="researchDocument" class="form-label">Selected Research Document</label>
            <input type="text" class="form-control" id="researchDocument" value="Research Document Title" readonly>
          </div>
  
          <!-- Reviewers Dropdown -->
          <div class="mb-3">
            <label for="reviewersDropdown" class="form-label">Select Reviewer</label>
            <select class="form-select" id="reviewersDropdown">
              <option selected disabled>Choose a reviewer</option>
              <option value="1">John Doe</option>
              <option value="2">Jane Smith</option>
              <option value="3">Alice Johnson</option>
              <option value="4">Bob Brown</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Assign</button>
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

