@extends('layouts.article')

@section('main')
    <body>
        <div class="container">
            <a class="font-thin text-4xl hover:text-white" href="{{ route('root')}}">FREE TALK</a>
            <br><br>
            <div class="m-4 border border-gray-100 p-4 bg-gray-400 shadow-xl">
                <div class="mb-4">
                    <a class="px-2 rounded bg-green-500 hover:bg-green-400 text-green-100 text-2xl" href="{{ route('articles.create') }}">發表文章</a>
                </div>
                <div>
                    <!-- 以迴圈印出資料 -->
                    @foreach($articles as $article)
                        <div class="border-t border-gray-300 my-1 p-2 m-4 shadow-xl ">
                            <h2 class="font-bold text-lg">
                                <!-- 檢視文章 -->
                                <a class="hover:text-white" href="{{ route('articles.show', $article) }}">
                                    {{ $article->title }}
                                </a>
                            </h2>
                            <div class="flex">
                                <p class="text-gray-900">
                                    {{ $article->created_at }} 由 {{ $article->user->name }} 分享
                                </p>
                                <!-- 特定用戶登入才看到編輯刪除按鈕 -->
                                @if (Route::has('login'))
                                    @auth
                                        @if (isset(Auth::user()->id) && Auth::user()->id == $article->user_id)
                                        <div class="flex">
                                            <a class="ml-2 mr-2 px-2 rounded bg-blue-500 hover:bg-blue-400 text-blue-100" href="{{ route('articles.edit', $article) }}">編輯</a>
                                            <form action="{{ route('articles.destroy', $article) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="px-2 rounded bg-red-500 hover:bg-red-400 text-red-100" onclick="return confirm('您確認要刪除嗎？')">刪除</button>
                                            </form>
                                        </div>
                                        @endif
                                    @endauth
                                @endif
                            </div>
                        </div>
                    @endforeach
                    {{ $articles->links()}}
                </div>
            </div>
        </div>
    </body>
@endsection