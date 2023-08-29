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
            <div style="display:flex; align-items: center">
                @if (Auth::user())
                    <div>
                        <a href="{{ route('profile.edit') }}" class="button button-hover" style="display:flex; gap: .25em">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
                            {{ Auth::user()->name }}
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" value="Cerrar sesión" class="button is-danger cerrar-sesion"/>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="button button-hover">Iniciar sesión</a>
                @endif

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
        @if (isset($error))
            <div class="notification is-danger p-4 m-4">
                {{$error}}
            </div>
        @endif

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