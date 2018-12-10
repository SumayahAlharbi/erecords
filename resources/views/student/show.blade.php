@extends('layouts.template')
@section('content')
<section class="section" style="padding:50px;min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <a href="{{ URL::previous() }}"><i class="fa fa-chevron-left"></i></a>&nbsp;&nbsp;{{$student->FirstName}} {{$student->LastName}}
          </div>

          <div class="card-body">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-personal-tab" data-toggle="tab" href="#nav-personal" role="tab" aria-controls="nav-home" aria-selected="true">
                  <i class="fa fa-user-md" aria-hidden="true"></i> Personal
                </a>
                <a class="nav-item nav-link" id="nav-academic-tab" data-toggle="tab" href="#nav-academic" role="tab" aria-controls="nav-profile" aria-selected="false">
                  <i class="fa fa-university" aria-hidden="true"></i> Academic
                </a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
                  <i class="fa fa-connectdevelop" aria-hidden="true"></i> Contact
                </a>
                <a class="nav-item nav-link" id="nav-attachment-tab" data-toggle="tab" href="#nav-attachment" role="tab" aria-controls="nav-contact" aria-selected="false">
                  <i class="fa fa-paperclip" aria-hidden="true"></i> Attachment
                </a>
                @role('male-manager|female-manager|admin')
                <a class="nav-item nav-link" id="nav-report-tab" href="{{ URL::to('studentReport/pdf',$student->id) }}" role="tab" aria-controls="nav-contact" aria-selected="false">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</a>
                </a>
                @endrole
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">

              <div class="tab-pane fade show active" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">
                @role('male-manager|female-manager')

                <div class="card-body" style="margin-top:10px;">
                  @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                  </div>
                  @endif
                  <form method="POST" action="{{ route('student.update_personal') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$student->id}}">

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Arabic First Name</label>
                      <div class="col-md-6">
                        <input type="text" name="ArabicFirstName" id="ArabicFirstName" class="form-control{{ $errors->has('ArabicFirstName') ? ' is-invalid' : '' }}" value="{{$student->ArabicFirstName}}" required autofocus>

                        @if ($errors->has('ArabicFirstName'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('ArabicFirstName') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Arabic Middle Name</label>
                      <div class="col-md-6">
                        <input type="text" name="ArabicMiddleName" id="ArabicMiddleName" class="form-control{{ $errors->has('ArabicMiddleName') ? ' is-invalid' : '' }}" value="{{$student->ArabicMiddleName}}" required autofocus>

                        @if ($errors->has('ArabicMiddleName'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('ArabicMiddleName') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Arabic Last Name</label>
                      <div class="col-md-6">
                        <input type="text" name="ArabicLastName" id="ArabicLastName" class="form-control{{ $errors->has('ArabicLastName') ? ' is-invalid' : '' }}" value="{{$student->ArabicLastName}}" required autofocus>

                        @if ($errors->has('ArabicLastName'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('ArabicLastName') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">English First Name</label>
                      <div class="col-md-6">
                        {{$student->FirstName}}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">English Middle Name</label>
                      <div class="col-md-6">
                        {{$student->MiddleName}}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">English Last Name</label>
                      <div class="col-md-6">
                        {{$student->LastName}}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">National ID</label>
                      <div class="col-md-6">
                        {{$student->NationalID}}
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                        <button type="submit" name="update_personal" class="btn btn-primary">Save</button>
                      </div>
                    </div>

                  </form>
                </div>
                @else
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Arabic First Name</label>
                    <div class="col-md-6">
                      {{$student->ArabicFirstName}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Arabic Middle Name</label>
                    <div class="col-md-6">
                      {{$student->ArabicMiddleName}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Arabic Last Name</label>
                    <div class="col-md-6">
                      {{$student->ArabicLastName}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">English First Name</label>
                    <div class="col-md-6">
                      {{$student->FirstName}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">English Middle Name</label>
                    <div class="col-md-6">
                      {{$student->MiddleName}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">English Last Name</label>
                    <div class="col-md-6">
                      {{$student->LastName}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">National ID</label>
                    <div class="col-md-6">
                      {{$student->NationalID}}
                    </div>
                  </div>

                </div>
                @endrole

              </div>
              <div class="tab-pane fade" id="nav-academic" role="tabpanel" aria-labelledby="nav-academic-tab">

                @role('male-manager|female-manager')

                <div class="card-body" style="margin-top:10px;">
                  <form method="POST" action="{{ route('student.update_academic') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$student->id}}">

                    <div class="form-row">
                      <div class="col">
                        <label for="Badge">Badge:</label>
                        {{$student->Badge}}
                      </div>

                      <div class="col">
                        <label for="Status">Status:</label>
                        {{$student->Status}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="AdmissionBatch">Admission Batch:</label>
                        {{$student->Batch}}
                      </div>

                      <div class="col">
                        <label for="StudentNo">Student No:</label>
                        {{$student->StudentNo}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="GraduationBatch">Graduation Batch:</label>
                        <input type="text" name="GraduationBatch" value="{{$student->GraduationBatch}}" id="GraduationBatch" class="form-control{{ $errors->has('GraduationBatch') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
                        @if ($errors->has('GraduationBatch'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('GraduationBatch') }}</strong>
                        </span>
                        @endif
                      </div>

                      <div class="col">
                        <label for="Stream">Stream:</label>
                        <input type="text" name="Stream" value="{{$student->Stream}}" id="Stream" class="form-control{{ $errors->has('Stream') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
                        @if ($errors->has('Stream'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('Stream') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="GraduateExpectationsYear">Graduate Expectations Year:</label>
                        {{$student->GraduateExpectationsYear}}
                      </div>


                      <div class="col">
                        <label for="LastActivationDate">Last Activation Date:</label>
                        {{$student->LastActivationDate}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="1stPostpone">1st Postpone:</label>
                        {{$student->FirstPostpone}}
                      </div>

                      <div class="col">
                        <label for="1stBlockDrop">1st Block Drop:</label>
                        {{$student->	FirstBlockDrop}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="2ndPostpone">2nd Postpone:</label>
                        {{$student->SecondPostpone}}
                      </div>

                      <div class="col">
                        <label for="2ndBlockDrop">2nd Block Drop:</label>
                        {{$student->	SecondBlockDrop}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="3rdPostpone">3rd Postpone:</label>
                        {{$student->ThirdPostpone}}
                      </div>

                      <div class="col">
                        <label for="3rdBlockDrop">3rd Block Drop:</label>
                        {{$student->	ThirdBlockDrop}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="1stAcademicViolation">1st Academic Violation:</label>
                        <input type="text" name="FirstAcademicViolation" class="form-control" value="{{$student->FirstAcademicViolation}}" id="FirstAcademicViolation">
                      </div>

                      <div class="col">
                        <label for="1stAttemptAttendanceViolation">1st Attempt Attendance Violation:</label>
                        <input type="text" name="FirstAttemptAttendanceViolation" class="form-control" value="{{$student->FirstAttemptAttendanceViolation}}" id="FirstAttemptAttendanceViolation">
                      </div>
                    </div>


                    <div class="form-row">
                      <div class="col">
                        <label for="2ndAcademicViolation">2nd Academic Violation:</label>
                        <input type="text" name="SecondAcademicViolation" class="form-control" value="{{$student->SecondAcademicViolation}}" id="SecondAcademicViolation">
                      </div>

                      <div class="col">
                        <label for="2ndAttemptAttendanceViolation">2nd Attempt Attendance Violation:</label>
                        <input type="text" name="SecondAttemptAttendanceViolation" class="form-control" value="{{$student->SecondAttemptAttendanceViolation}}" id="SecondAttemptAttendanceViolation">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="3rdAcademicViolation">3rd Academic Violation:</label>
                        <input type="text" name="ThirdAcademicViolation" class="form-control" value="{{$student->ThirdAcademicViolation}}" id="ThirdAcademicViolation">
                      </div>

                      <div class="col">
                        <label for="3rdAttemptAttendanceViolation">3rd Attempt Attendance Violation:</label>
                        <input type="text" name="ThirdAttemptAttendanceViolation" class="form-control" value="{{$student->ThirdAttemptAttendanceViolation}}" id="ThirdAttemptAttendanceViolation">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="Dismissed">Dismissed (Date):</label>
                        {{$student->Dismissed}}
                      </div>

                      <div class="col">
                        <label for="Withdrawal">Withdrawal:</label>
                        {{$student->Withdrawal}}
                      </div>
                    </div>
                    <div class="text-right">
                    <button type="submit" name="update_academic" class="btn btn-primary">Save</button>
                  </div>
                  </form>
                </div>
                @else
                <div class="card-body">
                  <div class="form-row">
                    <div class="col">
                      <label for="Badge">Badge:</label>
                      {{$student->Badge}}
                    </div>

                    <div class="col">
                      <label for="Status">Status:</label>
                      {{$student->Status}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="AdmissionBatch">Admission Batch:</label>
                      {{$student->Batch}}
                    </div>

                    <div class="col">
                      <label for="StudentNo">Student No:</label>
                      {{$student->StudentNo}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="GraduationBatch">Graduation Batch:</label>
                      {{$student->GraduationBatch}}
                    </div>

                    <div class="col">
                      <label for="Stream">Stream:</label>
                      {{$student->Stream}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="GraduateExpectationsYear">Graduate Expectations Year:</label>
                      {{$student->GraduateExpectationsYear}}
                    </div>


                    <div class="col">
                      <label for="LastActivationDate">Last Activation Date:</label>
                      {{$student->LastActivationDate}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="1stPostpone">1st Postpone:</label>
                      {{$student->FirstPostpone}}
                    </div>

                    <div class="col">
                      <label for="1stBlockDrop">1st Block Drop:</label>
                      {{$student->	FirstBlockDrop}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="2ndPostpone">2nd Postpone:</label>
                      {{$student->SecondPostpone}}
                    </div>

                    <div class="col">
                      <label for="2ndBlockDrop">2nd Block Drop:</label>
                      {{$student->	SecondBlockDrop}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="3rdPostpone">3rd Postpone:</label>
                      {{$student->ThirdPostpone}}
                    </div>

                    <div class="col">
                      <label for="3rdBlockDrop">3rd Block Drop:</label>
                      {{$student->	ThirdBlockDrop}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="1stAcademicViolation">1st Academic Violation:</label>
                      {{$student->FirstAcademicViolation}}
                    </div>

                    <div class="col">
                      <label for="1stAttemptAttendanceViolation">1st Attempt Attendance Violation:</label>
                      {{$student->FirstAttemptAttendanceViolation}}
                    </div>
                  </div>


                  <div class="form-row">
                    <div class="col">
                      <label for="2ndAcademicViolation">2nd Academic Violation:</label>
                      {{$student->SecondAcademicViolation}}
                    </div>

                    <div class="col">
                      <label for="2ndAttemptAttendanceViolation">2nd Attempt Attendance Violation:</label>
                      {{$student->SecondAttemptAttendanceViolation}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="3rdAcademicViolation">3rd Academic Violation:</label>
                      {{$student->ThirdAcademicViolation}}
                    </div>

                    <div class="col">
                      <label for="3rdAttemptAttendanceViolation">3rd Attempt Attendance Violation:</label>
                      {{$student->ThirdAttemptAttendanceViolation}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="Dismissed">Dismissed (Date):</label>
                      {{$student->Dismissed}}
                    </div>

                    <div class="col">
                      <label for="Withdrawal">Withdrawal:</label>
                      {{$student->Withdrawal}}
                    </div>
                  </div>
                </div>
                @endrole
              </div>
              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                @role('male-manager|female-manager')
                <div class="card-body" style="margin-top:10px;">
                  <form method="POST" action="{{ route('student.update_contact') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$student->id}}">

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Mobile</label>
                      <div class="col-md-6">
                        <input type="number" name="Mobile" value="0{{$student->Mobile}}" id="Mobile" class="form-control{{ $errors->has('Mobile') ? ' is-invalid' : '' }}" required autofocus min="0" oninput="validity.valid||(value='');">
                        @if ($errors->has('Mobile'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('Mobile') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">KSAU-HS Email</label>
                      <div class="col-md-6">
                        {{$student->KSAUHSEmail}}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">NGHA Email</label>
                      <div class="col-md-6">
                        {{$student->	NGHAEmail}}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Personal Email</label>
                      <div class="col-md-6">
                        {{$student->PersonalEmail}}
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                        <button type="submit" name="update_academic" class="btn btn-primary">Save</button>
                      </div>
                    </div>

                  </form>
                </div>
                @else
                <div class="card-body" style="margin-top:10px;">

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Mobile</label>
                    <div class="col-md-6">
                      0{{$student->Mobile}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">KSAU-HS Email</label>
                    <div class="col-md-6">
                      {{$student->KSAUHSEmail}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">NGHA Email</label>
                    <div class="col-md-6">
                      {{$student->	NGHAEmail}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Personal Email</label>
                    <div class="col-md-6">
                      {{$student->PersonalEmail}}
                    </div>
                  </div>

                  <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                      <button type="submit" name="update_contact" class="btn btn-primary">Save</button>
                    </div>
                  </div>

                </div>
                @endrole
              </div>
              <div class="tab-pane fade" id="nav-attachment" role="tabpanel" aria-labelledby="nav-attachment-tab">

                <div class="card-body" style="margin-top:10px;">

                  @role('male-manager|female-manager|female-officer|male-officer')

                  @if (count($attachments) > 0)
                  <h5>Attachment List</h5>
                  <ul>
                    @foreach ($attachments as $attachment)
                    <li>
                      <a href="{{ url('/attachments/' . $attachment->file) }}" target="_blank">{{$attachment->title}}</a>
                    </li>
                    @endforeach
                  </ul>
                  @endif
                  @endrole

                  @role('male-manager|female-manager')
                  <h5>Upload New Attachment</h5>
                  <form method="POST" action="{{ route('student.upload_attachment') }}" enctype="multipart/form-data" class="form-horizontal">
                    @csrf

                    <input type="hidden" name="id" value="{{$student->id}}">

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Attachment Title</label>
                      <div class="col-md-6">
                        <input type="text" name="attch_title" id="attch_title" class="form-control{{ $errors->has('attch_title') ? ' is-invalid' : '' }}" required autofocus>
                        @if ($errors->has('attch_title'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('attch_title') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Attachment File</label>
                      <div class="col-md-6">
                        <input type="file" name="attachment" id="attachment" class="form-control{{ $errors->has('attachment') ? ' is-invalid' : '' }}" required autofocus>
                        <span>image, pdf and word document</span>
                        @if ($errors->has('attachment'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('attachment') }}</strong>
                        </span>
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
                @endrole

              </div>
              <div class="tab-pane fade" id="nav-report" role="tabpanel" aria-labelledby="nav-report-tab">
                ...
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
