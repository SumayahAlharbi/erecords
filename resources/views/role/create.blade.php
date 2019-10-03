@extends('layouts.template')
@section('content')
<section class="section">
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
        <div class="card-header">Add New Role</div>

        <div class="card-body">
          @if(session()->get('success'))
   <div class="alert alert-success">
     {{ session()->get('success') }}
   </div>
 @endif

 @if(session()->get('warning'))
<div class="alert alert-warning">
{{ session()->get('warning') }}
</div>
@endif

          <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            @foreach($roles as $role)
            <tr>
              <th scope="row">{{$role->id}}</th>
              <td>{{ucwords($role->name)}}</td>
              <td><a onclick="return confirm('Are you sure?')" href="{{ route('role.delete',$role->id)}}" class="btn btn-danger">-</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>

          <form method="post" action="{{ route('role.store') }}" enctype="multipart/form-data">
            @csrf
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
