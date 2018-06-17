<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: #F2B142;">
    <div id="app">

        <div class="container" style="margin-top: 200px;">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1 style="color: white;text-align:center;font-weight:bold;margin-bottom:30px;">SIGN IN</h1>
                    <div class="panel" style="width: 90%;margin:0 auto;position:relative;margin-bottom: 200px;">
                        <div style="
                            width: 0px;
                            height: 0px;
                            position: absolute;
                            top: -21px;
                            left: 50%;
                            border-left: 20px solid transparent;
                            border-right: 20px solid transparent;
                            border-bottom: 20px solid #ffffff;
                        "></div>
                        <div class="panel-body" style="padding:50px;">
                            <img src="/mesa.png" alt="MESA LOGO" style="width:100px;margin:0 auto;display:block;">
                            <h3 class="text-center" style="margin-bottom: 50px;">CHRL MANAGER</h3>
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label for="username" class="col-md-4 control-label">Username</label>

                                    <div class="col-md-6">
                                        <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>
                                        
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-md-offset-4" style="margin-top: 20px;">
                                        <a  href="{{ route('register') }}">Create an account</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>