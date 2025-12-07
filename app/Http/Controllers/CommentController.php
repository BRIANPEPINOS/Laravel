<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $rules = [
            'content' => 'required|string',
        ];

        if (!auth()->check()) {
            $rules['guest_name'] = 'required|string|max:255';
            $rules['guest_email'] = 'nullable|email|max:255';
        }

        $data = $request->validate($rules);
        $data['post_id'] = $post->id;

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        Comment::create($data);

        return back()->with('status', 'Comentario publicado');
    }
}
