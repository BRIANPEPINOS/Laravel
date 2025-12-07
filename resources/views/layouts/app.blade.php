<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel Blog') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="container">
        <nav>
            <ul>
                <li><strong><a href="{{ route('home') }}">Laravel Blog</a></strong></li>
            </ul>
            <ul>
                @auth
                    @if(auth()->user()->isAdmin())
                        <li><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
                    @endif

                    @if(auth()->user()->isAdmin() || auth()->user()->isEditor())
                        <li><a href="{{ route('posts.create') }}">Nuevo Post</a></li>
                    @endif

                    <li>{{ auth()->user()->name }}</li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Salir</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Ingresar</a></li>
                    <li><a href="{{ route('register') }}">Registrarse</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main class="container">
        @if(session('status'))
            <article class="contrast">
                {{ session('status') }}
            </article>
        @endif

        @yield('content')
    </main>

    <footer class="container">
        <small>&copy; {{ date('Y') }} Laravel Blog - ESPE</small>
    </footer>
</body>
</html>
