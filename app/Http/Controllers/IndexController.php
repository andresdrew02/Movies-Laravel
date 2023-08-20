<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        //primeras 5 categorias y peliculas
        $categories = Category::all()->sortByDesc('createdAt')->take(5);
        $movies = Movie::all()->sortByDesc('createdAt')->take(5);
        return view('movies_index', [
            'categories' => $categories,
            'movies' => $movies
        ]);
    }
}
