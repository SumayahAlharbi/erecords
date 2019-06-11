<!DOCTYPE html>
<html lang="ar">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style type="text/css">
  @import url(https://fonts.googleapis.com/css?family=Raleway);
  body {
    font-family: 'Raleway', sans-serif;
    font-weight: normal;
    font-size: 16px;
  }
  </style>
</head>
@if (isset($batches))
<body>
<table style="width:100%;">
    <tr>
      <td style="text-align:left;"><img src={{ asset("logo/ksauhs.png")}} height="81" width="400"/></td>
      <td style="float:right;text-align:center;padding-left:50px"><p>College of Medicine - Jeddah<br>Student Affairs Department</p></td>
  </tr>
</table>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

<table Style="width:100%; border-collapse: collapse; border: 1px solid black;">
  <tr>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Batch</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Enrolled Active</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Dismissed</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Postponed</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Withdrawn</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Graduated</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Cancelled</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Record Closed</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Total</th>
  </tr>
  @foreach($batches as $index => $result)
  <tr Style="border: 1px solid black; text-align:center;">
    <td Style="border: 1px solid black; padding: 5px">{{$result->Batch}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$array_enrolledActive[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$array_dismissed[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$array_postponed[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$array_withdrawal[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$array_graduated[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$array_cancelled[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$array_recordClosed[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">
      {{$array_enrolledActive[$index]+$array_dismissed[$index]+$array_postponed[$index]+$array_withdrawal[$index]
      +$array_graduated[$index]+$array_cancelled[$index]+$array_recordClosed[$index]}}
    </td>
  </tr>
  @endforeach
  <tr>
    <td Style="border: 1px solid black; padding: 5px">Total</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_enrolledActive}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_dismissed}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_postponed}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_withdrawal}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_graduated}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_cancelled}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_recordClosed}}</td>
    <td Style="border: 1px solid black; padding: 5px">
      {{$total_enrolledActive+$total_dismissed+$total_postponed+$total_withdrawal+$total_graduated+$total_cancelled+$total_recordClosed}}
    </td>
  </tr>
</table>
<br>
<br>
<p>Date: {{ date("l, F d, Y") }}</p>
<br>
<br>
<table style="width:100%">
  <tr>
    <td style="width:50%;text-align:left;"><h4>Student Affairs Manager</h4></td>
    <td style="width:50%;text-align:right;"><h4>Academic Affairs Manager</h4></td>
</tr>
</table>
@endif
</body>
</html>
