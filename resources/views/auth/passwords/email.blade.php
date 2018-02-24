@extends('layouts.public')

@section('page-title') {{ trans('titles.reset_password') }} @stop

@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Reset Password</p>
        <form role="form" method="POST" action="{{ url('password/email') }}">
            {!!  csrf_field() !!}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                       placeholder="Email" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        Send Password Reset Link
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
