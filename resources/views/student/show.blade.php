<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>COMJ E-RECORDS</title>
  <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <link href="{{ URL::asset('css/navbar.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
  <div class='header'>
    <a href="{{ route('home') }}"><img src={{ asset('logo/comj-logo.png')}} alt='COMJ Logo' height="87" width="385"/></a>
  </div>

  <div class="nav-right">
    <nav class="navbar-logout" role="navigation">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
            <li><a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</div>

<div class='top-right'>
  <form method="get" action="{{ route('student.search_result') }}" enctype="multipart/form-data" class="search">
    <input type="text" placeholder="Search.." name="keyword"/>
    <button type="submit"><i class="fa fa-search"></i></button>
  </form>
</div>

<div class="flex-center position-ref full-height">
  <div class="content">
    <img src={{ asset('logo/comj.jpg')}} alt='KSAU-HS' height="720" width="1280"/>

  </div>

  <div class="search-details">
    <a href="{{ URL::previous() }}"><i class="fa fa-chevron-left"></i></a>
    <h4> {{$student->FirstName}} {{$student->LastName}} </h4>
    <main>

      <input id="tab1" type="radio" name="tabs" checked>
      <label class="tabs" for="tab1">Personal</label>

      <input id="tab2" type="radio" name="tabs">
      <label class="tabs" for="tab2">Academic</label>

      <input id="tab3" type="radio" name="tabs">
      <label class="tabs" for="tab3">Contact</label>

      <input id="tab4" type="radio" name="tabs">
      <label class="tabs" for="tab4">Attachment</label>

      @role('manager')
      <a style="text-decoration: none;" href="{{ URL::to('studentReport/pdf',$student->id) }}"><label class="tabs" for="tab5">Print</label></a>
      @endrole

      <section id="content1">
        @role('manager')
        <form method="POST" action="{{ route('student.update_personal') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{$student->id}}">
          <table>
            <tr>
              <td>Arabic First Name:</td>
              <td>
                <input type="text" name="ArabicFirstName" id="ArabicFirstName" class="form-control{{ $errors->has('ArabicFirstName') ? ' is-invalid' : '' }}" value="{{$student->ArabicFirstName}}" required autofocus>
              </td>
              @if ($errors->has('ArabicFirstName'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ArabicFirstName') }}</strong>
              </span>
              @endif
            </tr>
            <tr><td>Arabic Middle Name:</td>
              <td>
                <input type="text" name="ArabicMiddleName" id="ArabicMiddleName" class="form-control{{ $errors->has('ArabicMiddleName') ? ' is-invalid' : '' }}" value="{{$student->ArabicMiddleName}}" required autofocus>
              </td>
              @if ($errors->has('ArabicMiddleName'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ArabicMiddleName') }}</strong>
              </span>
              @endif
            </tr>
            <tr><td>Arabic Last Name:</td>
              <td>
                <input type="text" name="ArabicLastName" id="ArabicLastName" class="form-control{{ $errors->has('ArabicLastName') ? ' is-invalid' : '' }}" value="{{$student->ArabicLastName}}">
              </td>
              @if ($errors->has('ArabicLastName'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ArabicLastName') }}</strong>
              </span>
              @endif
            </tr>
            <tr><td>English First Name:</td><td> {{$student->FirstName}} </td></tr>
            <tr><td>English Middle Name:</td><td> {{$student->MiddleName}} </td></tr>
            <tr><td>English Last Name:</td><td> {{$student->LastName}} </td></tr>
            <tr><td>National ID:</td><td> {{$student->NationalID}} </td><td><button type="submit" name="update_personal">Save</button></td></tr>
          </table>
        </form>
        @else
        <table>
          <tr><td>Arabic First Name:</td><td>{{$student->ArabicFirstName}}</td></tr>
          <tr><td>Arabic Middle Name:</td><td>{{$student->ArabicMiddleName}}</td></tr>
          <tr><td>Arabic Last Name:</td><td>{{$student->ArabicLastName}}</td></tr>
          <tr><td>English First Name:</td><td> {{$student->FirstName}}</td></tr>
          <tr><td>English Middle Name:</td><td> {{$student->MiddleName}}</td></tr>
          <tr><td>English Last Name:</td><td> {{$student->LastName}}</td></tr>
          <tr><td>National ID:</td><td> {{$student->NationalID}}</td></tr>
        </table>

        @endrole
      </section>

      <section id="content2">
        @role('manager')
        <form method="POST" action="{{ route('student.update_academic') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{$student->id}}">
          <table>
            <tr>
              <td>Badge:</td><td> {{$student->Badge}}</td>
              <td>Status:</td><td> {{$student->Status}}</td>
              <tr>
              <td>Admission Batch:</td><td>{{$student->Batch}}</td>
                <td>Graduation Batch:</td>
                <td><input type="text" name="GraduationBatch" value="{{$student->GraduationBatch}}" id="GraduationBatch" class="form-control{{ $errors->has('GraduationBatch') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');"></td>
              @if ($errors->has('GraduationBatch'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('GraduationBatch') }}</strong>
              </span>
              @endif
            </tr>
            <tr>
              <td>Student No:</td><td> {{$student->StudentNo}}</td>

              <td>Stream: </td><td><input type="text" name="Stream" value="{{$student->Stream}}" id="Stream"class="form-control{{ $errors->has('Stream') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');"></td>
              @if ($errors->has('Stream'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('Stream') }}</strong>
              </span>
              @endif
              </tr>
              <tr>
                <td>Graduate Expectations Year:</td><td> {{$student->GraduateExpectationsYear}}</td>
                <td>Last Activation Date:</td><td> {{$student->LastActivationDate}}</td>
            </tr>
            <tr>
              <td>1st Postpone:</td><td> {{$student->FirstPostpone}}</td>
              <td>1st Block Drop:</td><td> {{$student->	FirstBlockDrop}}</td>
            </tr>
            <tr>
              <td>2nd Postpone: </td><td>{{$student->SecondPostpone}}</td>
              <td>2nd Block Drop:</td><td> {{$student->	SecondBlockDrop}}</td>
            </tr>
            <tr>
              <td>3rd Postpone: </td><td>{{$student->ThirdPostpone}}</td>
              <td>3rd Block Drop: </td><td>{{$student->	ThirdBlockDrop}}</td>
            </tr>
            <tr>
              <td>1st Academic Violation:</td><td><input type="date" name="FirstAcademicViolation" value="{{$student->FirstAcademicViolation}}" id="FirstAcademicViolation"></td>
              <td>1st Attempt Attendance Violation: </td><td><input type="date" name="FirstAttemptAttendanceViolation" value="{{$student->FirstAttemptAttendanceViolation}}" id="FirstAttemptAttendanceViolation"></td>
            </tr>
            <tr>
              <td>2nd Academic Violation:</td><td><input type="date" name="SecondAcademicViolation" value="{{$student->SecondAcademicViolation}}" id="SecondAcademicViolation" ></td>
              <td>2nd Attempt Attendance Violation: </td><td><input type="date" name="SecondAttemptAttendanceViolation" value="{{$student->SecondAttemptAttendanceViolation}}" id="SecondAttemptAttendanceViolation" ></td>
            </tr>
            <tr>
              <td>3rd Academic Violation:</td><td><input type="date" name="ThirdAcademicViolation" value="{{$student->ThirdAcademicViolation}}" id="ThirdAcademicViolation" ></td>
              <td>3rd Attempt Attendance Violation: </td><td><input type="date" name="ThirdAttemptAttendanceViolation" value="{{$student->ThirdAttemptAttendanceViolation}}" id="ThirdAttemptAttendanceViolation" ></td>
            </tr>
            <tr>
              <td>Dismissed (Date):</td><td> {{$student->Dismissed}}</td>
              <td>Withdrawal:</td><td> {{$student->Withdrawal}}</td>
            </tr>
          </table>
          <button type="submit" name="update_academic">Save</button>
        </form>
        @else
        <table>
          <tr>
            <td>Badge:</td><td> {{$student->Badge}}</td>
            <td>Batch:</td><td> {{$student->Batch}}</td>
          </tr>
          <tr>
            <td>Status:</td><td> {{$student->Status}}</td>
            <td>Student No:</td><td> {{$student->StudentNo}}</td>
          </tr>
          <tr>
            <td>Stream: </td><td>{{$student->Stream}}</td>
            <td>Last Activation Date:</td><td> {{ \Carbon\Carbon::parse($student->LastActivationDate)->format('d-m-Y')}}</td>
          </tr>
          <tr>
            <td>1st Postpone:</td><td> {{$student->FirstPostpone}}</td>
            <td>1st Block Drop:</td><td> {{$student->	FirstBlockDrop}}</td>
          </tr>
          <tr>
            <td>2nd Postpone: </td><td>{{$student->SecondPostpone}}</td>
            <td>2nd Block Drop:</td><td> {{$student->	SecondBlockDrop}}</td>
          </tr>
          <tr>
            <td>3rd Postpone: </td><td>{{$student->ThirdPostpone}}</td>
            <td>3rd Block Drop: </td><td>{{$student->	ThirdBlockDrop}}</td>
          </tr>
          <tr>
            <td>1st Academic Violation:</td><td> {{ \Carbon\Carbon::parse($student->FirstAcademicViolation)->format('d-m-Y')}}</td>
            <td>1st Attempt Attendance Violation: </td><td>{{ \Carbon\Carbon::parse($student->FirstAttemptAttendanceViolation)->format('d-m-Y')}}</td>
          </tr>
          <tr>
            <td>2nd Academic Violation:</td><td> {{ \Carbon\Carbon::parse($student->SecondAcademicViolation)->format('d-m-Y')}}</td>
            <td>2nd Attempt Attendance Violation: </td><td>{{ \Carbon\Carbon::parse($student->SecondAttemptAttendanceViolation)->format('d-m-Y')}}</td>
          </tr>
          <tr>
            <td>3rd Academic Violation:</td><td> {{ \Carbon\Carbon::parse($student->ThirdAcademicViolation)->format('d-m-Y')}}</td>
            <td>3rd Attempt Attendance Violation: </td><td>{{ \Carbon\Carbon::parse($student->ThirdAttemptAttendanceViolation)->format('d-m-Y')}}</td>
          </tr>
          <tr>
            <td>Dismissed (Date):</td><td> {{ \Carbon\Carbon::parse($student->Dismissed)->format('d-m-Y')}}</td>
            <td>Withdrawal:</td><td> {{ \Carbon\Carbon::parse($student->Withdrawal)->format('d-m-Y')}}</td>
          </tr>
          <tr>
            <td>Graduate Expectations Year: </td><td>{{$student->GraduateExpectationsYear}}</td>
          </tr>
        </table>

        @endrole
      </section>

      <section id="content3">
        @role('manager')

        <form method="POST" action="{{ route('student.update_contact') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{$student->id}}">
          <table>
            <tr><td>Mobile: </td><td> <input type="number" name="Mobile" value="0{{$student->Mobile}}" id="Mobile" class="form-control{{ $errors->has('Mobile') ? ' is-invalid' : '' }}" required autofocus min="0" oninput="validity.valid||(value='');"></td>
              @if ($errors->has('Mobile'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('Mobile') }}</strong>
              </span>
              @endif
            </tr>
            <tr><td>KSAU-HS Email:</td><td> {{$student->KSAUHSEmail}}</td></tr>
            <tr><td>NGHA Email:</td><td> {{$student->	NGHAEmail}}</td></tr>
            <tr><td>Personal Email:</td><td> {{$student->PersonalEmail}}</td></tr>
            <tr><td></td><td></td><td><button type="submit" name="update_contact">Save</button></td></tr>
          </table>
        </form>
        @else
        <table>
          <tr><td>Mobile: </td><td> 0{{$student->Mobile}}</td></tr>
          <tr><td>KSAU-HS Email:</td><td> {{$student->KSAUHSEmail}}</td></tr>
          <tr><td>NGHA Email:</td><td> {{$student->	NGHAEmail}}</td></tr>
          <tr><td>Personal Email:</td><td> {{$student->PersonalEmail}}</td></tr>
        </table>

        @endrole
      </section>

      <section id="content4">
        @role('manager')

        <h4>Upload New Attachment</h4>
        <div class="upload-form">
          <form method="POST" action="{{ route('student.upload_attachment') }}" enctype="multipart/form-data" class="form-horizontal">
            @csrf

            <input type="hidden" name="id" value="{{$student->id}}">

            <div class="form-group">
            <label for="attch_title" class="col-sm-2 control-label">Attachment Title</label>
            <div class="col-sm-10">
              <input type="text" name="attch_title" id="attch_title" class="form-control{{ $errors->has('attch_title') ? ' is-invalid' : '' }}" required autofocus>
              @if ($errors->has('attch_title'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('attch_title') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label for="attachment" class="col-sm-2 control-label">Attachment File</label>
            <div class="col-sm-4">
              <input type="file" name="attachment" id="attachment" class="form-control{{ $errors->has('attachment') ? ' is-invalid' : '' }}" required autofocus>
              <span>image, pdf and word document</span>
              @if ($errors->has('attachment'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('attachment') }}</strong>
              </span>
              @endif
            </div>
          </div>

            <button type="submit" class="btn btn-default">Save</button>
          </form>
        </div>

        <br>
        <br>
        <br>

        @endrole

        @if (count($attachments) > 0)
          <h4>Attachment List</h4>
            <ul>
              @foreach ($attachments as $attachment)
                <li>
                  <!--<p>{{$attachment->title}}</p>
                    @if (File::exists($attachment->image))
                      <img src="{{ asset($attachment->image) }}" alt="{{$attachment->title}}">
                    @endif
                  -->
                  <a href="{{ url('/attachments/' . $attachment->file) }}" target="_blank">{{$attachment->title}}</a>

                </li>

              @endforeach
            </ul>
            @endif
      </section>
    </main>
  </div>
</div>
</body>
</html>
