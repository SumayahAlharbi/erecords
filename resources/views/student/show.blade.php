<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>COMJ E-RECORDS</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Styles -->
  <style>
  html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Raleway', sans-serif;
    font-weight: normal;
    font-size: 16px;
    height: 100vh;
    margin: 0;
  }

  .full-height {
    height: 100vh;
  }

  .flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
  }

  .position-ref {
    position: relative;
  }

  .top-right {
    position: absolute;
    right: 15%;
    top:12%;
    z-index: 1;
    height: auto;
  }

  .top-right > a {
    float: left;
    width: 75%;
    margin-top:6px;
    color: 	#f1f1f1;
    padding: 4px;
    background: #538f6e;
    font-size: 16px;
    font-weight: normal;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
  }

  .top-right > button {
    margin-top:6px;
    float: left;
    width: 15%;
    padding: 4px;
    background: #3a7f59;
    color: white;
    font-size: 16px;
    border: 0.5px solid #3a7f59;
    border-left: none;
    cursor: pointer;
  }

  .top-right button:hover {
    background: #226f44;
  }

  .content {
    text-align: center;
  }

  .header {
    position: absolute;
    left: 15%;
    top:7%;
    z-index: 2;
  }

  .title {
    position: absolute;
    left: 15%;
    bottom:7%;
    z-index: 2;
    font-size: 40px;
    padding: 3px 6px 3px 6px;
    background: #f1f1f1;
    font-weight:500;
    color: 	#0A6030;
    letter-spacing: .3rem;
  }

  form.search input[type=text] {
    padding: 4px;
    font-size: 16px;
    border: 0.5px solid #f1f1f1;
    float: left;
    width: 75%;
    background: #f1f1f1;
  }

  form.search button {
    float: left;
    width: 15%;
    padding: 4px;
    background: 	#A69229;
    color: white;
    font-size: 16px;
    border: 0.5px solid #A69229;
    border-left: none; /* Prevent double borders */
    cursor: pointer;
  }

  form.search button:hover {
    background: #958324;
  }

  *:focus {
    outline: none;
  }

  .search-result {
    position: absolute;
    width: 1020px;
    min-height: 450px;
    max-height: 450px;
    overflow-y:scroll;
    left: 15%;
    top:30%;
    z-index: 2;
    padding: 20px;
    background-color: white;
  }

  .search-result a i{
    color: #3a7f59;
    cursor: pointer;
  }

  .search-result a i:hover {
    color: #226f44;
  }


  .search-result table {
    text-align: left;
    border-collapse: collapse;
    width: 100%;

  }

  .search-result table tr:nth-child(even) {background-color: #f6f6f6;}

  /* Different way*/
  /*.search-result table tr:hover {
  background-color: #f6f6f6;
  }
  */

  .search-result th, td {
    padding: 10px;
  }

  .search-result td {
    font-weight: normal;
  }

  .search-result  .pagination ul{
    left:0;
    position: absolute;
    bottom: 5%;
  }
  .search-result  .pagination ul li{
    display: inline-block;
    list-style-type: none;
  }
  .search-result  .pagination ul li :not(a){
    color: #636b6f;
    font-weight: normal;
    padding: 8px 16px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    background-color: #f1f1f1;
  }
  .search-result .pagination ul li a {
    color: #636b6f;
    font-weight: normal;
    padding: 8px 16px;
    text-decoration: none;
    background-color: #f1f1f1;
  }

  .search-result .pagination a:hover:not(.active) {background-color: #dbd3a9;}

  .search-result .pagination a:first-child {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
  }

  .search-result .pagination a:last-child {
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
  }
  .search-result  h3{
    display: inline-block;
    margin-left: 5px;
    color: #A69229;
    margin-bottom: 1.33em;
  }

  .search-result  p {
    margin: 0 0 20px;
    line-height: 1.5;
  }

  .search-result  section {
    display: none;
    padding: 20px 0 0;
    border-top: 1px solid #ddd;
  }
  .search-result  section table{
    text-align: left;
    border-collapse: collapse;
    width: auto;

  }
  .search-result  section table td{
    padding: 10px;
  }

  .search-result  input {
    display: none;
  }

  .search-result label {
    display: inline-block;
    margin: 0 0 -1px;
    padding: 15px 25px;
    font-weight: 600;
    text-align: center;
    color: #bbb;
    border: 1px solid transparent;
  }

  .search-result label:before {
    font-family: fontawesome;
    font-weight: normal;
    margin-right: 10px;
  }

  .search-result  label[for*='1']:before { content: '\f0f0'; }
  label[for*='2']:before { content: '\f19c'; }
  label[for*='3']:before { content: '\f20e'; }
  label[for*='4']:before { content: '\f0c6'; }

  .search-result  label:hover {
    color: #888;
    cursor: pointer;
  }

  .search-result  input:checked + label {
    color: #555;
    border: 1px solid #ddd;
    border-top: 2px solid #3a7f59;
    border-bottom: 1px solid #fff;
  }

  #tab1:checked ~ #content1,
  #tab2:checked ~ #content2,
  #tab3:checked ~ #content3,
  #tab4:checked ~ #content4 {
    display: block;
  }

  @media screen and (max-width: 650px) {
    label {
      font-size: 0;
    }
    label:before {
      margin: 0;
      font-size: 18px;
    }
  }

  @media screen and (max-width: 400px) {
    label {
      padding: 15px;
    }
  }
</style>
</head>
<body>
  <div class='header'>
    <a href="{{ route('home') }}"><img src={{ asset('logo/comj-logo.png')}} alt='COMJ Logo' height="87" width="385"/></a>

  </div>
  <div class='top-right'>
    <form method="get" action="{{ route('student.search') }}" enctype="multipart/form-data" class="search">
      <input type="text" placeholder="Search.." name="keyword"/>
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>

    <!--<a href="#">Summary Report</a><button onclick="window.location.href='#'"><i class="fa fa-chevron-right"></i></button>-->
  </div>

  <div class="flex-center position-ref full-height">
    <div class="content">
      <img src={{ asset('logo/comj.jpg')}} alt='KSAU-HS' height="720" width="1280"/>

    </div>

    <div class="search-result">
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
