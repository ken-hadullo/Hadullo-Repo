@extends("layouts.dashboard")

@section('head')
<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')



<main id="main" class="main">

    <div class="pagetitle">
        <h1><b>Super Admin Dashboard</b></h1>
        <nav>
            @include('includes.flash-message')
        </nav>
    </div><!-- End Page Title -->

    <!-- Title Row -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="ken-heading">Stage 1:Review Requirements Check</div>
        </div>
        <div class="col-md-6 text-end">
          


            

        </div>








    </div>

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Proposal Documents</h5>

                        <div class="row">
                            <div class="container">
                                <div class="col-12 col-md-6 col-lg-12">
                                    <div class="card document-card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="fa fa-file-text icon"></i>
                                                {{ $document->proposal_title }} 
                                                <span class="r-level">({{ $document->pLevel->name ?? 'Not Assigned' }})</span>
                                            </h5>
                                            
                                            <p class="card-text">
                                                <i class="fa fa-file icon"></i> 
                                                <strong>Research Document: </strong>
                                                @if($document->proposal_doc_path)
                                                    <a href="{{ asset($document->proposal_doc_path) }}" target="_blank">
                                                        View /Download Link
                                                    </a>
                                                @else
                                                    <span class="text-danger">No Document available</span>
                                                @endif
                                            </p>

                                            <p class="card-text">
                                                <i class="fa fa-user icon"></i> 
                                                <strong>Applicant(s) CV: </strong>
                                                @if($document->applicants_cv_path)
                                                    <a href="{{ asset($document->applicants_cv_path) }}" target="_blank">
                                                        View/Download Link
                                                    </a>
                                                @else
                                                    <span class="text-danger">No CV available</span>
                                                @endif
                                            </p>

                                            <p class="card-text">
                                                <i class="fa fa-check-circle icon"></i> 
                                                <strong>Ethical Approval Document:</strong> 
                                                @if($document->ethical_approval_path)
                                                    <a href="{{ asset($document->ethical_approval_path) }}" target="_blank">
                                                        View/Downlaod
                                                    </a>
                                                @else
                                                    <span class="text-danger">No Ethical Approval available</span>
                                                @endif
                                            </p>

                                            <p class="card-text">
                                                <i class="fa fa-exclamation-triangle icon"></i> 
                                               <strong> Plagiarism Report: </strong>
                                                @if($document->plagiarism_report_path)
                                                    <a href="{{ asset($document->plagiarism_report_path) }}" target="_blank">
                                                        View/Download
                                                    </a>
                                                @else
                                                    <span class="text-danger">No Plagiarism Report available</span>
                                                @endif
                                            </p>

                                            <p class="card-text">
                                                <i class="fa fa-credit-card icon"></i> 
                                               <strong> Payment Receipt: </strong>
                                                @if($document->payment_receipt_path)
                                                    <a href="{{ asset($document->payment_receipt_path) }}" target="_blank">
                                                        View /Downlaod
                                                    </a>
                                                @else
                                                    <span class="text-danger">No Payment Receipt available</span>
                                                @endif
                                            </p>

                                            <hr>

                                            <p class="card-text">
                                                <i class="fa fa-calendar icon"></i> 
                                                <span class="posted-on">
                                                    Posted: {{ $document->created_at->format("d/m/y  H:i a") }}  
                                                    by: <strong>{{ $document->user->name ?? 'No Data' }}</strong> &nbsp;{{ $document->researchRole->title ?? 'Not Assigned' }}
                                                </span>
                                            </p>



                                            
                                        </div>
                                    </div>
                                </div>
                                
                                  <!-- Buttons Section -->
                          <div class="button-group d-flex gap-2 align-items-start">
    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left icon"></i> Back
    </a>

    <!-- Approve Button -->
    @if(optional($document->review)->status !== 'approved')
        <form action="{{ route('approve.documents', $document->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check icon"></i> Approve
            </button>
        </form>
    @else
        <button class="btn btn-secondary" disabled>Approved</button>
    @endif

    <!-- Reject Button -->
    @if(optional($document->review)->status !== 'rejected')
        
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectDocumentModal">
                <i class="fa fa-times icon"></i> Reject
            </button>
        
    @else
        <button class="btn btn-secondary" disabled>Rejected</button>
    @endif
</div>

								
								
                                              </div>
                        </div> <!-- End Row -->
                    </div> <!-- End Card Body -->
                </div> <!-- End Card -->
            </div> <!-- End Col -->
        </div> <!-- End Row -->
    </section>

</main><!-- End #main -->



<!-- Reject Document Modal -->
<div class="modal fade" id="rejectDocumentModal" tabindex="-1" aria-labelledby="rejectDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectDocumentModalLabel">Reject Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('reject.documents', $document->id) }}" method="POST">
                @csrf
                
                <div class="modal-body">
                    <label for="rejectionMessage" class="form-label">Reason for Rejection:</label>
                    <textarea name="rejection_message" id="rejection_message" class="form-control" rows="3" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Reject Document</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>






@endsection
