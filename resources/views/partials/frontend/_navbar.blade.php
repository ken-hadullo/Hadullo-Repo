<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <class="m-0 text-primary"><img class="img-fluid" src="assets/front/img/tum-logo.jpg" alt="" class = "logo-login" width="95" height="95">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('home.index') }}" class="nav-item nav-link active">Home</a>
                <a href="{{route('about')}}" class="nav-item nav-link">About</a>
                <a href="courses.html" class="nav-item nav-link">The Committee</a>
                <a href="courses.html" class="nav-item nav-link">Reviewers</a>
                <a href="courses.html" class="nav-item nav-link">Applications</a>                
                <a href="contact.html" class="nav-item nav-link">Contact</a>
				<a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
				<a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
            </div>
           
        </div>
    </nav>
    <!-- Navbar End -->