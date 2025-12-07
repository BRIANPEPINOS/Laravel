@extends('layouts.app')

@section('content')
    <h1>Gestión de usuarios</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}">Cambiar rol</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
