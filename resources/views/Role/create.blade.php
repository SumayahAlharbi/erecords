@extends('layouts.template')
@section('content')
<section class="section" style="padding:50px;min-height: 100vh;">
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
        <div class="card-header">Add New Role</div>

        <div class="card-body">

          <form method="post" action="{{ route('role.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">Role Name</label>
            <div class="col-md-6">
              <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" autofocus required>

              @if ($errors->has('name'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif

            </div>
          </div>

          <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@endsection
