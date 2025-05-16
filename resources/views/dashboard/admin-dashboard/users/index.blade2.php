@extends("layouts.admin")
@section('content')

<style>

/* Base styling for the user links */
.user-link {
    text-decoration: none;        /* Remove default underline */
    color: #3498db;               /* Link color */
    font-family: 'Arial', sans-serif;
    font-size: 16px;
    transition: all 0.3s ease;    /* Smooth transition on hover */
}

/* Hover state */
.user-link:hover {
    color: #2c3e50;               /* Darker color when hovered */
    text-decoration: underline;   /* Add underline on hover */
}

/* Active state */
.user-link:active {
    color: #1abc9c;               /* A slightly different color for active links */
}

/* Focus state (when the link is focused, e.g., by keyboard navigation) */
.user-link:focus {
    outline: 2px solid #3498db;   /* Add focus outline for accessibility */
}

/* If you want the user links to appear in a list format with some spacing */
.user-links-list {
    list-style-type: none;         /* Remove bullet points */
    padding: 0;
    margin: 0;
}

.user-links-list li {
    margin: 10px 0;                /* Space between links */
}

.user-links-list li a {
    font-weight: bold;             /* Bold text for better visibility */
}

/* Optional: Add some padding and borders for specific types of links (e.g., profile buttons) */
.user-link.profile {
    padding: 8px 15px;             /* Padding for better click area */
    border: 2px solid #3498db;     /* Border around the link */
    border-radius: 5px;            /* Rounded corners */
    background-color: #f4f7fa;     /* Light background */
}

.user-link.profile:hover {
    background-color: #3498db;     /* Darker background on hover */
    color: white;                  /* Change text color to white on hover */
}

.user-link.profile:focus {
    background-color: #2980b9;     /* Different background when focused */
}





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
        <div class="cap">
            <a href="{{ route('create.user') }}">
                <button type="button" class="btn btn-primary">Create a User</button>
            </a>
        </div><br>
    </div><br>

    <div>
        <nav>
            <form method="POST" action="">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control rounded" onfocus="this.value=''" placeholder="Enter Your Search Name Here" aria-label="Search" aria-describedby="search-addon" required />
                    <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>Search</button>
                </div>
            </form>

            <div id="result" class="panel-panel-default" style="display:none">
                <ul class="list-group" id="memList"></ul>
            </div><br>

            <p>@include('includes.flash-message')</p>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Avatar</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Account Status</th>
                            <th>Admin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($users))
                            @foreach($users->where('role_id', '!=', 1) as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @php
                                            $avatar = Auth::user()->avatar ?? 'default.png';
                                        @endphp
                                        <img src="{{ asset('uploads/avatars/' . $avatar) }}" alt="User Avatar" class="rounded-circle" />
                                    </td>
                                    <td>{{ $user->email }}</td>
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
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{ $users->links() }}
</main>

@endsection
