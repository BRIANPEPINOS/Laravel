@extends('layouts.app')

@section('content')
    <h1>Nuevo post</h1>

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <label>
            Título
            <input type="text" name="title" value="{{ old('title') }}" required>
            @error('title')<small>{{ $message }}</small>@enderror
        </label>

        <label>
            Contenido
            <textarea name="content" rows="8" required>{{ old('content') }}</textarea>
            @error('content')<small>{{ $message }}</small>@enderror
        </label>

         
        <label>
            URL de la imagen (opcional)
            <input type="url" name="image_url" value="{{ old('image_url') }}">
            @error('image_url')<small>{{ $message }}</small>@enderror
        </label>

        <button type="submit">Guardar</button>
        <a href="{{ route('home') }}" role="button" class="secondary">Cancelar</a>
    </form>
@endsection
