@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-body">

          <div class="row mb-2">
            <div class="col">
            <h6>About ({{count($total)}}) Search Results for "{{ str_limit($search, $limit = 30, $end = '...') }}"</h6>
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

          @if (isset($searchResults_SIS))

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
                  <th scope="col">Admission Batch</th>
                  <th scope="col">Graduation Batch</th>
                  <th scope="col">Stream</th>
                </tr>
              </thead>
              @foreach($searchResults_SIS as $result)

                @if ($result->profile == 0)
                <tr>
                <th scope="row"><a href="{{route('student.create',$result->emplid)}}"><i class="fas fa-plus-square"></i></a></th>
                <td>{{$result->first_name50}}</td>
                <td>{{$result->last_name}}</td>
                <td>{{$result->external_system_id}}</td>
                <td>{{$result->national_id}}</td>
                <td>{{$result->student_status}}</td>
                <td>{{$result->campus_id}}</td>
                <td>{{$result->batch}}</td>
                <td>{{$result->graduationBatch}}</td>
                <td>{{$result->stream}}</td>
              </tr>
                @endif
                @if ($result->profile == 1)
                <tr class="colorful">
                <th scope="row"><a href="{{route('student.show',$result->emplid)}}"><i class="fa fa-chevron-circle-right"></i></a></th>
                <td>{{$result->first_name50}}</td>
                <td>{{$result->last_name}}</td>
                <td>{{$result->external_system_id}}</td>
                <td>{{$result->national_id}}</td>
                <td>{{$result->student_status}}</td>
                <td>{{$result->campus_id}}</td>
                <td>{{$result->batch}}</td>
                <td>{{$result->graduationBatch}}</td>
                <td>{{$result->stream}}</td>
              </tr>
                @endif


              @endforeach

            </tbody>
          </table>

          <div class="pagination justify-content-center">
            {!! $searchResults_SIS->appends(request()->input())->links(); !!}
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
</section>
@endsection
