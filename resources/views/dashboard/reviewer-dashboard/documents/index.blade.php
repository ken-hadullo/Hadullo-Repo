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
            <div class="ken-heading">Assigned Reviews and Posts</div>
        </div>
    </div>

    <hr><br>

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        

                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Document Title</th>
                                    <th>Download</th>
                                    <th>Action</th> <!-- New column for the Review button -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignedReviews as $index => $review)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $review->document->proposal_title ?? 'Untitled' }}</td>
                                        <td>
                                            @if(!empty($review->document->proposal_doc_path))
                                                <a href="{{ asset($review->document->proposal_doc_path) }}" target="_blank">
                                                    View Document 
                                                    (<span class="r-level">posted on 
                                                        {{ optional($review->assigned_at)->format('d M Y') ?? 'Not Assigned' }}
                                                    </span>)
                                                </a>
                                            @else
                                                <span class="text-danger">No Document available</span>
                                            @endif
                                        </td>
                                        <td>
                                            
                                                <a href="{{ route('reviewDocument', ['id' => $review->document->id]) }}" class="btn btn-primary">Review</a>

												
											
                                            </a>
                                        </td>
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
