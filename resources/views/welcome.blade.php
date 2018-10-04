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
    <img src={{ asset('logo/comj-logo.png')}} alt='COMJ Logo' height="87" width="385"/>
  </div>
  <div class="nav-right">
    @if (!Auth::check())
    <nav class="navbar" role="navigation">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
            <div class="col-lg-12">
              <div class="text-center">
                <h3><b>Admin Login</b></h3></div>
                <form method="POST" action="{{ route('admin.login.submit') }}" aria-label="{{ __('Login') }}">
                  @csrf

                  <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label text-md-right">{{ __('Username') }}</label>

                    <div class="col-md-6">
                      <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                      @if ($errors->has('username'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                      @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                          {{ __('Remember Me') }}
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </ul>
          </li>
        </ul>
      </nav>
      @else
      <nav class="navbar" role="navigation">
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="admin/home" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
              <a href="admin/logout">Logout</a>
            </ul>
          </li>
        </ul>
      </nav>
      @endif
    </div>
    <div class='search-center'>
      <form method="get" action="{{ route('student.search_result') }}" enctype="multipart/form-data" class="search">
        <input type="text" placeholder="Search.." name="keyword">
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
