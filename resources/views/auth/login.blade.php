@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    {{--<div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>--}}




                    <div class="login-bg ">
                        <div class="container ">
                            <div class="row justify-content-center " style="padding-bottom: 150px">
                                <div class="col-xl-10">
                                    <div class="form-input-content login-form">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="logo text-center">
                                                    <a href="#">
                                                        <img src="{{ URL::asset('/images/logo100.png') }}" alt="">
                                                    </a>
                                                </div>
                                                <h4 class="text-center mt-4">Log into Your Account</h4>

                                                <form method="POST" class="mt-5 mb-5" action="{{ route('login') }}">
                                                    @csrf

                                                    {{--<form class="mt-5 mb-5">--}}
                                                    {{--<div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" placeholder="Email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" placeholder="Password">
                                                    </div>--}}

                                                    <div class="form-group row">
                                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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

                                                    {{--<div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <div class="form-check p-l-0">
                                                                <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                                <label class="form-check-label ml-3" for="basic_checkbox_1">Check me out</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6 text-right"><a href="javascript:void()">Forgot Password?</a>
                                                        </div>
                                                    </div>--}}
                                                    <div class="text-center mb-4 mt-4">
                                                        <button type="submit" class="btn btn-primary">Sign in</button>
                                                    </div>
                                                </form>
                                                {{--<div class="text-center">
                                                    <h5 class="mb-5">Or with Login</h5>
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-facebook"><i class="fa fa-facebook"></i></a>
                                                        </li>
                                                        <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-twitter"><i class="fa fa-twitter"></i></a>
                                                        </li>
                                                        <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-linkedin"><i class="fa fa-linkedin"></i></a>
                                                        </li>
                                                        <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-google-plus"><i class="fa fa-google-plus"></i></a>
                                                        </li>
                                                    </ul>
                                                    <p class="mt-5">Dont have an account? <a href="javascript:void()">Register Now</a>
                                                    </p>
                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
{{--<script src="{{ URL::asset('/gleek/assets/plugins/common/common.min.js') }}"></script>
<!-- Custom script -->
<script src="{{ URL::asset('/gleek/main/js/custom.min.js') }}"></script>
<script src="{{ URL::asset('/gleek/main/js/settings.js') }}"></script>
<script src="{{ URL::asset('/gleek/main/js/gleek.js') }}"></script>--}}
