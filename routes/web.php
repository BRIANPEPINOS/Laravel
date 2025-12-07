<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UserController;

// Home del blog (lista de posts)
Route::get('/', [PostController::class, 'index'])->name('home');

// Detalle de un post
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Comentarios públicos
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->name('comments.store');

// Rutas protegidas por login
Route::middleware(['auth'])->group(function () {

    // CRUD de posts: solo editor y admin
    Route::middleware(['role:editor,admin'])->group(function () {
        Route::resource('posts', PostController::class)->except(['index', 'show']);
    });

    // Gestión de usuarios: solo admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    });
});

// Rutas de autenticación de laravel/ui
Auth::routes();
