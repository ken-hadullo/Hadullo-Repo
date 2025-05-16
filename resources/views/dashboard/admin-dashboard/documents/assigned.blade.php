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
                        
                       
					   <h2 class="mb-4">Assigned Documents</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Document Title</th>
                <th>Reviewer Name</th>
                <th>Date Assigned</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assignedDocuments as $assignment)
                <tr>
                    <td>{{ $assignment->document->proposal_title ?? 'N/A' }}</td>
                    <td>{{ $assignment->reviewer->name ?? 'Unassigned' }}</td>
                    <td><em>on {{ $assignment->assigned_at->format('d M Y, h:i A') }}</em></td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No assigned documents found.</td>
                </tr>
            @endforelse
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
