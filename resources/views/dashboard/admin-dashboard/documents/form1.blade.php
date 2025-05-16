@extends("layouts.dashboard")

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Super Admin Dashboard</h1><br>
        <div class="user-pg">
            <div style="width: 90%; float:left">Proposal Document Upload - Step 1</div>
            <nav>@include('includes.flash-message')</nav>
        </div>
        <br>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Step 1: Fill in the following Details</h5>

                        <form method="POST" action="{{ route('form1.process') }}">
                            @csrf

                       

                            <form method="POST" action="{{ route('form1.process') }}">
                                @csrf
                            
                                <!-- Title Input -->
                                <div class="row mb-3">
                                    <label for="proposal_title" class="col-sm-2 col-form-label">Title of Research</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="proposal_title" id="proposal_title" value="{{ old('proposal_title') }}" class="form-control">
                                        @error('proposal_title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <!-- Abstract Textarea -->
                                <div class="row mb-3">
                                    <label for="abstract" class="col-sm-2 col-form-label">Abstract</label>
                                    <div class="col-sm-10">
                                        <textarea name="abstract" id="abstract" rows="5" class="form-control">{{ old('abstract') }}</textarea>
                                        @error('abstract')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Add other form elements below as needed -->
                            
                            
                           
                                    
                             <!-- School -->
                        <div class="row mb-3">
                                <label for="proposal_level_id" class="col-sm-2 col-form-label">Document School</label>
                                <div class="col-sm-10">                                  
                                    
                                    <select name="school_id" class="form-control">
                                        <option value=""> -- Select One --</option>
                                        @foreach ($schools as $school)
                                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('school_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                                                             

                 

                             <!-- Department -->
                             <div class="row mb-3">
                                <label for="proposal_level_id" class="col-sm-2 col-form-label">Document Department</label>
                                <div class="col-sm-10">                                  
                                    
                                    <select id="department_id" class="form-select" name="department_id" aria-label="Select department">
                                        <option value="" disabled selected>-- Select One --</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('department_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror                             

                                </div>
                            



                                  
                            <!-- Proposal Level -->
                            <div class="row mb-3">
                                <label for="proposal_level_id" class="col-sm-2 col-form-label">Proposal Level</label>
                                <div class="col-sm-10">
                                    <select name="proposal_level_id" id="proposal_level_id" class="form-select">
                                        <option value="">-- Select Level --</option>
                                        @foreach($proposal_levels as $proposal_level)
                                            <option value="{{ $proposal_level->id }}">{{ $proposal_level->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('proposal_level_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="row mb-3">
                                <label for="research_role_id" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="research_role_id" id="research_role_id" class="form-select">
                                        <option value="">-- Select Role --</option>
                                        @foreach($research_roles as $research_role)
                                            <option value="{{ $research_role->id }}">{{ $research_role->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('research_role_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Next Button -->
                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">
                                        Next <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                        </form><!-- End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
