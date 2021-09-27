<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, $id) {
        $request->validate([
            'content' => 'required'
        ]);

        $comment = new Comment;
        $comment->user_id = $request->user()->id;
        $comment->article_id = $id;
        $comment->content = $request->content;
        $comment->save();
        return redirect('articles/'. $id)->with('notice', '回覆發表成功！');
    }

    // public function show($id) {
    //     $comments = Comment::where("article_id", $id)->get();
    //     return view('articles.show', ['comments' => $comments]);
    // }
}

