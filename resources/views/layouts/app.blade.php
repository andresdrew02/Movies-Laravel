<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>Movienator - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('draw.png') }}" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>

<body>
    <div id="navbar">
        <div class="marca">
            <a href="/">
                <img src={{asset('logo.png')}} alt="Logo de movienator">
            </a>
        </div>
        <div class="links">
            <div class="link-effect-3" id="link-effect-3">
                <a href="/categorias" data-hover="Categorías">Categorías</a>
                <a href="/peliculas" data-hover="Peliculas">Peliculas</a>
                <a href="#" data-hover="Comentarios">Comentarios</a>
            </div>
            <div>
                <a href="#" class="button button-hover">Iniciar sesión</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(window).scroll(function() {
            if ($(document).scrollTop() > 50) {
                $('#navbar').addClass('nav-border-shadow');
            }else{
                $('#navbar').removeClass('nav-border-shadow');
            }
        })
    </script>
    <div class="contenido">
        @yield('content')
    </div>
    <footer class="footer">
        <div class="content has-text-centered">
            <p>
                Movienator - By <a href="https://github.com/andresdrew02" target="_blank">Andrés</a>
            </p>
        </div>
    </footer>
</body>

</html>
