@extends('layouts.app')

@section('content')
    <h1>Editar post</h1>

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PUT')

        <label>
            Título
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
            @error('title')<small>{{ $message }}</small>@enderror
        </label>

        <label>
            Contenido
            <textarea name="content" rows="8" required>{{ old('content', $post->content) }}</textarea>
            @error('content')<small>{{ $message }}</small>@enderror
        </label>

        <label>
            URL de la imagen (opcional)
            <input type="url" name="image_url" value="{{ old('image_url', $post->image_url) }}">
            @error('image_url')<small>{{ $message }}</small>@enderror
        </label>

        <button type="submit">Actualizar</button>
        <a href="{{ route('posts.show', $post) }}" role="button" class="secondary">Cancelar</a>
    </form>
@endsection
