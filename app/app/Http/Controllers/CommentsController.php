<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'comment_text' => 'required|string|max:1000',
        ]);

        Auth::user()->comments()->create([
            'product_id' => $productId,
            'comment_text' => $request->comment_text,
        ]);

        return back()->with('success', 'Comment successfully added!');
    }

    public function destroy(Comment $comment)
    {

        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment successfully deleted!');
    }
}

