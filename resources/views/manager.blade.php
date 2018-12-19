@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-users-cog"></i>
                </div>
                <div class="mr-5">Users</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="{{ route('users') }}">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5">Activities!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="{{ route('activity.log') }}">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>



        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Last User Activities</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Action</th>
                      <th>Date</th>
                      <th>Description</th>
                      <th>Value Before</th>
                      <th>Value After</th>
                      <th>User Name</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Action</th>
                      <th>Date</th>
                      <th>Description</th>
                      <th>Value Before</th>
                      <th>Value After</th>
                      <th>User Name</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($lastLoggedActivity as $activity)
                    <tr>
                      <td>{{$activity->id}}</th>
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
                  </div>
                </div>
                <div class="card-footer small text-muted">Updated {{date('l, F d, Y H:i:s A',time())}}</div>
              </div>
            </div>
          </div>
        </section>
        @endsection
