<?php


namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Muestra los comentarios y el formulario para agregar uno nuevo
    public function index($postId)
    {
        $post = Post::findOrFail($postId);
        return view('comments.index', compact('post'));
    }

    // Guarda un nuevo comentario
    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'publish_date' => now(), // Establece la fecha y hora actual
        ]);

        return redirect()->route('comments.index', $postId)->with('success', 'Comentario agregado exitosamente');
    }

    public function destroy($id)
    {
        // Encuentra el comentario por su ID
        $comment = Comment::findOrFail($id);

        // Verifica que el usuario autenticado sea el dueño del comentario
        if ($comment->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'No tienes permiso para eliminar este comentario.');
        }

        // Eliminar el comentario
        $comment->delete();

        // Redirigir al post con un mensaje de éxito
        return redirect()->route('home')->with('success', 'Comentario eliminado exitosamente.');
    }

}

