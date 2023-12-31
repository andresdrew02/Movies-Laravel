@extends('layouts.app')
@section('title', 'Listado de películas')
<link rel="stylesheet" href="https://drive.google.com/uc?id=12IAn4T9eJTUVgSseD2j_1KQqc7_-g7d0">
<script src="https://cdn.tailwindcss.com"></script>
@section('content')
    <h1 class="title p-4">Listado de películas</h1>
    @include('./components.movie-filters')
    <div class="is-center">
        <div class="listado-peliculas @php if ($movies->count() == 0) echo 'flex justify-center items-center'; @endphp">
            @if ($movies->count() == 0)
                <h1 class="text-lg sm:text-2xl text-center title">No hay películas</h1>
            @endif
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
                                            @php
                                                $category = DB::table('categories')->where('id', $movie->category_id)->first()->name;
                                                echo '<a href="/peliculas?categoria=' . $category . '">' . $category . '</a>';
                                            @endphp
                                        </p>
                                        <p><a href="{{ route('movie.show', $movie->slug) }}" class="text-blue-600">Ver detalles</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    </div>
    <div class="paginator">
        {{ $movies->links() }}
    </div>
@endsection
