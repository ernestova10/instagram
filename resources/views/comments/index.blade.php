@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Comentarios para el post</h1>

    <div class="post mb-4 text-center">
        <h3>{{ $post->title }}</h3>

        <!-- Mostrar la imagen del post -->
        <div class="d-flex justify-content-center mb-4">
            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="Imagen del post" style="max-width: 500px; height: auto;">
        </div>

        <!-- Mostrar los comentarios existentes -->
        <h4>Comentarios:</h4>
        <div class="comments-section">
            @foreach ($post->comments as $comment)
                <div class="comment mb-2">
                    <strong>{{ $comment->user->name }}:</strong>
                    <p>{{ $comment->comment }}</p>

                    <!-- Mostrar el botón de eliminar solo si el comentario pertenece al usuario autenticado -->
                    @if ($comment->user_id === auth()->id())
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este comentario?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar Comentario</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Formulario para agregar un nuevo comentario -->
        @auth
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="comment"></label>
                    <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Agregar comentario</button>
            </form>
        @else
            <p>Por favor, <a href="{{ route('login') }}">inicia sesión</a> para comentar.</p>
        @endauth
    </div>
</div>
@endsection
