@extends("layouts.dashboard")

@section('head')
<link href="{{ asset('assets/admin/css/documents-documents-page.css') }}" rel="stylesheet">
<!-- Font Awesome CDN -->

<!-- Add this in the <head> section of your HTML -->

@endsection

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Profile</h1>
    </div>
    <nav></nav>
    @include('includes.warning-message')
    <nav>@include('includes.success-message')</nav>
    <section class="section profile-edit">
        <div class="container">
            <div class="card p-4">
                <!-- Title -->
                @if(in_array($user->role_id, [1,3,4]))
                <div class="mb-3">
                    <strong>Title:</strong> {{ $user->title }}
                    <button class="btn btn-sm btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#editTitleModal">Edit</button>
                </div>
                @endif

                <!-- Name -->
                <div class="mb-3">
                    <strong>Name:</strong> {{ $user->name }}
                    <button class="btn btn-sm btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#editNameModal">Edit</button>
                </div>

                <!-- Profile Photo -->
                @if(in_array($user->role_id, [1,3,4 ]))
                <div class="mb-3">
                    <strong>Profile Photo:</strong><br>
                    @if($user->avatar)
                        <img src="{{ asset('uploads/avatars/' . $user->avatar) }}" alt="Profile Photo" width="100" class="img-thumbnail">
                    @else
                        <img src="{{ asset('assets/admin/img/avatars/default.png') }}" alt="Default Profile Photo" width="100" class="img-thumbnail">
                    @endif
                    <br>
                    <button class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#editPhotoModal">Edit</button>
                </div>
                @endif

                <!-- Specialization -->
                @if(in_array($user->role_id, [1,3,4]))
                <div class="mb-3">
                    <strong>Specialization:</strong> {{ $user->specialization }}
                    <button class="btn btn-sm btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#editSpecializationModal">Edit</button>
                </div>
                @endif


            @if(in_array($user->staff_std_id, [1,3,4]))
                <div class="mb-3">
                    <strong>User ID [Staff or Student Number]:</strong> {{ $user->staff_std_id }}
                    <button class="btn btn-sm btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#editStaffStdIDModal">Edit</button>
                </div>
            @endif
            

                <!-- Edit Staff-Std ID -->
                
@if(in_array($user->role_id, [1,3,4]))
    <div class="mb-3">
        <strong>User ID [Staff or Student Number]:</strong> 
        {{ $user->staff_std_id ?? 'Not Available' }}
        <button class="btn btn-sm btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#editStaffStdIDModal">Edit</button>
    </div>
@endif


                    

@if(in_array($user->role_id, [1,3,4]))
<div class="mb-3">
    <strong>Phone:</strong> 
    {{ $user->phone ?? 'Not Available' }}
    <button class="btn btn-sm btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#editPhoneModal">Edit</button>
</div>
@endif
       

                <!-- Edit and Display School -->
                <div class="card-body">
                    <h5 class="card-title"><center>Edit School</center></h5>
                    <hr>
                    <p><strong>My School:</strong> {{ $user['Schoolname']['name'] ?? 'Not Selected' }}</p>
                    <p style="float: right; font-weight: bold; color: #008000;">
                        <a href="#link" data-bs-toggle="modal" data-bs-target="#ssdEditModal">
                            <i class="fa fa-edit" style="font-size:25px;color:green"></i> Edit
                        </a>
                    </p>
                </div>

                <!-- Edit Department -->
                <div class="card-body">
                    <h5 class="card-title"><center>Edit Department</center></h5>
                    <hr>
                    <p><strong>My Department:</strong> {{ $user['departmentName']['name'] ?? 'Not selected' }}</p>
                    <p style="float: right; font-weight: bold; color: #008000;">
                        <a href="#link" data-bs-toggle="modal" data-bs-target="#departmentEditModal">
                            <i class="fa fa-edit" style="font-size:25px;color:green"></i> Edit
                        </a>
                    </p>
                </div>

               
              
              


                <!-- Academic Qualifications -->
                @if(in_array($user->role_id, [1,3,4]))
                <div class="mb-3">
                    <p><strong>Highest Academic Qualification:</strong></p>
                    @if($user->education)
                        <ul>
                            @foreach(explode("\n", $user->education) as $qualification)
                                <li>{{ $qualification }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>Not Filled</p>
                    @endif
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#academicQualificationsModal">Edit Academic Qualifications</button>
                </div>
                @endif

                <!-- Research Interests -->
                @if(in_array($user->role_id, [1,3,4]))
                <div class="mb-3">
                    <p><strong>My Research Interests:</strong></p>
                    <p>{!! $user->research_interests ? nl2br(e($user->research_interests)) : 'Not Filled' !!}</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#researchModal">Edit Research Interests</button>
                </div>
                @endif

              <!-- Confirm Profile Update Form Start -->
<form action="{{ route('confirm.profile.update') }}" method="POST" class="mt-4">
  @csrf

  <!-- Optional: Add hidden inputs if needed -->
  {{-- 
  <input type="hidden" name="department_id" value="{{ $user->department_id }}">
  <input type="hidden" name="research_theme_id" value="{{ $user->research_theme_id }}">
  --}}

 <!-- Submit Button -->
<!-- Submit Button -->
<!-- Submit Button -->
<button type="submit" class="btn btn-success btn-lg w-100">
    <strong> Confirm Profile Update</strong>
  </button>
  
  


</form>
<!-- Confirm Profile Update Form End -->

            </div>

            

        </div>
    </section>
</main>

<!-- ================== Modals for Each Field ================== -->

<!-- Edit Title Modal -->
@if(in_array($user->role_id, [1,3,4]))
<div class="modal fade" id="editTitleModal" tabindex="-1" aria-labelledby="editTitleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('profile.updateField', ['id' => $user->id, 'field' => 'title']) }}" method="POST">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTitleLabel">Edit Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select name="title" class="form-select" required>
                        <option value="">Select Title</option>
                        <option value="Mr." {{ $user->title === 'Mr.' ? 'selected' : '' }}>Mr.</option>
                        <option value="Mrs." {{ $user->title === 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                        <option value="Miss" {{ $user->title === 'Miss' ? 'selected' : '' }}>Miss</option>
                        <option value="Dr." {{ $user->title === 'Dr.' ? 'selected' : '' }}>Dr.</option>
                        <option value="Prof." {{ $user->title === 'Prof.' ? 'selected' : '' }}>Prof.</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif


      

<!-- Edit Name Modal -->
<div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="editNameLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('profile.updateField', ['id' => $user->id, 'field' => 'name']) }}" method="POST">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNameLabel">Edit Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Profile Photo Modal -->
@if(in_array($user->role_id, [1,3,4]))
<div class="modal fade" id="editPhotoModal" tabindex="-1" aria-labelledby="editPhotoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('profile.photo', ['id' => $user->id, 'field' => 'avatar']) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPhotoLabel">Edit Profile Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" name="avatar" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload Photo</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif

<!-- Edit Specialization Modal -->
@if(in_array($user->role_id, [1,3,4]))
<div class="modal fade" id="editSpecializationModal" tabindex="-1" aria-labelledby="editSpecializationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('profile.updateField', ['id' => $user->id, 'field' => 'specialization']) }}" method="POST">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSpecializationLabel">Edit Specialization</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="specialization" class="form-control" value="{{ $user->specialization }}" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif

<!-- Edit Phone Modal -->
@if(in_array($user->role_id, [1,3,4]))
<div class="modal fade" id="editPhoneModal" tabindex="-1" aria-labelledby="editPhoneLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('profile.updateField', ['id' => $user->id, 'field' => 'phone']) }}" method="POST">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPhoneLabel">Edit Phone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif




<!-- Edit Staff-Std ID Modal -->
<div class="modal fade" id="editStaffStdIDModal" tabindex="-1" aria-labelledby="editStaffStdIDLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStaffStdIDLabel">Edit Staff or Student ID</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('update.staff_std_id', ['id' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <label for="staff_std_id" class="form-label">New Staff or Student ID:</label>
                    <input type="text" class="form-control" id="staff_std_id" name="staff_std_id" value="{{ $user->staff_std_id }}" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>



<!-- Edit School Modal -->
<div class="modal fade" id="ssdEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit School</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('update.school') }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="School" class="form-label"></label>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Department Modal -->
<div class="modal fade" id="departmentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('update.department') }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="School" class="form-label"></label>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Academic Qualifications Modal -->
@if(in_array($user->role_id, [1,3,4]))
<div class="modal fade" id="academicQualificationsModal" tabindex="-1" aria-labelledby="academicQualificationsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="academicQualificationsModalLabel">Academic Qualifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('update.education', $user) }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="education" class="form-label fw-bold">Enter Academic Qualifications</label>
                        <p class="form-text">
                            Highest Degree or Cert Attained (e.g., Ph.D., Master’s Degree, KCE, KACE)<br>
                            Field of Study (e.g., Artificial Intelligence, Economics, Physics)<br>
                            Institution Awarding the Degree (e.g., University of Nairobi)<br>
                            Year of Completion (e.g., 2019)
                        </p>
                        <textarea class="form-control" id="education" name="education" rows="4">{{ $user->education }}</textarea>
                        @if($errors->first('education'))
                            <div class="alert alert-danger mt-2">{{ $errors->first('education') }}</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Research Interests Modal -->
@if(in_array($user->role_id, [1,3,4]))
<div class="modal fade" id="researchModal" tabindex="-1" aria-labelledby="researchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.updateResearchInterests') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title" id="researchModalLabel">Edit Research Interests</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="research_interests" class="form-label">Research Interests</label>
                        <textarea class="form-control" id="research_interests" name="research_interests" rows="5">{{ old('research_interests', $user->research_interests) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


@endsection