<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function all()
    {
        $categories = Category::all();
        return view('categories_index', ['categories' => $categories]);
    }
}
