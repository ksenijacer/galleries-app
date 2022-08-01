<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Gallery;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function show(Gallery $gallery) {
        $comments = $gallery->comments;
        return response(['comments' => $comments]);
    }

    public function store(CommentRequest $request) {
        $validated = $request->validated();

        $newComment = new Comment($validated);
        $newComment->user()->associate(Auth::user());
        $newComment->save();

        $newComment = $newComment->load('user');

        return response()->json($newComment);
    }

    public function destroy(Comment $comment) {

        $comment->delete();
        return response($comment);
    }
}
