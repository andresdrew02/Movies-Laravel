<?php

namespace App\Http\Controllers;

use App\Filters\MoviesFilters;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function show($slug)
    {
        $movie = Movie::query()->where('slug', $slug)->first();
        $category = Category::query()->where("id", $movie->category_id)->first();
        $comments = Comment::query()->where("movie_id", $movie->id)->orderBy('created_at', 'desc')->paginate(10);
        if ($movie == null){
            abort(404);
        }
        return view('movies_show', [
            'movie' => $movie,
            'category' => $category,
            'comments' => $comments
        ]);
    }

    public function all(MoviesFilters $filters)
    {
        try {
            $movies = Movie::filter($filters)->orderBy('movies.created_at', 'desc')->paginate(5);
        }
        catch (\Exception $e){
            return view('movies_all',[
                'error' => 'Filtros no válidos',
                'movies' => Movie::query()->paginate(5)
            ]);
        }
        return view('movies_all', [
            'movies' => $movies
        ]);
    }
}
