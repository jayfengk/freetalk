<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CommentsController;
use App\Models\Article;

Route::resource('articles', ArticlesController::class);

Route::get('/', [ArticlesController::class, 'index'])->name('root');

Route::resource('articles.comments', CommentsController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/userhome', function () {
    return view('userhome');
})->name('userhome');

Route::get('/userhome', function() {
    // 利用SQL WHERE印出用戶發表過的所有資料到HOME
    $articles = Article::where("user_id", Auth::user()->id)->with('user')->orderByDesc('id')->paginate(5);
    return view('userhome', ['articles' => $articles]);
})->name('userhome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
