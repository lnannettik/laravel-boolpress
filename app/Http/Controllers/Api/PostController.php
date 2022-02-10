<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    // Post Archive

    public function index() {
        // return 'post JSON here';

        // senza paginazione 
        // $posts = Post::all();

        // con paginazione
        
        $posts = Post::paginate(3);

        return response()->json($posts);
    }
}
