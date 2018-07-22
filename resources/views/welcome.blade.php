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
      <img src={{ asset('logo/comj-logo.png')}} alt='COMJ Logo' height="87" width="385"/>
    </div>
      <div class='search-center'>
      <form method="get" action="{{ route('student.search_result') }}" enctype="multipart/form-data" class="search">
          <input type="text" placeholder="Search.." name="keyword"/>
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>

      <div class="flex-center position-ref full-height">
          <div class="content">
            <img src={{ asset('logo/comj.jpg')}} alt='KSAU-HS' height="720" width="1280"/>

          </div>
          <div class="title">
              <span style="color:#A69229">E</span>-RECORDS
          </div>
      </div>
  </body>
</html>
