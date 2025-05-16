@extends("layouts.frontend")

@section('head')
<link href="{{ asset('assets/front/css/loginreg.css') }}" rel="stylesheet">

@endsection
@section('content')






        <!-- Category Start -->
        <div class="container-xxl py-5">
            <div class="container">              
                <div class="row g-4">




                    <h1 class="text-center fw-bold" style="font-size: 2.2rem;">User Login</h1>
                    <div class="card shadow-lg p-4 mx-auto" style="max-width: 800px;">
                        
                        @include('includes.flash-message')
                        <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label"><i class="fas fa-envelope"></i>Email</label>
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
        <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" 
               required autocomplete="new-password" class="form-control @error('password') is-invalid @enderror">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
	<br>
     <div class="pass">Remember Me&nbsp;&nbsp;<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
     <span class="checkmark"></span></div>
	 
	 <div class="pass">
      @if (Route::has('password.request'))
      <a href="{{ route('password.request') }}">Forgot Password?</a>
       @endif
    </div>		


   

    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>

                    <div class="text-center mt-3">
                            <p>Dont have an Account? <a href="{{ route('register') }}">Register Here</a></p>
                        </div>
                    </div>


               

                </div>
            </div>
        </div>
        <!-- Category End -->





@endsection
