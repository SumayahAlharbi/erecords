@extends('layouts.template')
@section('content')
<section class="section" style="padding:50px;min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-body">

          <div style="text-align:right;display:block;">
            <div class="btn-group flex-wrap" role="group" style="margin-bottom: 20px;">
              <a class="btn btn-primary btn-md" href="{{ route('advanced_search') }}"><i class="fa fa-search-plus" aria-hidden="true"></i> Advanced Search</a>
              @role('male-manager|female-manager|admin')
              <a class="btn btn-success btn-md" href="{{ URL::to('summeryReport/pdf') }}"><i class="fa fa-file-alt" aria-hidden="true"></i> Summary Report</a>
              <a class="btn btn-warning btn-md" href="{{ URL::to('Student/pdf') }}"><i class="far fa-file-pdf" aria-hidden="true"></i> Export to PDF</a>
              <a class="btn btn-danger btn-md" href="{{ URL::to('Student/excel') }}"><i class="far fa-file-excel" aria-hidden="true"></i> Export to exel</a>
              @endrole
            </div>
          </div>


          <h6>Search Result for <span style='letter-spacing:normal;'>"{{$search}}"</span>..</h6>

          @if (isset($searchResults))

          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Badge</th>
                  <th scope="col">National ID</th>
                  <th scope="col">Status</th>
                  <th scope="col">Student No</th>
                  <th scope="col">Batch</th>
                  <th scope="col">Stream</th>
                </tr>
              </thead>
              @foreach($searchResults as $result)
              <tr>
                <th scope="row"><a href="{{route('student.show',$result->id)}}"><i class="fa fa-chevron-circle-right"></i></a></th>
                <td>{{$result->FirstName}}</td>
                <td>{{$result->LastName}}</td>
                <td>{{$result->Badge}}</td>
                <td>{{$result->NationalID}}</td>
                <td>{{$result->Status}}</td>
                <td>{{$result->StudentNo}}</td>
                <td>{{$result->Batch}}</td>
                <td>{{$result->Stream}}</td>
              </tr>

              @endforeach

            </tbody>
          </table>

          <div class="pagination justify-content-center">
            {!! $searchResults->appends(request()->input())->links(); !!}
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
</section>
@endsection
