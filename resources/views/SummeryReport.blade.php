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
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">ACTIVE</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">DISMISSED</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">POSTPOND</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">WITHDRAWL</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">INTERN</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">ALUMNI</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;padding:5px">Total of ID</th>
  </tr>
  @foreach($batches as $index => $result)
  <tr Style="border: 1px solid black; text-align:center;">
    <td Style="border: 1px solid black; padding: 5px">{{$result->Batch}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$active[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$dismissed[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$postponed[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$withdrawal[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$intern[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$alumni[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total[$index]}}</td>
  </tr>
  @endforeach
  <tr>
    <td Style="border: 1px solid black; padding: 5px">Total</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_active}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_dismissed}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_postponed}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_withdrawal}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_intern}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$total_alumni}}</td>
    <td Style="border: 1px solid black; padding: 5px">{{$totaloftotal}}</td>
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
