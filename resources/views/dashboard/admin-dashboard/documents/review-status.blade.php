@extends("layouts.dashboard")

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
            <div class="ken-heading"></div>
        </div>
        <div class="d-flex gap-2">
    <a href="{{ route('documents.index') }}">
        <button type="button" class="btn btn-primary btn-sm admin-add-button">
            Home
        </button>
    </a>
	

    
			<a href="{{ route('form1') }}">
                <button type="button" class="btn btn-primary btn-sm admin-add-button">Upload</button>
            </a>
    
    
</div>
    </div>

    <hr><br>

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Documents Review Status</h5>

                        

 
                        @if($groupedDocuments->isEmpty())
                        <div class="alert alert-info">
                            No reviews found.
                        </div>
                    @else
                        @foreach($groupedDocuments as $status => $documents)
                            <h3>{{ ucfirst($status) }} ({{ $documents->count() }})</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Proposal Title</th>
                                        <th>Reviewer</th>
                                        <th>Status</th>
                                        <th>Last Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $review)
                                        <tr>
                                            <td>{{ $review->document->proposal_title }}</td>
                                            <td>{{ $review->reviewer?->name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $review->status == 'approved' ? 'success' : ($review->status == 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst(str_replace('_', ' ', $review->status)) }}
                                                </span>
                                            </td>
                                            <td>{{ $review->updated_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    @endif
<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    
</div>


                    
                    </div>
                    
                </div>
            </div>
        </div>        
    </section>

</main><!-- End #main -->
@endsection
