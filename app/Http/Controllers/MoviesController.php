<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function show($slug)
    {
        $movie = Movie::query()->where('slug', $slug)->first();
        $category = Category::query()->where("id", $movie->category_id)->first();
        if ($movie == null){
            abort(404);
        }
        return view('movies_show', [
            'movie' => $movie,
            'category' => $category
        ]);
    }
    
    public function all(Request $request)
    {
        $categoria = $request->query('categoria');
        $movies = $categoria == null ? $movies = Movie::all() : 
            $movies = DB::table("movies")->join("categories", "categories.id", "=", "movies.category_id")
                ->whereRaw("lower(categories.name) like ?", ["%" . strtolower($categoria) . "%"])
                ->select("movies.*")->get();
        return view('movies_all', [
            'movies' => $movies
        ]);
    }
}
