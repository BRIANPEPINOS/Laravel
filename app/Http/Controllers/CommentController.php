<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Solo validar contenido, ya que siempre habrá user logueado
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $data['post_id'] = $post->id;
        $data['user_id'] = auth()->id(); //  siempre hay usuario

        Comment::create($data);

        return back()->with('status', 'Comentario publicado');
    }
}
