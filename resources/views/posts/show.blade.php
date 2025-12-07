@extends('layouts.app')

@section('content')
    <article>
        <header>
            <h1>{{ $post->title }}</h1>
            <p>
                Por {{ $post->user->name ?? 'Autor desconocido' }}
                · {{ $post->created_at->format('d/m/Y H:i') }}
            </p>
        </header>

          @if($post->image_url)
            <figure>
                <img src="{{ $post->image_url }}" alt="Imagen de {{ $post->title }}">
            </figure>
        @endif

        <p>{!! nl2br(e($post->content)) !!}</p>

        @auth
            @if(auth()->user()->isAdmin() || auth()->user()->isEditor())
                <footer style="margin-top: 1rem;">
                    <a href="{{ route('posts.edit', $post) }}">Editar</a>

                    <form method="POST"
                          action="{{ route('posts.destroy', $post) }}"
                          style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Eliminar publicación?')">
                            Eliminar
                        </button>
                    </form>
                </footer>
            @endif
        @endauth
    </article>

    <hr>

    <section>
        <h2>Comentarios ({{ $post->comments->count() }})</h2>

        @forelse($post->comments as $comment)
            <article>
                <header>
                    <strong>
                        @if($comment->user)
                            {{ $comment->user->name }}
                        @else
                            {{ $comment->guest_name ?? 'Invitado' }}
                        @endif
                    </strong>
                    · {{ $comment->created_at->format('d/m/Y H:i') }}
                </header>
                <p>{{ $comment->content }}</p>
            </article>
        @empty
            <p>Aún no hay comentarios. ¡Sé el primero en comentar!</p>
        @endforelse
    </section>

    <section>
        <h3>Nuevo comentario</h3>

        @auth
            <form method="POST" action="{{ route('comments.store', $post) }}">
                @csrf

                <label>
                    Comentario
                    <textarea name="content" rows="3" required>{{ old('content') }}</textarea>
                    @error('content')<small>{{ $message }}</small>@enderror
                </label>

                <button type="submit">Publicar comentario</button>
            </form>
        @else
            <article class="contrast">
                <p>Debes iniciar sesión para publicar un comentario.</p>
                <footer>
                    <a href="{{ route('login') }}">Ingresar</a>
                    <a href="{{ route('register') }}">Registrarse</a>
                </footer>
            </article>
        @endauth
    </section>
@endsection
