@extends('layouts.app')
@section('title', 'Listado de películas')

@section('content')
    <h1 class="title p-4">Listado de películas</h1>
    <div class="is-center">
        <div class="listado-peliculas">
            @foreach ($movies as $movie)
                <section class="section pelicula">
                    <div class="container">
                        <div class="columns is-centered">
                            <div class="column">
                                <div class="card">
                                    <div class="card-image">
                                        <figure class="image is-4by3">
                                            <img src={{ $movie->image_url }} alt="Movie Poster" style="object-fit:cover;">
                                        </figure>
                                    </div>
                                    <div class="card-content">
                                        <p class="title is-4">{{ $movie->name }}</p>
                                        <p class="subtitle is-6">Género:
                                            <a href="/peliculas?categoria={{ DB::table('categories')->where('id', $movie->category_id)->first()->name }}">
                                                {{ DB::table('categories')->where('id', $movie->category_id)->first()->name }}
                                            </a>
                                        </p>
                                        <p><a href="{{ route('movie.show', $movie->slug) }}">Ver detalles</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    </div>
@endsection
