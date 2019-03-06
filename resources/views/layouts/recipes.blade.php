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

@include('includes.header')

<div class="container">
    <div class="content">
        <ul>
            @if (Auth::guest())
                <li>
                    <a href="{{ url('#') }}">Подписаться на новые рецепты</a>
                </li>
            @else
                <li class="dropdown">
                    <a href="{{ url('/user/'.Auth::id()) }}" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">Мой профиль ({{ Auth::user()->name }})<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ url('/cookbook/new-recipe') }}">Добавить рецепт</a>
                        </li>
                        <li>
                            <a href="{{ url('/user/'.Auth::id().'/recipes') }}">Мои рецепты</a>
                        </li>
                        <li>
                            <a href="{{ url('/cookbook/my-private-recipes') }}">Мои приватные рецепты</a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}">Выйти</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
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
        </div>
    </div>
</div>

@include('includes.newitems')

@include('includes.footer')

<script src="{{url(elixir('js/jquery.min.js'))}}"></script>
<script src="{{url(elixir('js/main.js'))}}"></script>

</body>
</html>