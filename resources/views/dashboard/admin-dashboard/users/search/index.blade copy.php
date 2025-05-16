@extends("layouts.admin")
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
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
                  <h5 class="card-title">TUM | Digital Repository</h5>

                  @include('includes.flash-message')
                  <table>
							@php($i = 1)

                        @foreach ( $users as $user)

                        <tr>
                        <td>{{$i++}}</td>

                           <td><li class = "list-group-item"> {{ $user->name}}</li></td>
                           <td><li class = "list-group-item">  {{ $user->email}}</li></td>

                        </tr>

                        @endforeach





                  </table>

                </div>
                {{$users->links()}}
              </div>
            </div><!-- End of PHD Card -->






          </div>
        </div><!-- End Left side columns -->





      </div>
    </section>

  </main><!-- End #main -->

@endsection
