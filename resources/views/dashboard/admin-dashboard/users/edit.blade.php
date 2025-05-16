@extends("layouts.admin")
@section('content')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

<style>
  * {
    box-sizing: border-box;
  }

  /* Create two equal columns that floats next to each other */
  .column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 50px; /* Should be removed. Only for demonstration */
  }

  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
  </style>

<style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
    </style>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><b>Admin Dashboard</b></h1><div class = "back_button"><button type="button" class="btn btn-primary btn" onclick="history.back()">Back</button></div>
      <nav>
       <center><h4><b>Edit a User</b></h4></center>

      </nav>
      @include('includes.flash-message')



    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">



            <!-- PHD  Card -->
            <div class="col-xxl-4 col-md-12">
              <div class="card info-card sales-card">

                <div class="card-body">



                    <hr>

                    <section class="section">
                        <div class="row">



                          <div class="col-lg-8 mx-auto">

                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Edit User Form</h5>

                                <!-- Horizontal Form -->
                                <form  method = "POST" action = "{{route('update.user', $user)}}" >
                                    @method('put')
                                    @csrf

                                  <div class="row mb-3">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                      <input id="name" name = "name" type="text" class="form-control"  value= "{{$user->name }}">
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                      <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror"  name="email" value= "{{$user->email}}">
                                    </div>
                                  </div>


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Edit Role</label>
                    <div class="col-sm-10">
                        <select class="form-select" name = "roles_id" aria-label="Default select example">
                        <option selected>--Select One--</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{$role->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>


                                  <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                  </div>
                                </form><!-- End Horizontal Form -->

                              </div>
                            </div>



                          </div>


                        </div>
                      </section>





                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End of PHD Card -->

          </div>
        </div><!-- End Left side columns -->





      </div>
    </section>

  </main><!-- End #main -->

@endsection

