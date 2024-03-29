@extends('auth.layouts.app')

@section('title')
    Mul-App | Login
@endsection

@section('content')

    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('landing') }}"><b>Mul</b>-App</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            @if (session('status'))
                <p class="login-box-msg">{{ session('status') }}</p>
            @else
                <p class="login-box-msg">Sign in to start your session</p>
            @endif

            <form class="fpms" action="{{ route('login') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group{{ $errors->has('username') ? ' has-error' : ' has-feedback' }}">
                    <input type="text" class="form-control"
                           placeholder="Username" name="username" value="{{ old('username') }}">
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
                    <input type="password" class="form-control" placeholder="Password"
                           name="password" value="{{ old('password') }}">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="bpms btn btn-primary btn-block btn-flat">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->

            {{--<a href="#">I forgot my password</a><br>--}}
            <a href="{{ route('register') }}" class="text-center">Register a new membership</a>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
  