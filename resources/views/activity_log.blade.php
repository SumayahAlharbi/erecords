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

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('manager.home') }}">Home</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="#">User Activity Log<span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
          </nav>

          <br>

            <div class="card">

              <table Style="width:100%; border-collapse: collapse; border: 1px solid black;">
                <tr>
                  <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">ID</th>
                  <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Log Name</th>
                  <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Date</th>
                  <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px;">Description</th>
                  <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Before</th>
                  <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">User</th>
                </tr>

                @foreach($activities as $activity)
                <tr>
                  <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">{{$activity->id}}</td>
                  <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">{{$activity->log_name}}</td>
                  <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">{{$activity->created_at->diffForHumans()}}
                    <span style="display:block;">{{$activity->created_at}}</span></td>
                  <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px;">{{$activity->description}}</td>
                  <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">

                    @foreach($activity->properties as $index => $result)
                    <span style="display:block;">{{ $index}}: {{$result}}</span>
                    @endforeach

                  </td>
                  <td Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">{{$activity->causer->name}}</td>
                </tr>
                @endforeach
              </table>

            </div>
        </div>
    </div>
</div>
@endsection
