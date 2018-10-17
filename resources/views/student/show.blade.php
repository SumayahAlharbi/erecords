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
          <li><a href="{{ URL::to('summeryReport/pdf') }}">Summery Report</a></li>
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
      <label for="tab1">Personal</label>

      <input id="tab2" type="radio" name="tabs">
      <label for="tab2">Academic</label>

      <input id="tab3" type="radio" name="tabs">
      <label for="tab3">Contact</label>

      <input id="tab4" type="radio" name="tabs">
      <label for="tab4">Attachment</label>


      <a style="text-decoration: none;" href="{{ URL::to('studentReport/pdf',$student->ID) }}"><label for="tab5">Print</label></a>

      <section id="content1">
        @auth <!-- if admin is logged in -->
        <form method="POST" action="{{ route('student.update_personal') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{$student->ID}}">
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
                <input type="text" name="ArabicLastName" id="ArabicLastName" class="form-control{{ $errors->has('ArabicLastName') ? ' is-invalid' : '' }}" value="{{$student->ArabicLastName}}" required autofocus>
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
            <tr><td>National ID:</td><td> {{$student->NationalID}} </td><td><button type="submit" name="update_personal">Save</button></td>

          </tr>
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
        @endauth
      </section>

      <section id="content2">
        @auth <!-- if admin is logged in -->
        <form method="POST" action="{{ route('student.update_academic') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{$student->ID}}">
          <table>
            <tr>
              <td>Badge:</td><td> {{$student->Badge}}</td>
              <td>Batch:</td><td><input type="number" name="Batch" value="{{$student->Batch}}" id="Batch" class="form-control{{ $errors->has('Batch') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');"></td>
              @if ($errors->has('Batch'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('Batch') }}</strong>
              </span>
              @endif
            </tr>
            <tr>
              <td>Status:</td><td> {{$student->Status}}</td>
              <td>Student No:</td><td> {{$student->StudentNo}}</td>
            </tr>
            <tr>
              <td>Stream: </td><td><input type="number" name="Stream" value="{{$student->Stream}}" id="Stream" class="form-control{{ $errors->has('Stream') ? ' is-invalid' : '' }}" required autofocus min="1" oninput="validity.valid||(value='');"></td>
              @if ($errors->has('Stream'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('Stream') }}</strong>
              </span>
              @endif
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
              <td>1st Academic Violation:</td><td><input type="date" name="FirstAcademicViolation" value="{{$student->FirstAcademicViolation}}" id="FirstAcademicViolation" class="form-control{{ $errors->has('FirstAcademicViolation') ? ' is-invalid' : '' }}" required autofocus></td>
              @if ($errors->has('FirstAcademicViolation'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('FirstAcademicViolation') }}</strong>
              </span>
              @endif
              <td>1st Attempt Attendance Violation: </td><td><input type="date" name="FirstAttemptAttendanceViolation" value="{{$student->FirstAttemptAttendanceViolation}}" id="FirstAttemptAttendanceViolation" class="form-control{{ $errors->has('FirstAttemptAttendanceViolation') ? ' is-invalid' : '' }}" required autofocus></td>
              @if ($errors->has('FirstAttemptAttendanceViolation'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('FirstAttemptAttendanceViolation') }}</strong>
              </span>
              @endif
            </tr>
            <tr>
              <td>2nd Academic Violation:</td><td><input type="date" name="SecondAcademicViolation" value="{{$student->SecondAcademicViolation}}" id="SecondAcademicViolation" class="form-control{{ $errors->has('SecondAcademicViolation') ? ' is-invalid' : '' }}" required autofocus></td>
              @if ($errors->has('SecondAcademicViolation'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('SecondAcademicViolation') }}</strong>
              </span>
              @endif
              <td>2nd Attempt Attendance Violation: </td><td><input type="date" name="SecondAttemptAttendanceViolation" value="{{$student->SecondAttemptAttendanceViolation}}" id="SecondAttemptAttendanceViolation" class="form-control{{ $errors->has('SecondAttemptAttendanceViolation') ? ' is-invalid' : '' }}" required autofocus></td>
              @if ($errors->has('SecondAttemptAttendanceViolation'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('SecondAttemptAttendanceViolation') }}</strong>
              </span>
              @endif
            </tr>
            <tr>
              <td>3rd Academic Violation:</td><td><input type="date" name="ThirdAcademicViolation" value="{{$student->ThirdAcademicViolation}}" id="ThirdAcademicViolation" class="form-control{{ $errors->has('ThirdAcademicViolation') ? ' is-invalid' : '' }}" required autofocus></td>
              @if ($errors->has('ThirdAcademicViolation'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ThirdAcademicViolation') }}</strong>
              </span>
              @endif
              <td>3rd Attempt Attendance Violation: </td><td><input type="date" name="ThirdAttemptAttendanceViolation" value="{{$student->ThirdAttemptAttendanceViolation}}" id="ThirdAttemptAttendanceViolation" class="form-control{{ $errors->has('ThirdAttemptAttendanceViolation') ? ' is-invalid' : '' }}" required autofocus></td>
              @if ($errors->has('ThirdAttemptAttendanceViolation'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ThirdAttemptAttendanceViolation') }}</strong>
              </span>
              @endif
            </tr>
            <tr>
              <td>Dismissed (Date):</td><td> {{$student->Dismissed}}</td>
              <td>Withdrawal:</td><td> {{$student->Withdrawal}}</td>
            </tr>
            <tr>
              <td>Graduate Expectations Year:</td><td> {{$student->GraduateExpectationsYear}}</td>
              <td></td>
              <td></td>
              <td><button type="submit" name="update_academic">Save</button></td>
            </tr>
          </table>
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
            <td>1st Academic Violation:</td><td> {{$student->FirstAcademicViolation}}</td>
            <td>1st Attempt Attendance Violation: </td><td>{{$student->FirstAttemptAttendanceViolation}}</td>
          </tr>
          <tr>
            <td>2nd Academic Violation:</td><td> {{$student->SecondAcademicViolation}}</td>
            <td>2nd Attempt Attendance Violation: </td><td>{{$student->SecondAttemptAttendanceViolation}}</td>
          </tr>
          <tr>
            <td>3rd Academic Violation:</td><td> {{$student->ThirdAcademicViolation}}</td>
            <td>3rd Attempt Attendance Violation: </td><td>{{$student->ThirdAttemptAttendanceViolation}}</td>
          </tr>
          <tr>
            <td>Dismissed (Date):</td><td> {{$student->Dismissed}}</td>
            <td>Withdrawal:</td><td> {{$student->Withdrawal}}</td>
          </tr>
          <tr>
            <td>Graduate Expectations Year: </td><td>{{$student->GraduateExpectationsYear}}</td>
          </tr>
        </table>
        @endauth
      </section>

      <section id="content3">
        @auth <!-- if admin is logged in -->
        <form method="POST" action="{{ route('student.update_contact') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{$student->ID}}">
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
        @endauth
      </section>

      <section id="content4">
        @auth <!-- if admin is logged in -->
        <p>View & Upload function</p>
        @else
        <p>View the attachment </p>
        @endauth
      </section>

    </main>
  </div>

</div>
</body>
</html>
