@extends('layouts.app')
@section('title', 'Viendo pelicula')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                            <p><strong>Sinopsis:</strong> {{ $movie->description }}</p>
                            <p><strong>Estrellas:</strong> {{ $movie->stars }}</p>
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
                <div class="box" id="{{$comment->id}}">
                    <article class="media" style="display:flex; justify-content: space-between; align-items: center">
                       <div style="margin-left:2em">
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
                       </div>
                        @if(Auth::user() && $comment->user_id == Auth::user()->id)
                            <button class="button is-ghost" title="Borrar comentario" onmousedown="deleteComment({{$comment->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" id="trashIcon"><style>#trashIcon{fill:#d20010}</style><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>
                            </button>
                        @endif
                    </article>
                </div>
           @endforeach
        </div>
        <div class="paginator">
            {{ $comments->links() }}
        </div>
    </section>

    <script>
        //Función que gestiona el borrado de un comentario mediante AJAX tanto de los comentarios del POST que correspondan al usuario como los que añada y se actualicen dinámicamente
        function deleteComment(id){
            if (!window.confirm('¿Está seguro de que desea borrar el comentario?')){
                return
            }
            const el = document.getElementById(id)
            el.scrollIntoView({
                behavior:"smooth"
            })
            el.remove()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax(`/comment/${id}`, {
                method: 'DELETE',
                error: function(){
                    window.alert('Ha ocurrido un error, inténtelo de nuevo mas tarde.')
                    location.reload()
                }
            })
        }
    </script>
@endsection
