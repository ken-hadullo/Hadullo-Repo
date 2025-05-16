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

                        @if(session('totalReviewers') !== null)
    <div class="alert alert-info">
        <strong>{{ session('totalReviewers') }}</strong> potential reviewers were found and assigned.
    </div>
@endif

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    
                      


                        <h2 class="mb-4">Assigned Reviewers </h2>

                       

                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Reviewer Name</th>
                                    <th>Department</th>
                                    <th>School</th>
                                    <th>Assigned At</th>
                                    <th>Match Reason</th>
                                    <th>Match Score</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignedReviewers as $index => $review)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $review->reviewer->name }}</td>
                                        <td>{{ $review->reviewer->department->name ?? 'N/A' }}</td>
                                        <td>{{ $review->reviewer->school->name ?? 'N/A' }}</td>
                                        <td>{{ $review->assigned_at ? \Carbon\Carbon::parse($review->assigned_at)->format('Y-m-d H:i') : 'Not Assigned' }}</td>
                                        <td>{{ $review->match_reason ?? 'N/A' }}</td>
                                        <td>{{ $review->match_score }}</td>
                                        <td><span class="badge bg-{{ $review->status == 'pending' ? 'warning' : 'success' }}">{{ ucfirst($review->status) }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        

                        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>

                    </div>
                </div>
            </div>
        </div>        
    </section>

</main><!-- End #main -->
@endsection
