@extends("layouts.admin")
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>Super Admin Dashboard</h1><br>
      <div class = "user-pg">
        <div style="width: 90%; float:left">
           Create Users page
         </div>

         <div style="width: 10%; float:right">
           Back
         </div>
      </div>
      <br>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">General Form Elements</h5>

              <!-- General Form Elements -->

           <form  method = "POST" action = "{{ route('admin.store') }}"   enctype="multipart/form-data" >
                @csrf
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text"  name = "name" id = "name"  placeholder="User Name" value = "{{ old('name') }}"class="form-control">
                  </div>
                  @error('name')
                  <div class = alert-danger>{{ $message }}</div>
                  @enderror
                </div>


                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name = "email" id = "email" class="form-control" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your Email">
                  </div>
                  @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Assign Role</label>
                    <div class="col-sm-10">
                        <select class="form-select" name = "role_id" aria-label="Default select example">
                        <option selected>--Select One--</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{$role->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>


                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Submit Button</label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Submit Form</button>
                    </div>
                  </div>


                </div>  </div>








              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>







      </div>
    </section>

  </main><!-- End #main -->

@endsection
