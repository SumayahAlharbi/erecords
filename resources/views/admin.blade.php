@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Admin Dashboard</div>

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
                    <th scope="row">{{$user->id}}</th>
                    <td>{{ucwords($user->name)}}</td>
                    <td>{{ucwords($user->email)}}</td>
                    <td>
                      <ol>
                      @foreach($user->roles as $role)
                      <li>{{ ucwords($role->name)}}</li>
                      @endforeach
                    </ol>
                  </td>
                    <td>
                      <a href="{{ URL::to('admin/userRoles', $user->id)}}" class="btn btn-info">Edit</a>
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
