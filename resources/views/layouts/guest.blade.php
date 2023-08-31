<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://drive.google.com/uc?id=1vvEUs3JC-GYEWIUNZKiAO8gM-aMKkWAR">
    <title>Movienator - @yield('title')</title>
    <link rel="shortcut icon" href="https://drive.google.com/uc?id=1J0h-XO72QZiuFUbRwqTHvyBdTCvQed20" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body>
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
