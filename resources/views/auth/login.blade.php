@extends('layouts.master')

@section('content')
<div class="container" style="flex:1; display: flex;">
    <div class="row" style="display:flex;">
        <div class="col-md-8 col-md-offset-2" style="width: 100%; margin: auto;">
            <div class="panel panel-default">
                <h1 id="signupModalTitle" style="text-align:center; color:#060b2b;">SIGN IN</h1>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('authenticate') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label" style="color: black;">@lang('auth.emailField')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block" style="color:#B70000;">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label" style="color:black;">@lang('auth.password')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block" style="color:#B70000;">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label style="color:black;">
                                        <input type="checkbox" name="remember" > @lang('auth.rememberMe')
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">@lang('auth.frogotYourPassword')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
