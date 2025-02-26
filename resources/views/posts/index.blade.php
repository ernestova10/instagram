@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-4">Crear Post</a>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Imagen del post">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                            <a href="#" class="btn btn-primary">Ver Post</a>
                            @if($post->user_id == auth()->id())
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
