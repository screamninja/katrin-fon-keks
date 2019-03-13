<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('link')
    <link rel="stylesheet" href="{{url(elixir('fonts/stylesheet.css'))}}">
    <link rel="stylesheet" href="{{url(elixir('css/normalize.css'))}}">
    <link rel="stylesheet" href="{{url(elixir('css/main.css'))}}">
    <script src="https://use.fontawesome.com/aab054733b.js"></script>
    <link href="https://use.fontawesome.com/aab054733b.css" media="all" rel="stylesheet">
</head>
<body>

@include('includes.header')

@yield('content')

@include('includes.footer')

@yield('script')
<script src="{{url(elixir('js/jquery.min.js'))}}"></script>
<script src="{{url(elixir('js/main.js'))}}"></script>

</body>
</html>