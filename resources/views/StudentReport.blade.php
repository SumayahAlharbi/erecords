<!DOCTYPE html>
<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
  <body>
<div id="container">
<div id="left"><img src={{ asset('logo/ksauhs.png')}} height="81" width="400"/></div>
<div id="right"><br>College of Medicine - Jeddah<br>Student Affairs Department</div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div id="container">
  <div id="center"><h3>Student Summary Infotmation</h3></div>
  <div id="right"><br>Report Date: <br> {{ date('l, F m, Y') }}</div>
</div>

<br>
<br>
<br>
<br>

<fieldset style="border: 1px black solid">
<legend>GENERAL INFORMATION</legend>
<table style="width:100%">
<tbody>
<tr><th style="width:16%">English Name:</th>
  <td style="width:16%">{{$student->FirstName}}</td>
  <td style="width:16%">{{$student->MiddleName}}</td>
  <td style="width:16%">{{$student->LastName}}</td></tr>
<tr><th style="width:16%">Arabic Name:</th>

  <?php
/*
  $test=$student->ArabicFirstName;
  preg_match_all('/./us', $test, $ar);
  $text = join('',array_reverse($ar[0]));
  // if there are numbers in the string
  // so the next line reverse the number back
  // treat also numbers with dot (decimal) and email
  $text = preg_replace_callback('/\d+-\d+|\d+|\d+\.\d+|\S+@\S+/', function (array $m) { return strrev($m[0]); }, $text);
*/
  ?>

  <td style="width:16%"><div id="arabic-text">{{$student->ArabicFirstName}}</div></td>
  <td style="width:16%"><label>{{$student->ArabicMiddleName}}<label></td>
  <td style="width:16%">{{$student->ArabicLastName}}</td></tr>
<tr><th style="width:25%">Student No:</th>
  <td style="width:25%">{{$student->StudentNo}}</td>
  <th style="width:25%">Status:</th>
  <td style="width:25%">{{$student->Status}}</td></tr>
<tr><th style="width:25%">KSAU-HS Email:</th>
  <td style="width:35%">{{$student->KSAUHSEmail}}</td>
  <th style="width:20%">Badge No:</th>
  <td style="width:20%">{{$student->Badge}}</td></tr>
<tr><th style="width:25%">Batch:</th>
  <td style="width:35%">{{$student->Batch}}</td>
  <th style="width:20%">National ID:</th>
  <td style="width:20%">{{$student->NationalID}}</td></tr>
<tr><th style="width:25%">Mobile:</th>
  <td style="width:35%">{{$student->Mobile}}</td>
  <th style="width:20%">Stream:</th>
  <td style="width:20%">{{$student->Stream}}</td></tr>
</tbody>
</table>
</fieldset>

<br>

<div id="container">
<fieldset style="border: 1px black solid;width:45%;float:left;display:inline-block;text-align:left;">
<legend>TRANSACTIONS</legend>
<table style="width:100%">
<tbody>
<tr><th>Postponement</th></tr>
<tr><td>1st:</td><td>{{$student->FirstPostpone}}</td></tr>
<tr><td>2nd:</td><td>{{$student->SecondPostpone}}</td></tr>
<tr><td>3rd:</td><td>{{$student->ThirdPostpone}}</td></tr>
<tr><th>Block Drop</th></tr>
<tr><td>1st:</td><td>{{$student->FirstBlockDrop}}</td></tr>
<tr><td>2nd:</td><td>{{$student->SecondBlockDrop}}</td></tr>
<tr><td>3rd:</td><td>{{$student->ThirdBlockDrop}}</td></tr>

<tr><td>Dismissed Date:</td><td>{{$student->Dismissed}}</td></tr>
<tr><td>Withdrawal Date:</td><td>{{$student->Withdrawal}}</td></tr>
</tbody>
</table>
</fieldset>

<fieldset style="border: 1px black solid;width:45%;float:right;display:inline-block;text-align:left;">
<legend>PERFORMANCES</legend>
<table style="width:100%">
<tbody>
<tr><th>Academic Violation</th></tr>
<tr><td>1st:</td><td>{{$student->FirstAcademicViolation}}</td></tr>
<tr><td>2nd:</td><td>{{$student->SecondAcademicViolation}}</td></tr>
<tr><td>3rd:</td><td>{{$student->ThirdAcademicViolation}}</td></tr>
<tr><th>Forbidden form final exam</th></tr>
<tr><td>1st:</td><td>{{$student->FirstAttemptAttendanceViolation}}</td></tr>
<tr><td>2nd:</td><td>{{$student->SecondAttemptAttendanceViolation}}</td></tr>
<tr><td>3rd:</td><td>{{$student->ThirdAttemptAttendanceViolation}}</td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
</tbody>
</table>
</fieldset>
</div>

<style type="text/css">
#container {
    width:100%;
    text-align:center;
    height: auto;
    display:inline-block;
}

#left {
    float:left;
    width:auto;
    height: 20px;
}

#center {
    margin:0 auto;
    width:auto;
    height: 20px;
}
#right {
    float:right;
    width:auto;
    height: 20px;
    margin-right: 10px;
}
#arabic-text {
font-family: 'DejaVu Sans', sans-serif;
direction: rtl;
}
</style>
</body>
</html>
