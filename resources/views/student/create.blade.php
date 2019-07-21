@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Create Student
          </div>

          <div class="card-body">

            <form method="POST" action="{{ route('student.store')}}" enctype="multipart/form-data" class="form-horizontal">
              @csrf

              <input type="hidden" name="stu_sis_id" value="{{$student->emplid}}">

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Arabic First Name</label>
                <div class="col-md-6">
                  <input type="text" name="ArabicFirstName" class="form-control{{ $errors->has('ArabicFirstName') ? ' is-invalid' : '' }}" value="{{$student->first_name}}" required autofocus>
                  @if ($errors->has('ArabicFirstName'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ArabicFirstName') }}</strong>
                  </span>
                  @endif
                </div>
                <span class="required-f">*</span>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Arabic Middle Name</label>
                <div class="col-md-6">
                  <input type="text" name="ArabicMiddleName" class="form-control{{ $errors->has('ArabicMiddleName') ? ' is-invalid' : '' }}" value="{{$student->middle_name_cd}}" required autofocus>
                  @if ($errors->has('ArabicMiddleName'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ArabicMiddleName') }}</strong>
                  </span>
                  @endif
                </div>
                <span class="required-f">*</span>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Arabic Last Name</label>
                <div class="col-md-6">
                  <input type="text" name="ArabicLastName" class="form-control{{ $errors->has('ArabicLastName') ? ' is-invalid' : '' }}" value="{{$student->last_name_cd}}" required autofocus>
                  @if ($errors->has('ArabicLastName'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ArabicLastName') }}</strong>
                  </span>
                  @endif
                </div>
                <span class="required-f">*</span>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">English First Name</label>
                <div class="col-md-6">
                  <input type="text" name="FirstName" class="form-control" value="{{$student->first_name50}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">English Middle Name</label>
                <div class="col-md-6">
                  <input type="text" name="MiddleName" class="form-control" value="{{$student->middle_name}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">English Last Name</label>
                <div class="col-md-6">
                  <input type="text" name="LastName" class="form-control" value="{{$student->last_name}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">National ID</label>
                <div class="col-md-6">
                  <input type="text" name="NationalID" class="form-control" value="{{$student->national_id}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Badge:</label>
                <div class="col-md-6">
                  <input type="text" name="Badge" class="form-control" value="{{$student->external_system_id}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Status:</label>
                <div class="col-md-6">
                  <input type="text" name="Status" class="form-control" value="{{$student->student_status}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Student No:</label>
                <div class="col-md-6">
                  <input type="text" name="StudentNo" class="form-control" value="{{$student->campus_id}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Gender:</label>
                <div class="col-md-6">
                  @if ($student->sex == 'M')
                  <input type="text" name="Gender" class="form-control" value="Male" readonly>
                  @else
                  <input type="text" name="Gender" class="form-control" value="Female" readonly>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Admission Batch:</label>
                <div class="col-md-6">
                  <input type="text" name="AdmissionBatch" id="AdmissionBatch" class="form-control{{ $errors->has('AdmissionBatch') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
                  @if ($errors->has('AdmissionBatch'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('AdmissionBatch') }}</strong>
                  </span>
                  @endif
                </div>
                <span class="required-f">*</span>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Graduation Batch:</label>
                <div class="col-md-6">
                  <input type="text" name="GraduationBatch" id="GraduationBatch" class="form-control{{ $errors->has('GraduationBatch') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
                  @if ($errors->has('GraduationBatch'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('GraduationBatch') }}</strong>
                  </span>
                  @endif
                </div>
                <span class="required-f">*</span>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Stream:</label>
                <div class="col-md-6">
                  <input type="text" name="Stream" id="Stream" class="form-control{{ $errors->has('Stream') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
                  @if ($errors->has('Stream'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('Stream') }}</strong>
                  </span>
                  @endif
                </div>
                <span class="required-f">*</span>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Graduate Expectations Year:</label>
                <div class="col-md-6">
                  <input type="text" name="GraduateExpectationsYear" id="GraduateExpectationsYear" class="form-control{{ $errors->has('GraduateExpectationsYear') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
                  @if ($errors->has('GraduateExpectationsYear'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('GraduateExpectationsYear') }}</strong>
                  </span>
                  @endif
                </div>
                <span class="required-f">*</span>
              </div>

              <!--<div class="form-group row">
                <label class="col-md-4 col-form-label">Last Activation Date:</label>
                <div class="col-md-6">
                  <input type="text" name="LastActivationDate" value="{{$student->STUDENT_STATUS_DT}}" class="form-control">
                </div>
              </div>


              <div class="form-group row">
                <label class="col-md-4 col-form-label">1st Postpone:</label>
                <div class="col-md-6">
                  <input type="text" name="FirstPostpone" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">2nd Postpone:</label>
                <div class="col-md-6">
                  <input type="text" name="SecondPostpone" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">3rd Postpone:</label>
                <div class="col-md-6">
                  <input type="text" name="ThirdPostpone" class="form-control">
                </div>
              </div>



              <div class="form-group row">
                <label class="col-md-4 col-form-label">1st Block Drop:</label>
                <div class="col-md-6">
                  <input type="text" name="FirstBlockDrop" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">2nd Block Drop:</label>
                <div class="col-md-6">
                  <input type="text" name="SecondBlockDrop" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">3rd Block Drop:</label>
                <div class="col-md-6">
                  <input type="text" name="ThirdBlockDrop" class="form-control">
                </div>
              </div>


              <div class="form-group row">
                <label class="col-md-4 col-form-label">1st Academic Violation:</label>
                <div class="col-md-6">
                  <input type="text" name="FirstAcademicViolation" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">2nd Academic Violation:</label>
                <div class="col-md-6">
                  <input type="text" name="SecondAcademicViolation" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">3rd Academic Violation:</label>
                <div class="col-md-6">
                  <input type="text" name="ThirdAcademicViolation" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">1st Attempt Attendance Violation:</label>
                <div class="col-md-6">
                  <input type="text" name="FirstAttemptAttendanceViolation" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">2nd Attempt Attendance Violation:</label>
                <div class="col-md-6">
                  <input type="text" name="SecondAttemptAttendanceViolation" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">3rd Attempt Attendance Violation:</label>
                <div class="col-md-6">
                  <input type="text" name="ThirdAttemptAttendanceViolation" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Dismissed (Date):</label>
                <div class="col-md-6">
                  <input type="text" name="Dismissed" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Withdrawal:</label>
                <div class="col-md-6">
                  <input type="text" name="Withdrawal" class="form-control">
                </div>
              </div>-->

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Mobile</label>
                <div class="col-md-6">
                  <input type="text" name="Mobile" value="0{{$student->phone}}" id="Mobile" class="form-control{{ $errors->has('Mobile') ? ' is-invalid' : '' }}" required autofocus min="0" oninput="validity.valid||(value='');">
                  @if ($errors->has('Mobile'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('Mobile') }}</strong>
                  </span>
                  @endif
                </div>
                <span class="required-f">*</span>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label">KSAU-HS Email</label>
                <div class="col-md-6">
                  @if($ksauhs_email)
                  <input type="text" name="KSAUHSEmail" value="{{$ksauhs_email->email_addr}}" id="KSAUHSEmail" class="form-control{{ $errors->has('KSAUHSEmail') ? ' is-invalid' : '' }}" required autofocus>
                    @else
                    <input type="text" name="KSAUHSEmail" id="KSAUHSEmail" class="form-control{{ $errors->has('KSAUHSEmail') ? ' is-invalid' : '' }}" required autofocus>
                  @endif
                  @if ($errors->has('KSAUHSEmail'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('KSAUHSEmail') }}</strong>
                  </span>
                  @endif
                </div>
                <span class="required-f">*</span>
              </div>

              <!--<div class="form-group row">
                <label class="col-md-4 col-form-label">NGHA Email</label>
                <div class="col-md-6">
                  <input type="text" name="NGHAEmail" class="form-control">
                </div>
              </div>-->

              <div class="form-group row">
                <label class="col-md-4 col-form-label">Personal Email</label>
                <div class="col-md-6">
                  @if($personal_email)
                  <input type="text" name="PersonalEmail" value="{{$personal_email->email_addr}}" class="form-control">
                  @else
                  <input type="text" name="PersonalEmail" class="form-control">
                  @endif
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
