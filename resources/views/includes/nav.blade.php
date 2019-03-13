<nav class="header-nav">
    <ul class="header-menu">
        <li>
            <a class="header-link link-home" href="/">
                <svg class="header-icon-home">
                    <use xlink:href="{{ asset('image/svg/symbol-defs.svg#icon-home') }}"/>
                </svg>
            </a>
        </li>
        <li><a class="header-link header-link-special" href="#">Акции</a></li>
        <li class="header-dropdown">
            <a class="header-link header-link-dropdown" href="#">
                <span class="header-icon-dropdown"></span>
                Торты
            </a>
            <ul class="header-dropdown-menu">
                <li><a href="#">Свадебные</a></li>
                <li><a href="#">На День Рождения</a></li>
                <li><a href="#">Праздничные</a></li>
                <li><a href="#">Для Мужчин</a></li>
                <li><a href="#">Детские</a></li>
                <li><a href="#">Муссовые</a></li>
            </ul>
        </li>
        <li><a class="header-link" href="#">Капкейки</a></li>
        <li><a class="header-link" href="#">Десерты</a></li>
        <li><a class="header-link header-cake-icon" href="#"><span></span>Начинки</a></li>
        <li><a class="header-link" href="#">Портфолио</a></li>
        <li><a class="header-link header-link-bold" href="/cookbook">Рецепты от Катрин</a></li>
        <li><a class="header-link" href="/about">О нас</a></li>
        <li class="header-dropdown">
            <a class="header-link header-link-dropdown" href="#">
                @if(Auth::guest())
                    Кабинет
                @else
                    {{ Auth::user()->name }}
                @endif
            </a>
            <ul class="header-dropdown-menu">
                @if (Auth::guest())
                    <li><a href="/login">Войти</a></li>
                    <li><a href="/register">Зарегистрироваться</a></li>
                @else
                    <li><a href="{{ url('/user/'.Auth::id()) }}">Профиль</a></li>
                    <li><a href="/logout">Выйти</a></li>
                @endif
            </ul>
        </li>
    </ul>
</nav>