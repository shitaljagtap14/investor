

<html>
<head>
    <title>Investor Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="{{ asset('assets/layout/styles/layout.css') }}" rel="stylesheet" type="text/css" media="all">
</head>
<style>
    body {
        background-image: url("public/assets/images/demo/backgrounds/logo.png");
    }
</style>
{{--<body id="top">--}}

<div class="wrapper row0">
    <div id="topbar" class="hoc clear">
        <div class="fl_right">
            <ul class="nospace inline pushright">
                <li><i class="fa fa-user"></i> <a href="{{ route('register') }}">Register</a></li>
                <li><i class="fa fa-sign-in"></i> <a href="{{ route('login') }}">Login</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="bgded overlay" style="background-image:url('{{ asset('assets/images/demo/backgrounds/logo.png')}}')">
    <div class="wrapper row1">
        <header id="header" class="hoc clear">
            <div id="logo" class="fl_left">
                <h1><a href="index.html">Investor Online</a></h1>
            </div>
        </header>
    </div>
    <div id="pageintro" class="hoc clear">
        <article>
            <h2 class="heading">Welcome to Investor Online </h2>
            <p>Take Our Quiz</p>
        </article>
    </div>


<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>

<script src="{{ asset('assets/layout/scripts/jquery.min.js')}}"></script>
<script src="{{ asset('assets/layout/scripts/jquery.backtotop.js')}}"></script>
<script src="{{ asset('assets/layout/scripts/jquery.mobilemenu.js')}}"></script>
</div>


</html>