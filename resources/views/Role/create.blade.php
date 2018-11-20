@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.home') }}">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Roles</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Permissions
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('permission.create') }}">Add Permission</a>
                <a class="dropdown-item" href="{{ route('permission.assign') }}">Assign Permission to Role</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
        <br>
      <div class="card">
        <table Style="width:100%; border-collapse: collapse; border: 1px solid black;">
          <tr>
            <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">ID</th>
            <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Name</th>
          </tr>

          @foreach($roles as $role)
          <tr>
            <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">{{$role->id}}</td>
            <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">{{ucwords($role->name)}}</td>
          </tr>
          @endforeach
        </table>

      </div>
      <br>
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
@endsection
