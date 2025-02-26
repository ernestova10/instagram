@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Bienvenido a Instagram</h1>

    <!-- Botón para crear un nuevo post -->
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Crear Post</a>

    <!-- Mostrar los posts -->
    @foreach ($posts as $post)
        <div class="post mb-4 p-4 text-center rounded shadow-lg" style="background-color:rgb(255, 255, 255); border-radius: 10px;">
            <h3>{{ $post->user->name }}</h3>
            <p>{{ $post->description }}</p>

            <!-- Imagen centrada -->
            <div class="d-flex justify-content-center">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Imagen del post" style="max-width: 300px; height: auto; border-radius: 10px;">
            </div>

            <!-- Likes y Comentarios con mejor diseño -->
            <div class="post-stats mt-3 d-flex justify-content-center align-items-center gap-4">
                <!-- Likes -->
                <div class="post-stat-item">
                    <form action="{{ $post->likes->where('user_id', auth()->id())->count() == 0 ? route('posts.like', $post->id) : route('posts.unlike', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ $post->likes->where('user_id', auth()->id())->count() == 0 ? 'btn-danger' : 'btn-secondary' }}" style="border-radius: 50px; padding: 8px 15px;">
                            ❤️ {{ $post->likes->count() }}
                        </button>
                    </form>
                </div>

                <!-- Comentarios -->
                <div class="post-stat-item">
                    <span class="badge bg-info p-2" style="font-size: 16px; border-radius: 8px;">
                        💬 {{ $post->comments->count() }}
                    </span>
                </div>
            </div>

            <!-- Botón para ver comentarios -->
            <a href="{{ route('comments.index', $post->id) }}" class="btn btn-info mt-3">Ver comentarios</a>

            <!-- Mostrar el botón de eliminar solo si el post pertenece al usuario autenticado -->
            @if ($post->user_id === auth()->id())
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-2">Eliminar Post</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
@endsection
