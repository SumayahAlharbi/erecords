@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
        <div class="card">
          <div class="card-header">
            Add New Students
          </div>

          <div class="card-body">

            @if ($message = Session::get('add_new_student'))
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
            </div>
            @endif

            <form method="POST" action="{{ route('student.add')}}" enctype="multipart/form-data" class="form-horizontal" id="addStudent-form">
              @csrf

              <div class="col-md-12 form-group form-inline">
                <label class="col-md-6 col-form-label">Admission Batch:</label>
                  <input type="text" name="AdmissionBatch" id="AdmissionBatch" class="form-control{{ $errors->has('AdmissionBatch') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
                  @if ($errors->has('AdmissionBatch'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('AdmissionBatch') }}</strong>
                  </span>
                  @endif
              </div>

              <div class="col-md-12 form-group form-inline">
                <label class="col-md-6 col-form-label">Graduation Batch:</label>
                  <input type="text" name="GraduationBatch" id="GraduationBatch" class="form-control{{ $errors->has('GraduationBatch') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
                  @if ($errors->has('GraduationBatch'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('GraduationBatch') }}</strong>
                  </span>
                  @endif
              </div>

              <div class="col-md-12 form-group form-inline">
                <label class="col-md-6 col-form-label">Stream:</label>
                  <input type="text" name="Stream" id="Stream" class="form-control{{ $errors->has('Stream') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
                  @if ($errors->has('Stream'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('Stream') }}</strong>
                  </span>
                  @endif
              </div>

            <div class="col-md-12 form-group form-inline">
                <label class="col-md-6 col-form-label">Graduate Expectations Year:</label>
                  <input type="text" name="GraduateExpectationsYear" id="GraduateExpectationsYear" class="form-control{{ $errors->has('GraduateExpectationsYear') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
                  @if ($errors->has('GraduateExpectationsYear'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('GraduateExpectationsYear') }}</strong>
                  </span>
                  @endif
              </div>

              <br>
              <div class="row">
                  <div class="col text-center"><h5>List of New Students</h5>
                  </div>
                </div>

                <br>

                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <td>

                          <label class="container2">
                          <input type="checkbox" id="selectAll">
                          <span class="checkmark"></span>
                          </label>

                        </td>
                        <th class="th-lg">First Name</th>
                        <th class="th-lg">Last Name</th>
                        <th class="th-lg">Badge</th>
                        <th class="th-lg">National ID</th>
                        <th class="th-lg">Status</th>
                        <th class="th-lg">Student No</th>
                      </tr>
                    </thead>

                    <!--<div class="control-group">
<label class="control-label" for="checkboxes">Checkboxes</label>
<div class="controls">-->

                    @foreach($results as $index => $result)
                      <tr>
                      <td>
                        <label class="container2">
                        <input type="checkbox" name="NewStudents[]" value="{{$result[0]->emplid}}" class="new_students_list">
                        <span class="checkmark"></span>
                        </label>
                      </td>
                      <td>{{$result[0]->first_name50}}</td>
                      <td>{{$result[0]->last_name}}</td>
                      <td>{{$result[0]->external_system_id}}</td>
                      <td>{{$result[0]->national_id}}</td>
                      <td>{{$result[0]->student_status}}</td>
                      <td>{{$result[0]->campus_id}}</td>
                    </tr>
                    @endforeach
                  <!-- </div>
                  </div> -->
                  </tbody>
                </table>

              </div>

                <div class="row">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </form>
          </div>
        </div>
    </div>
  </section>
  @endsection
