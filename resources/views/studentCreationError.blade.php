@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Warning!</div>

          <div class="card-body">
            <p>Student Already Exist.. Profile Link <a href="{{route('student.show',$id)}}"><i class="fa fa-chevron-circle-right"></i></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>
  @endsection
