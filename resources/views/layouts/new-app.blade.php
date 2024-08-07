<?php $url = config('app.url'); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MonMenu.io</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{--
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;700;800&display=swap"
        rel="stylesheet">
 --}}

    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;700;800&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;700;800&display=swap">
    </noscript>

    <link rel="shortcut icon" href="{{ $url }}img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ $url }}styles/css/vitrine.css">

    <meta name="description"
        content="Avec MonMenu.io vous aurez possibilité de mettre en ligne votre menu pour soit visible
    par tous et de n’importe ou. Gérer votre menu n’auras jamais été aussi simple !" />

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9Z9VHBG5H0"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-9Z9VHBG5H0');
    </script>


</head>

<style>
    .header .navbar {
        display: none;
    }

    ul#primary-menu {
        display: flex;
        gap: 20px;
    }

    ul#primary-menu a {
        text-decoration: none;
        color: #000;
    }

    @media(max-width:830px) {
        .vitrine .header .container {
            flex-direction: column;

        }

        ul#primary-menu {
            margin-top: 25px;
            font-size: 14px
        }


    }
</style>

<body class="vitrine">
    <header class="header">
        <div class="container">
            <figure class="header-logo">
                <a href="https://monmenu.io">
                    <img src="{{ $url }}img/vitrine/logo.svg" alt="Logo MonMenu.io" width="100px"
                        height="64px">
                </a>
            </figure>
            {{--
<nav class="navbar">
                <a href="mailto:hello@monmenu.io"><img src="{{ $url }}img/vitrine/Vector.svg" alt="Icon e-mail"
                        width="21px" height="15px"></a>
                <a href="tel:0620577532"><img src="{{ $url }}img/vitrine/Vector-1.svg" alt="Icon téléphone"
                        width="21px" height="15px"></a>
                <a href="{{ route('login') }}"><img src="{{ $url }}img/vitrine/Vector-2.svg"
                        alt="Icon mon compte" width="21px" height="15px"></a>
                <a href="https://monmenu.io/" target="_blank"><img src="{{ $url }}img/vitrine/shop.svg"
                        alt="Icon mon compte" width="21px" height="15px"></a>
            </nav>

                --}}
        </div>
    </header>
    <main class="main">
        @yield('app-content')
    </main>
    <footer class="footer">
        {{--
        <div class="container">
            <nav class="navbar">
                <a href="mailto:hello@monmenu.io"><img src="{{ $url }}img/vitrine/Vector-white.svg"
                        alt="Icon e-mail" width="21px" height="15px"></a>
                <a href="tel:0505050505"><img src="{{ $url }}img/vitrine/Vector-1-white.svg"
                        alt="Icon téléphone" width="21px" height="15px"></a>
                <a href="{{ route('login') }}"><img src="{{ $url }}img/vitrine/Vector-2-white.svg"
                        alt="Icon mon compte" width="21px" height="15px"></a>
            </nav>
            <figure class="footer-logo">
                <img src="{{ $url }}img/vitrine/logo-white.png" alt="Logo MonMenu.io">
            </figure>
            <div class="footer-links">
                <a href="#">CVU et CGV</a>
                <a href="#">Mentions légales</a>
            </div>
            <p class="footer-copyright">&copy; Copyright 2023 <a href="https://eurofrance-pub.com/" target="_blank">EURO
                    FRANCE PUB</a></p>
        </div>
        --}}
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $('.header').load('https://monmenu.io/ .header .container', function() {
            $('.header .navbar').css('display', 'flex');
        });
        $('.footer').load('https://monmenu.io/ .footer .container', () => {
            setTimeout(() => {
                const burger = document.querySelector('.burger');
                const menu = document.querySelector('.menu');

                burger.addEventListener('click', () => {
                    if (menu.getAttribute('id') === 'navbar-active') {
                        menu.removeAttribute('id');
                        menu.setAttribute('id', 'primary-menu');
                    } else {
                        menu.setAttribute('id', 'navbar-active');
                    }
                })
            }, 500);
        });
    </script>

    @yield('app-footer-js')
</body>

</html>
