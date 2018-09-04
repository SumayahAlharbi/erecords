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

    <div class="search-result">
      <a class="advanced_search" href="{{ route('advanced_search') }}">Advanced Search</a>
      <h4>Search Result for <span style='letter-spacing:normal;'>"{{$search}}"</span>..</h4>
      @if (isset($searchResults))
      <table>
        <tr><th></th>
          <th>First Name</th>
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
          <td><a href="{{route('student.show',$result->ID)}}"><i class="fa fa-chevron-circle-right"></i></a></td>
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
