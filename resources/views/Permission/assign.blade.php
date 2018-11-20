@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<link href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
#loader{
visibility:hidden;
}
/* The container */
.container2 {
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
<script type="text/javascript">
$(document).ready(function() {
  $('.selectpicker').selectpicker(); // not working with ajax

  $('select[name="role_id"]').on('change', function(){
      var roleID = $(this).val();
      if(roleID) {
          $.ajax({
              url: 'dynamic_dependent/ajax/'+roleID,
              type:"GET",
              dataType:"json",
              beforeSend: function(){
                  $('#loader').css("visibility", "visible");
              },

              success:function(data) {

                  //$('select[name="permission_id[]"]').empty();
                  $('#permission_list').empty();

                  $.each(data[0], function(key, value){

                    //$('#permission_ist').append('<li><input type="checkbox" name="permission_id[]" value="'+ key +'" checked><label>'+ value +'</label></li>');

                      $('#permission_list').append('<label class="container2">'+value+'<input type="checkbox" name="permission_id[]" value="'+ key +'" checked><span class="checkmark"></span></label>');

                      //$('select[name="permission_id[]"]').append('<option value="'+ key +'" selected>' + value + '</option>');
                  });

                  $.each(data[1], function(key, value){
                    $('#permission_list').append('<label class="container2">'+ value['name'] +'<input type="checkbox" name="permission_id[]" value="'+ value['id'] +'"><span class="checkmark"></span></label>');
                    //$('#permission_ist').append('<li><input type="checkbox" name="permission_id[]" value="'+ value['id'] +'"><label>'+ value['name'] +'</label></li>');
                    //$('select[name="permission_id[]"]').append('<option value="'+ value['id'] +'">' + value['name'] + '</option>');
                  });

              },
              complete: function(){
                  $('#loader').css("visibility", "hidden");
              }
          });
      } else {
        $('#permission_list').empty();
          //$('select[name="permission_id[]"]').empty();
      }

  });

});
</script>

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
            <li class="nav-item">
              <a class="nav-link" href="{{ route('role.create') }}">Roles</a>
            </li>
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Permissions
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('permission.create') }}">Add Permission</a>
                <a class="dropdown-item" href="#">Assign Permission to Role<span class="sr-only">(current)</span></a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
        <br>
      <div class="card">
        <div class="card-header">Assign Role to Permissions</div>

        <div class="card-body">

          <form method="POST" action="{{ route('permission.update') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
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
@endsection
