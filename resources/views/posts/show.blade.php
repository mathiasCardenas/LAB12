@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p><small>Por: {{ $post->user->name }}</small></p>

    <!-- Sección de comentarios -->
    <div class="mt-5">
        <h3>Comentarios ({{ $post->comments->count() }})</h3>
        
        <!-- Formulario para agregar comentario -->
        @auth
        <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">Agregar comentario</label>
                <textarea name="content" class="form-control" rows="3" placeholder="Escribe tu comentario..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Comentar</button>
        </form>
        @else
        <div class="alert alert-info">
            <a href="{{ route('login') }}">Inicia sesión</a> para comentar.
        </div>
        @endauth

        <!-- Lista de comentarios -->
        @if($post->comments->count() > 0)
            @foreach ($post->comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-text">{{ $comment->content }}</p>
                        <p class="card-text">
                            <small class="text-muted">
                                Por: {{ $comment->user->name }} 
                                - {{ $comment->created_at->format('d/m/Y H:i') }}
                            </small>
                            @auth
                                @if ($comment->user_id === Auth::id())
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar comentario?')">Eliminar</button>
                                    </form>
                                @endif
                            @endauth
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-secondary">
                No hay comentarios aún. Sé el primero en comentar.
            </div>
        @endif
    </div>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Volver a Publicaciones</a>
</div>
@endsection