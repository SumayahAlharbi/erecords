<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>COMJ E-RECORDS</title>
  <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <link href="{{ URL::asset('css/navbar.css') }}" rel="stylesheet" type="text/css">

</head>
<body>
  <div class='header'>
    <a href="{{ URL('/') }}"><img src={{ asset('logo/comj-logo.png')}} alt='COMJ Logo' height="87" width="385"></a>
  </div>

  @auth
  <div class="nav-right">
    <nav class="navbar-logout" role="navigation">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
            <li><a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</div>
@endauth


    <div class="flex-center position-ref full-height">
      <div class="content">
        <img src={{ asset('logo/comj.jpg')}} alt='KSAU-HS' height="720" width="1280"/>
      </div>

      <div class="search-result">
        <h3>Access denied, you don't have the permission to view this page.</h3>
      </div>
    </div>
  </body>
</html>
