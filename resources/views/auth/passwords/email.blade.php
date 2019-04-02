@extends('layouts.login')
@section('content')
<div class="login" style="background-image:url('logo/home.jpg')">

      <div class="card login-box">
      <div class="card-body">


                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf
                        <h3 class="box-title m-b-20">Reset Password</h3>
                        <div class="form-group">
                          <div class="col-xs-12">
                                <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group text-center m-t-20">
                          <div class="col-xs-12">
                                <button type="submit" class="btn btn-info btn-lg btn-block waves-effect waves-light">
                                    {{ __('Send Password Reset Link') }}
                                </button>

                                </div>
                            </div>

                            <div class="form-group ">
                              <div class="col-xs-12">

                                <i class="fas fa-arrow-left"></i><a class="btn btn-link text-success" href="{{ URL::previous() }}">
                                  {{ __('Back to login') }}
                                </a>
                              </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
@endsection
