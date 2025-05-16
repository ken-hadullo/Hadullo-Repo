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

       
      </nav>
    </div><!-- End Page Title -->




    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">



            <table>
                <tr>
				<th>SN</th>
                  <th>Name</th>
                 <th>Email</th>

                  

                </tr>
                
                </tr>
                

              </table>



          </div>
        </div><!-- End Left side columns -->





      </div>
    </section>

  </main><!-- End #main -->

@endsection
