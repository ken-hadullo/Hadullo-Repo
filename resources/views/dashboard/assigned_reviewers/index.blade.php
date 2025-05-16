@extends("layouts.dashboard")
@section('content')

@section('head')

<link href="{{ asset('assets/admin/css/documents-documents-page.css') }}" rel="stylesheet">
@endsection



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>My Dashboard</h1>

      <nav>
        @include('includes.success-message')
    </nav>
	    <center><div class = "my-tt">Assigned Reviewers Dashboard</div></center>

    

    </div><!-- End Page Title -->

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<h2>Document Details</h2>
    <!-- In your view file -->
<form method="POST" action="{{ route('documents.assign-reviewers', $document->id) }}">
    @csrf
    <h3>Potential Reviewers</h3>
    @foreach($potentialReviewers as $reviewer)
        <div class="form-check">
            <input type="checkbox" name="reviewer_ids[]" value="{{ $reviewer->id }}">
            <label>{{ $reviewer->name }} ({{ $reviewer->email }})</label>
        </div>
    @endforeach
    
    <h3>Current Reviewers</h3>
    @foreach($document->assignedReviewers as $reviewer)
        <div>{{ $reviewer->name }} (Assigned: {{ $reviewer->pivot->assigned_at->format('Y-m-d') }})</div>
    @endforeach
    
    <button type="submit" class="btn btn-primary">Save Assignments</button>
</form>
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">

        <div class="row">        


        </div>      
	   
      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->

@endsection
