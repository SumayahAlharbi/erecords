<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>COMJ E-RECORDS</title>
  <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
  <div class='header'>
    <a href="{{ route('home') }}"><img src={{ asset('logo/comj-logo.png')}} alt='COMJ Logo' height="87" width="385"/></a>

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
      <h3> {{$student->FirstName}} {{$student->LastName}} </h3>
      <main>

        <input id="tab1" type="radio" name="tabs" checked>
        <label for="tab1">Personal</label>

        <input id="tab2" type="radio" name="tabs">
        <label for="tab2">Academic</label>

        <input id="tab3" type="radio" name="tabs">
        <label for="tab3">Contact</label>

        <input id="tab4" type="radio" name="tabs">
        <label for="tab4">Attachment</label>

        <section id="content1">
          <table>
            <tr><td>Arabic First Name:</td><td>{{$student->ArabicFirstName}}</td></tr>
            <tr><td>Arabic Middle Name:</td><td> {{$student->ArabicMiddleName}}</td></tr>
            <tr><td>Arabic Last Name:</td><td> {{$student->ArabicLastName}}</td></tr>
            <tr><td>English First Name:</td><td> {{$student->FirstName}}</td></tr>
            <tr><td>English Middle Name:</td><td> {{$student->MiddleName}}</td></tr>
            <tr><td>English Last Name:</td><td> {{$student->LastName}}</td></tr>
            <tr><td>National ID:</td><td> {{$student->NationalID}}</td></tr>
          </table>
        </section>

        <section id="content2">
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
              <td>Graduate Expectations Year: {{$student->GraduateExpectationsYear}}</td>
            </tr>
          </table>
        </section>

        <section id="content3">
          <table>
            <tr><td>Mobile: </td><td>0{{$student->Mobile}}</td></tr>
            <tr><td>KSAU-HS Email:</td><td> {{$student->KSAUHSEmail}}</td></tr>
            <tr><td>NGHA Email:</td><td> {{$student->	NGHAEmail}}</td></tr>
            <tr><td>Personal Email:</td><td> {{$student->PersonalEmail}}</td></tr>
          </table>
        </section>

        <section id="content4">
          <p> I need a server </p>
        </section>

      </main>
    </div>

  </div>
</body>
</html>
