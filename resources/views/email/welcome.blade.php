@extends('layouts.public')

@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Welcome to Invester.</p>
        <div class="links">
            We have sent a verification email to {{$user->email}}. Please check your mail click on the link to activate your account.
        </div>
    </div>
@stop
