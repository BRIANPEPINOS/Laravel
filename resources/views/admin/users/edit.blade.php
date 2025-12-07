@extends('layouts.app')

@section('content')
    <h1>Editar rol de usuario</h1>

    <article>
        <p><strong>Usuario:</strong> {{ $user->name }} ({{ $user->email }})</p>
    </article>

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <label>
            Rol
            <select name="role" required>
                @foreach($roles as $role)
                    <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
            @error('role')<small>{{ $message }}</small>@enderror
        </label>

        <button type="submit">Guardar cambios</button>
        <a href="{{ route('admin.users.index') }}" role="button" class="secondary">Cancelar</a>
    </form>
@endsection
