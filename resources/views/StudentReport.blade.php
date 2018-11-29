<!DOCTYPE html>
<html lang="ar">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style type="text/css">
  #container {
    height: auto;
    display:inline-block;
    text-align:center;
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
    font-family: 'examplefont', sans-serif;
  }

  fieldset {
    border:1px solid black;
    padding: 1em;
    display: inline-block;
  }
  legend{
    padding: 2em;
  }
  </style>
</head>
<body>
  <table>
    <tr>
      <td style='width=50%;float:left;'><img src={{ asset('logo/ksauhs.png')}} height="81" width="400"/></td>
      <td style='width=50%;float:right;text-align:center;padding-left:50px;'>College of Medicine - Jeddah<br>Student Affairs Department</td>
    </tr>
  </table>

  <br>
  <br>
  <br>
  <br>

  <div id="container">
    <div id="center"><h3>Student Summary Infotmation</h3></div>
    <div id="right">Report Date: <br> {{ date('l, F m, Y') }}</div>
  </div>

  <br>
  <br>
  <br>

  <fieldset>
    <legend>GENERAL INFORMATION</legend>
    <table style="width:100%">
      <tbody>
        <tr><th style="width:16%;padding: 3px;text-align: left;">English Name:</th>
          <td style="width:16%;padding: 3px;text-align: left;">{{$student->FirstName}}</td>
          <td style="width:16%;padding: 3px;text-align: left;">{{$student->MiddleName}}</td>
          <td style="width:16%;padding: 3px;text-align: left;">{{$student->LastName}}</td></tr>
          <tr><th style="width:16%;padding: 3px;text-align: left;">Arabic Name:</th>
            <td style="width:16%;padding: 3px;text-align: left;"><div id="arabic-text"><?php echo htmlentities($student->ArabicLastName,ENT_QUOTES, "UTF-8");?></div></td>

            <td style="width:16%;padding: 3px;text-align: left;"><div id="arabic-text"><?php echo htmlentities($student->ArabicMiddleName,ENT_QUOTES, "UTF-8");?></div></td>
            <td style="width:16%;padding: 3px;text-align: left;"><div id="arabic-text"><?php echo htmlentities($student->ArabicFirstName,ENT_QUOTES, "UTF-8");?></div></td></tr>
            <tr><th style="width:25%;padding: 3px;text-align: left;">Student No:</th>
              <td style="width:25%;padding: 3px;text-align: left;">{{$student->StudentNo}}</td>
              <th style="width:25%;padding: 3px;text-align: left;">Status:</th>
              <td style="width:25%;padding: 3px;text-align: left;">{{$student->Status}}</td></tr>
              <tr><th style="width:25%;padding: 3px;text-align: left;">KSAU-HS Email:</th>
                <td style="width:35%;padding: 3px;text-align: left;">{{$student->KSAUHSEmail}}</td>
                <th style="width:20%;padding: 3px;text-align: left;">Badge No:</th>
                <td style="width:20%;padding: 3px;text-align: left;">{{$student->Badge}}</td></tr>
                <tr><th style="width:25%;padding: 3px;text-align: left;">Batch:</th>
                  <td style="width:35%;padding: 3px;text-align: left;">{{$student->Batch}}</td>
                  <th style="width:20%;padding: 3px;text-align: left;">National ID:</th>
                  <td style="width:20%;padding: 3px;text-align: left;">{{$student->NationalID}}</td></tr>
                  <tr><th style="width:25%;padding: 3px;text-align: left;">Mobile:</th>
                    <td style="width:35%;padding: 3px;text-align: left;">0{{$student->Mobile}}</td>
                    <th style="width:20%;padding: 3px;text-align: left;">Stream:</th>
                    <td style="width:20%;padding: 3px;text-align: left;">{{$student->Stream}}</td></tr>
                  </tbody>
                </table>
              </fieldset>

              <br>

              <fieldset style="width:45%;float:left;text-align:left;">
                <legend>TRANSACTIONS</legend>
                <table style="width:100%">
                  <tbody>
                    <tr><th style="padding: 3px;text-align: left;">Postponement</th></tr>
                    <tr><td style="padding: 3px;text-align: left;">1st:</td><td style="padding: 3px;text-align: left;">{{$student->FirstPostpone}}</td></tr>
                    <tr><td style="padding: 3px;text-align: left;">2nd:</td><td style="padding: 3px;text-align: left;">{{$student->SecondPostpone}}</td></tr>
                    <tr><td style="padding: 3px;text-align: left;">3rd:</td><td style="padding: 3px;text-align: left;">{{$student->ThirdPostpone}}</td></tr>
                    <tr><th style="padding: 3px;text-align: left;">Block Drop</th></tr>
                    <tr><td style="padding: 3px;text-align: left;">1st:</td><td style="padding: 3px;text-align: left;">{{$student->FirstBlockDrop}}</td></tr>
                    <tr><td style="padding: 3px;text-align: left;">2nd:</td><td style="padding: 3px;text-align: left;">{{$student->SecondBlockDrop}}</td></tr>
                    <tr><td style="padding: 3px;text-align: left;">3rd:</td><td style="padding: 3px;text-align: left;">{{$student->ThirdBlockDrop}}</td></tr>

                    <tr><td style="padding: 3px;text-align: left;">Dismissed Date:</td><td style="padding: 3px;text-align: left;">{{$student->Dismissed}}</td></tr>
                    <tr><td style="padding: 3px;text-align: left;">Withdrawal Date:</td><td style="padding: 3px;text-align: left;">{{$student->Withdrawal}}</td></tr>
                  </tbody>
                </table>
              </fieldset>

              <fieldset style="width:45%;float:right;text-align:left;">
                <legend>PERFORMANCES</legend>
                <table style="width:100%">
                  <tbody>
                    <tr><th style="padding: 3px;text-align: left;">Academic Violation</th></tr>
                    <tr><td style="padding: 3px;text-align: left;">1st:</td><td style="padding: 3px;text-align: left;">{{$student->FirstAcademicViolation}}</td></tr>
                    <tr><td style="padding: 3px;text-align: left;">2nd:</td><td style="padding: 3px;text-align: left;">{{$student->SecondAcademicViolation}}</td></tr>
                    <tr><td style="padding: 3px;text-align: left;">3rd:</td><td style="padding: 3px;text-align: left;">{{$student->ThirdAcademicViolation}}</td></tr>
                    <tr><th style="padding: 3px;text-align: left;">Forbidden form final exam</th></tr>
                    <tr><td style="padding: 3px;text-align: left;">1st:</td><td style="padding: 3px;text-align: left;">{{$student->FirstAttemptAttendanceViolation}}</td></tr>
                    <tr><td style="padding: 3px;text-align: left;">2nd:</td><td style="padding: 3px;text-align: left;">{{$student->SecondAttemptAttendanceViolation}}</td></tr>
                    <tr><td style="padding: 3px;text-align: left;">3rd:</td><td style="padding: 3px;text-align: left;">{{$student->ThirdAttemptAttendanceViolation}}</td></tr>

                    <tr><td style="padding: 3px;">&nbsp;</td></tr>
                    <tr><td style="padding: 3px;">&nbsp;</td></tr>
                  </tbody>
                </table>
              </fieldset>

            </body>
            </html>
