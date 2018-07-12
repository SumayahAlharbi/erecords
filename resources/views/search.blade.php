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
    top:9%;
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
    border-left: none; /* Prevent double borders */
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
    border: 0.5px solid #e9e9e9;
    float: left;
    width: 75%;
    background: #f1f1f1;
  }

  /* Style the submit button */
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
    height: 370px;
    left: 15%;
    top:40%;
    z-index: 2;

    padding: 20px;
    /*background-color: rgba(255, 255, 255, 0.8);*/
    background-color: white;
  }
  .search-result table {
    text-align: left;
    border-collapse: collapse;
    width: 100%;

  }
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

    <a href="#">Summary Report</a><button onclick="window.location.href='#'"><i class="fa fa-chevron-circle-right"></i></button>
  </div>

  <div class="flex-center position-ref full-height">
    <div class="content">
      <img src={{ asset('logo/comj.jpg')}} alt='KSAU-HS' height="720" width="1280"/>

    </div>

    <div class="search-result">
      <h4>Search Result for <span style='letter-spacing:normal;'>"{{$search}}"</span>..</h4>
      @if (isset($searchResults))
      <table>
        <tr><th>First Name</th>
          <th>Last Name</th>
          <th>Badge</th>
          <th>National ID</th>
          <th>Status</th>
          <th>Student No</th>
          <th>Batch</th>
          <th>Stream</th>
        </tr>
        @foreach($searchResults as $result)
        <tr>
          <td>{{$result->FirstName}}</td>
          <td>{{$result->LastName}}</td>
          <td>{{$result->Badge}}</td>
          <td>{{$result->NationalID}}</td>
          <td>{{$result->Status}}</td>
          <td>{{$result->StudentNo}}</td>
          <td>{{$result->Batch}}</td>
          <td>{{$result->Stream}}</td>
        </tr>

        @endforeach
      </table>


      <div class="pagination">
        {!! $searchResults->appends(['keyword' => $search])->links()
        !!}
      </div>

      @endif
    </div>

  </div>
</body>
</html>
