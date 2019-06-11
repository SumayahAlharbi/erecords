@extends('layouts.template')
@section('content')
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <a href="{{ URL::previous() }}"><i class="fa fa-chevron-left"></i></a>&nbsp;&nbsp;{{$student->first_name50}} {{$student->last_name}}
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
                  <i class="fab fa-connectdevelop" aria-hidden="true"></i> Contact
                </a>
                <a class="nav-item nav-link" id="nav-attachment-tab" data-toggle="tab" href="#nav-attachment" role="tab" aria-controls="nav-contact" aria-selected="false">
                  <i class="fa fa-paperclip" aria-hidden="true"></i> Attachment
                </a>
                @role('male-manager|female-manager|admin')
                <a class="nav-item nav-link" id="nav-report-tab" href="{{ URL::to('studentReport/pdf',$student->emplid) }}" role="tab" aria-controls="nav-contact" aria-selected="false">
                  <i class="fa fa-print" aria-hidden="true"></i> Print</a>
                </a>
                @endrole
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">

              <div class="tab-pane fade show active" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">
                @role('male-manager|female-manager')

                <div class="card-body">
                  @if ($message = Session::get('update_personal'))
                  <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                  </div>
                  @endif
                  <form method="POST" action="{{ route('student.update_personal') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$stu->id}}">

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Arabic First Name</label>
                      <div class="col-md-6">
                        @if ($stu !== null)
                        <input type="text" name="ArabicFirstName" id="ArabicFirstName" class="form-control{{ $errors->has('ArabicFirstName') ? ' is-invalid' : '' }}" value="{{$stu->ArabicFirstName}}" required autofocus>
                        @else
                        <input type="text" name="ArabicFirstName" id="ArabicFirstName" class="form-control{{ $errors->has('ArabicFirstName') ? ' is-invalid' : '' }}" value="" required autofocus>
                        @endif

                        @if ($errors->has('ArabicFirstName'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('ArabicFirstName') }}</strong>
                        </span>
                        @endif

                      <small id="emailHelp" class="form-text text-muted">SIS value: {{$student->first_name}}</small>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Arabic Middle Name</label>
                      <div class="col-md-6">
                        @if ($stu !== null)
                        <input type="text" name="ArabicMiddleName" id="ArabicMiddleName" class="form-control{{ $errors->has('ArabicMiddleName') ? ' is-invalid' : '' }}" value="{{$stu->ArabicMiddleName}}" required autofocus>
                        @else
                        <input type="text" name="ArabicMiddleName" id="ArabicMiddleName" class="form-control{{ $errors->has('ArabicMiddleName') ? ' is-invalid' : '' }}" value="" required autofocus>
                        @endif

                        @if ($errors->has('ArabicMiddleName'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('ArabicMiddleName') }}</strong>
                        </span>
                        @endif

                        <small id="emailHelp" class="form-text text-muted">SIS value: {{$student->middle_name_cd}}</small>
                      </div>

                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Arabic Last Name</label>
                      <div class="col-md-6">
                        @if ($stu !== null)
                        <input type="text" name="ArabicLastName" id="ArabicLastName" class="form-control{{ $errors->has('ArabicLastName') ? ' is-invalid' : '' }}" value="{{$stu->ArabicLastName}}" required autofocus>
                        @else
                        <input type="text" name="ArabicLastName" id="ArabicLastName" class="form-control{{ $errors->has('ArabicLastName') ? ' is-invalid' : '' }}" value="" required autofocus>
                        @endif

                        @if ($errors->has('ArabicLastName'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('ArabicLastName') }}</strong>
                        </span>
                        @endif

                        <small id="emailHelp" class="form-text text-muted">SIS value: {{$student->last_name_cd}}</small>
                      </div>

                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">English First Name</label>
                      <div class="col-md-6">
                        {{$student->first_name50}}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">English Middle Name</label>
                      <div class="col-md-6">
                        {{$student->middle_name}}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">English Last Name</label>
                      <div class="col-md-6">
                        {{$student->last_name}}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">National ID</label>
                      <div class="col-md-6">
                        {{$student->national_id}}
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </div>

                  </form>
                </div>
                @else
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Arabic First Name</label>
                    <div class="col-md-6">
                      @if ($stu !== null)
                      {{$stu->ArabicFirstName}}
                      @endif

                      <small id="emailHelp" class="form-text text-muted">SIS value: {{$student->first_name}}</small>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Arabic Middle Name</label>
                    <div class="col-md-6">
                      @if ($stu !== null)
                      {{$stu->ArabicMiddleName}}
                      @endif

                      <small id="emailHelp" class="form-text text-muted">SIS value: {{$student->middle_name_cd}}</small>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Arabic Last Name</label>
                    <div class="col-md-6">
                      @if ($stu !== null)
                      {{$stu->ArabicLastName}}
                      @endif

                      <small id="emailHelp" class="form-text text-muted">SIS value: {{$student->last_name_cd}}</small>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">English First Name</label>
                    <div class="col-md-6">
                      {{$student->first_name50}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">English Middle Name</label>
                    <div class="col-md-6">
                      {{$student->middle_name}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">English Last Name</label>
                    <div class="col-md-6">
                      {{$student->last_name}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">National ID</label>
                    <div class="col-md-6">
                      {{$student->national_id}}
                    </div>
                  </div>

                </div>
                @endrole

              </div>
              <div class="tab-pane fade" id="nav-academic" role="tabpanel" aria-labelledby="nav-academic-tab">

                @role('male-manager|female-manager')

                <div class="card-body">
                  @if ($message = Session::get('update_academic'))
                  <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                  </div>
                  @endif

                  <form method="POST" action="{{ route('student.update_academic') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$stu->id}}">

                    <div class="form-row">
                      <div class="col">
                        <label for="Badge">Badge:</label>
                        {{$student->external_system_id}}
                      </div>

                      <div class="col">
                        <label for="Status">Status:</label>
                        {{$student->student_status}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="AdmissionBatch">Admission Batch:</label>
                        {{$stu->Batch}}
                      </div>

                      <div class="col">
                        <label for="StudentNo">Student No:</label>
                        {{$student->campus_id}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="GraduationBatch">Graduation Batch:</label>
                        <input type="text" name="GraduationBatch" value="{{$stu->GraduationBatch}}" id="GraduationBatch" class="form-control{{ $errors->has('GraduationBatch') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
                        @if ($errors->has('GraduationBatch'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('GraduationBatch') }}</strong>
                        </span>
                        @endif
                      </div>

                      <div class="col">
                        <label for="Stream">Stream:</label>
                        <input type="text" name="Stream" value="{{$stu->Stream}}" id="Stream" class="form-control{{ $errors->has('Stream') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');">
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
                        {{$stu->GraduateExpectationsYear}}
                      </div>


                      <div class="col">
                        <label for="LastActivationDate">Last Activation Date:</label>
                        {{$student->STUDENT_STATUS_DT}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="1stPostpone">1st Postpone:</label>
                        {{$stu->FirstPostpone}}
                      </div>

                      <div class="col">
                        <label for="1stBlockDrop">1st Block Drop:</label>
                        {{$stu->FirstBlockDrop}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="2ndPostpone">2nd Postpone:</label>
                        {{$stu->SecondPostpone}}
                      </div>

                      <div class="col">
                        <label for="2ndBlockDrop">2nd Block Drop:</label>
                        {{$stu->SecondBlockDrop}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="3rdPostpone">3rd Postpone:</label>
                        {{$stu->ThirdPostpone}}
                      </div>

                      <div class="col">
                        <label for="3rdBlockDrop">3rd Block Drop:</label>
                        {{$stu->ThirdBlockDrop}}
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="1stAcademicViolation">1st Academic Violation:</label>
                        <input type="text" name="FirstAcademicViolation" class="form-control" value="{{$stu->FirstAcademicViolation}}" id="FirstAcademicViolation">
                      </div>

                      <div class="col">
                        <label for="1stAttemptAttendanceViolation">1st Attempt Attendance Violation:</label>
                        <input type="text" name="FirstAttemptAttendanceViolation" class="form-control" value="{{$stu->FirstAttemptAttendanceViolation}}" id="FirstAttemptAttendanceViolation">
                      </div>
                    </div>


                    <div class="form-row">
                      <div class="col">
                        <label for="2ndAcademicViolation">2nd Academic Violation:</label>
                        <input type="text" name="SecondAcademicViolation" class="form-control" value="{{$stu->SecondAcademicViolation}}" id="SecondAcademicViolation">
                      </div>

                      <div class="col">
                        <label for="2ndAttemptAttendanceViolation">2nd Attempt Attendance Violation:</label>
                        <input type="text" name="SecondAttemptAttendanceViolation" class="form-control" value="{{$stu->SecondAttemptAttendanceViolation}}" id="SecondAttemptAttendanceViolation">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="3rdAcademicViolation">3rd Academic Violation:</label>
                        <input type="text" name="ThirdAcademicViolation" class="form-control" value="{{$stu->ThirdAcademicViolation}}" id="ThirdAcademicViolation">
                      </div>

                      <div class="col">
                        <label for="3rdAttemptAttendanceViolation">3rd Attempt Attendance Violation:</label>
                        <input type="text" name="ThirdAttemptAttendanceViolation" class="form-control" value="{{$stu->ThirdAttemptAttendanceViolation}}" id="ThirdAttemptAttendanceViolation">
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <label for="Dismissed">Dismissed (Date):</label>
                        {{$stu->Dismissed}}
                      </div>

                      <div class="col">
                        <label for="Withdrawal">Withdrawal:</label>
                        {{$stu->Withdrawal}}
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
                      {{$student->external_system_id}}
                    </div>

                    <div class="col">
                      <label for="Status">Status:</label>
                      {{$student->student_status}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="AdmissionBatch">Admission Batch:</label>
                      {{$stu->Batch}}
                    </div>

                    <div class="col">
                      <label for="StudentNo">Student No:</label>
                      {{$student->campus_id}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="GraduationBatch">Graduation Batch:</label>
                      {{$stu->GraduationBatch}}
                    </div>

                    <div class="col">
                      <label for="Stream">Stream:</label>
                      {{$stu->Stream}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="GraduateExpectationsYear">Graduate Expectations Year:</label>
                      {{$stu->GraduateExpectationsYear}}
                    </div>


                    <div class="col">
                      <label for="LastActivationDate">Last Activation Date:</label>
                      {{$student->STUDENT_STATUS_DT}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="1stPostpone">1st Postpone:</label>
                      {{$stu->FirstPostpone}}
                    </div>

                    <div class="col">
                      <label for="1stBlockDrop">1st Block Drop:</label>
                      {{$stu->FirstBlockDrop}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="2ndPostpone">2nd Postpone:</label>
                      {{$stu->SecondPostpone}}
                    </div>

                    <div class="col">
                      <label for="2ndBlockDrop">2nd Block Drop:</label>
                      {{$stu->SecondBlockDrop}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="3rdPostpone">3rd Postpone:</label>
                      {{$stu->ThirdPostpone}}
                    </div>

                    <div class="col">
                      <label for="3rdBlockDrop">3rd Block Drop:</label>
                      {{$stu->ThirdBlockDrop}}
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="1stAcademicViolation">1st Academic Violation:</label>
                      <div>{{$stu->FirstAcademicViolation}}</div>
                    </div>

                    <div class="col">
                      <label for="1stAttemptAttendanceViolation">1st Attempt Attendance Violation:</label>
                      <div>{{$stu->FirstAttemptAttendanceViolation}}</div>
                    </div>
                  </div>


                  <div class="form-row">
                    <div class="col">
                      <label for="2ndAcademicViolation">2nd Academic Violation:</label>
                      <div>{{$stu->SecondAcademicViolation}}</div>
                    </div>

                    <div class="col">
                      <label for="2ndAttemptAttendanceViolation">2nd Attempt Attendance Violation:</label>
                      <div>{{$stu->SecondAttemptAttendanceViolation}}</div>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="3rdAcademicViolation">3rd Academic Violation:</label>
                      <div>{{$stu->ThirdAcademicViolation}}</div>
                    </div>

                    <div class="col">
                      <label for="3rdAttemptAttendanceViolation">3rd Attempt Attendance Violation:</label>
                      <div>{{$stu->ThirdAttemptAttendanceViolation}}</div>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <label for="Dismissed">Dismissed (Date):</label>
                      {{$stu->Dismissed}}
                    </div>

                    <div class="col">
                      <label for="Withdrawal">Withdrawal:</label>
                      {{$stu->Withdrawal}}
                    </div>
                  </div>
                </div>
                @endrole
              </div>
              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                @role('male-manager|female-manager')
                <div class="card-body">
                  @if ($message = Session::get('update_contact'))
                  <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                  </div>
                  @endif

                  <form method="POST" action="{{ route('student.update_contact') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$stu->id}}">

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
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">KSAU-HS Email</label>
                      <div class="col-md-6">
                        @if($ksauhs_email)
                        {{$ksauhs_email->email_addr}}
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">NGHA Email</label>
                      <div class="col-md-6">
                        <input type="text" name="NGHAEmail" value="{{$stu->NGHAEmail}}" id="NGHAEmail" class="form-control{{ $errors->has('NGHAEmail') ? ' is-invalid' : '' }}">
                        @if ($errors->has('NGHAEmail'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('NGHAEmail') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Personal Email</label>
                      <div class="col-md-6">
                        @if($personal_email)
                        {{$personal_email->email_addr}}
                        @endif
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
                <div class="card-body">

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Mobile</label>
                    <div class="col-md-6">
                      0{{$student->phone}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">KSAU-HS Email</label>
                    <div class="col-md-6">
                      @if($ksauhs_email)
                      {{$ksauhs_email->email_addr}}
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">NGHA Email</label>
                    <div class="col-md-6">
                      {{$stu->NGHAEmail}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Personal Email</label>
                    <div class="col-md-6">
                      @if($personal_email)
                      {{$personal_email->email_addr}}
                      @endif
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

                <div class="card-body">

                  @role('male-manager|female-manager')

                  @if ($message = Session::get('upload_attachment'))
                  <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                  </div>
                  @endif

                  @if ($message = Session::get('update_attachment'))
                  <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                  </div>
                  @endif

                  @if ($message = Session::get('delete_attachment'))
                  <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                  </div>
                  @endif

                  @if (count($attachments) > 0)
                  <h5>Attachment List</h5>
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <td>Browse</td>
                          <td>Edit</td>
                          <td>Delete</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($attachments as $attachment)
                        <tr>
                          <th>
                            <a href="{{route('attachments',$attachment->file)}}" target="_blank" title="Browse">{{$attachment->title}}</a>
                          </th>
                          <th>
                            <a href="{{ route('student.showEditAttForm',['attachment'=>$attachment->id,'student'=>$student->emplid])}}" title="Edit"><i class="far fa-edit"></i></a>
                          </th>
                          <th>
                            <a href="{{route('student.delete_attachment',['attachment'=>$attachment->id,'student'=>$student->emplid])}}" title="Delete"
                              onclick="return confirm('Are you sure you want to delete this file?')"><i class="far fa-trash-alt"></i></a>
                          </th>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  @endrole

                  @role('female-officer|male-officer')
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <td>Browse</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($attachments as $attachment)
                        <tr>
                          <th>
                            <a href="{{route('attachments',$attachment->file)}}" target="_blank" title="Browse">{{$attachment->title}}</a>
                          </th>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  @endrole
                  @endif

                  @role('male-manager|female-manager')
                  <h5>Upload New Attachment</h5>
                  <form method="POST" action="{{ route('student.upload_attachment') }}" enctype="multipart/form-data" class="form-horizontal">
                    @csrf

                    <input type="hidden" name="id" value="{{$stu->id}}">

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
                  @endrole
                </div>
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
