<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener todos los posts, ordenados por fecha de publicación (más recientes primero)
        $posts = Post::latest()->get();

        // Pasar los posts a la vista
        return view('home', compact('posts'));
    }
}
