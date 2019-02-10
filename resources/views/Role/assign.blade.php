@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Assign User to Role</div>
          <div class="card-body">

            <form method="POST" action="{{ route('role.update',$user->first()->user_id) }}" enctype="multipart/form-data">
              @csrf
              <input name="_method" type="hidden" value="PUT">
              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">User Name</label>
                <div class="col-md-6 mt-2">
                  {{ucwords($user->first()->user_name)}}
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">User Email</label>
                <div class="col-md-6 mt-2">
                  {{ucwords($user->first()->user_email)}}
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Roles List</label>
                <div class="col-md-6 mt-2">

                  @if ($user->first()->role_name !=null)
                    <!-- user cuurent roles -->
                    @foreach($user as $value)
                    <label class="container2">{{ ucwords($value->role_name)}}
                      <input type="checkbox" name="roles[]" value="{{$value->role_id}}" checked="checked">
                      <span class="checkmark"></span>
                    </label>
                    @endforeach
                  @endif

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
