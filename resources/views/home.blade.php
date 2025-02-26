@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Bienvenido a Instagram</h1>

    <!-- Botón para crear un nuevo post -->
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Crear Post</a>
    
    <!-- Mostrar los posts -->
    @foreach ($posts as $post)
        <div class="post mb-4 text-center"> <!-- Centra el contenido dentro de cada post -->
            <h3>{{ $nombre = $post->user->name }}</h3>
            <p>{{ $post->description }}</p>

            <!-- Imagen centrada -->
            <div class="d-flex justify-content-center">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Imagen del post" style="max-width: 300px; height: auto;">
            </div>

            <!-- Likes y Comentarios con un diseño más llamativo -->
            <div class="post-stats mt-3 d-flex justify-content-center">
                <!-- Likes -->
                <div class="post-stat-item mr-4">
                    <span class="badge bg-danger p-2">
                        ❤️ {{ $post->n_likes }}
                    </span>
                    
                </div>

                <!-- Comentarios -->
                <div class="post-stat-item ml-4">
                    <span class="badge bg-info p-2">
                        💬 {{ $post->comments->count() }}
                    </span>
                   
                </div>
            </div>

            <!-- Emoticono de comentario que redirige a la página de comentarios -->
            <a href="{{ route('comments.index', $post->id) }}" class="btn btn-info mt-3">Ver comentarios</a><br><br>

            <!-- Mostrar el botón de eliminar solo si el post pertenece al usuario autenticado -->
            @if ($post->user_id === auth()->id())
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar Post</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
@endsection
