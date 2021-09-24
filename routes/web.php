<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Models\Article;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('articles', ArticlesController::class);

Route::get('/', [ArticlesController::class, 'index'])->name('root');

Route::middleware(['auth:sanctum', 'verified'])->get('/userhome', function () {
    return view('userhome');
})->name('userhome');

Route::get('/userhome', function() {
    // 利用SQL WHERE印出用戶發表過的所有資料到HOME
    $articles = Article::where("user_id", Auth::user()->id)->orderByDesc('id')->paginate(5);
    return view('userhome', ['articles' => $articles]);
})->name('userhome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
