@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('manager.home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">User Activities</li>
          </ol>

          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Action</th>
                    <th scope="col">Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Value Before</th>
                    <th scope="col">Value After</th>
                    <th scope="col">User</th>
                  </tr>
                </thead>
                @foreach($activities as $activity)
                <tr>
                  <th scope="row">{{$activity->id}}</th>
                  <td>{{$activity->log_name}}</td>
                  <td>{{$activity->created_at->diffForHumans()}}
                    {{$activity->created_at}}</td>
                    <td>{{$activity->description}}</td>

                    @foreach($activity->properties as $index => $result)
                    <td>{{$result}}</td>
                    @endforeach

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
