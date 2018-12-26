@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
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
                <tbody>
                  @foreach($lastLoggedActivity as $index => $result)
                  <tr>
                    <td>{{$result->id}}</th>
                      <td>{{$result->name}}</td>
                      <td>{{\Carbon\Carbon::parse($result->created_date)->diffForHumans(\Carbon\Carbon::now())}}
                        {{$result->created_date}}</td>
                        <td>{{$result->des}}</td>
                        <td>{{json_decode('"'.$before[$index].'"')}}</td>
                        <td>{{json_decode('"'.$after[$index].'"')}}</td>
                        <td>
                          {{$result->user_name}}
                        </td>
                      </tr>

                      @endforeach
                    </tbody>
              </table>
              <div class="pagination justify-content-center">
                {!! $lastLoggedActivity->appends(request()->input())->links(); !!}
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
