@extends('layouts.app')
@section('title', 'Viendo pelicula')

@section('content')
<div class="p-4">
  <button class="button is-info" onclick="history.back()">Volver atrás</button>
</div>
    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src={{ $movie->image_url }} alt="Movie Poster" style="object-fit:cover;">
                            </figure>
                        </div>
                        <div class="card-content">
                            <p class="title is-4">{{ $movie->name }}</p>
                            <p class="subtitle is-6">Género: <a
                                    href="/peliculas?categoria={{ $category->name }}">{{ $category->name }}<button
                                        class="button is-primary" onclick="history.back()">Volver atrás</button>
                                </a></p>
                            <p>Sinopsis: {{ $movie->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
