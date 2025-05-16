@extends("layouts.admin")

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1><b>Super Admin Dashboard</b></h1>
        <nav>
            @include('includes.success-message')
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="column">
            <div class="ken-heading">Assigned Reviewers</div>
        </div>
    </div>

    <hr><br>

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Assigned Reviews</h5>


                       
                        <div class="card-body">
                            @if($submittedDocuments->isEmpty())
                                <p>No documents submitted yet.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Department</th>
                                            <th>Submission Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($submittedDocuments as $index => $document)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $document->title }}</td>
                                                <td>{{ $document->department->name ?? 'N/A' }}</td>
                                                <td>{{ $document->created_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $document->status == 'approved' ? 'success' : ($document->status == 'pending' ? 'warning' : 'danger') }}">
                                                        {{ ucfirst($document->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                
                    {{-- Documents Assigned for Review --}}
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h4>Documents Assigned for Review</h4>
                        </div>
                        <div class="card-body">
                            @if($assignedReviews->isEmpty())
                                <p>No documents assigned for review.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Document Title</th>
                                            <th>Author</th>
                                            <th>Department</th>
                                            <th>Assigned Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($assignedReviews as $index => $review)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $review->document->title }}</td>
                                                <td>{{ $review->document->author->name }}</td>
                                                <td>{{ $review->document->department->name ?? 'N/A' }}</td>
                                                <td>{{ $review->assigned_at ? $review->assigned_at->format('Y-m-d H:i') : 'Not Assigned' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $review->status == 'pending' ? 'warning' : 'success' }}">
                                                        {{ ucfirst($review->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>   
                       
                       
                       
                       
                       
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>

                </div>
                </div>
            </div>
        </div>        
    </section>

</main><!-- End #main -->
@endsection
