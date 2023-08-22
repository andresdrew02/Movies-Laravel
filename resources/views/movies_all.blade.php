@extends('layouts.app')
@section('title', 'Listado de películas')
<link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
<script src="https://cdn.tailwindcss.com"></script>
@section('content')
    <h1 class="title p-4">Listado de películas</h1>
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
                                            <a
                                                href="/peliculas?categoria={{ DB::table('categories')->where('id', $movie->category_id)->first()->name }}">
                                                {{ DB::table('categories')->where('id', $movie->category_id)->first()->name }}
                                            </a>
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
