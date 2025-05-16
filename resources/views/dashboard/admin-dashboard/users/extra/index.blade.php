@extends("layouts.admin")
@section('content')

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
      <h1>Admin Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>         <li class="breadcrumb-item active">Users </li>
        </ol>



        <form>
             @csrf
            <div class="input-group">
                <input type="text"  name = "search" id  = "search" class="form-control rounded"  placeholder="Enter Your Search Name Here" aria-label="Search" aria-describedby="search-addon" required/>
                <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>search</button>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>

            </tr>
            </thead>
            <tbody>
            </tbody>
            </table>






        <p> @include('includes.flash-message')</p>
      </nav>
    </div><!-- End Page Title -->




    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">



            <table>
                <tr>
                  <th>Name</th>
                  <th>Avatar</th>
                  <th>Email</th>

                  <th>Admin</th>
                  <th>Action</th>

                </tr>
                @if(!empty($users))
                @foreach($users as $user)

                <tr>
                  <td>{{ $user->name}}</td>
                  <td>{{ $user->avatar}}</td>
                  <td>{{ $user->email}}</td>


                  <td><a class="btn btn-primary  btn-sm" href="{{ route('edit.user', $user) }}" role="button">Edit</a></td>


                  <td><form action = "{{ route('user.destroy', $user) }}" method = "post">
                    @csrf
                     @method('delete')

                     <button class="btn btn-sm btn-danger" input type = "submit" value = "delete">Delete</button>
                </form></td>
                </tr>
                @endforeach
                @endif


              </table>



          </div>
        </div><!-- End Left side columns -->





      </div>
    </section>

  </main><!-- End #main -->

@endsection
