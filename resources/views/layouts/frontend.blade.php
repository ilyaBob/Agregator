<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Fantworld - фантастические аудиокниги</title>
    <meta name="charset" content="utf-8">
    <link href="{{asset('css/autotunespeed-cb47929c2a0e39b91d7fe555f25b98d1.css')}}" rel="stylesheet" media="screen">
    <meta name="title" content="Fantworld - фантастические аудиокниги">
    <meta name="description" content="У нас вы найдете только лучшие аудиокниги жанра фантастика и фэнтези различных авторов и декламаторов">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#303d4a">
    <link rel="icon" href="images/favicon.png" type="image/png">
<body class="modal-is-opened">

<div class="wrapper">

    <div class="wrapper-container wrapper-main d-flex fd-column">

        <header class="header d-flex ai-center vw100">
            <div class="header__search d-none">
                <form id="quicksearch" method="post">
                    <input type="hidden" name="do" value="search">
                    <input type="hidden" name="subaction" value="search">
                    <div class="header__search-box">
                        <input id="ajax_search" name="story" placeholder="Поиск по сайту..." type="text"
                               autocomplete="off">
                        <button type="submit" class="search-btn"><span class="fal fa-search"></span></button>
                    </div>
                </form>
            </div>
            <a href="/" class="logo header__logo">
                <div class="logo__title">FantWorld</div>
                <p class="logo__caption">фантастические аудиокниги</p>
            </a>
            <ul class="header__menu d-flex flex-grow-1 js-this-in-mobile-menu">
                <li><a href="/"><span class="fal fa-home"></span>Главная</a></li>
                <li><a href="/authors.html"><span class="fal fa-book"></span>Авторы</a></li>
                <li><a href="/voiced.html"><span class="fal fa-volume-up"></span>Исполнители</a></li>
                @can('view', auth()->user())
                <li><a style="color: #fdc01c" href="{{route('admin.index')}}">Админка</a></li>
                @endcan
            </ul>
            <div class="header__btn-search btn-icon js-toggle-search"><span class="fal fa-search"></span></div>

            @if(!auth()->user())
                <div class="btn-accent centered-content js-show-login">Войти</div>
            @else
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button style="background: none" type="submit" class="btn-accent centered-content logout">Выйти</button>
                </form>
            @endif


            <div class="header__btn-menu d-none js-show-mobile-menu"><span class="fal fa-bars"></span></div>
        </header>

        <div class="content flex-grow-1 cols d-flex">
            @if(isset($books))
                @include('includes.frontend.carousel')
            @endif

            @include('includes.frontend.aside')

            @yield('container')
        </div>

        <footer class="footer d-flex ai-center">
            <a href="https://fantworld.net/pravoobladatelyam.html"
               class="btn-accent centered-content">Правообладателям</a>

            <div class="footer__text flex-grow-1">
                © 2023 "Fantworld.net" Лучшие фантастические аудиокниги рунета слушать онлайн
            </div>
        </footer>
    </div>
</div>

@include('includes.frontend.login-form')

<style>
    .notaval {
        position: absolute;
        left: 5px;
        top: 5px;
        border-radius: 4px;
        background: #cc7914;
        color: #fff;
        font-size: 13px;
        padding: 3px 10px;
    }
</style>

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/scripts/frontend.js')}}"> </script>
</body>
</html>
