@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-md-8">
        <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('manager.home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Users</li>
          </ol>

        <div class="card">

          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Roles</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <th scope="row">{{$user->user_id}}</th>
                  <td>{{ucwords($user->user_name)}}</td>
                  <td>{{ucwords($user->user_email)}}</td>
                  <td>{{ ucwords($user->role_name)}}</td>
                  <td>
                    <a href="{{ URL::to('/manager/userRoles', $user->user_id)}}" class="btn btn-danger">Edit</a>
                  </td>
                </tr>

                @endforeach
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@endsection
