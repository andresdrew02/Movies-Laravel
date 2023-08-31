<?php

namespace App\Http\Controllers;

use App\Filters\ProfanityFilter;
use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function all(Request $request)
    {
        $comments = Comment::where('user_id', Auth::id())->paginate(10);
        return view('comments_all', [
            'comentarios' => $comments
        ]);
    }
    public function store(Request $request, String $slug)
    {
        //Comprueba la existencia de la pelicula
        $movie = Movie::where('slug', $slug)->first();
        if ($movie == null) {
            return response('No existe la pelicula', 404);
        }

        //valida los datos
        $validator = Validator::make($request->all(), [
            'comment' => ['required', 'min:4']
        ]);
        if ($validator->fails()) {
            return response($validator->errors()->toArray(), 400);
        }

        $profanity = ProfanityFilter::filter($request->comment);

        if ($profanity) {
            return response()->json(['profanity'=>'El comentario contiene palabras prohibidas'], 400);
        }
        $validatedData = $request->all();
        $comment = Comment::create([
            'movie_id' => $movie->id,
            'user_id' => Auth::id(),
            'comment' => $validatedData['comment']
        ]);

        return response($comment,200);
    }

    public function destroy(Request $request, Int $id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id != Auth::id())
        {
            return response('',403);
        }
        if ($comment->delete())
        {
            return response('/', 200);
        }
        return response('/',500);
    }
}
