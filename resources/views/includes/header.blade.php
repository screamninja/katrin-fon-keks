<header class="@yield('header_class')">
    <div class="header-row">

        <div class="header-top-row">
            <div class="container">
                <div class="header-top-row-wrapper">
                    <div class="header-top-row-column">
                        <span class="user-phone">+7(905)295-05-22</span>
                        <span class="user-mail">katrinfonkeks@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom-row">
            <div class="container">
                <div class="header-bottom-row-wrapper">
                    <a href="/" class="page-logo">
                        <img src="image/logo-cat.png" alt="Катрин фон Кекс Лого" class="page-logo-cat">
                        <span class="page-logo-text">Катрин фон Кекс</span>
                    </a>

                    @yield('nav')

                    <div class="header-burger">
                        <div class="header-burger-line header-burger-line-top"></div>
                        <div class="header-burger-line header-burger-line-mid"></div>
                        <div class="header-burger-line header-burger-line-bot"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @yield('front')

</header>