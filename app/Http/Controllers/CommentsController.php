<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request) {
        $content = $request->validate([
            'content' => 'required'
        ]);

        auth()->user()->article()->comments()->create($content);
        return redirect()->route('root')->with('notice', '回覆成功！');
    }

    public function show($id) {
        $comment = Comment::find($article_id);
        return view('articles.show', ['comment' => $comment]);
    }
}
