@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style type="text/css">
a.button {
  background-color: red;
  color: white;
  width: 60px;
  height: 30px;
  padding: 5px 8px;
  position: relative;
  text-decoration: none;
  text-transform: uppercase;
}

a.button:hover {
  background-color: #ce0606;
  cursor: pointer;
}

a.button:active {
  box-shadow: none;
  top: 5px;
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

              <table Style="width:100%; border-collapse: collapse; border: 1px solid black;">
                <tr>
                  <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">ID</th>
                  <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Name</th>
                  <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Email</th>
                  <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Roles</th>
                  <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Actions</th>
                </tr>

                @foreach($users as $user)
                <tr>
                  <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">{{$user->id}}</td>
                  <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">{{ucwords($user->name)}}</td>
                  <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">{{ucwords($user->email)}}</td>
                  <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">
                    <ol style="text-align:left;padding-top:14px;">
                    @foreach($user->roles as $role)
                    <li>{{ ucwords($role->name)}}</li>
                    @endforeach
                  </ol>
                  </td>
                  <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">
                    <a href="{{ URL::to('/manager/userRoles', $user->id)}}" class="button">Edit</a>
                  </td>
                </tr>

                @endforeach

              </table>

            </div>
        </div>
    </div>
</div>
@endsection
