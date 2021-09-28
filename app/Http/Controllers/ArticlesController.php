<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    // 身份驗證
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index() {
        // 印出資料
        $articles = Article::with('user')->orderBy('id', 'desc')->paginate(10);
        $number = Comment::where('article_id', 21)->get();
        $collection = collect($number);
        return view('articles.index', ['articles' => $articles, 'collection' => $collection]);
    }

    public function show($id) {
        $article = Article::find($id);
        // 取出回覆資料
        $comments = Comment::where('article_id', $id)->with('user')->get();
        //計算回覆數量
        $number = Comment::where('article_id', $id)->get();
        $collection = collect($number);
        return view('articles.show', ['article' => $article, 'comments' => $comments, 'collection' => $collection]);
    }

    public function create() {
        return view('articles.create');
    }

    public function store(Request $request, $id) {
        $content = $request->validate([
            'title' => 'required|max:30',
            'content' => 'required|min:10'
        ]);
        
        //限制只有透過登入才能CREATE文章
        auth()->user()->articles()->create($content);
        return redirect('articles/'. $id)->with('notice', '文章發表成功！');
    }

    public function edit($id) {
        //限制只有文章作者才能EDIT文章
        $article = auth()->user()->articles->find($id);
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Request $request, $id) {
        //限制只有文章作者才能UPDATE文章
        $article = auth()->user()->articles->find($id);

        $content = $request->validate([
            'title' => 'required|max:30',
            'content' => 'required|min:10'
        ]);

        $article->update($content);
        return redirect('articles/'. $id)->with('notice', '文章更新成功！');
    }

    public function destroy($id) {
        //限制只有文章作者才能DELETE文章
        $article = auth()->user()->articles()->find($id);
        $article->delete();
        return redirect()->route('root')->with('notice', '文章已刪除！');
    }
}
