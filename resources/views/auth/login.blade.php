@extends('layouts.template')
@section('content')
<section class="login" style="background-image:url({{ asset('logo/home.jpg')}});min-height: 100vh;background-size: cover;
background-repeat: no-repeat;
background-position: center center;
height: 100%;
width: 100%;
padding: 8% 0;
position: fixed;">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card" style="  width: 350px;
      margin: 0 auto;">
      <div class="card-body">



        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
          @csrf

          <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
              <a class="btn btn-lg waves-effect waves-light btn-success btn-block" href="{{ url('cas/login')}}">{{ __('Login with KSAU-HS ID') }}</a>
            </div>
          </div>

          <hr>
          <h3 class="box-title m-b-20">Login</h3>

          <div class="form-group">
            <div class="col-xs-12">
              <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group ">
            <div class="col-xs-12">
              <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

              @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group ">
            <div class="col-xs-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                  {{ __('Remember Me') }}
                </label>
              </div>
              <i class="fas fa-lock"></i><a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
              </a>
            </div>
          </div>

          <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
              <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Login</button>
            </div>
          </div>


        </form>
      </div>
    </div>


  </div>
</div>
</div>
</section>
@endsection
