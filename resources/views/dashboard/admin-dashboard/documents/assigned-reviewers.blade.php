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
            <div class="ken-heading">Assigned Reviewers</div>
        </div>
        
    </div>

    <hr><br>

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">assigned Reviews</h5>

                                               

                        <h2>Assigned Reviewers for: {{ $document->proposal_title }}</h2>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    
                       
                        @if($document->assignedReviewers->isEmpty())
                        <p>No reviewers assigned yet.</p>
                    @else

                    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Name</th>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Phone</th>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Specialization</th>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Research Interests</th>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Education</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($document->assignedReviewers as $reviewer)
                                <tr>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $reviewer->name }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $reviewer->phone }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $reviewer->specialization }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $reviewer->research_interests }}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $reviewer->education }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    
                    
                    
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
                    



                    
                    </div>
                    
                </div>
            </div>
        </div>        
    </section>

</main><!-- End #main -->
@endsection
