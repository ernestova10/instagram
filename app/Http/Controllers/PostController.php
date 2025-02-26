<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        // Mostrar todos los posts, ordenados por fecha
        $posts = Post::orderBy('publish_date', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
        // Validar la entrada
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif,svg|max:2048',
        ]);

        // Subir la imagen si existe
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Crear el post
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'publish_date' => now(),
            'user_id' => Auth::id(),
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post creado con éxito');
    }

    public function destroy(Post $post) {
        // Verificar que el usuario sea el dueño del post
        if ($post->user_id == Auth::id()) {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post eliminado con éxito');
        }

        return redirect()->route('posts.index')->with('error', 'No puedes eliminar este post');
    }

     // Método para mostrar un post con los comentarios
     public function show($id)
     {
         $post = Post::with('comments.user')->findOrFail($id);
         return view('posts.show', compact('post'));
     }
 
     // Método para crear un comentario
     public function storeComment(Request $request, $postId)
     {
         $request->validate([
             'comment' => 'required|string|max:500',
         ]);
 
         $comment = new Comment();
         $comment->comment = $request->comment;
         $comment->user_id = Auth::id();
         $comment->post_id = $postId;
         $comment->save();
 
         return back()->with('success', 'Comentario agregado correctamente');
     }

    public function like(Post $post)
    {
         // Verifica si el usuario ya ha dado like
         if (!$post->likes()->where('user_id', auth()->id())->exists()) {
             $post->likes()->create([
                 'user_id' => auth()->id()
             ]);
         }
     
         return redirect()->back(); // Redirige a la misma página
     }
     
     public function unlike(Post $post)
     {
         // Buscar y eliminar el like del usuario autenticado
         $post->likes()->where('user_id', auth()->id())->delete();
     
         return redirect()->back(); // Redirige a la misma página
     }

}
