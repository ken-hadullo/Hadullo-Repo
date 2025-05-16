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

    <div class="card-header">
   

                <strong class="card-title user-pg">Users Page</strong>
      <div class = "cap"><a href="{{ route('create.user') }}"><button type="button" class="btn btn-primary btn">Create a User</button></a></div><br>

    </div><br>




    <div class="">
            <nav>
        <form  method = "POST" action ="" >
             @csrf
            <div class="input-group">
                <input type="text"  name = "search" id  = "search" class="form-control rounded" onfocus = "this.value='' " placeholder="Enter Your Search Name Here" aria-label="Search" aria-describedby="search-addon" required/>
                <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>search</button>
            </div>
        </form>

		 <div id = "result" class ="panel-panel-deafult" style = "dispay:none">
            <ul class = "list-group" id = "memList">

            </ul>
            </div><br>




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
				  <th>Role</th>
                  <th>Account Status</th>

                  <th>Admin</th>
                  <th>Action</th>

                </tr>
				
				@if(!empty($users))
@foreach($users->where('role_id', '!=', 1) as $user)
<tr>
    <td>{{ $user->name}}</td>
    <td>
        @if(Auth::check() && !empty(Auth::user()->avatar))
            <img src="{{ asset('uploads/avatars/' . Auth::user()->avatar) }}" alt="User Avatar" class="rounded-circle" />
        @else
            <img src="{{ asset('assets/admin/img/profiles/default.png') }}" alt="Default Avatar" class="rounded-circle" />
        @endif
    </td>
    <td>{{ $user->email}}</td>
    <td>{{ $user->role ? $user->role->name : 'Applicant' }}</td>
    <td>
        @if ($user->verified == 0)
            <span class="pending"><center>Pending</center></span>
        @else
            <span class="approved"><center><strong>Active</strong></center></span>
        @endif
    </td>
    <td><a class="btn btn-primary btn-sm" href="{{ route('edit.user', $user) }}" role="button">Edit</a></td>
    <td>
        <form action="{{ route('user.destroy', $user) }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-sm btn-danger" type="submit" onclick="return ConfirmDelete();">Delete</button>
        </form>
    </td>
</tr>
@endforeach
@endif
               
              </table>

          </div>
        </div><!-- End Left side columns -->

      </div>

    </section>
    {{$users->links()}}
  </main><!-- End #main -->

@endsection
