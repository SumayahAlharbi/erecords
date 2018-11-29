<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>COMJ E-RECORDS</title>
  <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css">

  <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/css/bootstrap.css" rel="stylesheet"/>
  <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.1/css/bootstrap-select.css" rel="stylesheet"/>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.1/js/bootstrap-select.js"></script>

  <link href="{{ URL::asset('css/navbar.css') }}" rel="stylesheet" type="text/css">

  <script type="text/javascript">
  $(document).ready(function() {
    $('.selectpicker').selectpicker();
  });
</script>
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
          @role('male-manager|female-manager')
          <li><a href="{{ route('manager.home') }}" target="_blank">Manager Dashboard</a></li>
          @endrole
          @role('admin')
          <li><a href="{{ route('admin.home') }}" target="_blank">Admin Dashboard</a></li>
          @endrole
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

  <div class="search-form">
    <h3> Advanced Search</h3>
    <form method="get" action="{{ route('student.advanced_search_result') }}" enctype="multipart/form-data">
      <div class="form-group">
        <label for="FirstName">First Name</label>
        <input type="text" class="form-control" id="FirstName" name="FirstName">
      </div>
      <div class="form-group">
        <label for="MiddleName">Middle Name</label>
        <input type="text" class="form-control" id="MiddleName" name="MiddleName">
      </div>
      <div class="form-group">
        <label for="LastName">Last Name</label>
        <input type="text" class="form-control" id="LastName" name="LastName">
      </div>
      <div class="form-group">
        <label for="NationalID">National ID</label>
        <input type="text" class="form-control" id="NationalID" name="NationalID">
      </div>
      <div class="form-group">
        <label for="Badge">Badge</label>
        <input type="text" class="form-control" id="Badge" name="Badge">
      </div>
      <div class="form-group">
        <label for="Batch">Batch</label>
        <select class="form-control selectpicker" id="Batch" name="Batch[]" multiple="multiple">
          <option value=""></option>
          @foreach($batches as $batche)
          <option value="{{$batche->Batch}}">{{$batche->Batch}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="Status">Status</label>
        <select class="form-control selectpicker" id="Status" name="Status[]" multiple="multiple">
          <option value=""></option>
          @foreach($status as $value)
          <option value="{{$value->Status}}">{{$value->Status}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="Stream">Stream</label>
        <select class="form-control selectpicker" id="Stream" name="Stream[]" multiple="multiple">
          <option value=""></option>
          @foreach($streams as $stream)
          <option value="{{$stream->Stream}}">{{$stream->Stream}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="StudentNo">Student No</label>
        <input type="text" class="form-control" id="StudentNo" name="StudentNo">
      </div>

      <div class="form-group">
        <label for="Mobile">Mobile</label>
        <input type="text" class="form-control" id="Mobile" name="Mobile">
      </div>

      <div class="form-group">
        <label for="KSAUHSEmail">KSAU-HS Email</label>
        <input type="text" class="form-control" id="KSAUHSEmail" name="KSAUHSEmail">
      </div>

      <div class="form-group">
        <label for="NGHAEmail">NGHA Email</label>
        <input type="text" class="form-control" id="NGHAEmail" name="NGHAEmail">
      </div>

      <div class="form-group">
        <label for="PersonalEmail">Personal Email</label>
        <input type="text" class="form-control" id="PersonalEmail" name="PersonalEmail">
      </div>

      <div class="form-group">
        <label for="LastActivationDate">Last Activation Date</label>
        <input type="date" class="form-control" id="LastActivationDate" name="LastActivationDate">
      </div>


      <div class="form-group">
        <label for="Dismissed">Dismissed</label>
        <input type="date" class="form-control" id="Dismissed" name="Dismissed">
      </div>
      <div class="form-group">
        <label for="FirstBlockDrop">First Block Drop</label>
        <input type="date" class="form-control" id="FirstBlockDrop" name="FirstBlockDrop">
      </div>

      <div class="form-group">
        <label for="FirstPostpone">First Postpone</label>
        <input type="date" class="form-control" id="FirstPostpone" name="FirstPostpone">
      </div>

      <div class="form-group">
        <label for="FirstAcademicViolation">First Academic Violation</label>
        <input type="date" class="form-control" id="FirstAcademicViolation" name="FirstAcademicViolation">
      </div>

      <div class="form-group">
        <label for="SecondBlockDrop">Second Block Drop</label>
        <input type="date" class="form-control" id="SecondBlockDrop" name="SecondBlockDrop">
      </div>

      <div class="form-group">
        <label for="SecondPostpone">Second Postpone</label>
        <input type="date" class="form-control" id="SecondPostpone" name="SecondPostpone">
      </div>

      <div class="form-group">
        <label for="SecondAcademicViolation">Second Academic Violation</label>
        <input type="date" class="form-control" id="SecondAcademicViolation" name="SecondAcademicViolation">
      </div>

      <div class="form-group">
        <label for="ThirdBlockDrop">Third Block Drop</label>
        <input type="date" class="form-control" id="ThirdBlockDrop" name="ThirdBlockDrop">
      </div>

      <div class="form-group">
        <label for="ThirdPostpone">Third Postpone</label>
        <input type="date" class="form-control" id="ThirdPostpone" name="ThirdPostpone">
      </div>

      <div class="form-group">
        <label for="ThirdAcademicViolation">Third Academic Violation</label>
        <input type="date" class="form-control" id="ThirdAcademicViolation" name="ThirdAcademicViolation">
      </div>

      <div class="form-group">
        <label for="FirstAttemptAttendanceViolation">First Attempt Attendance Violation</label>
        <input type="date" class="form-control" id="FirstAttemptAttendanceViolation" name="FirstAttemptAttendanceViolation">
      </div>



      <div class="form-group">
        <label for="SecondAttemptAttendanceViolation">Second Attempt Attendance Violation</label>
        <input type="date" class="form-control" id="SecondAttemptAttendanceViolation" name="SecondAttemptAttendanceViolation">
      </div>



      <div class="form-group">
        <label for="ThirdAttemptAttendanceViolation">Third Attempt Attendance Violation</label>
        <input type="date" class="form-control" id="ThirdAttemptAttendanceViolation" name="ThirdAttemptAttendanceViolation">
      </div>

      <div class="form-group">
        <label for="Withdrawal">Withdrawal</label>
        <input type="date" class="form-control" id="Withdrawal" name="Withdrawal">
      </div>

      <div class="form-group">
        <label for="GraduateExpectationsYear">Graduate Expectations Year</label>
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

      <div class="form-group">
        <label for="delayedGraduation">Delayed Graduation Student</label>
        <input type="checkbox" name="delayedGraduation">
      </div>

      <br>
      <button type="submit" class="btn btn-default">Search</button>
    </form>
  </div>

</div>
</body>
</html>
