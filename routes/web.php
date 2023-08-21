<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MoviesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [IndexController::class, 'index']);
Route::get("/peliculas?categoria={name}", [MoviesController::class, 'show'])->name("category.all");
Route::get("/peliculas/{slug}", [MoviesController::class, 'show'])->name("movie.show");
Route::get("/peliculas",[MoviesController::class, 'all'])->name("movies.all");