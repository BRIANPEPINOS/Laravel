@extends('layouts.app')

@section('content')
    <h1>Publicaciones recientes</h1>

    @if($posts->isEmpty())
        <p>No hay publicaciones aún.</p>
    @else
        <section>
            @foreach($posts as $post)
                <article>
                    <header>
                        <h2>
                            <a href="{{ route('posts.show', $post) }}">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p>
                            Por {{ $post->user->name ?? 'Autor desconocido' }}
                            · {{ $post->created_at->format('d/m/Y H:i') }}
                        </p>
                    </header>
                    <p>{{ Str::limit($post->content, 200) }}</p>
                    <footer>
                        <a href="{{ route('posts.show', $post) }}">Leer más</a>
                    </footer>
                </article>
            @endforeach
        </section>

        {{ $posts->links() }}
    @endif
@endsection
