@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container-fluied">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-body">

          <div class="row mb-2">
            <div class="col">
            <h6>{{count($total)}} Search Results</h6>
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
                  <th class="th-lg">First Name</th>
                  <th class="th-lg">Last Name</th>
                  <th class="th-lg">Badge</th>
                  <th class="th-lg">National ID</th>
                  <th class="th-lg">Status</th>
                  <th class="th-lg">Student No</th>
                  <th class="th-lg">Admission Batch</th>
                  <th class="th-lg">Graduation Batch</th>
                  <th class="th-lg">Stream</th>
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


          <!--
          @role('male-manager|female-manager|admin')
          <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
          <div class="btn-group mr-2" role="group" aria-label="First group">
          <a class="btn btn-danger" href="{{ URL::to('Student/pdf') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a>
        </div>
        <div class="btn-group mr-2" role="group" aria-label="Second group">
        <a class="btn btn-danger" href="{{ URL::to('Student/excel') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to exel</a>
      </div>
    </div>

    <div class="btn-group float-right" role="group">
    <a class="btn btn-danger" href="{{ URL::to('Student/pdf') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a>
    <a class="btn btn-danger" href="{{ URL::to('Student/excel') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to exel</a>
  </div>
  @endrole
-->

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
