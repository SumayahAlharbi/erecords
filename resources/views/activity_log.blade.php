@extends('layouts.template')
@section('content')
<section class="section" style="padding:50px;min-height: 100vh;">
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Manager Dashboard</div>

          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Log Name</th>
                  <th scope="col">Date</th>
                  <th scope="col">Description</th>
                  <th scope="col">Value Before</th>
                  <th scope="col">User</th>
                </tr>
              </thead>
              @foreach($activities as $activity)
              <tr>
                <th scope="row">{{$activity->id}}</th>
                <td>{{$activity->log_name}}</td>
                <td>{{$activity->created_at->diffForHumans()}}</td>
                <td>{{$activity->created_at}}</td>
                <td>
                @foreach($activity->properties as $index => $result)
                <span style="display:block;">{{ $index}}: {{$result}}</span>
                @endforeach
              </td>
                <td>
                  {{$activity->causer->name}}
                </td>
              </tr>

              @endforeach

            </tbody>
          </table>
          <div class="pagination justify-content-center">
            {!! $activities->appends(request()->input())->links(); !!}
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>
@endsection
