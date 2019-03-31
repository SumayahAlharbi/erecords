@extends('layouts.template')
@section('content')
<section class="section" style="padding:50px;min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="CAS-tab" data-toggle="tab" href="#cas" role="tab" aria-controls="CAS Login" aria-selected="true">CAS Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="App Login" aria-selected="false">App Login</a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

          <div class="tab-pane active" id="cas" role="tabpanel" aria-labelledby="CAS-tab">
            <div class="card">
            <div class="card-body">
              <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                  <h5> Comming Soon </h5>
                  <h6> Login with KSAU-HS ID </h6>
                  <!--<a class="btn btn-primary btn-lg waves-effect waves-light" href="{{ url('cas/login')}}">{{ __('Login with KSAU-HS ID') }}</a>-->
                </div>
              </div>
            </div>
          </div>
        </div>
          <div class="tab-pane" id="login" role="tabpanel" aria-labelledby="login-tab">

            <div class="card">
              <div class="card-body">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                  @csrf

                  <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                      @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
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

                      <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>




      </div>


    </div>
  </div>
</div>
</section>
@endsection
