@extends('layouts.article')

@section('main')
    <div class="container">
        <a class="font-thin text-4xl hover:text-white" href="{{ route('root')}}">FREE TALK</a>
        <a class="font-thin text-3xl"> > {{ $article->title }}</a>
        <br><br>

        <div class="m-4 rounded-lg border border-gray-100 p-4 bg-gray-400 shadow-2xl">
            <a class="px-2 rounded bg-green-500 hover:bg-green-400 text-green-100 text-2xl" href="{{ route('articles.create') }}">發表文章</a>
            <br><br>
            <div class="flex">
                <h1 class="ml-2 mb-2 font-thin text-3xl text-gray-100">標題：</h1>
                <h1 class="ml-2 mb-2 font-thin text-3xl">{{ $article->title }}</h1>
            </div>
            <div class="flex">
                <p class="ml-2 font-thin fs-5 ">作者：</p>
                <p class="font-thin fs-5 text-red-600">{{ $article->user->name }}</p>
                <p class="ml-10 font-thin fs-5">時間：</p>
                <p class="font-thin fs-5">{{ $article->created_at }}</p>
                <p class="ml-10 font-thin fs-5">本文共獲得 {{ $collection->count() }} 個回覆</p>
            </div>
            <!-- 作者登入才看到編輯刪除按鈕 -->
            @if (Route::has('login'))
                @auth
                    @if (isset(Auth::user()->id) && Auth::user()->id == $article->user_id)
                    <div class="flex mt-2">
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
            <hr class="mt-4 mb-4">
            <div>
                <p class="ml-2 font-thin text-2xl text-gray-100 p-2">內文：</p>
            </div>
            <div>
                <pre class="ml-4 mr-4 text-lg p-2">{{ $article->content }}</pre>
            </div>
            <hr class="mt-4 mb-4">
            <div>
                <p class="ml-2 font-thin text-2xl text-gray-100 p-2">回覆</p>
            </div>
            <!-- 以迴圈印出回覆 -->
            <div class="container">
                @foreach($comments as $comment)
                    <div class="flex ml-4">
                        <!-- 所有人都可以檢視回覆 -->
                        @if($comment->user->name == $article->user->name)
                            <div class="text-red-600">{{ $comment->user->name }}</div>
                        @else
                            <div>{{ $comment->user->name }}</div>
                        @endif
                        ：
                        <p>{{ $comment->content }}</p>
                    </div>
                    <div class="text-right italic">{{ $comment->created_at }}</div>
                @endforeach
            </div>

                <hr class="mt-4 mb-4">
            @if (Route::has('login'))
                @auth
                <div>
                    <!-- 錯誤提示 -->
                    @if($errors->any())
                        <div class="errors p-3 bg-red-500 text-red-100 font-thin rounded">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="container-fluid" action="{{ route('articles.comments.store', $article->id) }}" method="post">
                        @csrf
                        <p>{{ Auth::user()->name }}：</p>
                        <div class="flex field my-2">
                            <textarea name="content" id="" cols="50" rows="1" class="container rounded-lg border border-gray-300 p-2" placeholder="請輸入回覆內容"></textarea>
                            <div class="actions">
                                <button type="submit" class="px-3 py-3 ml-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-nowrap">回覆</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="mt-4 mb-4">
                @else
                @endauth
            @endif
            <div>
                <a href="{{ route('root') }}" class="ml-2 px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">返回首頁</a>
            </div>
        </div>
    </div>
@endsection