@extends("layouts.dashboard")

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  * {
    box-sizing: border-box;
  }

  .column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 50px;
  }

  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  .admin-add-button {
    margin-right: 10px;
  }

  .btn-action {
    margin: 2px;
  }
</style>
@endsection

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1><b>User Dashboard</b></h1>
        <nav>
            @include('includes.success-message')
        </nav>
    </div>

    <div class="row">
        <div class="column">
            <div class="ken-heading">Research Documents Home</div>
        </div>
        <div class="column">
            <div class="d-flex gap-2">
                @auth
                @if(auth()->user()->role_id == 1)
                    <a href="{{ route('review-status') }}">
                        <button type="button" class="btn btn-primary btn-sm admin-add-button">
                            Review Status
                        </button>
                    </a>
                @endif
            @endauth
            
                <a href="{{ route('form1') }}">
                    <button type="button" class="btn btn-primary btn-sm admin-add-button">Upload Document</button>
                </a>
            </div>
        </div>
    </div>

    <hr><br>

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Research Documents</h5>

                        <table class="table table-bordered border-primary">
                            @php $i = 1 @endphp
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Status</th>
                                    @if(auth()->user()->role_id == 1)
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                        
                            <tbody>
                                @if($documents->count() > 0)
                                    @foreach($documents as $document)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>
                                            {{ $document->proposal_title }} 
                                            (<span class="r-level">{{ $document->pLevel->name ?? 'Not Assigned' }}</span>)
                                        </td>
                                        <td>
                                            @if(!empty($document->proposal_doc_path))
                                                <a href="{{ asset($document->proposal_doc_path) }}" target="_blank">
                                                    View Document </a>
                                                    (<span class="r-level">posted on {{ $document->created_at->format('d/m/y') }}</span>)
                                                
                                               by {{ $document->user->name ?? 'No Data' }} 
                                            (<span class="r-level">{{ $document->researchRole->title ?? 'Not Assigned' }}</span>)
                                            @else
                                                <span class="text-danger">No Document available</span>
                                            @endif
                                        </td>
                        
                                        <td>
                                            @php
                                                $status = optional($document->review)->status;
                                            @endphp
                                        
                                            @if($status === 'approved')
                                                <button class="btn btn-success btn-sm" disabled>
                                                    <i class="fa fa-check"></i> Approved
                                                </button>
                                            @elseif($status === 'rejected')
                                                <button class="btn btn-danger btn-sm" disabled>
                                                    <i class="fa fa-times"></i> Rejected
                                                </button>
                                            @elseif($status === 'assigned')
                                                <button class="btn btn-primary btn-sm" disabled>
                                                    <i class="fa fa-user-check"></i> Assigned
                                                </button>
                                            @elseif($status === 'in_review')
                                                <button class="btn btn-info btn-sm" disabled>
                                                    <i class="fa fa-eye"></i> In Review
                                                </button>
                                            @elseif($status === 'verdict_passed')
                                                <button class="btn btn-success btn-sm" disabled>
                                                    <i class="fa fa-gavel"></i> Verdict Passed
                                                </button>
                                            @else
                                                <button class="btn btn-warning btn-sm" disabled>
                                                    <i class="fa fa-hourglass-half"></i> Pending
                                                </button>
                                            @endif
                                        </td>
                                        
                                        @if(auth()->user()->role_id == 1)
                                        <td>
                                            @if($status === 'approved')
                                            @if($document->review && $document->review->status === 'approved')
                                            <a href="{{ route('documents.reviewers', $document->id) }}" class="btn btn-info btn-sm me-2">
                                                <strong>Potential Reviewers</strong>
                                            </a>
                                        @endif
                                            @elseif($status === 'pending' || empty($status))
                                                <a href="{{ route('view.document.requirements', $document->id) }}" 
                                                   class="btn btn-info btn-sm"
                                                   title="Review Document">
                                                    View/Approve/Reject
                                                </a>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">No documents found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>


                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection