<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users= User::orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = ['lector', 'editor', 'admin'];

        return view('admin.users.edit', compact('user', 'roles'));
    }
    /**
     * Update the specified resource in storage.
     */
   // Actualizar rol
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => 'required|in:lector,editor,admin',
        ]);

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('status', 'Rol actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
