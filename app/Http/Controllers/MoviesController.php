<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function show($slug)
    {
        return view('movies.show', ['id' => $slug]);
    }
}
