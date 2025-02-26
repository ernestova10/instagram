@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Bienvenido a Instagram</h1>

    <!-- Botón para crear un nuevo post -->
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Crear Post</a>
    
    <!-- Mostrar los posts -->
    @foreach ($posts as $post)
        <div class="post mb-4 text-center"> <!-- Centra el contenido dentro de cada post -->
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->description }}</p>

            <!-- Imagen centrada -->
            <div class="d-flex justify-content-center">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Imagen del post" style="max-width: 300px; height: auto;">
            </div>

            <p>{{ $post->n_likes }} likes</p>
            <p>{{ $post->comments->count() }} comentarios</p>

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
