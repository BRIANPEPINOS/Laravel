@extends('layouts.app')

@section('content')
    <h1>Publicaciones recientes</h1>

    <div class="post-grid">

        @foreach($posts as $post)
            <article class="post-card">

                {{-- IMAGEN DEL POST --}}
                @if($post->image_url)
                    <img src="{{ $post->image_url }}" alt="Imagen de {{ $post->title }}">
                @endif

                {{-- TITULO --}}
                <h3>
                    <a href="{{ route('posts.show', $post) }}">
                        {{ $post->title }}
                    </a>
                </h3>

                {{-- METADATA --}}
                <small>
                    Por {{ $post->user->name ?? 'Autor desconocido' }}
                    · {{ $post->created_at->format('d/m/Y H:i') }}
                </small>

                {{-- EXTRACTO DEL CONTENT --}}
                <p>
                    {{ Str::limit($post->content, 120) }}
                </p>

                {{-- BOTON LEER MÁS --}}
                <a href="{{ route('posts.show', $post) }}">Leer más</a>

            </article>
        @endforeach
    </div>

@endsection
