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
    @include('../components.navbar')
    <div class="contenido">
        @include('../components.errors')
        @yield('content')
    </div>
   @include('../components.footer')
</body>
</html>
