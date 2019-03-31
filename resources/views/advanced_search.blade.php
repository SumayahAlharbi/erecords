@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Advanced Search</div>

          <div class="card-body">
            <form method="get" action="{{ route('student.advanced_search_result') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label for="FirstName" class="col-sm-4 col-form-label text-md-right">First Name</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="FirstName" name="FirstName">
                </div>
              </div>
              <div class="form-group row">
                <label for="MiddleName" class="col-sm-4 col-form-label text-md-right">Middle Name</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="MiddleName" name="MiddleName">
                </div>
              </div>
              <div class="form-group row">
                <label for="LastName" class="col-sm-4 col-form-label text-md-right">Last Name</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="LastName" name="LastName">
                </div>
              </div>
              <div class="form-group row">
                <label for="NationalID" class="col-sm-4 col-form-label text-md-right">National ID</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="NationalID" name="NationalID">
                </div>
              </div>
              <div class="form-group row">
                <label for="Badge" class="col-sm-4 col-form-label text-md-right">Badge</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="Badge" name="Badge">
                </div>
              </div>

              <!--<div class="form-group row">
                <label for="Batch" class="col-sm-4 col-form-label text-md-right">Batch</label>
                <div class="col-md-6">
                  <select class="form-control selectpicker" id="Batch" name="Batch[]" multiple="multiple">
                    <option value=""></option>
                    @foreach($batches as $batche)
                    <option value="{{$batche->Batch}}">{{$batche->Batch}}</option>
                    @endforeach
                  </select>
                </div>
              </div>-->

              <div class="form-group row">
                <label for="Status" class="col-sm-4 col-form-label text-md-right">Status</label>
                <div class="col-md-6">
                  <select class="form-control selectpicker" id="Status" name="Status[]" multiple="multiple">
                    <option value=""></option>
                    @foreach($status as $value)
                    <option value="{{$value->student_status}}">{{$value->student_status}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <!--<div class="form-group row">
                <label for="Stream" class="col-sm-4 col-form-label text-md-right">Stream</label>
                <div class="col-md-6">
                  <select class="form-control selectpicker" id="Stream" name="Stream[]" multiple="multiple">
                    <option value=""></option>
                    @foreach($streams as $stream)
                    <option value="{{$stream->Stream}}">{{$stream->Stream}}</option>
                    @endforeach
                  </select>
                </div>
              </div>-->

              <div class="form-group row">
                <label for="StudentNo" class="col-sm-4 col-form-label text-md-right">Student No</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="StudentNo" name="StudentNo">
                </div>
              </div>

              <div class="form-group row">
                <label for="Mobile" class="col-sm-4 col-form-label text-md-right">Mobile</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="Mobile" name="Mobile">
                </div>
              </div>

              <div class="form-group row">
                <label for="KSAUHSEmail" class="col-sm-4 col-form-label text-md-right">KSAU-HS Email</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="KSAUHSEmail" name="KSAUHSEmail">
                </div>
              </div>

              <!--<div class="form-group row">
                <label for="NGHAEmail" class="col-sm-4 col-form-label text-md-right">NGHA Email</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="NGHAEmail" name="NGHAEmail">
                </div>
              </div>-->

              <div class="form-group row">
                <label for="PersonalEmail" class="col-sm-4 col-form-label text-md-right">Personal Email</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="PersonalEmail" name="PersonalEmail">
                </div>
              </div>

              <!--<div class="form-group row">
                <label for="LastActivationDate" class="col-sm-4 col-form-label text-md-right">Last Activation Date</label>
                <div class="col-md-6">
                  <input type="date" class="form-control" id="LastActivationDate" name="LastActivationDate">
                </div>
              </div>


              <div class="form-group row">
                <label for="Dismissed" class="col-sm-4 col-form-label text-md-right">Dismissed</label>
                <div class="col-md-6">
                  <input type="date" class="form-control" id="Dismissed" name="Dismissed">
                </div>
              </div>
              <div class="form-group row">
                <label for="FirstBlockDrop" class="col-sm-4 col-form-label text-md-right">First Block Drop</label>
                <div class="col-md-6">
                  <input type="date" class="form-control" id="FirstBlockDrop" name="FirstBlockDrop">
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="FirstPostpone" class="col-sm-4 col-form-label text-md-right">First Postpone</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="FirstPostpone" name="FirstPostpone">
              </div>
            </div>

            <div class="form-group row">
              <label for="FirstAcademicViolation" class="col-sm-4 col-form-label text-md-right">First Academic Violation</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="FirstAcademicViolation" name="FirstAcademicViolation">
              </div>
            </div>

            <div class="form-group row">
              <label for="SecondBlockDrop" class="col-sm-4 col-form-label text-md-right">Second Block Drop</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="SecondBlockDrop" name="SecondBlockDrop">
              </div>
            </div>

            <div class="form-group row">
              <label for="SecondPostpone" class="col-sm-4 col-form-label text-md-right">Second Postpone</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="SecondPostpone" name="SecondPostpone">
              </div>
            </div>

            <div class="form-group row">
              <label for="SecondAcademicViolation" class="col-sm-4 col-form-label text-md-right">Second Academic Violation</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="SecondAcademicViolation" name="SecondAcademicViolation">
              </div>
            </div>

            <div class="form-group row">
              <label for="ThirdBlockDrop" class="col-sm-4 col-form-label text-md-right">Third Block Drop</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="ThirdBlockDrop" name="ThirdBlockDrop">
              </div>
            </div>

            <div class="form-group row">
              <label for="ThirdPostpone" class="col-sm-4 col-form-label text-md-right">Third Postpone</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="ThirdPostpone" name="ThirdPostpone">
              </div>
            </div>

            <div class="form-group row">
              <label for="ThirdAcademicViolation" class="col-sm-4 col-form-label text-md-right">Third Academic Violation</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="ThirdAcademicViolation" name="ThirdAcademicViolation">
              </div>
            </div>

            <div class="form-group row">
              <label for="FirstAttemptAttendanceViolation" class="col-sm-4 col-form-label text-md-right">First Attempt Attendance Violation</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="FirstAttemptAttendanceViolation" name="FirstAttemptAttendanceViolation">
              </div>
            </div>

            <div class="form-group row">
              <label for="SecondAttemptAttendanceViolation" class="col-sm-4 col-form-label text-md-right">Second Attempt Attendance Violation</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="SecondAttemptAttendanceViolation" name="SecondAttemptAttendanceViolation">
              </div>
            </div>

            <div class="form-group row">
              <label for="ThirdAttemptAttendanceViolation" class="col-sm-4 col-form-label text-md-right">Third Attempt Attendance Violation</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="ThirdAttemptAttendanceViolation" name="ThirdAttemptAttendanceViolation">
              </div>
            </div>

            <div class="form-group row">
              <label for="Withdrawal" class="col-sm-4 col-form-label text-md-right">Withdrawal</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="Withdrawal" name="Withdrawal">
              </div>
            </div>

            <div class="form-group row">
              <label for="GraduateExpectationsYear" class="col-sm-4 col-form-label text-md-right">Graduate Expectations Year</label>
              <div class="col-md-6">
                <select class="form-control selectpicker" id="GraduateExpectationsYear" name="GraduateExpectationsYear[]" multiple="multiple">
                  <option value=""></option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
                  <option value="2029">2029</option>
                  <option value="2030">2030</option>
                </select>
              </div>
            </div>

              <div class="form-group row">
                <div class="col-md-8 offset-md-4">
                      <div class="form-check">
                        <input type="checkbox" name="delayedGraduation">
                        <label class="form-check-label" for="delayedGraduation">
                          Delayed Graduation Student
                        </label>
                    </div>
                </div>
            </div>
          -->

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">Search</button>
                </div>
              </div>
              <br>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
