@extends('layouts.app')
@section('title', 'Página principal')

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
    <section class="hero is-primary">
        <div class="hero-body">
            <p class="title is-gapless">
                Movienator
            </p>
            <p class="subtitle is-gapless">
                Encuentra películas y opina sobre ellas con nuestra gran comunidad.
            </p>
            <button class="button hero-button">Unirte a Movienator</button>
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
                        <a href="{{ route('category.show', $category->id) }}" class="button is-info is-fullwidth">
                            Ver peliculas de
                            {{ strtolower($category->name) }}
                        </a>
                    </footer>
                </div>
            @endforeach
        </div>
    </div>

    <div class="content is-normal p-4 content-columnas">
        <h1>Últimas cinco películas añadidas</h1>
        <div class="columnas">
            @foreach ($movies as $movie)
                <div class="card columna">
                    <div class="card-content">
                        <p class="title">
                            {{ $movie->name }}
                        </p>
                        <p class="subtitle">
                            {{ $movie->description }}
                        </p>
                    </div>
                    <footer class="card-footer p-2">
                        <a href="{{ route('movie.show', $movie->slug) }}" class="button is-info is-fullwidth">
                            Ver detalles de {{ $movie->name }}
                        </a>
                    </footer>
                </div>
            @endforeach
        </div>
    </div>
@endsection
