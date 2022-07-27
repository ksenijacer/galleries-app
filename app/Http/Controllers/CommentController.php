<?php

namespace App\Http\Controllers;
use App\Models\Gallery;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(Gallery $gallery) {
        $comments = $gallery->comments;
        return response(['comments' => $comments]);
    }

    public function store(Gallery $gallery, Request $request) {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);
        $comment = $gallery->comments()->create($request->all());
        $comment->user;
        return $comment;
    }

    public function destroy(Comment $comment) {
        return $comment->delete();
    }
}
