@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Assign Role to Permissions</div>

          <div class="card-body">

          <form method="POST" action="{{ route('permission.update') }}" enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Role Name</label>
              <div class="col-md-6">
                <select name="role_id" id="role_id" class="form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" required autofocus>
                  <option selected="selected" value="">Choose a Role</option>
                  @foreach ($roles_list as $role)
                  <option value="{{$role->id}}">{{ucwords($role->name)}}</option>
                  @endforeach
                </select>

                @if ($errors->has('role_id'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('role_id') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Permission List</label>
              <div class="col-md-6">
              <span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span>
              <div id="permission_list"></div>
            </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Save</button>
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
