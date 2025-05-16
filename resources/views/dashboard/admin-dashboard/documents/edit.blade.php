@extends("layouts.dashboard")
@section('content')

@section('head')
   <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
@endsection
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Super Admin Dashboard</h1><br>
      <div class = "user-pg">
        <div style="width: 90%; float:left">
           Edit a Document Item
        </div>

         <div style="width: 10%; float:right">
        <a href = "{{ route('newsposts.index') }}"><button type="button" class="btn btn-primary btn-sm admin-add-button">Back</button></a>
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

              <form  method = "POST" action = "{{ route('update.documents', $document) }}"   enctype="multipart/form-data" >
                @method('put')
                @csrf

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text"  name = "title" id = "title"  value = "{{$document->title }}" class="form-control">
                  </div>
                  @error('title')
                  <div class = alert-danger>{{ $message }}</div>
                  @enderror
                </div>


                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Image Upload</label>
                    <div class="col-sm-10">
                      <input type="file"  name = "pfile" id = "pfile"  class="form-control">
                    </div>
                    @if($errors->first('pfile'))
                    <div class = alert-danger>{{ $errors->first('pfile') }}</div>
                    @endif
                </div>


                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Document Content</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="body" name = "body" rows="3">{{ $document->body }}</textarea>
                  </div>
                  @if($errors->first('body'))
                      <div class = alert-danger>{{ $errors->first('body') }}</div>
                      @endif
                </div>



                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Submit Button</label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Submit Form</button>
                      <button type="reset" class="btn btn-primary">Reset</button>
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

@section('scripts')
<script>CKEDITOR.replace( 'body' );</script>
@endsection
