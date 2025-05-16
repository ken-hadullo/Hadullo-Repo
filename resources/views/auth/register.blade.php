@extends("layouts.frontend")

@section('head')
<link href="{{ asset('assets/front/css/loginreg.css') }}" rel="stylesheet">

@endsection
@section('content')






        <!-- Category Start -->
        <div class="container-xxl py-5">
            <div class="container">              
                <div class="row g-4">




                    <h1 class="text-center fw-bold" style="font-size: 2.2rem;">User Registration</h1>
                    <div class="card shadow-lg p-4 mx-auto" style="max-width: 800px;">
                        
                        @include('includes.flash-message')
                        <form method="POST" action="{{ route('create.store') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label"><i class="fas fa-user"></i> Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" 
               placeholder="Enter Name" required autofocus autocomplete="name" 
               class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" 
               placeholder="Enter Email" required autocomplete="username" 
               class="form-control @error('email') is-invalid @enderror">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="staff_std_id" class="form-label"><i class="fas fa-id-badge"></i> User ID <small class="text-muted">(Enter Staff No or Student No)</small></label>
        <input type="text" name="staff_std_id" id="staff_std_id" value="{{ old('staff_std_id') }}" 
               placeholder="Enter User ID(Staff ID or Std ID)" required autocomplete="username" 
               class="form-control @error('staff_std_id') is-invalid @enderror">
        @error('staff_std_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
        <input type="password" id="password" name="password" placeholder="Password" 
               required autocomplete="new-password" class="form-control @error('password') is-invalid @enderror">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i> Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" 
               required autocomplete="new-password" class="form-control @error('password_confirmation') is-invalid @enderror">
        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="role_id" class="form-label"><i class="fas fa-user-tag"></i> Role <small class="text-muted">(Select Applicant or Reviewer)</small></label>
        <select name="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
            <option value="" disabled {{ old('role_id') == null ? 'selected' : '' }}>Select Role</option>
            <option value="2" {{ old('role_id') == "2" ? 'selected' : '' }}>Applicant</option>
            <option value="3" {{ old('role_id') == "3" ? 'selected' : '' }}>Reviewer</option>
			<option value="4" {{ old('role_id') == "4" ? 'selected' : '' }}>Committee</option>
	   </select>
        @error('role_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
	
	<input type="hidden" name="recaptcha_token" id="recaptchaToken">

    <button type="submit" class="btn btn-primary w-100">Register</button>
</form>

                        <div class="text-center mt-3">
                            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                        </div>
                    </div>


               

                </div>
            </div>
        </div>
        <!-- Category End -->
		
		
		<!-- Google reCAPTCHA Script -->
<script src="https://www.google.com/recaptcha/api.js?render='6Ldv5wQrAAAAADUBFD93nbuDIXAePw0EW5IoreZx'"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Ldv5wQrAAAAADUBFD93nbuDIXAePw0EW5IoreZx', {action: 'submit'}).then(function(token) {
            document.getElementById('recaptchaToken').value = token;
        });
    });
</script>


<script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {action: 'submit'}).then(function(token) {
            document.getElementById('recaptchaToken').value = token;
        });
    });
</script>


@endsection
