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
            <div class="ken-heading">Potential Reviewers</div>
        </div>
       <div class="d-flex gap-2">
    <a href="">
        <button type="button" class="btn btn-primary btn-sm admin-add-button">
            Approved
        </button>
    </a>
	
	 <a href="">
        <button type="button" class="btn btn-primary btn-sm admin-add-button">
            Assigned
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
                                          

<span class="badge bg-primary">
    Total Potential Reviewers: {{ $reviewerCount }}
</span>

 @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
    </div>
@endif

<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => el.classList.remove('show'));
    }, 4000);
</script>


     
   <h4>Potential Reviewers for: <strong>{{ $document->proposal_title }}</strong></h4>

   <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Name</th>
            <th>Specialization</th>
            <th>Education</th>
            <th>Research Interests</th>
            <th>Department</th>
			 <th>Score</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($potentialReviewers as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->specialization }}</td>
                <td>{{ $user->education }}</td>
                <td>{{ $user->research_interests }}</td>
                <td>{{ $user->department->name ?? 'N/A' }}</td>
				<td><strong>{{ $user->match_score }}</strong></td>
                <td>
  

                    <form action="{{ route('assignReviewer') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="document_id" value="{{ $document->id }}">
                        <input type="hidden" name="reviewer_id" value="{{ $user->id }}">
                    
                        <button type="submit" class="btn btn-sm btn-primary">
                            Assign Reviewer
                        </button>
                    </form>


                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No potential reviewers found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
	
    <a href="" class="btn btn-secondary">Back</a>
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
