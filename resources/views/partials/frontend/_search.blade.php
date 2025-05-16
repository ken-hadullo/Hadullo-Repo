<div class="row height d-flex justify-content-center align-items-center">
  <div class="col-md-10">
    <form method="GET" action="{{ route('frontsearch.index') }}" enctype="multipart/form-data">
      <div class="search d-flex align-items-center">
        <i class="fa fa-search me-2"></i>
        <input 
          type="search" 
          name="searchterm" 
          class="form-control flex-grow-1 me-2" 
          value="{{ request('searchterm') }}" 
          placeholder="Search" 
          required
        />
        <button type="submit" class="btn btn-primary">UASU Tum</button>
      </div>
    </form>
  </div>
</div>
