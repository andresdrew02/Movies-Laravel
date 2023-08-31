@extends('layouts.app')
@section('title', 'Página principal')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>


@section('content')
    <style>
        .hero {
            height: 100vh;
            display: flex;
        }

        .hero-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            transform: translateY(-10%);
        }
    </style>
    <section class="hero purple hero-image">
        <div class="hero-body">
            <p class="title is-gapless has-text-white">
                Movienator
            </p>
            <p class="subtitle is-gapless has-text-white">
                Encuentra películas y opina sobre ellas con nuestra gran comunidad.
            </p>
            <a href="/register" class="button hero-button">Unirte a Movienator</a>
        </div>
    </section>

    <div class="content is-normal p-4 content-columnas">
        <h1>Últimas cinco categorías añadidas</h1>
        <div class="columnas">
            @foreach ($categories as $category)
                <div class="card columna">
                    <div class="card-content">
                        <p class="title">
                            {{ $category->name }}
                        </p>
                        <p class="subtitle no-gap">
                            {{ $category->description }}
                        </p>
                    </div>
                    <footer class="card-footer p-2">
                        <a href="{{ route('category.all', $category->name) }}" class="button is-info is-fullwidth">
                            Ver peliculas de
                            {{ strtolower($category->name) }}
                        </a>
                    </footer>
                </div>
            @endforeach
        </div>
    </div>

    <h1 class="p-4 title">Últimas cinco peliculas añadidas</h1>
    <!-- Slider main container -->
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            @foreach ($movies as $movie)
            <div class="swiper-slide" style="background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('{{ $movie->image_url }}'); background-size: cover;">
                <div style="display: flex; width:100%; height:100%; justify-content: center; align-items: center;">
                    <a href="{{ route('movie.show', $movie->slug) }}" class="title little-hover" style="color:white;"> {{$movie->name}}</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>


    <script>
        const swiper = new Swiper('.swiper', {
            direction: 'horizontal',
            loop: false,
            pagination: {
                el: '.swiper-pagination',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        });
    </script>
@endsection
