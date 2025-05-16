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
            <div class="ken-heading">Reviewer Match</div>
        </div>
        <div class="d-flex gap-2">
    <a href="">
        <button type="button" class="btn btn-primary btn-sm admin-add-button">
            Approved
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
                        <h5 class="card-title">Research Documents</h5>


    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade-message">
        {{ session('success') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade-message">
        {{ session('info') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade-message">
        {{ session('error') }}
    </div>
@endif

{{-- Fade out script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fadeMessages = document.querySelectorAll('.fade-message');
        fadeMessages.forEach(function(message) {
            setTimeout(() => {
                message.style.transition = "opacity 1s ease-out";
                message.style.opacity = 0;
                setTimeout(() => message.remove(), 1000);
            }, 3000); // 3 seconds before fading starts
        });
    });
</script>



  
    <div class="container">
        <h2>Reviewer Recommendations for: <em>{{ $document->proposal_title }}</em></h2>
    
        @if(count($recommendations) > 0)
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>Reviewer Name</th>
                    <th>Phone</th>
                    <th>Specialization</th>
                    <th>Education</th>
                    <th>Research Interests</th>
                    <th>Score</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recommendations as $rec)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rec['user']->name }}</td>
                        <td>{{ $rec['user']->phone }}</td>
                        <td>{{ $rec['user']->specialization }}</td>
                        <td>{{ $rec['user']->education }}</td>
                        <td>{{ $rec['user']->research_interests }}</td>
                        <td>{{ $rec['score'] }}</td>
                        <td>
                         					
							
							
							

<form action="{{ route('assign.reviewer', ['documentId' => $document->id]) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">
        Assign Reviewer
    </button>
</form>



                                                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        @else
            <p>No suitable reviewers found for this document.</p>
        @endif
    </div>
    
    
    


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
