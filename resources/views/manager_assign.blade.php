@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style type="text/css">
/* The container */
.container2 {
    margin-top: 25px;
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 14px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.container2 input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container2:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container2 input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container2 input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container2 .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Manager Dashboard</a>
      </nav>

        <br>
      <div class="card">
        <div class="card-header">Assign User to Role</div>
        <div class="card-body">

          <form method="GET" action="{{ route('user.update',$user->first()->user_id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">User Name</label>
              <div class="col-md-6">
                <div style="margin-top:7px">{{ucwords($user->first()->user_name)}}</div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">User Email</label>
              <div class="col-md-6">
                <div style="margin-top:7px">{{ucwords($user->first()->user_email)}}</div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Roles List</label>
              <div class="col-md-6">
                  <!-- user cuurent roles -->
                  @foreach($user as $value)
                    <label class="container2">{{ ucwords($value->role_name)}}
                      @if ($value->role_name =='admin')
                      <input type="checkbox" name="roles[]" value="{{$value->role_id}}" checked="checked" disabled>
                      @else
                      <input type="checkbox" name="roles[]" value="{{$value->role_id}}" checked="checked">
                      @endif
                    <span class="checkmark"></span>
                  </label>
                  @endforeach

                  <!-- rest of roles -->
                  @foreach($roles as $role)
                  <label class="container2">{{ ucwords($role->name)}}
                    <input type="checkbox" name="roles[]" value="{{$role->id}}">
                    <span class="checkmark"></span>
                  </label>
                  @endforeach
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
@endsection
