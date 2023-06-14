<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentsController extends Controller
{
    public function index()
    {
        try {
            $comments = Comment::query()->orderBy('created_at', 'desc')->paginate(10);
        } catch (\Exception $e) {
            abort(404);
        }
        return view('admin.comments', compact('comments'));
    }

    public function show(Comment $comment)
    {
        return view('admin.commentsShow', compact('comment'));
    }

    public function edit(Comment $comment)
    {
        try {
            $comment->active ? $comment->active = false : $comment->active = true;
            $comment->save();
        } catch (\Exception $e) {
            abort(404);
        }
        return to_route('adminIndex');
    }
}
