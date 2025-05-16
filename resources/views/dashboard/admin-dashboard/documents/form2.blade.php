@extends("layouts.dashboard")

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Super Admin Dashboard</h1><br>
        <div class="user-pg">
            
            <nav>@include('includes.success-message')</nav>
        </div>
		<div class="user-pg">
            <div style="width: 90%; float:left">Proposal Document Upload - Step 2</div>
            
        </div>
        <br>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Step 2: Upload Documents</h5>

                        <form method="POST" action="{{ route('store.documents') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- File Upload Fields -->
                            @php
                                $fileFields = [
                                    'proposal_doc' => 'Proposal Document',
                                    'payment_receipt' => 'Payment Receipt',
                                    'applicants_cvs' => 'Applicant CV',
                                    'plagiarism_report' => 'Plagiarism Report',
                                    'ethical_approval' => 'Ethical Approval'
                                ];
                            @endphp

                            @foreach($fileFields as $name => $label)
                            <div class="row mb-3">
                                <label for="{{ $name }}" class="col-sm-2 col-form-label">{{ $label }}</label>
                                <div class="col-sm-10">
                                    <input type="file" name="{{ $name }}" id="{{ $name }}" class="form-control">
                                    @error($name)
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endforeach

                            <!-- Comments -->
                            <div class="row mb-3">
                                <label for="comments" class="col-sm-2 col-form-label">Comments</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="comments" name="comments" rows="3" placeholder="Enter comments">{{ old('comments') }}</textarea>
                                    @error('comments')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-success">Submit Proposal</button>
									<button type="button" class="btn btn-secondary" onclick="history.back()">Back</button>
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
