@extends('layouts.app')
@section('title', 'Listado de categorías')

@section('content')
    <div class="content is-normal p-4 content-columnas">
        <h1>Todas las categorías</h1>
        <div class="columnas">
            @foreach ($categories as $category)
                <div class="card columna">
                    <div class="card-content">
                        <a class="title category-title" href="{{ route('category.all', $category->name) }}">
                            {{ $category->name }}
                        </a>
                        <p class="subtitle no-gap">
                            {{ $category->description }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
