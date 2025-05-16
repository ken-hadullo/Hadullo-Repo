@extends("layouts.dashboard")

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1><b>Super Admin Dashboard</b></h1>
        <nav>
            @include('includes.flash-message')
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="column">
            <div class="ken-heading">Document Submission Progress</div>
        </div>
        <div class="column">
            <a href="{{ route('create.documents') }}">
                <button type="button" class="btn btn-primary btn-sm admin-add-button">Add a Document</button>
            </a>
            <a href="">
                <button type="button" class="btn btn-secondary btn-sm admin-add-button">Manage Documents</button>
            </a>
        </div>
    </div>

    <hr><br>

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Research Documents</h5>

    
                        <h1 class="mt-4">Document Progression Bar</h1>

                        @foreach($documents as $document)
                        <div class="card mb-4 p-3">
                            <h5>{{ $document->proposal_title }}</h5>
                            <div class="progress" style="height: 40px; font-size: 18px; font-weight: bold;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated
                                    {{ $document->status == 0 ? 'bg-secondary' : '' }}
                                    {{ $document->status == 1 ? 'bg-warning' : '' }}
                                    {{ $document->status == 2 ? 'bg-info' : '' }}
                                    {{ $document->status == 3 ? 'bg-primary' : '' }}
                                    {{ $document->status == 4 ? 'bg-success' : '' }}"
                                    role="progressbar"
                                    style="width:
                                        {{ $document->status == 0 ? '10%' : '' }}
                                        {{ $document->status == 1 ? '25%' : '' }}
                                        {{ $document->status == 2 ? '50%' : '' }}
                                        {{ $document->status == 3 ? '75%' : '' }}
                                        {{ $document->status == 4 ? '100%' : '' }};">
                                    {{ \App\Models\Document::getStatusLabel($document->status) }}
                                    ({{ $document->status == 0 ? '10%' : '' }}
                                     {{ $document->status == 1 ? '25%' : '' }}
                                     {{ $document->status == 2 ? '50%' : '' }}
                                     {{ $document->status == 3 ? '75%' : '' }}
                                     {{ $document->status == 4 ? '100%' : '' }})
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    
                </div>
            </div>
        </div>        
    </section>

</main><!-- End #main -->
@endsection
