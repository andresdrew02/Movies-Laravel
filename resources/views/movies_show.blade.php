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
                                <img src="{{ $movie->image_url }}" alt="Movie Poster" style="object-fit:cover;">
                            </figure>
                        </div>
                        <div class="card-content">
                            <p class="title is-4">{{ $movie->name }}</p>
                            <p class="subtitle is-6">Género: <a
                                    href="/peliculas?categoria={{ $category->name }}">{{ $category->name }}
                                </a></p>
                            <p>Sinopsis: {{ $movie->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container" id="comentarios">
            <h1 class="title">Comentarios de {{ $movie->name }}</h1>
            @if($comments->count() <= 0)
                <h2 class="subtitle">No hay comentarios de esta película, ¡se el primero en publicar!</h2>
            @endif
            @if(Auth::user())
                @include('./components.comment_form', ['movie' => $movie, 'user' => Auth::user()])
            @else
                <h2 class="subtitle">Para comentar, <a href="/login">inicia sesión</a> o <a href="/register">regístrate</a></h2>
            @endif
           @foreach($comments as $comment)
                <div class="box">
                    <article class="media">
                        <figure class="media-left">
                            <figure class="image is-64x64">
                                <img src="https://ui-avatars.com/api/?name={{$comment->user->name}}" alt="{{$comment->user->name}}" class="is-rounded">
                            </figure>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong>{{$comment->user->name}}</strong>
                                    <br>
                                        {{$comment->comment}}
                                    <br>
                                    <small>Publicado el {{date('d/m/Y', strtotime($comment->created_at))}}</small>
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
           @endforeach

        </div>
    </section>
@endsection
