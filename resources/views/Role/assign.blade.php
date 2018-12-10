@extends('layouts.template')
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
@section('content')
<section class="section" style="padding:50px;min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Assign User to Role</div>
          <div class="card-body">

            <form method="POST" action="{{ route('role.update',$user->first()->user_id) }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input name="_method" type="hidden" value="PUT">
              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">User Name</label>
                <div class="col-md-6">
                  {{ucwords($user->first()->user_name)}}
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">User Email</label>
                <div class="col-md-6">
                  {{ucwords($user->first()->user_email)}}
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Roles List</label>
                <div class="col-md-6">
                  <!-- user cuurent roles -->
                  @foreach($user as $value)
                  <label class="container2">{{ ucwords($value->role_name)}}
                    <input type="checkbox" name="roles[]" value="{{$value->role_id}}" checked="checked">
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
</section>
@endsection
