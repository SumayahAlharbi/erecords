@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-body">

          <div class="row mb-2">
            <div class="col">
            <h6>Search Result for "{{ str_limit($search, $limit = 30, $end = '...') }}"</h6>
          </div>
          <div class="col">
            <div class="btn-group-justified flex-wrap float-right" role="group">
              <a class="btn btn-primary btn-md" href="{{ route('advanced_search') }}" title="Advanced Search"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
              @role('male-manager|female-manager|admin')
              <a class="btn btn-warning btn-md" href="{{ URL::to('summeryReport/pdf') }}" title="Summary Report"><i class="fa fa-file-alt" aria-hidden="true"></i></a>
              <a class="btn btn-danger btn-md" href="{{ URL::to('Student/pdf') }}" title="Export to PDF"><i class="far fa-file-pdf" aria-hidden="true"></i></a>
              <a class="btn btn-success btn-md" href="{{ URL::to('Student/excel') }}" title="Export to Excel"><i class="far fa-file-excel" aria-hidden="true"></i></a>
              @endrole
            </div>
          </div>
          </div>

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
            <!--{!! $searchResults->links() !!}-->
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
</section>
@endsection
