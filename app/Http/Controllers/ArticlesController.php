<?php

namespace App\Http\Controllers;
use App\Models\Article;
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
        return view('articles.index', ['articles' => $articles]);
    }

    public function show($id) {
        $article = Article::find($id);
        return view('articles.show', ['article' => $article]);
    }

    public function create() {
        return view('articles.create');
    }

    public function store(Request $request) {
        $content = $request->validate([
            'title' => 'required',
            'content' => 'required|min:10'
        ]);
        
        //限制只有透過登入才能CREATE文章
        auth()->user()->articles()->create($content);
        return redirect()->route('root')->with('notice', '文章發表成功！');
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
            'title' => 'required',
            'content' => 'required|min:10'
        ]);

        $article->update($content);
        return redirect()->route('root')->with('notice', '文章更新成功！');
    }

    public function destroy($id) {
        //限制只有文章作者才能DELETE文章
        $article = auth()->user()->articles()->find($id);
        $article->delete();
        return redirect()->route('root')->with('notice', '文章已刪除！');
    }
}
