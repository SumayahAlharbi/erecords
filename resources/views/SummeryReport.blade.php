@if (isset($batches))
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

<table Style="width:100%; border-collapse: collapse; border: 1px solid black;">
  <tr>
    <th Style="border: 1px solid black; text-align:center; height: 50px;">Batch</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;">ACTIVE</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;">DISMISSED</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;">POSTPOND</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;">WITHDRAWL</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;">INTERN</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;">ALUMNI</th>
    <th Style="border: 1px solid black; text-align:center; height: 50px;">Total of ID</th>
  </tr>
  @foreach($batches as $index => $result)
  <tr Style="border: 1px solid black; text-align:center;">
    <td Style="border: 1px solid black; padding: 5px;">{{$result->Batch}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$active[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$dismissed[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$postponed[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$withdrawal[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$intern[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$alumni[$index]}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$total[$index]}}</td>
  </tr>
  @endforeach
  <tr>
    <td Style="border: 1px solid black; padding: 5px;">Total</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$total_active}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$total_dismissed}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$total_postponed}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$total_withdrawal}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$total_intern}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$total_alumni}}</td>
    <td Style="border: 1px solid black; padding: 5px;">{{$totaloftotal}}</td>
  </tr>
</table>
<br>
<br>
<p>Date: {{ date('l, F m, Y') }}</p>
<br>
<br>
<div id="container">
<div id="left">Student Affairs Manager</div>
<div id="right">Academic Affairs Manager</div>
</div>
@endif

<style>
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
</style>
