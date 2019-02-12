<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url(elixir('fonts/stylesheet.css'))}}">
    <link rel="stylesheet" href="{{url(elixir('css/normalize.css'))}}">
    <link rel="stylesheet" href="{{url(elixir('css/main.css'))}}">
    <script src="https://use.fontawesome.com/aab054733b.js"></script>
    <link href="https://use.fontawesome.com/aab054733b.css" media="all" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">DevUserLab Laravel Demo</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ url('/') }}">Главная</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li>
                        <a href="{{ url('/auth/login') }}">Логин</a>
                    </li>
                    <li>
                        <a href="{{ url('/auth/register') }}">Регистрация</a>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @if (Auth::user()->canPost())
                                <li>
                                    <a href="{{ url('/new-post') }}">Добавить пост</a>
                                </li>
                                <li>
                                    <a href="{{ url('/user/'.Auth::id().'/posts') }}">Мои посты</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ url('/user/'.Auth::id()) }}">Мой профиль</a>
                            </li>
                            <li>
                                <a href="{{ url('/auth/logout') }}">Выйти</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @if (Session::has('message'))
        <div class="flash alert-info">
            <p class="panel-body">
                {{ Session::get('message') }}
            </p>
        </div>
    @endif
    @if ($errors->any())
        <div class='flash alert-danger'>
            <ul class="panel-body">
                @foreach ( $errors->all() as $error )
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>@yield('title')</h2>
                    @yield('title-meta')
                </div>
                <div class="panel-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <p>Copyright © 2019 | <a href="http://screamnijna.info">Scream Ninja Dev</a></p>
        </div>
    </div>
</div>
@include('includes.footer')

<script src="{{url(elixir('js/jquery.min.js'))}}"></script>
<script src="{{url(elixir('js/main.js'))}}"></script>
</body>
</html>

{{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>--}}
