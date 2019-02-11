<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap AND fontawesome CSS
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  -->
  <link href="{{ asset('css/bootstrap-min.css') }}" media="all" rel="stylesheet" type="text/css">
  <!-- Dose not work
  <link href="{{ asset('css/fontawesome-all.css') }}" media="all" rel="stylesheet" type="text/css">-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <link href="{{ asset('css/custom-nav.css') }}" media="all" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/allApp.css') }}" media="all" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/bootstrap-select.css') }}" media="all" rel="stylesheet" type="text/css">

  <title>Student E-Records</title>
</head>
<body>

  @if (!Auth::check())
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}"><img src={{ asset('logo/comj-logo.png')}} alt='COMJ Logo' height="87" width="385" id="Logo"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  @else
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}"><img src={{ asset('logo/comj-logo.png')}} alt='COMJ Logo' height="87" width="385" id="Logo"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              @role('male-manager|female-manager')
              <a class="dropdown-item" href="{{ route('manager.home') }}">Dashboard</a>
              @endrole
              @role('admin')
              <a class="dropdown-item" href="{{ route('admin.home') }}">Dashboard</a>
              <a class="dropdown-item" href="{{ route('role.create') }}">Add Roles</a>
              <a class="dropdown-item" href="{{ route('permission.create') }}">Add Permission</a>
              <a class="dropdown-item" href="{{ route('permission.assign') }}">Assign Permission to Role</a>
              @endrole
              <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
          </div>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
        @role('male-manager|male-officer|female-officer|female-manager|admin')
        <form class="form-inline my-md-0" method="POST" action="{{ route('student.search_result') }}">
          @csrf
          <input class="form-control" type="text" placeholder="Search" name="keyword">
        </form>
        @endrole
      </div>
    </div>
  </nav>
  @endif

  <div id="main">
    @yield('content')
  </div>

  <!-- Footer -->
  <footer class="footer">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© Copyright - College of Medicine - Jeddah</div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>

  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
  <script type="text/javascript" src="{{ asset('js/popper-min.js') }}"></script>
  <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->
  <script type="text/javascript" src="{{ asset('js/bootstrap-min.js') }}"></script>

  <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet"/>-->
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>-->
  <script type="text/javascript" src="{{ asset('js/bootstrap-select.js') }}"></script>

  <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>-->
  <script type="text/javascript" src="{{ asset('js/bootstrap-bundle-min.js') }}"></script>

  <script type="text/javascript" src="{{ asset('js/allApp.js') }}"></script>

</body>
</html>
